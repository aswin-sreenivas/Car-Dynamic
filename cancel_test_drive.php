<?php
session_start();
$conn = new mysqli("localhost", "root", "", "toyota_showcase");

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['request_id'])) {
    $user_id = $_SESSION['user_id'];
    $request_id = $_POST['request_id'];

    // Check if the request exists and is pending
    $stmt = $conn->prepare("SELECT id FROM test_drive_requests WHERE id = ? AND user_id = ? AND status = 'Pending'");
    $stmt->bind_param("ii", $request_id, $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Delete the request
        $delete_stmt = $conn->prepare("DELETE FROM test_drive_requests WHERE id = ?");
        $delete_stmt->bind_param("i", $request_id);
        if ($delete_stmt->execute()) {
            header("Location: status.php");
            exit();
        } else {
            die("Error canceling request.");
        }
    } else {
        die("Invalid request or already processed.");
    }
} else {
    die("No request ID provided.");
}

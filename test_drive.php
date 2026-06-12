<?php
session_start();
$conn = new mysqli("localhost", "root", "", "toyota_showcase");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access. Please log in.");
}

$user_id = $_SESSION['user_id'];
$variant_id = intval($_POST['variant_id']);

// Prevent duplicate requests
$check_query = "SELECT id FROM test_drive_requests WHERE user_id = ? AND variant_id = ? AND status IN ('Pending', 'Accepted')";
$check_stmt = $conn->prepare($check_query);
$check_stmt->bind_param("ii", $user_id, $variant_id);
$check_stmt->execute();
$check_stmt->store_result();

if ($check_stmt->num_rows > 0) {
    die("You already have a pending or approved test drive request for this variant.");
}
$check_stmt->close();

// Insert new request
$insert = $conn->prepare("INSERT INTO test_drive_requests (user_id, variant_id, request_date, status) VALUES (?, ?, NOW(), 'Pending')");
$insert->bind_param("ii", $user_id, $variant_id);

if (!$insert->execute()) {
    die("Error submitting request: " . $insert->error);
}

$insert->close();
header("Location: index.php");
exit();
?>

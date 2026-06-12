<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "toyota_showcase");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die("Access Denied");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['request_id']) && isset($_POST['action'])) {
    $request_id = $_POST['request_id'];
    $action = $_POST['action'];

    if ($action === "accept") {
        $status = "approved";
    } elseif ($action === "reject") {
        $status = "rejected";
    } else {
        die("Invalid Action");
    }

    $update_query = "UPDATE test_drive_requests SET status='$status' WHERE id='$request_id'";
    if ($conn->query($update_query)) {
        header("Location: view_test_drives.php");
        exit();
    } else {
        die("Error updating status: " . $conn->error);
    }
} else {
    die("Invalid request.");
}
?>

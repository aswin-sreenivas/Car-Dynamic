<?php
session_start();
$conn = new mysqli("localhost", "root", "", "toyota_showcase");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Error: You must be logged in.");
}

$user_id = $_SESSION['user_id'];
$variant_id = intval($_POST['variant_id']);
$mobile = $conn->real_escape_string($_POST['mobile']);
$email = $conn->real_escape_string($_POST['email']);
$location = $conn->real_escape_string($_POST['location']);
$time = $conn->real_escape_string($_POST['time']);

// Insert request into database
$query = "INSERT INTO test_drive_requests (user_id, variant_id, mobile, email, location, preferred_time, status) 
          VALUES ('$user_id', '$variant_id', '$mobile', '$email', '$location', '$time', 'pending')";

if ($conn->query($query)) {
    header("Location: index.php");
    exit();
} else {
    die("Error: " . $conn->error);
}
?>

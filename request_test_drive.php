<?php
session_start();
$conn = new mysqli("localhost", "root", "", "toyota_showcase");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ensure variant_id is provided
if (!isset($_GET['variant_id'])) {
    die("Error: No variant selected.");
}

$variant_id = intval($_GET['variant_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Request Test Drive</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; text-align: center; }
        .container { max-width: 400px; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); }
        input, select, button { width: 90%; padding: 10px; margin: 10px 0; }
        button { background: #cc0000; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Schedule Your Test Drive</h2>
        <form action="submit_test_drive.php" method="POST">
            <input type="hidden" name="variant_id" value="<?= $variant_id ?>">

            <label>Mobile Number:</label>
            <input type="text" name="mobile" required>

            <label> Email:</label>
            <input type="email" name="email" required>

            <label> Preferred showroom:</label>
            <input type="text" name="location" required>

            <label> Preferred Time:</label>
            <input type="datetime-local" name="time" required>

            <button type="submit"> Submit Request</button>
        </form>
        <br>
        <a href="index.php"> Cancel</a>
    </div>
</body>
</html>

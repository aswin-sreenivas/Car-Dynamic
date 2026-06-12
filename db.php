<?php
$host = 'localhost';
$dbname = 'toyota_showcase';
$username = 'root';
$password = '';

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>

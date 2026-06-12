<?php
$conn = new mysqli("localhost", "root", "", "toyota_showcase");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $place = $_POST['place'];
    $password = $_POST['password'];

    // Insert user with default role as 'user'
    $query = "INSERT INTO users (username, email, mobile, place, password) 
              VALUES ('$username', '$email', '$mobile', '$place', '$password')";
    
    if ($conn->query($query)) {
        header("Location: login.php");
        exit();
    } else {
        $error = "Signup failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        form { width: 300px; margin: auto; }
        input { display: block; width: 100%; margin: 10px 0; padding: 10px; }
        button { padding: 10px; background: green; color: white; border: none; }
    </style>
</head>
<body>

<h2>Signup</h2>

<form method="post">
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="mobile" placeholder="Mobile Number" required>
    <input type="text" name="place" placeholder="Place" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Signup</button>
</form>

<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<p><a href="login.php">Already have an account? Login</a></p>

</body>
</html>

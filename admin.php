<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "toyota_showcase");

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_model'])) {
        $model_name = $conn->real_escape_string($_POST['model_name']);
        $image_url = $conn->real_escape_string($_POST['model_image_url']);
        $conn->query("INSERT INTO models (name, image_url) VALUES ('$model_name', '$image_url')");
    } elseif (isset($_POST['add_variant'])) {
        $model_id = (int)$_POST['model_id'];
        $variant_name = $conn->real_escape_string($_POST['variant_name']);
        $description = $conn->real_escape_string($_POST['description']);
        $price = (float)$_POST['price'];
        $image_url = $conn->real_escape_string($_POST['variant_image_url']);
        $conn->query("INSERT INTO variants (model_id, name, description, price, image_url) VALUES ('$model_id', '$variant_name', '$description', '$price', '$image_url')");
    } elseif (isset($_POST['delete_model'])) {
        $model_id = (int)$_POST['model_id'];
        $conn->query("DELETE FROM models WHERE id = '$model_id'");
    } elseif (isset($_POST['delete_variant'])) {
        $variant_id = (int)$_POST['variant_id'];
        $conn->query("DELETE FROM variants WHERE id = '$variant_id'");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Panel</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 600px; margin: auto; padding: 20px; }
        input, select, textarea { width: 100%; padding: 8px; margin: 5px 0; }
        button { background: blue; color: white; padding: 10px; border: none; cursor: pointer; }
        button:hover { opacity: 0.8; }
        nav {
            background: linear-gradient(to right, #cc0000, #990000);
            padding: 15px;
            text-align: center;
            position: sticky;
            top: 0;
            width: 100%;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        nav a { color: white; text-decoration: none; margin: 0 20px; font-weight: bold; font-size: 18px; transition: 0.3s; }
        nav a:hover { color: #ffcc00; }
    </style>
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="container">
        <h2>Admin Panel</h2>

        <h3>Add New Model</h3>
        <form method="post">
            <input type="text" name="model_name" placeholder="Model Name" required>
            <input type="text" name="model_image_url" placeholder="Model Image URL" required>
            <button type="submit" name="add_model">Add Model</button>
        </form>

        <h3>Add New Variant</h3>
        <form method="post">
            <select name="model_id" required>
                <option value="">Select Model</option>
                <?php
                $models = $conn->query("SELECT id, name FROM models");
                while ($row = $models->fetch_assoc()):
                ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php endwhile; ?>
            </select>
            <input type="text" name="variant_name" placeholder="Variant Name" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <input type="number" name="price" placeholder="Price" required>
            <input type="text" name="variant_image_url" placeholder="Variant Image URL" required>
            <button type="submit" name="add_variant">Add Variant</button>
        </form>

        <h3>Delete Model</h3>
        <form method="post">
            <select name="model_id" required>
                <option value="">Select Model</option>
                <?php
                $models->data_seek(0);
                while ($row = $models->fetch_assoc()):
                ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php endwhile; ?>
            </select>
            <button type="submit" name="delete_model" style="background: red;">Delete Model</button>
        </form>

        <h3>Delete Variant</h3>
        <form method="post">
            <select name="variant_id" required>
                <option value="">Select Variant</option>
                <?php
                $variants = $conn->query("SELECT v.id, v.name, m.name AS model_name FROM variants v JOIN models m ON v.model_id = m.id");
                while ($variant = $variants->fetch_assoc()):
                ?>
                    <option value="<?= $variant['id'] ?>"><?= $variant['model_name'] ?> - <?= $variant['name'] ?></option>
                <?php endwhile; ?>
            </select>
            <button type="submit" name="delete_variant" style="background: red;">Delete Variant</button>
        </form>

        <a href="view_test_drives.php">View Test Drives</a> |
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>

<?php
session_start();
$conn = new mysqli("localhost", "root", "", "toyota_showcase");

if (isset($_GET['name'])) {
    $model_name = $_GET['name'];
    $model = $conn->query("SELECT * FROM models WHERE name='$model_name'")->fetch_assoc();
    if (!$model) {
        die("Model not found");
    }

    $variants = $conn->query("SELECT * FROM variants WHERE model_id='{$model['id']}'");
} else {
    die("No model selected.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= htmlspecialchars($model['name']) ?></title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .variant-container { display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; margin-top: 20px; }
        .variant { width: 300px; padding: 15px; border: 1px solid #ddd; border-radius: 10px; text-align: center; }
        .variant img { width: 100%; border-radius: 10px; }
        .test-drive { background: red; color: white; padding: 10px; border: none; cursor: pointer; margin-top: 10px; }
        /* Navbar */
        nav {
            background: linear-gradient(to right, #cc0000, #990000);
            padding: 15px;
            text-align: center;
            position: sticky;
            top: 0;
            width: 100%;
            z-index: 100;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        nav a { color: white; text-decoration: none; margin: 0 20px; font-weight: bold; font-size: 18px; transition: 0.3s; }
        nav a:hover { color: #ffcc00; }
    </style>
</head>
<body>
<?php include("navbar.php");?>
    <h1><?php  $model1 = $conn->query("SELECT * FROM models WHERE name='$model_name'")->fetch_assoc(); echo $model1['name'];?></h1>
    <h2>Available Variants</h2>
    <div class="variant-container">
        <?php while ($variant = $variants->fetch_assoc()): ?>
            <div class="variant">
                <img src="<?= htmlspecialchars($variant['image_url']) ?>" alt="<?= htmlspecialchars($variant['name']) ?>">
                <h3><?= htmlspecialchars($variant['name']) ?></h3>
                <p><?= htmlspecialchars($variant['description']) ?></p>
                <p><strong>Price: </strong> $<?= htmlspecialchars($variant['price']) ?></p>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php
                    $user_id = $_SESSION['user_id'];
                    $variant_id = $variant['id'];

                    // Check if the user has already requested this variant
                    $existing_request = $conn->query("SELECT status FROM test_drive_requests WHERE user_id='$user_id' AND variant_id='$variant_id' AND status IN ('Pending', 'Accepted')")->fetch_assoc();
                    ?>

                    <?php if ($existing_request): ?>
                        <p><strong> Test drive request already submitted (<?= htmlspecialchars($existing_request['status']) ?>)</strong></p>
                    <?php else: ?>
                        <a href="request_test_drive.php?variant_id=<?= $variant_id ?>" class="test-drive">Request Test Drive</a>
                    <?php endif; ?>

                <?php else: ?>
                    <p><a href="login.php">Login to request a test drive</a></p>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>

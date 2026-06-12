<?php
include '../db.php';
if (!isset($_GET['name'])) {
    die("Model not specified.");
}
$model_name = $conn->real_escape_string($_GET['name']);
$result = $conn->query("SELECT * FROM models WHERE name='$model_name'");
$model = $result->fetch_assoc();
if (!$model) {
    die("Model not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($model['name']); ?> - Toyota Showcase</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <nav>
        <a href="../index.php">Home</a>
        <a href="../admin/login.php">Admin</a>
    </nav>

    <header>
        <h1><?php echo htmlspecialchars($model['name']); ?></h1>
    </header>

    <section class="model-details">
        <img src="<?php echo htmlspecialchars($model['image_url']); ?>" alt="<?php echo htmlspecialchars($model['name']); ?>">
        <p><?php echo htmlspecialchars($model['description']); ?></p>
        <iframe src="<?php echo htmlspecialchars($model['youtube_url']); ?>" allowfullscreen></iframe>
        <button>Apply for Test Drive</button>
    </section>

    <footer>
        <p>&copy; 2025 Toyota Showcase</p>
    </footer>
</body>
</html>

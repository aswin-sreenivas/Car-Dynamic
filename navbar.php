<?php
if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    session_start();
}

$conn = new mysqli("localhost", "root", "", "toyota_showcase");

$models = $conn->query("SELECT name FROM models LIMIT 5");
?>

<nav>
    <a href="index.php">Home</a>
    <?php if (!isset($_SESSION['user_id'])): ?>
        <a href="login.php">Login</a>
    <?php else: ?>
        <a href="logout.php">Logout</a>
        <a href="status.php">Status</a>
    <?php endif; ?>

    <a href="admin.php" style="background-color: #28a745; padding: 5px 10px; border-radius: 5px; color: white; text-decoration: none;">Admin Login</a>

    <?php while ($model = $models->fetch_assoc()): ?>
        <a href="model.php?name=<?= urlencode($model['name']) ?>">
            <?= htmlspecialchars($model['name']) ?>
        </a>
    <?php endwhile; ?>
</nav>

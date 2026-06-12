<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toyota Showcase</title>
    <style>
        /* General Styling */
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f8f9fa; color: #333; }
        
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

        /* Hero Section */
        .hero {
            background: url('https://global.toyota/pages/history/toyota_museum.jpg') no-repeat center/cover;
            height: 400px;
            width:103%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.8);
        }

        /* Models Section */
        .models-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            padding: 40px;
        }

        .model {
            width: 250px;
            padding: 15px;
            background: white;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
            cursor: pointer; /* Makes it feel clickable */
        }

        .model:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
        }

        .model img {
            width: 100%;
            border-radius: 10px;
            height: 150px;
            object-fit: cover;
        }

        .model p {
            font-size: 1.1em;
            font-weight: bold;
            margin-top: 10px;
            color: #cc0000;
        }

        /* Make whole div clickable */
        .model a {
            display: block;
            text-decoration: none;
            color: inherit;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 20px;
            background: #222;
            color: white;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <?php include("navbar.php");?>

    <!-- Hero Section -->
    <div class="hero">
        <div>
            <h1>Welcome to Toyota Showcase</h1>
            <p>Discover Toyota’s latest models, features, and book a test drive today.</p>
        </div>
    </div>

    <!-- Popular Models -->
    <section class="popular-models">
        <h2 style="text-align:center; color:#cc0000;"> Popular Toyota Models</h2>
        <div class="models-container">
            <?php 
            $conn = new mysqli("localhost", "root", "", "toyota_showcase");
            $models = $conn->query("SELECT * FROM models");
            while ($model = $models->fetch_assoc()): ?>
                <a href="model.php?name=<?= urlencode($model['name']) ?>" class="model">
                    <img src="<?= htmlspecialchars($model['image_url'] ?: 'https://via.placeholder.com/250') ?>" alt="<?= htmlspecialchars($model['name']) ?>">
                    <p><?= htmlspecialchars($model['name']) ?></p>
                </a>
            <?php endwhile; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        &copy; 2025 Toyota Showcase | All Rights Reserved.
    </footer>

</body>
</html>

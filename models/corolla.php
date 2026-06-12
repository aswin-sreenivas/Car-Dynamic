<?php
// Define Corolla variants as an array (this will later be in a database)
$corolla_models = [
    [
        "name" => "Corolla LE",
        "image" => "https://www.toyotaofboerne.com/assets/stock/colormatched_01/transparent/1280/cc_2024toc04_01_1280/cc_2024toc041927630_01_1280_040.png?timestamp=0001-01-01T00:00:00&bg-color=FFFFFF&width=800%20800w",
        "description" => "A fuel-efficient and stylish compact sedan with modern technology."
    ],
    [
        "name" => "Corolla SE",
        "image" => "https://www.crowntoyota.com/inventoryphotos/15590/5yfp4mce2sp224798/sp/1.png?timestamp=2025-01-25T19:43:19Z&bg-color=FFFFFF&width=800%20800w",
        "description" => "Sporty design with enhanced performance and advanced safety features."
    ],
    [
        "name" => "Corolla XSE",
        "image" => "https://hips.hearstapps.com/hmg-prod/images/2023-toyota-corolla-cross-hybrid-xse-195-64764b50353cb.jpg?crop=0.686xw:0.580xh;0.109xw,0.405xh&resize=700:*",
        "description" => "Premium interior, powerful engine, and high-end technology."
    ],
    [
        "name" => "Corolla Hybrid",
        "image" => "https://hips.hearstapps.com/hmg-prod/images/2023-corolla-hybrid-se-rubyflarepearl-008-1665768400.jpg?crop=0.667xw:1.00xh;0.219xw,0&resize=640:*",
        "description" => "Eco-friendly efficiency with excellent fuel economy."
    ],
    [
        "name" => "Corolla GR",
        "image" => "https://example.com/corolla_gr.jpg",
        "description" => "High-performance turbocharged engine for thrill-seekers."
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toyota Corolla Models</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }
        nav {
            background-color: #d71a28;
            padding: 15px;
            text-align: center;
            position: sticky;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 18px;
        }
        .container {
            width: 90%;
            margin: 20px auto;
            text-align: center;
        }
        h1 {
            color: #d71a28;
        }
        .model {
            display: flex;
            background: white;
            padding: 15px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            align-items: center;
        }
        .model img {
            width: 200px;
            border-radius: 10px;
            margin-right: 20px;
        }
        .model-info {
            text-align: left;
            flex: 1;
        }
        .test-drive-btn {
            background: #d71a28;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
        .test-drive-btn:hover {
            background: #a5121e;
        }
    </style>
</head>
<body>

    <nav>
        <a href="index.php">Home</a>
        <a href="corolla.php">Corolla</a>
        <a href="camry.php">Camry</a>
        <a href="rav4.php">RAV4</a>
    </nav>

    <div class="container">
        <h1>Toyota Corolla Models</h1>
        <p>Discover different Corolla variants and book a test drive today!</p>

        <?php foreach ($corolla_models as $model): ?>
            <div class="model">
                <img src="<?= $model['image'] ?>" alt="<?= $model['name'] ?>">
                <div class="model-info">
                    <h2><?= $model['name'] ?></h2>
                    <p><?= $model['description'] ?></p>
                    <button class="test-drive-btn">Book a Test Drive</button>
                </div>
            </div>
        <?php endforeach; ?>
        
    </div>

</body>
</html>

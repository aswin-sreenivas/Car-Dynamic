<?php
session_start();
$conn = new mysqli("localhost", "root", "", "toyota_showcase");

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user's test drive requests
$query = "SELECT t.id, v.name AS variant_name, m.name AS model_name, t.request_date, t.status 
          FROM test_drive_requests t
          JOIN variants v ON t.variant_id = v.id
          JOIN models m ON v.model_id = m.id
          WHERE t.user_id = ?
          ORDER BY t.request_date DESC";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Test Drive Requests</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; background: #f4f4f4; }
        .container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #cc0000; color: white; }
        .pending { color: orange; font-weight: bold; }
        .accepted { color: green; font-weight: bold; }
        .rejected { color: red; font-weight: bold; }
        .cancel-btn { background: #ff0000; color: white; padding: 5px 10px; border: none; cursor: pointer; }
        .cancel-btn:hover { background: darkred; }
        
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

<?php include("navbar.php"); ?>

<div class="container">
    <h2>🚗 My Test Drive Requests</h2>
    <table>
        <tr>
            <th>Model</th>
            <th>Variant</th>
            <th>Requested On</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['model_name']) ?></td>
                <td><?= htmlspecialchars($row['variant_name']) ?></td>
                <td><?= htmlspecialchars($row['request_date']) ?></td>
                <td class="<?= strtolower($row['status']) ?>"><?= htmlspecialchars($row['status']) ?></td>
                <td>
                    <?php if ($row['status'] == 'pending'): ?>
                        <form action="cancel_test_drive.php" method="POST" style="display:inline;">
                            <input type="hidden" name="request_id" value="<?= $row['id'] ?>">
                            <button type="submit" class="cancel-btn">Cancel</button>
                        </form>
                    <?php else: ?>
                        ❌ Cannot cancel
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="index.php">🏠 Back to Home</a>
</div>

</body>
</html>

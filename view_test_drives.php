<?php
session_start();
$conn = new mysqli("localhost", "root", "", "toyota_showcase");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Handle status update
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['request_id'], $_POST['status'])) {
    $request_id = intval($_POST['request_id']);
    $status = in_array($_POST['status'], ['Accepted', 'Rejected']) ? $_POST['status'] : 'Pending';

    $update = $conn->prepare("UPDATE test_drive_requests SET status = ? WHERE id = ?");
    $update->bind_param("si", $status, $request_id);
    
    if (!$update->execute()) {
        die("Error updating status: " . $update->error);
    }

    $update->close();
    header("Location: test_drive_requests.php");
    exit();
}

// Fetch test drive requests
$query = "SELECT t.id, u.username, v.name AS variant_name, m.name AS model_name, t.request_date, t.status, 
                 t.mobile, t.email, t.location, t.preferred_time
          FROM test_drive_requests t
          JOIN users u ON t.user_id = u.id
          JOIN variants v ON t.variant_id = v.id
          JOIN models m ON v.model_id = m.id
          ORDER BY t.request_date DESC";


$requests = $conn->query($query);
if (!$requests) {
    die("Error fetching requests: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Test Drive Requests</title>
    <style>
  <style>
    body { 
        font-family: Arial, sans-serif; 
        text-align: center; 
        background: #f4f4f4; 
        margin: 0;
        padding: 0;
    }

    .container { 
        max-width: 90%; 
        margin: 20px auto; 
        background: white; 
        padding: 20px; 
        border-radius: 10px; 
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); 
    }

    table { 
        width: 100%; 
        border-collapse: collapse; 
        margin-top: 20px; 
        background: white;
    }

    th, td { 
        border: 1px solid #ddd; 
        padding: 12px; 
        text-align: center; 
        font-size: 14px;
    }

    th { 
        background: #cc0000; 
        color: white; 
        font-size: 16px;
    }

    tr:nth-child(even) { 
        background: #f9f9f9; 
    }

    tr:hover { 
        background: #f1f1f1; 
    }

    button { 
        border: none; 
        padding: 8px 12px; 
        cursor: pointer; 
        border-radius: 5px; 
        font-size: 14px;
    }

    .accept-btn { 
        background: green; 
        color: white; 
    }

    .reject-btn { 
        background: red; 
        color: white; 
    }

    .back-link { 
        display: inline-block; 
        margin-top: 15px; 
        font-size: 16px; 
        text-decoration: none; 
        color: #cc0000; 
        font-weight: bold; 
    }

    .back-link:hover { 
        text-decoration: underline; 
    }

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

    nav a { 
        color: white; 
        text-decoration: none; 
        margin: 0 20px; 
        font-weight: bold; 
        font-size: 18px; 
        transition: 0.3s; 
    }

    nav a:hover { 
        color: #ffcc00; 
    }
</style>

    </style>
</head>
<body>
<?php include("navbar.php");?>
<div class="container">
    <h2>📋 Test Drive Requests</h2>
    <table>
        <tr>
            <th>User</th>
            <th>Model</th>
            <th>Variant</th>
            <th>Request On</th>
            <th>Mobile</th>
            <th>email</th>
            <th>showroom</th>
            <th>date and time</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $requests->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['username']) ?></td>
        <td><?= htmlspecialchars($row['model_name']) ?></td>
        <td><?= htmlspecialchars($row['variant_name']) ?></td>
        <td><?= htmlspecialchars($row['request_date']) ?></td>
        <td><?= htmlspecialchars($row['mobile']) ?></td>
<td><?= htmlspecialchars($row['email']) ?></td>
<td><?= htmlspecialchars($row['location']) ?></td>
<td><?= htmlspecialchars($row['preferred_time']) ?></td>

        <td>
            <?php
            $request_id = $row['id'];
            $status_query = $conn->query("SELECT status FROM test_drive_requests WHERE id='$request_id'");
            $status = $status_query->fetch_assoc()['status'];

            if ($status === 'Pending'): ?>
                <form action="update_test_drive.php" method="POST" style="display:inline;">
                    <input type="hidden" name="request_id" value="<?= $request_id ?>">
                    <button type="submit" name="action" value="accept" style="background: green; color: white; padding: 5px;">✅ Accept</button>
                    <button type="submit" name="action" value="reject" style="background: red; color: white; padding: 5px;">❌ Reject</button>
                </form>
            <?php else: ?>
                <strong><?= htmlspecialchars($status) ?></strong>
            <?php endif; ?>
        </td>
        <td>
    <?php 
    echo "<!-- Debug: Status is " . htmlspecialchars($status) . " -->"; // Debugging line

    if ($status === 'pending'): ?> 
        <form action="update_test_drive.php" method="POST" style="display:inline;">
            <input type="hidden" name="request_id" value="<?= $request_id ?>">
            <button type="submit" name="action" value="accept" style="background: green; color: white; padding: 5px;">✅ Accept</button>
            <button type="submit" name="action" value="reject" style="background: red; color: white; padding: 5px;">❌ Reject</button>
        </form>
    <?php else: ?>
        <strong><?= htmlspecialchars(ucfirst($status)) ?></strong> <!-- Show text instead of buttons -->
    <?php endif; ?>
</td>

    </tr>
<?php endwhile; ?>

    </table>
    <br>
    <a href="admin.php">🔙 Back to Admin Panel</a>
</div>

</body>
</html>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



require '../processes/db.php';

/* ---------- AUTH CHECK ---------- */
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$userId = $_SESSION['user_id'];
$role   = $_SESSION['role'] ?? 'client'; // SAFE fallback
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .box { border: 1px solid #ccc; padding: 15px; margin-bottom: 15px; }
        .admin { background: #f5f5f5; }
        .client { background: #eef7ff; }
    </style>
</head>
<body>

<h2>Dashboard</h2>

<?php if ($role === 'admin'): ?>

    <!-- ================= ADMIN DASHBOARD ================= -->
    <div class="box admin">
        <h3>Admin Panel</h3>

        <!-- TEMPORARY NOTE -->
        <p><em>Site creation disabled until tables exist.</em></p>
        <p>You are logged in as an admin.</p>
    </div>

<?php else: ?>

    <!-- ================= CLIENT DASHBOARD ================= -->
    <div class="box client">
        <h3>Client Panel</h3>
        <p>You are logged in as a client.</p>

        <?php
        /*
         This query FAILS if `sites` table does not exist.
         So we guard it.
        */

        try {
            $stmt = $pdo->prepare("SELECT * FROM sites WHERE user_id = ?");
            $stmt->execute([$userId]);
            $site = $stmt->fetch();

            if ($site) {
                echo "<p><strong>Site Name:</strong> " . htmlspecialchars($site['site_name']) . "</p>";
                echo "<p><strong>Status:</strong> " . htmlspecialchars($site['status']) . "</p>";
            } else {
                echo "<p>No site assigned yet.</p>";
            }

        } catch (PDOException $e) {
            echo "<p><strong>Note:</strong> Sites table not created yet.</p>";
        }
        ?>
    </div>

<?php endif; ?>

<br>
<a href="../logout.php">Logout</a>

</body>
</html>

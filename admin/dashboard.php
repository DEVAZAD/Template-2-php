<?php
require_once '../processes/db.php';


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}


$username = $_SESSION['username'] ?? 'User';
$role     = $_SESSION['role'] ?? 'client';


$totalProjects = 0;

if ($role === 'admin') {
    $stmt = $pdo->query("SELECT COUNT(*) FROM sites");
    $totalProjects = (int) $stmt->fetchColumn();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="dashboard-includes/navbar.css">
    <link rel="stylesheet" href="dashboard-includes/sidebar.css">

    <title>Dashboard</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }



        .stats {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .stat-box {
            flex: 1;
            background: white;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .stat-box h3 {
            margin-bottom: 10px;
            color: #333;
        }

        .stat-box p {
            font-size: 36px;
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>

<body>
    <!-- Navbar -->

    <?php include 'dashboard-includes/header.php'; ?>

    <!-- Sidebar -->
    <?php include 'dashboard-includes/sidebar.php'; ?>

    <!-- CONTENT -->
    <div class="content">
        <h2>Dashboard Overview</h2>

        <?php if ($role === 'admin'): ?>
            <div class="stats">
                <div class="stat-box">
                    <h3>Total Projects</h3>
                    <p><?= $totalProjects ?></p>
                </div>
            </div>
        <?php else: ?>
            <p>Welcome to your dashboard.</p>
        <?php endif; ?>
    </div>

</body>

</html>
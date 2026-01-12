<?php
require_once '../processes/db.php';

/*
Redirect to login if not authenticated
*/
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}


$username = $_SESSION['username'] ?? 'User';
$role     = $_SESSION['role'] ?? 'client';
$loginAt  = $_SESSION['login_time'] ?? time();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .navbar {
            background: #007bff;
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .container2 {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .btn {
            padding: 0.5rem 1rem;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn:hover {
            background: #c82333;
        }

        .left-sidebar {
            position: fixed;
            top: 70px;
            left: 0;
            width: 200px;
            height: 100%;
            background-color: #333;
            color: white;
            padding-top: 20px;
        }

        .sidebar-menu ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar-menu ul li {
            padding: 10px 20px;
            border-bottom: 1px solid #444;
        }

        .sidebar-menu ul li:hover {
            background-color: #444;
            cursor: pointer;
        }

        .sidebar-menu ul li a {
            color: white;
            text-decoration: none;
            display: block;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div>
            <a href="/pages/dashboard.php" class="logo" style="display: flex;">
                <img src="../assets/client/logo.png" alt="Logo" style="height:40px;">
                <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
            </a>
        </div>


        <a href="logout.php" class="btn">Logout</a>
    </nav>

    <div class="left-sidebar">
        <div class="sidebar-menu">
            <ul class="links">
                <li>Dashboard</li>
                <li><a href="/admin/create-site.php">Create new site</a></li>
                <li>Lorem, ipsum.</li>
                <li>Lorem, ipsum.</li>
            </ul>
        </div>

    </div>
    <div class="container2">

        <h2>Dashboard</h2>
        <p>You have successfully logged in to your account.</p>
        <p>This is a protected page that only logged-in users can access.</p>

        <div style="margin-top: 2rem;">
            <h3>Your Account Information</h3>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
            <p><strong>User ID:</strong> <?php echo $_SESSION['user_id']; ?></p>
            <p><strong>Login Time:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
        </div>
    </div>
</body>

</html>
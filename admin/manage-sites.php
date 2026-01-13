<?php
require_once '../processes/db.php';


if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: ../pages/login.php');
    exit;
}


$username = $_SESSION['username'] ?? 'User';
$role     = $_SESSION['role'] ?? 'client';


$stmt = $pdo->query(
    "SELECT id, site_slug, title, logo, created_at
     FROM sites
     ORDER BY created_at DESC"
);
$sites = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Manage Sites</title>

    <link rel="stylesheet" href="dashboard-includes/navbar.css">
    <link rel="stylesheet" href="dashboard-includes/sidebar.css">

    <style>
        .content {
            margin-left: 220px;
            padding: 2rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #f8f9fa;
        }

        img {
            height: 40px;
        }

        .btn {
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-edit {
            background: #007bff;
            color: #fff;
        }

        .btn-delete {
            background: #dc3545;
            color: #fff;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <?php include 'dashboard-includes/header.php'; ?>

    <!-- Sidebar -->
    <?php include 'dashboard-includes/sidebar.php'; ?>

    <!-- Content -->
    <div class="content">

        <h2>Manage Sites</h2>

        <?php if (empty($sites)): ?>
            <p>No sites found.</p>
        <?php else: ?>

            <table>
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($sites as $site): ?>
                        <tr>
                            <td>
                                <?php if (!empty($site['logo'])): ?>
                                    <img src="/uploads/logos/<?= htmlspecialchars($site['logo']) ?>" alt="Logo">
                                <?php endif; ?>
                            </td>

                            <td><?= htmlspecialchars($site['title']) ?></td>
                            <td><?= htmlspecialchars($site['site_slug']) ?></td>
                            <td><?= date('Y-m-d', strtotime($site['created_at'])) ?></td>

                            <td>
                                <a class="btn btn-edit"
                                    href="edit-site.php?id=<?= (int)$site['id'] ?>">
                                    Edit
                                </a>

                                <a class="btn btn-delete"
                                    href="delete-site.php?id=<?= (int)$site['id'] ?>"
                                    onclick="return confirm('Are you sure you want to delete this site?')">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php endif; ?>

    </div>

</body>

</html>
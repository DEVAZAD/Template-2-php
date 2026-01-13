<?php
require_once '../processes/db.php';

/*
|--------------------------------------------------------------------------
| Admin Guard
|--------------------------------------------------------------------------
*/
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: ../pages/login.php');
    exit;
}

/*
|--------------------------------------------------------------------------
| Fetch all sites
|--------------------------------------------------------------------------
*/
$stmt = $pdo->query("
    SELECT id, site_slug, title, logo, created_at
    FROM sites
    ORDER BY created_at DESC
");
$sites = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Manage Sites</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }

        .container {
            max-width: 1000px;
            margin: 2rem auto;
            background: white;
            padding: 2rem;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
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
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }

        .btn-edit {
            background: #007bff;
            color: white;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
        }
    </style>
</head>

<body>

    <div class="container">
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
                                <?php if ($site['logo']): ?>
                                    <img src="/uploads/logos/<?= htmlspecialchars($site['logo']) ?>">
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
                                    onclick="return confirm('Delete this site?')">
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
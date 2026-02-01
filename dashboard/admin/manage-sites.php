<?php
require_once '../db.php';

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: ../login.php');
    exit;
}

$username = $_SESSION['username'] ?? 'User';
$role     = $_SESSION['role'] ?? 'client';

$stmt = $pdo->query(
    "SELECT id, site_slug, title, logo
     FROM sites
     ORDER BY id DESC"
);
$sites = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Sites</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- Header -->
    <?php include '../dashboard-includes/header.php'; ?>

    <!-- Sidebar (independent) -->
    <?php include '../dashboard-includes/sidebar.php'; ?>

    <!-- Content -->
    <main class="container-fluid py-4" style="padding-left:220px;">

        <h3 class="mb-4">Manage Sites</h3>

        <?php if (empty($sites)): ?>
            <div class="alert alert-secondary">
                No sites found.
            </div>
        <?php else: ?>

            <div class="card shadow-sm">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">
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
                                            <img
                                                src="/uploads/logos/<?= htmlspecialchars($site['logo']) ?>"
                                                alt="Logo"
                                                style="height:40px;">
                                        <?php else: ?>
                                            <span class="text-muted">—</span>
                                        <?php endif; ?>
                                    </td>

                                    <td><?= htmlspecialchars($site['title']) ?></td>
                                    <td><?= htmlspecialchars($site['site_slug']) ?></td>

                                    <!-- Fake "Created" column using ID -->
                                    <td>#<?= (int)$site['id'] ?></td>

                                    <td>
                                        <a href="edit-site.php?id=<?= (int)$site['id'] ?>"
                                            class="btn btn-sm btn-primary me-1">
                                            Edit
                                        </a>

                                        <a href="delete-site.php?id=<?= (int)$site['id'] ?>"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this site?')">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>

        <?php endif; ?>

    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
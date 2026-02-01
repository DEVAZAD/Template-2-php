<?php
require_once '../db.php';

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'] ?? 'user';
$role     = $_SESSION['role'] ?? 'client';

/* Stats */
$totalSites   = (int) $pdo->query("SELECT COUNT(*) FROM sites")->fetchColumn();
$totalClients = (int) $pdo->query("SELECT COUNT(*) FROM users WHERE role='client'")->fetchColumn();
$totalAdmins  = (int) $pdo->query("SELECT COUNT(*) FROM users WHERE role='admin'")->fetchColumn();

/* Latest sites */
$latestSites = $pdo->query(
    "SELECT id, title, site_slug
     FROM sites
     ORDER BY id DESC
     LIMIT 5"
)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <?php include '../dashboard-includes/header.php'; ?>
    <?php include '../dashboard-includes/sidebar.php'; ?>

    <!-- CONTENT -->
    <main class="container-fluid py-4" style="padding-left:220px;">

        <h3 class="mb-4">Admin Dashboard</h3>

        <!-- STATS -->
        <div class="row g-3 mb-4">

            <div class="col-md-4">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <h6 class="text-muted">Total Sites</h6>
                        <h2 class="fw-bold text-primary"><?= $totalSites ?></h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <h6 class="text-muted">Clients</h6>
                        <h2 class="fw-bold text-success"><?= $totalClients ?></h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <h6 class="text-muted">Admins</h6>
                        <h2 class="fw-bold text-warning"><?= $totalAdmins ?></h2>
                    </div>
                </div>
            </div>

        </div>

        <!-- LATEST SITES -->
        <div class="card shadow-sm">
            <div class="card-header fw-semibold">
                Latest Sites
            </div>

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!$latestSites): ?>
                            <tr>
                                <td colspan="3" class="text-center text-muted">
                                    No sites found
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($latestSites as $site): ?>
                                <tr>
                                    <td><?= htmlspecialchars($site['title']) ?></td>
                                    <td><?= htmlspecialchars($site['site_slug']) ?></td>
                                    <td>
                                        <a href="edit-site.php?id=<?= (int)$site['id'] ?>"
                                            class="btn btn-sm btn-primary">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
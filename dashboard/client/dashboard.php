<?php
require_once '../db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userId  = $_SESSION['user_id'];
$username = $_SESSION['username'] ?? 'User';
$role     = $_SESSION['role'] ?? 'client';

$stmt = $pdo->prepare(
    "SELECT * FROM sites WHERE client_id = ? LIMIT 1"
);
$stmt->execute([$userId]);
$site = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <?php include '../dashboard-includes/header.php'; ?>
    <?php include '../dashboard-includes/sidebar.php'; ?>

    <main class="container-fluid py-4" style="padding-left:220px;">

        <h3 class="mb-4">Dashboard Overview</h3>

        <?php if ($role === 'client'): ?>

            <?php if (!$site): ?>

                <div class="alert alert-warning">
                    <strong>No site assigned.</strong><br>
                    Your website has not been created yet.
                </div>

            <?php else: ?>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="mb-2"><?= htmlspecialchars($site['title']) ?></h4>

                        <p class="text-muted mb-1">
                            Slug: <strong><?= htmlspecialchars($site['site_slug']) ?></strong>
                        </p>

                        <?php if (!empty($site['description'])): ?>
                            <p><?= nl2br(htmlspecialchars($site['description'])) ?></p>
                        <?php endif; ?>

                        <a href="edit-site.php" class="btn btn-primary">
                            Edit My Site
                        </a>
                    </div>
                </div>

            <?php endif; ?>

        <?php else: ?>

            <div class="alert alert-primary">
                Welcome, <strong><?= htmlspecialchars($username) ?></strong>.
            </div>

        <?php endif; ?>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
require_once '../db.php';

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'client') {
    header('Location: ../login.php');
    exit;
}

$userId  = $_SESSION['user_id'];
$errors  = [];
$success = '';

$username = $_SESSION['username'] ?? 'client';
$role     = $_SESSION['role'] ?? 'client';

/* Fetch client's site */
$stmt = $pdo->prepare(
    "SELECT * FROM sites WHERE client_id = ? LIMIT 1"
);
$stmt->execute([$userId]);
$site = $stmt->fetch(PDO::FETCH_ASSOC);

/* Update only if site exists */
if ($site && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $title     = trim($_POST['title'] ?? '');
    $desc      = trim($_POST['description'] ?? '');
    $phone     = trim($_POST['phone'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $facebook  = trim($_POST['facebook'] ?? '');

    if ($title === '') {
        $errors[] = 'Title is required';
    }

    /* Optional logo upload */
    $logoName = $site['logo'];
    if (!empty($_FILES['logo']['name']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {

        $dir = __DIR__ . '/../uploads/logos/';
        is_dir($dir) || mkdir($dir, 0755, true);

        $ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
        $logoName = uniqid('logo_', true) . '.' . $ext;

        move_uploaded_file($_FILES['logo']['tmp_name'], $dir . $logoName);
    }

    if (!$errors) {
        $stmt = $pdo->prepare(
            "UPDATE sites SET
                title = ?,
                description = ?,
                logo = ?,
                phone = ?,
                email = ?,
                facebook = ?
             WHERE client_id = ?"
        );

        $stmt->execute([
            $title,
            $desc,
            $logoName,
            $phone,
            $email,
            $facebook,
            $userId
        ]);

        $success = 'Site updated successfully';

        /* Refresh site data */
        $stmt = $pdo->prepare(
            "SELECT * FROM sites WHERE client_id = ? LIMIT 1"
        );
        $stmt->execute([$userId]);
        $site = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit My Site</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <?php include '../dashboard-includes/header.php'; ?>
    <?php include '../dashboard-includes/sidebar.php'; ?>

    <!-- CONTENT -->
    <main class="container-fluid py-4" style="padding-left:220px; max-width:900px;">

        <h3 class="mb-4">My Site</h3>

        <?php if (!$site): ?>

            <!-- NO SITE ASSIGNED -->
            <div class="alert alert-warning">
                <strong>No site assigned.</strong><br>
                Your website has not been created yet.
                Please contact the admin.
            </div>

        <?php else: ?>

            <!-- ERRORS -->
            <?php foreach ($errors as $e): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($e) ?></div>
            <?php endforeach; ?>

            <!-- SUCCESS -->
            <?php if ($success): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php endif; ?>

            <!-- EDIT FORM -->
            <form method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">

                <div class="mb-3">
                    <label class="form-label">Site Title</label>
                    <input type="text"
                        name="title"
                        class="form-control"
                        value="<?= htmlspecialchars($site['title']) ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description"
                        class="form-control"
                        rows="4"><?= htmlspecialchars($site['description']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Logo (optional)</label>
                    <input type="file" name="logo" class="form-control">
                    <?php if ($site['logo']): ?>
                        <small class="text-muted d-block mt-1">
                            Current logo: <?= htmlspecialchars($site['logo']) ?>
                        </small>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text"
                        name="phone"
                        class="form-control"
                        value="<?= htmlspecialchars($site['phone']) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email"
                        name="email"
                        class="form-control"
                        value="<?= htmlspecialchars($site['email']) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Facebook URL</label>
                    <input type="url"
                        name="facebook"
                        class="form-control"
                        value="<?= htmlspecialchars($site['facebook']) ?>">
                </div>

                <button class="btn btn-primary w-100">
                    Update Site
                </button>
            </form>

        <?php endif; ?>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
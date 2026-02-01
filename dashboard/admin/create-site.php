<?php
require_once '../db.php';

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: ../login.php');
    exit;
}

$errors = [];
$success = '';

$username = $_SESSION['username'] ?? 'client';
$role     = $_SESSION['role'] ?? 'client';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Collect inputs
    $data = [
        'title'     => trim($_POST['title'] ?? ''),
        'slug'      => trim($_POST['slug'] ?? ''),
        'desc'      => trim($_POST['description'] ?? ''),
        'phone'     => trim($_POST['phone'] ?? ''),
        'email'     => trim($_POST['email'] ?? ''),
        'facebook'  => trim($_POST['facebook'] ?? ''),
        'client_id' => (int) ($_POST['client_id'] ?? 0),
    ];

    // Basic validation
    if ($data['title'] === '' || $data['slug'] === '' || $data['client_id'] <= 0) {
        $errors[] = 'Title, URL, and Client are required';
    }

    // Clean slug
    $slug = strtolower($data['slug']);
    $slug = preg_replace('#^https?://|^www\.#', '', $slug);
    $slug = explode('.', $slug)[0];

    if (!preg_match('/^[a-z0-9-]+$/', $slug)) {
        $errors[] = 'Invalid site URL';
    }

    // One site per client
    if (!$errors) {
        $stmt = $pdo->prepare("SELECT 1 FROM sites WHERE client_id = ?");
        $stmt->execute([$data['client_id']]);
        if ($stmt->fetch()) {
            $errors[] = 'This client already has a site';
        }
    }

    // Optional logo upload
    $logo = null;
    if (!empty($_FILES['logo']['name']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        $dir = __DIR__ . '/../uploads/logos/';
        is_dir($dir) || mkdir($dir, 0755, true);

        $ext  = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
        $logo = uniqid('logo_', true) . '.' . $ext;
        move_uploaded_file($_FILES['logo']['tmp_name'], $dir . $logo);
    }

    // Insert
    if (!$errors) {
        $stmt = $pdo->prepare(
            "INSERT INTO sites
            (site_slug, title, description, logo, phone, email, facebook, client_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );

        $stmt->execute([
            $slug,
            $data['title'],
            $data['desc'],
            $logo,
            $data['phone'],
            $data['email'],
            $data['facebook'],
            $data['client_id']
        ]);

        $success = 'Site created successfully';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Create Site</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <?php include '../dashboard-includes/header.php'; ?>
    <?php include '../dashboard-includes/sidebar.php'; ?>

    <div class="container mt-4" style="padding-left:220px; max-width:700px;">

        <h3 class="mb-4">Create Site</h3>

        <?php foreach ($errors as $e): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($e) ?></div>
        <?php endforeach; ?>

        <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">

            <div class="mb-3">
                <label class="form-label">Assign Client</label>
                <select name="client_id" class="form-select" required>
                    <option value="">Select Client</option>
                    <?php
                    foreach ($pdo->query("SELECT id, username FROM users WHERE role='client'") as $c) {
                        echo "<option value='{$c['id']}'>{$c['username']}</option>";
                    }
                    ?>
                </select>
            </div>

            <input class="form-control mb-3" name="title" placeholder="Site Title" required>
            <input class="form-control mb-3" name="slug" placeholder="example.com" required>
            <textarea class="form-control mb-3" name="description" placeholder="Description"></textarea>
            <input class="form-control mb-3" type="file" name="logo">
            <input class="form-control mb-3" name="phone" placeholder="Phone">
            <input class="form-control mb-3" type="email" name="email" placeholder="Email">
            <input class="form-control mb-3" name="facebook" placeholder="Facebook URL">

            <button class="btn btn-primary w-100">Create Site</button>
        </form>
    </div>

</body>

</html>
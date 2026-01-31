<?php
require_once '../processes/db.php';


if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: ../pages/login.php');
    exit;
}


$username = $_SESSION['username'] ?? 'User';
$role     = $_SESSION['role'] ?? 'client';

$errors  = [];
$success = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $title = trim($_POST['title'] ?? '');
    $rawSlug = trim($_POST['slug'] ?? '');
    $desc  = trim($_POST['description'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $fb    = trim($_POST['facebook'] ?? '');


    if ($title === '' || $rawSlug === '') {
        $errors[] = 'Title and Site URL are required';
    }


    $slug = strtolower($rawSlug);
    $slug = preg_replace('#^https?://#', '', $slug);
    $slug = preg_replace('#^www\.#', '', $slug);
    $slug = explode('.', $slug)[0];

    if (!preg_match('/^[a-z0-9-]+$/', $slug)) {
        $errors[] = 'Invalid site URL format';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare(
            "SELECT 1 FROM sites WHERE site_slug = ? LIMIT 1"
        );
        $stmt->execute([$slug]);

        if ($stmt->fetch()) {
            $errors[] = 'Site already exists';
        }
    }

    $logoDir    = __DIR__ . '/../uploads/logos/';
    $galleryDir = __DIR__ . '/../uploads/gallery/';

    if (!is_dir($logoDir)) {
        mkdir($logoDir, 0755, true);
    }
    if (!is_dir($galleryDir)) {
        mkdir($galleryDir, 0755, true);
    }


    $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
    $logoName = null;

    if (empty($errors)) {

        if (empty($_FILES['logo']['name'])) {
            $errors[] = 'Logo is required';
        } elseif ($_FILES['logo']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'Logo upload failed';
        } elseif (!in_array($_FILES['logo']['type'], $allowedTypes)) {
            $errors[] = 'Invalid logo file type';
        } else {
            $ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
            $logoName = uniqid('logo_', true) . '.' . $ext;

            if (!move_uploaded_file(
                $_FILES['logo']['tmp_name'],
                $logoDir . $logoName
            )) {
                $errors[] = 'Failed to save logo';
            }
        }
    }


    $gallery = [];

    if (empty($errors) && !empty($_FILES['images']['name'][0])) {

        foreach ($_FILES['images']['name'] as $i => $name) {

            if ($_FILES['images']['error'][$i] !== UPLOAD_ERR_OK) {
                continue;
            }

            if (!in_array($_FILES['images']['type'][$i], $allowedTypes)) {
                continue;
            }

            $ext = pathinfo($name, PATHINFO_EXTENSION);
            $file = uniqid('img_', true) . '.' . $ext;

            if (move_uploaded_file(
                $_FILES['images']['tmp_name'][$i],
                $galleryDir . $file
            )) {
                $gallery[] = $file;
            }
        }
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare(
            "INSERT INTO sites
            (site_slug, title, description, logo, phone, email, facebook, images)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );

        $stmt->execute([
            $slug,
            $title,
            $desc,
            $logoName,
            $phone,
            $email,
            $fb,
            json_encode($gallery)
        ]);

        $success = "Site created successfully. URL: /sites/site.php?site=$slug";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Create Site</title>

    <link rel="stylesheet" href="dashboard-includes/navbar.css">
    <link rel="stylesheet" href="dashboard-includes/sidebar.css">
</head>

<body>

    <?php include 'dashboard-includes/header.php'; ?>
    <?php include 'dashboard-includes/sidebar.php'; ?>

    <div style="margin-left:220px;padding:2rem;">

        <h2>Create New Site</h2>

        <?php if ($success): ?>
            <p style="color:green"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>

        <?php foreach ($errors as $error): ?>
            <p style="color:red"><?= htmlspecialchars($error) ?></p>
        <?php endforeach; ?>

        <form method="POST" enctype="multipart/form-data">

            <input type="text" name="title" placeholder="Site Title" required><br><br>

            <input type="text" name="slug"
                placeholder="Site URL (e.g. abc.com)"
                required><br><br>

            <textarea name="description" placeholder="Description"></textarea><br><br>

            <input type="file" name="logo" required><br><br>

            <input type="text" name="phone" placeholder="Phone"><br><br>
            <input type="email" name="email" placeholder="Email"><br><br>

            <input type="url" name="facebook" placeholder="Facebook"><br><br>

            <input type="file" name="images[]" multiple><br><br>

            <button type="submit">Create Site</button>

        </form>

    </div>

</body>

</html>
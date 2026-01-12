<?php
require_once '../processes/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    redirect('../pages/login.php');
}

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = trim($_POST['title'] ?? '');
    $slug  = trim($_POST['slug'] ?? '');
    $desc  = trim($_POST['description'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $fb    = trim($_POST['facebook'] ?? '');

    if ($title === '' || $slug === '') {
        $errors['general'] = 'Title and slug are required';
    }

    /* Check slug */
    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT 1 FROM sites WHERE site_slug = ? LIMIT 1");
        $stmt->execute([$slug]);
        if ($stmt->fetch()) {
            $errors['general'] = 'Site slug already exists';
        }
    }

    /* Upload logo */
    $logoName = null;
    if (empty($errors) && !empty($_FILES['logo']['name'])) {
        $logoName = uniqid() . '_' . $_FILES['logo']['name'];
        move_uploaded_file(
            $_FILES['logo']['tmp_name'],
            "../uploads/logos/$logoName"
        );
    }

    /* Upload gallery */
    $gallery = [];
    if (empty($errors) && !empty($_FILES['images']['name'][0])) {
        foreach ($_FILES['images']['name'] as $i => $name) {
            $file = uniqid() . '_' . $name;
            move_uploaded_file(
                $_FILES['images']['tmp_name'][$i],
                "../uploads/gallery/$file"
            );
            $gallery[] = $file;
        }
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("
            INSERT INTO sites
            (site_slug, title, description, logo, phone, email, facebook, images)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");

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

        $success = 'Site created successfully';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Create Site</title>
</head>

<body>

    <h2>Create New Site</h2>

    <?php if ($success): ?>
        <p style="color:green"><?= $success ?></p>
    <?php endif; ?>

    <?php if (!empty($errors['general'])): ?>
        <p style="color:red"><?= $errors['general'] ?></p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">

        <input type="text" name="title" placeholder="Title" required><br><br>
        <input type="text" name="slug" placeholder="Slug" required><br><br>

        <textarea name="description" placeholder="Description"></textarea><br><br>

        <input type="file" name="logo" required><br><br>

        <input type="text" name="phone" placeholder="Phone"><br><br>
        <input type="email" name="email" placeholder="Email"><br><br>

        <input type="url" name="facebook" placeholder="Facebook"><br><br>

        <input type="file" name="images[]" multiple><br><br>

        <button type="submit">Create Site</button>

    </form>

</body>

</html>
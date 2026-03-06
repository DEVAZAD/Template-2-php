<?php
require_once __DIR__ . '/../../src/config/database.php';
requireAuth('admin');
$username = $_SESSION['username']; $role = $_SESSION['role'];
$errors = []; $success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = clean($_POST['title']??''); $slug = clean($_POST['slug']??'');
    $desc  = clean($_POST['description']??''); $phone = clean($_POST['phone']??'');
    $email = clean($_POST['email']??''); $facebook = clean($_POST['facebook']??'');
    $cid   = (int)($_POST['client_id']??0);
    if (!$title||!$slug||!$cid) $errors[]='Title, URL slug, and client are required.';
    $slug = strtolower(preg_replace('/[^a-z0-9-]/','',preg_replace('#^https?://|^www\.#','',$slug)));
    if (!$errors) { $st=$pdo->prepare("SELECT 1 FROM sites WHERE client_id=?"); $st->execute([$cid]); if ($st->fetch()) $errors[]='This client already has a site.'; }
    $logo = null;
    if (!$errors && !empty($_FILES['logo']['name']) && $_FILES['logo']['error']===UPLOAD_ERR_OK) {
        is_dir(UPLOAD_DIR)||mkdir(UPLOAD_DIR,0755,true);
        $ext=pathinfo($_FILES['logo']['name'],PATHINFO_EXTENSION);
        $logo=uniqid('logo_',true).'.'.$ext;
        move_uploaded_file($_FILES['logo']['tmp_name'],UPLOAD_DIR.$logo);
    }
    if (!$errors) { $pdo->prepare("INSERT INTO sites (site_slug,title,description,logo,phone,email,facebook,client_id) VALUES (?,?,?,?,?,?,?,?)")->execute([$slug,$title,$desc,$logo,$phone,$email,$facebook,$cid]); $success='Site created!'; }
}
$clients = $pdo->query("SELECT id,username FROM users WHERE role='client' ORDER BY username")->fetchAll();
?>
<!DOCTYPE html><html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Create Site — ABCEL</title></head>
<body>
<?php include __DIR__ . '/../../src/includes/dashboard/header.php'; ?>
<?php include __DIR__ . '/../../src/includes/dashboard/sidebar.php'; ?>
<main class="main-content">
  <div class="page-header"><h1 class="page-title">➕ Create New Site</h1><p class="page-subtitle">Assign a website to a client account.</p></div>
  <div style="max-width:660px">
    <?php foreach($errors as $e): ?><div class="alert alert-danger">⚠️ <?= htmlspecialchars($e) ?></div><?php endforeach; ?>
    <?php if($success): ?><div class="alert alert-success">✅ <?= htmlspecialchars($success) ?></div><?php endif; ?>
    <div class="card"><div class="card-header"><span class="card-title">Site Details</span></div><div class="card-body">
      <form method="POST" enctype="multipart/form-data">
        <div class="form-group"><label class="form-label">Assign to Client *</label>
          <select name="client_id" class="form-control" required><option value="">— Select Client —</option>
            <?php foreach($clients as $c): ?><option value="<?=$c['id']?>"><?= htmlspecialchars($c['username']) ?></option><?php endforeach; ?>
          </select>
        </div>
        <div class="form-grid">
          <div class="form-group"><label class="form-label">Site Title *</label><input type="text" name="title" class="form-control" value="<?= htmlspecialchars($_POST['title']??'') ?>" placeholder="My Site" required></div>
          <div class="form-group"><label class="form-label">URL Slug *</label><input type="text" name="slug" class="form-control" value="<?= htmlspecialchars($_POST['slug']??'') ?>" placeholder="my-site" required></div>
        </div>
        <div class="form-group"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($_POST['description']??'') ?></textarea></div>
        <div class="form-grid">
          <div class="form-group"><label class="form-label">Phone</label><input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($_POST['phone']??'') ?>"></div>
          <div class="form-group"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="<?= htmlspecialchars($_POST['email']??'') ?>"></div>
        </div>
        <div class="form-group"><label class="form-label">Facebook URL</label><input type="url" name="facebook" class="form-control" value="<?= htmlspecialchars($_POST['facebook']??'') ?>"></div>
        <div class="form-group"><label class="form-label">Logo (optional)</label><input type="file" name="logo" class="form-control" accept="image/*"></div>
        <div style="display:flex;gap:12px"><button type="submit" class="btn btn-primary">➕ Create Site</button><a href="dashboard.php" class="btn btn-ghost">Cancel</a></div>
      </form>
    </div></div>
  </div>
</main></body></html>

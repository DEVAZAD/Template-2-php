<?php
require_once __DIR__ . '/../../src/config/database.php';
requireAuth('client');
$userId = $_SESSION['user_id']; $username = $_SESSION['username']; $role = $_SESSION['role'];
$errors = []; $success = '';
$st = $pdo->prepare("SELECT * FROM sites WHERE client_id=? LIMIT 1"); $st->execute([$userId]); $site = $st->fetch();

if ($site && $_SERVER['REQUEST_METHOD']==='POST') {
    $title=$_POST['title']??''; $desc=$_POST['description']??''; $phone=$_POST['phone']??''; $email=$_POST['email']??''; $facebook=$_POST['facebook']??'';
    if (!trim($title)) $errors[]='Title is required.';
    $logo=$site['logo'];
    if (!empty($_FILES['logo']['name'])&&$_FILES['logo']['error']===UPLOAD_ERR_OK) {
        is_dir(UPLOAD_DIR)||mkdir(UPLOAD_DIR,0755,true);
        $ext=pathinfo($_FILES['logo']['name'],PATHINFO_EXTENSION); $logo=uniqid('logo_',true).'.'.$ext;
        move_uploaded_file($_FILES['logo']['tmp_name'],UPLOAD_DIR.$logo);
    }
    if (!$errors) {
        $pdo->prepare("UPDATE sites SET title=?,description=?,logo=?,phone=?,email=?,facebook=? WHERE client_id=?")->execute([$title,$desc,$logo,$phone,$email,$facebook,$userId]);
        $success='Site updated!'; $st->execute([$userId]); $site=$st->fetch();
    }
}
?>
<!DOCTYPE html><html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Edit My Site — ABCEL</title></head>
<body>
<?php include __DIR__ . '/../../src/includes/dashboard/header.php'; ?>
<?php include __DIR__ . '/../../src/includes/dashboard/sidebar.php'; ?>
<main class="main-content">
  <div class="page-header"><h1 class="page-title">✏️ Edit My Site</h1><p class="page-subtitle">Update your site's content and branding.</p></div>
  <?php if(!$site): ?><div class="alert alert-warning">⚠️ No site assigned. Contact an administrator.</div>
  <?php else: ?>
    <?php foreach($errors as $e): ?><div class="alert alert-danger">⚠️ <?= htmlspecialchars($e) ?></div><?php endforeach; ?>
    <?php if($success): ?><div class="alert alert-success">✅ <?= htmlspecialchars($success) ?></div><?php endif; ?>
    <div style="max-width:660px"><div class="card"><div class="card-header"><span class="card-title">Site Information</span></div><div class="card-body">
      <form method="POST" enctype="multipart/form-data">
        <div class="form-group"><label class="form-label">Site Title *</label><input type="text" name="title" class="form-control" value="<?= htmlspecialchars($site['title']) ?>" required></div>
        <div class="form-group"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($site['description']??'') ?></textarea></div>
        <div class="form-group"><label class="form-label">Logo</label><input type="file" name="logo" class="form-control" accept="image/*">
          <?php if($site['logo']): ?><div style="margin-top:8px;display:flex;align-items:center;gap:10px"><img src="<?= UPLOAD_URL.htmlspecialchars($site['logo']) ?>" style="height:42px;border-radius:6px;border:1px solid var(--border)"><small class="text-muted">Current logo</small></div><?php endif; ?>
        </div>
        <div class="form-grid">
          <div class="form-group"><label class="form-label">Phone</label><input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($site['phone']??'') ?>"></div>
          <div class="form-group"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="<?= htmlspecialchars($site['email']??'') ?>"></div>
        </div>
        <div class="form-group"><label class="form-label">Facebook URL</label><input type="url" name="facebook" class="form-control" value="<?= htmlspecialchars($site['facebook']??'') ?>"></div>
        <div style="display:flex;gap:12px"><button type="submit" class="btn btn-primary">💾 Save Changes</button><a href="dashboard.php" class="btn btn-ghost">Back</a></div>
      </form>
    </div></div></div>
  <?php endif; ?>
</main></body></html>

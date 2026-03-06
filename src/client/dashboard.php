<?php
require_once __DIR__ . '/../../src/config/database.php';
requireAuth();
$userId = $_SESSION['user_id']; $username = $_SESSION['username']; $role = $_SESSION['role'];
$st = $pdo->prepare("SELECT * FROM sites WHERE client_id=? LIMIT 1"); $st->execute([$userId]); $site = $st->fetch();
?>
<!DOCTYPE html><html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Dashboard — ABCEL</title></head>
<body>
<?php include __DIR__ . '/../../src/includes/dashboard/header.php'; ?>
<?php include __DIR__ . '/../../src/includes/dashboard/sidebar.php'; ?>
<main class="main-content">
  <div class="page-header"><h1 class="page-title">👋 Welcome, <?= htmlspecialchars($username) ?>!</h1><p class="page-subtitle">Your site overview.</p></div>
  <?php if(!$site): ?>
    <div class="alert alert-warning">⚠️ <strong>No site assigned yet.</strong> Please contact your administrator.</div>
    <div class="card" style="max-width:480px"><div class="card-body" style="text-align:center;padding:48px 32px"><div style="font-size:3rem;margin-bottom:16px">🌐</div><h3>Your site is being prepared</h3><p class="text-muted" style="margin-top:8px;font-size:.9rem">An admin will assign your site soon.</p></div></div>
  <?php else: ?>
    <div class="site-card" style="max-width:660px;margin-bottom:24px">
      <div class="site-card-header">
        <?php if($site['logo']): ?><img src="<?= UPLOAD_URL.htmlspecialchars($site['logo']) ?>" style="height:48px;border-radius:6px"><?php else: ?><div style="width:48px;height:48px;background:var(--brand-light);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:1.4rem">🌐</div><?php endif; ?>
        <div><div style="font-size:1.1rem;font-weight:700"><?= htmlspecialchars($site['title']) ?></div><div class="text-muted" style="font-size:.83rem"><?= htmlspecialchars($site['site_slug']) ?></div></div>
        <span class="badge badge-success" style="margin-left:auto">Active</span>
      </div>
      <div class="site-card-body">
        <?php if($site['description']): ?><p style="margin-bottom:16px"><?= nl2br(htmlspecialchars($site['description'])) ?></p><?php endif; ?>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:20px">
          <?php if($site['phone']): ?><div><small class="text-muted">📞 Phone</small><div class="fw-600"><?= htmlspecialchars($site['phone']) ?></div></div><?php endif; ?>
          <?php if($site['email']): ?><div><small class="text-muted">✉️ Email</small><div class="fw-600"><?= htmlspecialchars($site['email']) ?></div></div><?php endif; ?>
        </div>
        <a href="update-site.php" class="btn btn-primary">✏️ Edit My Site</a>
      </div>
    </div>
  <?php endif; ?>
</main></body></html>

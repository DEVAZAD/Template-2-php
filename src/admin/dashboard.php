<?php
require_once __DIR__ . '/../../src/config/database.php';
requireAuth('admin');
$username = $_SESSION['username']; $role = $_SESSION['role'];

$totalSites   = (int)$pdo->query("SELECT COUNT(*) FROM sites")->fetchColumn();
$totalClients = (int)$pdo->query("SELECT COUNT(*) FROM users WHERE role='client'")->fetchColumn();
$totalAdmins  = (int)$pdo->query("SELECT COUNT(*) FROM users WHERE role='admin'")->fetchColumn();
$latestSites  = $pdo->query("SELECT s.id,s.title,s.site_slug,u.username AS client FROM sites s LEFT JOIN users u ON s.client_id=u.id ORDER BY s.id DESC LIMIT 5")->fetchAll();
$recentUsers  = $pdo->query("SELECT id,username,email FROM users WHERE role='client' ORDER BY id DESC LIMIT 5")->fetchAll();
?>
<!DOCTYPE html><html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Admin Dashboard — ABCEL</title></head>
<body>
<?php include __DIR__ . '/../../src/includes/dashboard/header.php'; ?>
<?php include __DIR__ . '/../../src/includes/dashboard/sidebar.php'; ?>
<main class="main-content">
  <div class="page-header">
    <h1 class="page-title">👋 Welcome back, <?= htmlspecialchars($username) ?>!</h1>
    <p class="page-subtitle">Platform overview at a glance.</p>
  </div>
  <div class="stats-grid">
    <div class="stat-card"><div class="stat-icon brand">🌐</div><div><div class="stat-value"><?= $totalSites ?></div><div class="stat-label">Total Sites</div></div></div>
    <div class="stat-card"><div class="stat-icon success">👥</div><div><div class="stat-value"><?= $totalClients ?></div><div class="stat-label">Clients</div></div></div>
    <div class="stat-card"><div class="stat-icon warning">🛡️</div><div><div class="stat-value"><?= $totalAdmins ?></div><div class="stat-label">Admins</div></div></div>
    <div class="stat-card"><div class="stat-icon info">⏳</div><div><div class="stat-value"><?= max(0,$totalClients-$totalSites) ?></div><div class="stat-label">Pending Sites</div></div></div>
  </div>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-bottom:24px">
    <div class="card">
      <div class="card-header"><span class="card-title">🌐 Latest Sites</span><a href="manage-sites.php" class="btn btn-ghost btn-sm">View All</a></div>
      <div class="table-wrapper"><table><thead><tr><th>Title</th><th>Client</th></tr></thead><tbody>
        <?php if (!$latestSites): ?><tr><td colspan="2" style="text-align:center;padding:24px;color:var(--muted)">No sites yet</td></tr>
        <?php else: foreach ($latestSites as $s): ?>
          <tr><td><strong><?= htmlspecialchars($s['title']) ?></strong><br><small class="text-muted"><?= htmlspecialchars($s['site_slug']) ?></small></td><td><?= htmlspecialchars($s['client']??'—') ?></td></tr>
        <?php endforeach; endif; ?>
      </tbody></table></div>
    </div>
    <div class="card">
      <div class="card-header"><span class="card-title">👥 Recent Clients</span><a href="manage-users.php" class="btn btn-ghost btn-sm">View All</a></div>
      <div class="table-wrapper"><table><thead><tr><th>Username</th><th>Email</th></tr></thead><tbody>
        <?php if (!$recentUsers): ?><tr><td colspan="2" style="text-align:center;padding:24px;color:var(--muted)">No clients yet</td></tr>
        <?php else: foreach ($recentUsers as $u): ?>
          <tr><td><strong><?= htmlspecialchars($u['username']) ?></strong></td><td class="text-muted"><?= htmlspecialchars($u['email']) ?></td></tr>
        <?php endforeach; endif; ?>
      </tbody></table></div>
    </div>
  </div>
  <div class="card"><div class="card-header"><span class="card-title">⚡ Quick Actions</span></div>
    <div class="card-body" style="display:flex;gap:12px;flex-wrap:wrap">
      <a href="create-site.php" class="btn btn-primary">➕ Create Site</a>
      <a href="manage-sites.php" class="btn btn-ghost">🗂️ Manage Sites</a>
      <a href="manage-users.php" class="btn btn-ghost">👥 Manage Users</a>
    </div>
  </div>
</main>
</body></html>

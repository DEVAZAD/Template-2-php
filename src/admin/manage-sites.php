<?php
require_once __DIR__ . '/../../src/config/database.php';
requireAuth('admin');
$username = $_SESSION['username']; $role = $_SESSION['role'];
if (isset($_GET['delete'])&&is_numeric($_GET['delete'])) { $pdo->prepare("DELETE FROM sites WHERE id=?")->execute([(int)$_GET['delete']]); redirect('/src/admin/manage-sites.php?deleted=1'); }
$sites = $pdo->query("SELECT s.id,s.site_slug,s.title,s.logo,s.email,u.username AS client FROM sites s LEFT JOIN users u ON s.client_id=u.id ORDER BY s.id DESC")->fetchAll();
?>
<!DOCTYPE html><html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Manage Sites — ABCEL</title></head>
<body>
<?php include __DIR__ . '/../../src/includes/dashboard/header.php'; ?>
<?php include __DIR__ . '/../../src/includes/dashboard/sidebar.php'; ?>
<main class="main-content">
  <div class="page-header flex-row justify-between">
    <div><h1 class="page-title">🗂️ Manage Sites</h1><p class="page-subtitle">All registered sites.</p></div>
    <a href="create-site.php" class="btn btn-primary">➕ Create Site</a>
  </div>
  <?php if(isset($_GET['deleted'])): ?><div class="alert alert-success">✅ Site deleted.</div><?php endif; ?>
  <div class="card">
    <?php if(empty($sites)): ?>
      <div class="empty-state"><div class="empty-state-icon">🌐</div><h4>No sites yet</h4><p>Create your first site.</p><a href="create-site.php" class="btn btn-primary" style="margin-top:16px">Create Site</a></div>
    <?php else: ?>
      <div class="table-wrapper"><table>
        <thead><tr><th>#</th><th>Logo</th><th>Title</th><th>Slug</th><th>Client</th><th>Actions</th></tr></thead>
        <tbody>
          <?php foreach($sites as $i=>$s): ?>
          <tr>
            <td class="text-muted"><?= $i+1 ?></td>
            <td><?php if($s['logo']): ?><img src="<?= UPLOAD_URL.htmlspecialchars($s['logo']) ?>" style="height:34px;border-radius:4px"><?php else: ?><span style="font-size:1.2rem">🌐</span><?php endif; ?></td>
            <td><strong><?= htmlspecialchars($s['title']) ?></strong></td>
            <td><span class="badge badge-info"><?= htmlspecialchars($s['site_slug']) ?></span></td>
            <td><?= htmlspecialchars($s['client']??'—') ?></td>
            <td><div style="display:flex;gap:8px"><a href="manage-sites.php?delete=<?=$s['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">🗑️ Delete</a></div></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table></div>
    <?php endif; ?>
  </div>
</main></body></html>

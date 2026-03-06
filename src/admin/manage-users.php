<?php
require_once __DIR__ . '/../../src/config/database.php';
requireAuth('admin');
$username = $_SESSION['username']; $role = $_SESSION['role'];
if (isset($_GET['delete'])&&is_numeric($_GET['delete'])&&(int)$_GET['delete']!==$_SESSION['user_id']) { $pdo->prepare("DELETE FROM users WHERE id=? AND role!='admin'")->execute([(int)$_GET['delete']]); redirect('/src/admin/manage-users.php?deleted=1'); }
$users = $pdo->query("SELECT id,username,email,role FROM users ORDER BY role,username")->fetchAll();
?>
<!DOCTYPE html><html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Manage Users — ABCEL</title></head>
<body>
<?php include __DIR__ . '/../../src/includes/dashboard/header.php'; ?>
<?php include __DIR__ . '/../../src/includes/dashboard/sidebar.php'; ?>
<main class="main-content">
  <div class="page-header"><h1 class="page-title">👥 Manage Users</h1><p class="page-subtitle">All registered accounts.</p></div>
  <?php if(isset($_GET['deleted'])): ?><div class="alert alert-success">✅ User deleted.</div><?php endif; ?>
  <div class="card"><div class="table-wrapper"><table>
    <thead><tr><th>#</th><th>User</th><th>Email</th><th>Role</th><th>Action</th></tr></thead>
    <tbody>
      <?php foreach($users as $i=>$u): ?>
      <tr>
        <td class="text-muted"><?=$i+1?></td>
        <td><div style="display:flex;align-items:center;gap:10px"><div class="avatar" style="width:30px;height:30px;font-size:.75rem"><?= strtoupper(substr($u['username'],0,1)) ?></div><strong><?= htmlspecialchars($u['username']) ?></strong></div></td>
        <td class="text-muted"><?= htmlspecialchars($u['email']) ?></td>
        <td><span class="badge <?=$u['role']==='admin'?'badge-warning':'badge-success' ?>"><?= ucfirst($u['role']) ?></span></td>
        <td><?php if($u['role']!=='admin'): ?><a href="manage-users.php?delete=<?=$u['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">🗑️</a><?php else: ?><span class="text-muted" style="font-size:.8rem">Admin</span><?php endif; ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table></div></div>
</main></body></html>

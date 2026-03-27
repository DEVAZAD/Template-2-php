<?php
$titles = ['dashboard'=>'Dashboard','create-site'=>'Create Site','manage-sites'=>'Manage Sites','manage-users'=>'Manage Users','update-site'=>'Edit My Site'];
$key   = str_replace('.php', '', basename($_SERVER['PHP_SELF']));
$title = $titles[$key] ?? 'Dashboard';
$init  = strtoupper(substr($username ?? 'U', 0, 1));
?>
<link rel="stylesheet" href="<?= ASSETS ?>/css/dashboard.css">
<div class="topbar">
  <div class="topbar-left">
    <div>
      <div class="topbar-title"><?= htmlspecialchars($title) ?></div>
      <div class="topbar-breadcrumb">DSCPS &rsaquo; <?= htmlspecialchars($title) ?></div>
    </div>
  </div>
  <div class="topbar-right">
    <div class="user-info">
      <div class="user-name"><?= htmlspecialchars($username ?? 'User') ?></div>
      <div class="user-role"><?= ucfirst($role ?? 'client') ?></div>
    </div>
    <div class="avatar"><?= $init ?></div>
  </div>
</div>

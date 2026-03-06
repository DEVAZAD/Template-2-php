<?php
$currentFile = basename($_SERVER['PHP_SELF']);
function navLink(string $href, string $icon, string $label, string $current, string $match): void {
    $active = str_contains($current, $match) ? 'active' : '';
    echo "<a href=\"$href\" class=\"sidebar-link $active\"><span class=\"icon\">$icon</span>$label</a>";
}
?>
<div class="sidebar">
  <a href="<?= BASE ?>/" class="sidebar-brand">
    <div class="sidebar-brand-icon">&#x1F33F;</div>
    <div>
      <div class="sidebar-brand-text">ABCEL</div>
      <div class="sidebar-brand-sub">Dashboard</div>
    </div>
  </a>
  <nav class="sidebar-nav">
    <div class="sidebar-section-label">Main</div>
    <?php if ($role === 'admin'): ?>
      <?php navLink(BASE.'/src/admin/dashboard.php', '&#x1F4CA;', 'Overview', $currentFile, 'dashboard'); ?>
      <div class="sidebar-section-label" style="margin-top:14px">Management</div>
      <?php navLink(BASE.'/src/admin/create-site.php', '&#x2795;', 'Create Site', $currentFile, 'create-site'); ?>
      <?php navLink(BASE.'/src/admin/manage-sites.php', '&#x1F5C2;&#xFE0F;', 'Manage Sites', $currentFile, 'manage-sites'); ?>
      <?php navLink(BASE.'/src/admin/manage-users.php', '&#x1F465;', 'Manage Users', $currentFile, 'manage-users'); ?>
    <?php else: ?>
      <?php navLink(BASE.'/src/client/dashboard.php', '&#x1F4CA;', 'Overview', $currentFile, 'dashboard'); ?>
      <div class="sidebar-section-label" style="margin-top:14px">My Site</div>
      <?php navLink(BASE.'/src/client/update-site.php', '&#x270F;&#xFE0F;', 'Edit My Site', $currentFile, 'update-site'); ?>
    <?php endif; ?>
  </nav>
  <div class="sidebar-footer">
    <a href="<?= BASE ?>/auth/logout.php" class="sidebar-logout">
      <span class="icon">&#x1F6AA;</span> Log Out
    </a>
  </div>
</div>

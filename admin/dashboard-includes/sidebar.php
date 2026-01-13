<div class="sidebar">
    <a href="dashboard.php">Dashboard</a>

    <?php if ($role === 'admin'): ?>
        <a href="/admin/create-site.php">Create Site</a>
        <a href="/admin/manage-sites.php">Manage Sites</a>
    <?php endif; ?>
</div>
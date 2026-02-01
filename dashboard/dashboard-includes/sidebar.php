<div class="position-fixed top-0 vh-100 text-white"
    style="width:200px; background:#111827;">

    <div class="px-5 py-4 border-bottom"
        style="border-color:rgba(255,255,255,.08)!important;">
        <div class="fw-semibold">Your</div>
        <div class="small text-muted">Dashboard</div>
    </div>

    <div class="mt-3">

        <?php if ($role === 'admin'): ?>

            <a href="/project1/dashboard/admin/dashboard.php"
                class="d-flex align-items-center gap-2 px-4 py-2 text-decoration-none text-white rounded"
                style="margin:4px 12px;">
                📊 <span>Dashboard</span>
            </a>

            <a href=""
                class="d-flex align-items-center gap-2 px-4 py-2 text-decoration-none text-white rounded"
                style="margin:4px 12px;">
                👤 <span>My Profile</span>
            </a>
            <a href="/project1/dashboard/admin/create-site.php"
                class="d-flex align-items-center gap-2 px-4 py-2 text-decoration-none text-white rounded"
                style="margin:4px 12px;">
                ⭐ <span>Create Sites</span>
            </a>

            <a href="/project1/dashboard/admin/manage-sites.php"
                class="d-flex align-items-center gap-2 px-4 py-2 text-decoration-none text-white rounded"
                style="margin:4px 12px;">
                🎓 <span>Manage Sites</span>
            </a>



            <a href=""
                class="d-flex align-items-center gap-2 px-4 py-2 text-decoration-none text-white rounded"
                style="margin:4px 12px;">
                📄 <span>Reports</span>
            </a>

        <?php else: ?>

            <a href="/project1/dashboard/client/dashboard.php"
                class="d-flex align-items-center gap-2 px-4 py-2 text-decoration-none text-white rounded"
                style="margin:4px 12px;">
                📊 <span>Dashboard</span>
            </a>


            <a href="/project1/dashboard/client/update-site.php"
                class="d-flex align-items-center gap-2 px-4 py-2 text-decoration-none text-white rounded"
                style="margin:4px 12px;">
                🛠️ <span>Update Site</span>
            </a>

            <a href=""
                class="d-flex align-items-center gap-2 px-4 py-2 text-decoration-none text-white rounded"
                style="margin:4px 12px;">
                🔒 <span>Change Password</span>
            </a>

            <a href=""
                class="d-flex align-items-center gap-2 px-4 py-2 text-decoration-none text-white rounded"
                style="margin:4px 12px;">
                ✉️ <span>Messages</span>
            </a>

        <?php endif; ?>

    </div>
</div>
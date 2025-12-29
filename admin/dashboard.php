<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied";
    exit;
}
?>

<h1>Admin Dashboard</h1>
<p>If you can see this, admin protection works.</p>

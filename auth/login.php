<?php
require_once __DIR__ . '/../src/config/database.php';
if (isLoggedIn()) redirect(BASE . ($role === 'admin' ? '/src/admin/dashboard.php' : '/src/client/dashboard.php'));

$errors = []; $username = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = clean($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if (!$username) $errors['username'] = 'Required';
    if (!$password) $errors['password'] = 'Required';
    if (empty($errors)) {
        try {
            $st = $pdo->prepare("SELECT id,username,password_hash,role FROM users WHERE username=? OR email=? LIMIT 1");
            $st->execute([$username, $username]);
            $user = $st->fetch();
            if ($user && password_verify($password, $user['password_hash'])) {
                session_regenerate_id(true);
                $_SESSION = ['user_id'=>$user['id'],'username'=>$user['username'],'role'=>$user['role'],'login_time'=>time()];
                redirect(BASE . ($user['role'] === 'admin' ? '/src/admin/dashboard.php' : '/src/client/dashboard.php'));
            } else { $errors['general'] = 'Invalid credentials.'; }
        } catch (PDOException $e) { $errors['general'] = 'Something went wrong.'; }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login &#8212; ABCEL</title>
  <link rel="stylesheet" href="<?= ASSETS ?>/css/auth.css">
</head>
<body>
<div class="auth-left">
  <a href="<?= BASE ?>/" class="auth-brand">
    <div class="auth-brand-icon">&#x1F33F;</div>
    <span class="auth-brand-name">ABCEL</span>
  </a>
  <div class="auth-hero">
    <h1>Enriching Lives,<br>One Community<br>at a Time.</h1>
    <p>Log in to manage sites, track projects, and collaborate across your network.</p>
  </div>
  <div class="auth-features">
    <div class="auth-feature"><div class="auth-feature-icon">&#x1F4CA;</div><div class="auth-feature-text"><strong>Dashboard Insights</strong>Monitor all sites and clients in one place.</div></div>
    <div class="auth-feature"><div class="auth-feature-icon">&#x1F512;</div><div class="auth-feature-text"><strong>Secure Access</strong>Role-based login for admins and clients.</div></div>
    <div class="auth-feature"><div class="auth-feature-icon">&#x1F30D;</div><div class="auth-feature-text"><strong>Cultural Heritage</strong>Preserving traditions through digital tools.</div></div>
  </div>
</div>
<div class="auth-right">
  <div class="auth-box">
    <h2 class="auth-box-title">Welcome back</h2>
    <p class="auth-box-sub">Sign in to your account to continue</p>
    <?php if (isset($errors['general'])): ?>
      <div class="alert-box danger"><?= htmlspecialchars($errors['general']) ?></div>
    <?php endif; ?>
    <form method="POST" novalidate>
      <div class="form-group">
        <label class="form-label">Username or Email</label>
        <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($username) ?>" placeholder="Your username or email" autocomplete="username">
        <?php if (isset($errors['username'])): ?><div class="form-error"><?= $errors['username'] ?></div><?php endif; ?>
      </div>
      <div class="form-group">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Your password" autocomplete="current-password">
        <?php if (isset($errors['password'])): ?><div class="form-error"><?= $errors['password'] ?></div><?php endif; ?>
      </div>
      <button type="submit" class="btn-auth">Sign In &#x2192;</button>
    </form>
    <p class="auth-link">Don't have an account? <a href="<?= BASE ?>/auth/signup.php">Create one</a></p>
  </div>
</div>
</body>
</html>

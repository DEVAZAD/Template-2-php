<?php
require_once __DIR__ . '/../src/config/database.php';
$errors = []; $success = ''; $username = ''; $email = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = clean($_POST['username'] ?? '');
    $email    = clean($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';
    if (!$username || strlen($username)<3) $errors['username'] = 'Min 3 characters';
    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Valid email required';
    if (!$password || strlen($password)<6) $errors['password'] = 'Min 6 characters';
    if ($password !== $confirm) $errors['confirm'] = 'Passwords do not match';
    if (empty($errors)) {
        $st = $pdo->prepare("SELECT id FROM users WHERE username=? OR email=?");
        $st->execute([$username, $email]);
        if ($st->rowCount()) $errors['general'] = 'Username or email already taken.';
    }
    if (empty($errors)) {
        $pdo->prepare("INSERT INTO users (username,email,password_hash,role) VALUES (?,?,?,'client')")
            ->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT)]);
        $success = 'Account created! <a href="' . BASE . '/auth/login.php">Sign in now</a>.';
        $username = $email = '';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up &#8212; ABCEL</title>
  <link rel="stylesheet" href="<?= ASSETS ?>/css/auth.css">
</head>
<body>
<div class="auth-left">
  <a href="<?= BASE ?>/" class="auth-brand">
    <div class="auth-brand-icon">&#x1F33F;</div>
    <span class="auth-brand-name">ABCEL</span>
  </a>
  <div class="auth-hero">
    <h1>Join Our Growing<br>Community of<br>Change Makers.</h1>
    <p>Create your account and start managing your digital presence with ABCEL.</p>
  </div>
  <div class="auth-features">
    <div class="auth-feature"><div class="auth-feature-icon">&#x1F680;</div><div class="auth-feature-text"><strong>Quick Setup</strong>Get started in under 2 minutes.</div></div>
    <div class="auth-feature"><div class="auth-feature-icon">&#x1F6E1;&#xFE0F;</div><div class="auth-feature-text"><strong>Secure by Default</strong>Your data is always protected.</div></div>
    <div class="auth-feature"><div class="auth-feature-icon">&#x1F91D;</div><div class="auth-feature-text"><strong>Collaborative</strong>Work with teams across the network.</div></div>
  </div>
</div>
<div class="auth-right">
  <div class="auth-box">
    <h2 class="auth-box-title">Create your account</h2>
    <p class="auth-box-sub">Fill in your details to get started</p>
    <?php if (isset($errors['general'])): ?><div class="alert-box danger"><?= htmlspecialchars($errors['general']) ?></div><?php endif; ?>
    <?php if ($success): ?><div class="alert-box success"><?= $success ?></div><?php endif; ?>
    <form method="POST" novalidate>
      <div class="form-group">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($username) ?>" placeholder="Choose a username">
        <?php if (isset($errors['username'])): ?><div class="form-error"><?= $errors['username'] ?></div><?php endif; ?>
      </div>
      <div class="form-group">
        <label class="form-label">Email Address</label>
        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($email) ?>" placeholder="your@email.com">
        <?php if (isset($errors['email'])): ?><div class="form-error"><?= $errors['email'] ?></div><?php endif; ?>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" placeholder="Min 6 chars">
          <?php if (isset($errors['password'])): ?><div class="form-error"><?= $errors['password'] ?></div><?php endif; ?>
        </div>
        <div class="form-group">
          <label class="form-label">Confirm Password</label>
          <input type="password" name="confirm_password" class="form-control" placeholder="Repeat">
          <?php if (isset($errors['confirm'])): ?><div class="form-error"><?= $errors['confirm'] ?></div><?php endif; ?>
        </div>
      </div>
      <button type="submit" class="btn-auth">Create Account &#x2192;</button>
    </form>
    <p class="auth-link">Already have an account? <a href="<?= BASE ?>/auth/login.php">Sign in</a></p>
  </div>
</div>
</body>
</html>

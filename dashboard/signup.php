<?php
require_once 'db.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = sanitize_input($_POST['username'] ?? '');
    $email = sanitize_input($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($username)) {
        $errors['username'] = 'Username is required';
    } elseif (strlen($username) < 3) {
        $errors['username'] = 'Username must be at least 3 characters';
    }

    if (empty($email)) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address';
    }

    if (empty($password)) {
        $errors['password'] = 'Password is required';
    } elseif (strlen($password) < 6) {
        $errors['password'] = 'Password must be at least 6 characters';
    }

    if ($password !== $confirm_password) {
        $errors['confirm_password'] = 'Passwords do not match';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare(
            "SELECT id FROM users WHERE username = ? OR email = ?"
        );
        $stmt->execute([$username, $email]);

        if ($stmt->rowCount() > 0) {
            $errors['general'] = 'Username or email already exists';
        }
    }

    if (empty($errors)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare(
            "INSERT INTO users (username, email, password_hash, role)
             VALUES (?, ?, ?, 'client')"
        );
        $stmt->execute([$username, $email, $password_hash]);

        $success = 'Account created successfully! You can now <a href="login.php">login</a>.';

        $username = $email = '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex align-items-center justify-content-center min-vh-100" style="background:#34476fff;">

    <div class="card shadow-sm p-4" style="max-width:420px; width:100%;">
        <h4 class="text-center mb-4">Create Your Account</h4>

        <?php if (isset($errors['general'])): ?>
            <div class="alert alert-danger py-2">
                <?= $errors['general']; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success py-2">
                <?= $success; ?>
            </div>
        <?php endif; ?>

        <form method="POST" novalidate>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text"
                    name="username"
                    class="form-control"
                    value="<?= htmlspecialchars($username ?? '') ?>"
                    required>

                <?php if (isset($errors['username'])): ?>
                    <div class="text-danger small mt-1">
                        <?= $errors['username']; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email"
                    name="email"
                    class="form-control"
                    value="<?= htmlspecialchars($email ?? '') ?>"
                    required>

                <?php if (isset($errors['email'])): ?>
                    <div class="text-danger small mt-1">
                        <?= $errors['email']; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password"
                    name="password"
                    class="form-control"
                    required>

                <?php if (isset($errors['password'])): ?>
                    <div class="text-danger small mt-1">
                        <?= $errors['password']; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password"
                    name="confirm_password"
                    class="form-control"
                    required>

                <?php if (isset($errors['confirm_password'])): ?>
                    <div class="text-danger small mt-1">
                        <?= $errors['confirm_password']; ?>
                    </div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn w-100 mt-2"
                style="background:#34476fff; color:white;">
                Create Account
            </button>
        </form>

        <div class="text-center mt-3">
            Already have an account?
            <a href="login.php" class="fw-bold text-decoration-none" style="color:#34476fff;">
                Login here
            </a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
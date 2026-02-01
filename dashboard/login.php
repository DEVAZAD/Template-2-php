<?php
require_once 'admin/db.php';
/*
If user is already logged in, send them to dashboard
*/
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] === 'admin') {
        header('Location: admin/dashboard.php');
    } elseif ($_SESSION['role'] === 'client') {
        header('Location: client/dashboard.php');
    }
    exit;
}

$errors = [];
$username = '';

/*
Handle Login
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validation
    if ($username === '') {
        $errors['username'] = 'Username or email is required';
    }

    if ($password === '') {
        $errors['password'] = 'Password is required';
    }

    // Authenticate
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare(
                "SELECT id, username, password_hash, role
                 FROM users
                 WHERE username = ? OR email = ?
                 LIMIT 1"
            );
            $stmt->execute([$username, $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password_hash'])) {

                // Prevent session fixation
                session_regenerate_id(true);

                // Store session data
                $_SESSION['user_id']   = $user['id'];
                $_SESSION['username']  = $user['username'];
                $_SESSION['role']      = $user['role'];
                $_SESSION['login_time'] = time();

                // Redirect to dashboard
                if ($user['role'] === 'admin') {
                    header('Location: admin/dashboard.php');
                } elseif ($user['role'] === 'client') {
                    header('Location: client/dashboard.php');
                }
                exit;
            } else {
                $errors['general'] = 'Invalid username/email or password';
            }
        } catch (PDOException $e) {
            // Do NOT expose DB error in production
            $errors['general'] = 'Something went wrong. Please try again.';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class=" d-flex align-items-center justify-content-center min-vh-100" style="background:  #34476fff;">

    <div class="card shadow-sm p-4" style="max-width:400px; width:100%;">
        <h4 class="text-center mb-4">Login to Your Account</h4>

        <?php if (isset($errors['general'])): ?>
            <div class="alert alert-danger py-2">
                <?= $errors['general']; ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Username or Email</label>
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

            <button type="submit" class="btn w-100 mt-2" style="background:  #34476fff; color: white;">
                Login
            </button>
        </form>

        <div class="text-center mt-3">
            Don’t have an account?
            <a href="admin/signup.php" class="text-decoration-none fw-bold" style="color: #34476fff;">
                Sign up here
            </a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
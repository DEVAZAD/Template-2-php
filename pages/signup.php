<?php
require_once 'processes/db.php'; // ✅ FIXED PATH

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = sanitize_input($_POST['username'] ?? '');
    $email = sanitize_input($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validation
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

    // Check if username or email exists
    if (empty($errors)) {
        $stmt = $pdo->prepare(
            "SELECT id FROM users WHERE username = ? OR email = ?"
        );
        $stmt->execute([$username, $email]);

        if ($stmt->rowCount() > 0) {
            $errors['general'] = 'Username or email already exists';
        }
    }

    // Create account
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

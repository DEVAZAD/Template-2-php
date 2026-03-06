<?php
// ============================================================
//  Database Configuration & Bootstrap
// ============================================================

session_start();

define('DB_HOST', 'localhost');
define('DB_NAME', 'auth_system');
define('DB_USER', 'root');
define('DB_PASS', '');

// ── Base path: auto-detect from server, e.g. "/project1" or "" ──
$scriptPath = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
// Walk up until we find the project root (where index.php lives)
// We detect by finding the common prefix up to /src, /auth, etc.
$base = '';
foreach (['/src/', '/auth/'] as $marker) {
    $pos = strpos($scriptPath, $marker);
    if ($pos !== false) {
        $base = rtrim(substr($scriptPath, 0, $pos), '/');
        break;
    }
}
// If running from root index.php, base = everything before the filename
if ($base === '') {
    $base = rtrim(dirname($scriptPath), '/');
    if ($base === '.') $base = '';
}

define('BASE', $base);          // e.g. "/project1"  or ""
define('ASSETS', BASE . '/public');

define('UPLOAD_DIR', __DIR__ . '/../../public/uploads/logos/');
define('UPLOAD_URL', ASSETS . '/uploads/logos/');

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
        DB_USER, DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

function clean(string $v): string { return htmlspecialchars(strip_tags(trim($v))); }
function redirect(string $url): void { header("Location: $url"); exit; }
function isLoggedIn(): bool { return isset($_SESSION['user_id']); }
function requireAuth(string $role = ''): void {
    if (!isLoggedIn()) redirect(BASE . '/auth/login.php');
    if ($role && ($_SESSION['role'] ?? '') !== $role) redirect(BASE . '/auth/login.php');
}

<?php
// Compute base for pages that don't load database.php (like index.php)
if (!defined('BASE')) {
  $sp = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
  $base = '';
  foreach (['/src/', '/auth/'] as $m) {
    $p = strpos($sp, $m);
    if ($p !== false) {
      $base = rtrim(substr($sp, 0, $p), '/');
      break;
    }
  }
  if ($base === '') {
    $base = rtrim(dirname($sp), '/');
    if ($base === '.') $base = '';
  }
  define('BASE', $base);
  define('ASSETS', BASE . '/public');
}
?>
<header id="site-header">
  <nav class="nav-inner">
    <a href="<?= BASE ?>/" class="nav-logo">
      <img src="<?= ASSETS ?>/images/logo.png" alt="DSCPS Logo">
      <span>DSCPS</span>
    </a>
    <button class="hamburger" aria-label="Menu">&#9776;</button>
    <ul class="nav-links">
      <li><a href="<?= BASE ?>/">Home</a></li>
      <li><a href="<?= BASE ?>/#about-us">About Us</a></li>
      <li><a href="<?= BASE ?>/#activities">Activities</a></li>
      <li><a href="<?= BASE ?>/#partners">Partners</a></li>
      <li><a href="<?= BASE ?>/#team">Team</a></li>
      <li><a href="<?= BASE ?>/#gallery">Gallery</a></li>
      <li><a href="<?= BASE ?>/#contact">Connect</a></li>
    </ul>
    <div class="nav-cta">
      <a href="<?= BASE ?>/auth/login.php" class="btn btn-primary">Login</a>
    </div>
  </nav>
</header>
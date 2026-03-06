<?php
$pageTitle = 'Gallery';
$sp = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
$base = '';
foreach (['/src/', '/auth/'] as $m) { $p = strpos($sp, $m); if ($p !== false) { $base = rtrim(substr($sp,0,$p),'/'); break; } }
if ($base === '') { $base = rtrim(dirname($sp),'/'); if ($base==='.') $base=''; }
if (!defined('BASE'))   define('BASE',   $base);
if (!defined('ASSETS')) define('ASSETS', BASE . '/public');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle ?> &#8212; ABCEL</title>
  <link rel="stylesheet" href="<?= ASSETS ?>/css/main.css">
  <style>
    .gallery-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:16px; }
    .gallery-item { border-radius:8px; overflow:hidden; aspect-ratio:4/3; cursor:pointer; transition:transform .25s,box-shadow .25s; }
    .gallery-item:hover { transform:scale(1.02); box-shadow:0 8px 24px rgba(0,0,0,.15); }
    .gallery-item img { width:100%; height:100%; object-fit:cover; display:block; }
  </style>
</head>
<body>
<?php include __DIR__ . '/../../src/includes/header.php'; ?>
<div class="container section-pad">
  <h1 class="section-title">Gallery</h1>
  <p class="section-sub">Moments captured from our programmes and community events.</p>
  <div class="gallery-grid" style="margin-top:40px">
    <?php
    $imgs = [
      ASSETS.'/images/banners/bann1.png',
      ASSETS.'/images/gallery/im1.jpg',
      ASSETS.'/images/banners/bann2.png',
      ASSETS.'/images/gallery/im2.jpg',
      ASSETS.'/images/banners/slid1.png',
      ASSETS.'/images/gallery/im3.jpg',
      ASSETS.'/images/banners/bann1.png',
      ASSETS.'/images/gallery/im2.jpg',
    ];
    foreach ($imgs as $i => $src): ?>
    <div class="gallery-item">
      <img src="<?= htmlspecialchars($src) ?>" alt="Gallery image <?= $i+1 ?>">
    </div>
    <?php endforeach; ?>
  </div>
  <div style="margin-top:32px">
    <a href="<?= BASE ?>/" class="btn">&#x2190; Back to Home</a>
  </div>
</div>
<?php include __DIR__ . '/../../src/includes/footer.php'; ?>
<script src="<?= ASSETS ?>/js/main.js"></script>
</body>
</html>

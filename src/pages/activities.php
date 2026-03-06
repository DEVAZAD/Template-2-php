<?php
$pageTitle = 'Activities';
// Define BASE/ASSETS before any output
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
</head>
<body>
<?php include __DIR__ . '/../../src/includes/header.php'; ?>
<div class="container section-pad">
  <h1 class="section-title">Activities</h1>
  <p class="section-sub">Discover our ongoing programs and initiatives.</p>
  <div class="grid-auto" style="margin-top:40px">
    <div class="card">
      <div style="font-size:2rem;margin-bottom:12px">&#x1F393;</div>
      <h3>Cultural Documentation</h3>
      <p style="color:var(--gray);margin-top:8px;line-height:1.7">Preserving traditional knowledge through modern digital documentation methods and community outreach.</p>
    </div>
    <div class="card">
      <div style="font-size:2rem;margin-bottom:12px">&#x1F331;</div>
      <h3>Community Workshops</h3>
      <p style="color:var(--gray);margin-top:8px;line-height:1.7">Regular workshops connecting younger generations with elders to share cultural practices and stories.</p>
    </div>
    <div class="card">
      <div style="font-size:2rem;margin-bottom:12px">&#x1F4F8;</div>
      <h3>Digital Archive</h3>
      <p style="color:var(--gray);margin-top:8px;line-height:1.7">Building a comprehensive digital archive of photographs, oral histories, and cultural artefacts.</p>
    </div>
    <div class="card">
      <div style="font-size:2rem;margin-bottom:12px">&#x1F91D;</div>
      <h3>Partnership Programs</h3>
      <p style="color:var(--gray);margin-top:8px;line-height:1.7">Collaborating with schools, universities and NGOs to amplify cultural awareness initiatives.</p>
    </div>
  </div>
  <div style="margin-top:32px">
    <a href="<?= BASE ?>/" class="btn">&#x2190; Back to Home</a>
  </div>
</div>
<?php include __DIR__ . '/../../src/includes/footer.php'; ?>
<script src="<?= ASSETS ?>/js/main.js"></script>
</body>
</html>

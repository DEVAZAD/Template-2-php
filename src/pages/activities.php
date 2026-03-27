<?php
$pageTitle = 'Activities';
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
  <title><?= $pageTitle ?> &#8212; DSCPS</title>
  <link rel="stylesheet" href="<?= ASSETS ?>/css/main.css">
</head>
<body>
<?php include __DIR__ . '/../../src/includes/header.php'; ?>
<div class="container section-pad">
  <h1 class="section-title">Our Activities</h1>
  <p class="section-sub">Ongoing programmes and initiatives of the Donyi Sanggo Culture Preservation Society.</p>

  <div class="grid-auto" style="margin-top:40px">

    <div class="card">
      <div style="font-size:2rem;margin-bottom:12px">&#x1F3D8;&#xFE0F;</div>
      <h3>Visit to Your Village Programme</h3>
      <p style="color:var(--gray);margin-top:8px;line-height:1.7">Started in January 2012 from Komsing Village under the guidance of Lt. Shri Tage Taki, this programme covers 2–3 villages annually in far-flung interior areas where no proper road or telecommunication is available. It delivers cultural awareness and skill training directly to village youth and women folk.</p>
    </div>

    <div class="card">
      <div style="font-size:2rem;margin-bottom:12px">&#x1F3AD;</div>
      <h3>Lost of Culture, Lost of Identity</h3>
      <p style="color:var(--gray);margin-top:8px;line-height:1.7">Running since the inception of DSCPS, this flagship programme incites a sense of oneness and brotherhood amongst indigenous tribal people. It promotes ownership of the rich tribal cultural heritage inherited from ancestors and works to resist the deep influence of western culture and alien religions that have threatened tribal identity.</p>
    </div>

    <div class="card">
      <div style="font-size:2rem;margin-bottom:12px">&#x1F4E3;</div>
      <h3>Awareness Programme</h3>
      <p style="color:var(--gray);margin-top:8px;line-height:1.7">DSCPS conducts awareness activities on critical social issues including Drug Abuse, Alcoholism, Rape, Murder, Child Marriage and Bridge Prize. Through audio-video shows in unreached villages, the society involves youth and women to address these challenges and provide solace to victims across the state.</p>
    </div>

    <div class="card">
      <div style="font-size:2rem;margin-bottom:12px">&#x1F6E0;&#xFE0F;</div>
      <h3>Training and Workshop</h3>
      <p style="color:var(--gray);margin-top:8px;line-height:1.7">The society organises training and workshop programmes in collaboration with like-minded government and non-government departments, CBOs and NGOs. These sessions disseminate knowledge and practical experiences to tribal youth, building skills and opening employable avenues despite the acute financial challenges faced by the organisation.</p>
    </div>

  </div>

  <!-- Annual Report Highlight -->
  <div class="card" style="margin-top:48px;padding:36px">
    <h2 style="margin-bottom:16px;font-size:1.3rem">Annual Report 2021–23</h2>
    <p style="color:var(--gray);line-height:1.8;margin-bottom:12px">Over the last three years DSCPS has continued its unwavering commitment to tribal cultural preservation across North East India. Despite operating with very limited resources and no voluntary funding from well-wishers, the society has strived to give exceptional services to the needy and downtrodden.</p>
    <p style="color:var(--gray);line-height:1.8">The society remains dedicated to its core belief: <strong style="color:var(--dark)">preserving tribal heritage is preserving identity.</strong></p>
  </div>

  <div style="margin-top:32px">
    <a href="<?= BASE ?>/" class="btn">&#x2190; Back to Home</a>
  </div>
</div>
<?php include __DIR__ . '/../../src/includes/footer.php'; ?>
<script src="<?= ASSETS ?>/js/main.js"></script>
</body>
</html>
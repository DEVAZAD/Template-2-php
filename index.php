<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DSCPS — Enriching Lives</title>
  <?php
  $sp = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
  $base = rtrim(dirname($sp), '/');
  if ($base === '.') $base = '';
  if (!defined('BASE'))   define('BASE',   $base);
  if (!defined('ASSETS')) define('ASSETS', BASE . '/public');
  ?>
  <link rel="stylesheet" href="<?= ASSETS ?>/css/main.css">
</head>

<body>

  <?php include 'src/includes/header.php'; ?>
  <?php include 'src/includes/slider.php'; ?>

  <div class="container">

    <!-- The Idea -->
    <section class="section-pad" id="idea">
      <h1 class="section-title">THE IDEA</h1>
      <div class="grid-auto" style="margin-bottom:36px">
        <div class="card">
          <div class="idea-icon">&#x1F33F;</div>
          <h3>Preservation</h3>
          <p style="margin-top:8px;color:var(--gray)">Protecting age-old tribal cultural heritage from extinction — one tradition at a time.</p>
        </div>
        <div class="card">
          <div class="idea-icon">&#x1F91D;</div>
          <h3>Empowerment</h3>
          <p style="margin-top:8px;color:var(--gray)">Uplifting the socially and economically weaker sections of the society through education and skill-building.</p>
        </div>
        <div class="card">
          <div class="idea-icon">&#x1F331;</div>
          <h3>Identity</h3>
          <p style="margin-top:8px;color:var(--gray)">Reviving a sense of oneness and pride in indigenous tribal heritage across North East India.</p>
        </div>
      </div>
      <p class="idea-desc">With the coming of development in tribal areas, the rich cultural heritage of tribal people has been heavily affected by the influence of western culture. DSCPS is dedicatedly working for the preservation of tribal folk art, music, faith and belief systems through vocational training, awareness and skilling programmes.</p>
      <div style="text-align:center;margin-top:24px"><a href="#contact" class="btn btn-primary">Know More</a></div>
    </section>

    <!-- About Us -->
    <section class="section-pad" id="about-us">
      <h1 class="section-title">About Us</h1>
      <p class="section-sub">Donyi Sanggo Culture Preservation Society (DSCPS) — Regd. No. SR/ITA/2299</p>
      <div class="grid-2 about-section">
        <div>
          <h3>Our Vision</h3>
          <p style="color:var(--gray);line-height:1.8;margin-top:10px;margin-bottom:20px">To protect and preserve the cultural heritage of the tribal and provide quality services and opportunities to all strata of life.</p>
          <h3>Our Mission</h3>
          <p style="color:var(--gray);line-height:1.8;margin-top:10px;margin-bottom:20px">To protect, preserve and document the rich cultural heritage of the tribal from alien doctrines and provide exceptional welfare services to the youth of the society.</p>
          <h3>Our Goal</h3>
          <p style="color:var(--gray);line-height:1.8;margin-top:10px">To establish ourselves at the forefront of society to protect and preserve the age-old rich cultural heritage of the tribal from extinction, and to educate and skill the youth for self-reliance.</p>
        </div>
        <div class="vision-cards">
          <div class="card">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
              <circle cx="9" cy="7" r="4"></circle>
              <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
              <path d="M16 3.128a4 4 0 0 1 0 7.744"></path>
            </svg>
            <h4>Cultural Documentation</h4>
            <p style="font-size:.85rem;color:var(--gray);margin-top:6px">Preserving tribal folk art, music, faith and belief systems through modern documentation</p>
          </div>
          <div class="card">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 7v14"></path>
              <path d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z"></path>
            </svg>
            <h4>Community Engagement</h4>
            <p style="font-size:.85rem;color:var(--gray);margin-top:6px">Reaching far-flung interior villages to deliver awareness and skill training</p>
          </div>
          <div class="card">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
              <polyline points="14 2 14 8 20 8"></polyline>
            </svg>
            <h4>Youth Skilling</h4>
            <p style="font-size:.85rem;color:var(--gray);margin-top:6px">Building careers and opening employable avenues for tribal youth across the region</p>
          </div>
          <div class="card">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"></circle>
              <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"></path>
              <path d="M2 12h20"></path>
            </svg>
            <h4>North East Outreach</h4>
            <p style="font-size:.85rem;color:var(--gray);margin-top:6px">Operating across the whole of North East India since 2004</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Activities -->
    <section class="section-pad" id="activities" style="text-align:center">
      <h1 class="section-title">Activities</h1>
      <p class="section-sub">Discover our ongoing programmes and initiatives designed to preserve and promote cultural heritage.</p>
      <a href="<?= BASE ?>/src/pages/activities.php" class="btn btn-primary">See All Activities &#x2192;</a>
    </section>

    <!-- Partners -->
    <section class="section-pad" id="partners">
      <h1 class="section-title">Our Partners</h1>
      <p class="section-sub">Collaborating with like-minded organisations to amplify our impact</p>
      <div class="partners-grid">
        <div class="card partner-card">
          <div class="partner-logo"></div>
          <h3>Heritage Trust</h3>
        </div>
        <div class="card partner-card">
          <div class="partner-logo"></div>
          <h3>Cultural Connect</h3>
        </div>
        <div class="card partner-card">
          <div class="partner-logo"></div>
          <h3>Tradition Keepers</h3>
        </div>
        <div class="card partner-card">
          <div class="partner-logo"></div>
          <h3>Indigenous Voices</h3>
        </div>
      </div>
    </section>

    <!-- Team -->
    <section class="section-pad" id="team">
      <h1 class="section-title">Meet Our Team</h1>
      <p class="section-sub">Dedicated members driving our mission forward</p>
      <div class="team-grid">
        <?php
        $team = [
          ['Shri Tasung Taki','Member', 'From Pangin Town, Shri Tasung Taki plays an important role in promoting cultural awareness and assisting in the organisation\'s programmes across the region.'],
          ['Shri John Taki','Member','A committed member from Komsing Village, Shri John Taki supports the society\'s ongoing programmes and cultural research initiatives.'],
          ['Shri Nong Tamuk','Assistant Secretary','Representing Komsing Village, Shri Nong Tamuk assists in managing communications and documentation within the society.'],
          ['Shri Jun Taki','Convener','As the Convener from Pangin Town, Shri Jun Taki coordinates events, meetings, and cultural programmes with strong organisational leadership.'],
          ['Smti Osi Taki', 'Treasurer','A diligent and trusted member from Pangin Town, Smti Osi Taki oversees the financial management of the DSCPS with commitment and transparency.'],
          ['Shri Kabang Taki', 'Chairman','Based in Pangin Town, Shri Kabang Taki leads the DSCPS with a strong commitment to community development and the preservation of tribal cultural heritage.'],
        ];
        foreach ($team as $m): ?>
          <div class="card team-card">
            <img src="<?= ASSETS ?>/images/team/client.png" alt="<?= htmlspecialchars($m[0]) ?>" class="team-photo">
            <h3><?= htmlspecialchars($m[0]) ?></h3>
            <h4><?= htmlspecialchars($m[1]) ?></h4>
            <p><?= htmlspecialchars($m[2]) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- Gallery -->
    <section class="section-pad" id="gallery" style="text-align:center">
      <h1 class="section-title">Gallery</h1>
      <p class="section-sub">Moments from our programmes and community events.</p>
      <a href="<?= BASE ?>/src/pages/gallery.php" class="btn btn-primary">View Full Gallery &#x2192;</a>
    </section>

  </div>

  <!-- Opportunities -->
  <section class="opp-section">
    <div class="container">
      <div class="grid-2">
        <div class="opp-content">
          <h1>REALM OF CONTEMPORARY OPPORTUNITIES</h1>
          <p>As India and North East in particular are at the brink of change, there is a surge of contemporary opportunities for tribal individuals and the larger ecosystem.</p>
          <p>DSCPS is working as a torch bearer for educating and skilling the youth to seize these opportunities.</p>
          <a href="#contact" class="btn btn-primary">Know More</a>
        </div>
        <div class="opp-image"></div>
      </div>
    </div>
  </section>

  <div class="container">

    <!-- Mission -->
    <section class="section-pad mission-section">
      <h1>One connection can turn into many.<br>Creating a network of opportunities.</h1>
      <div class="flex mission-container">
        <div class="mission-content">
          <p>The Donyi Sanggo Culture Preservation Society was founded in 2004 with the objective of working towards the upliftment of socially and economically weaker sections of the society.</p>
          <p>By preserving the rich traditional cultural heritage of the tribal and educating and skilling the youth, DSCPS is building carriers and opening employable avenues across North East India.</p>
          <p>Registered under Society Registration Act 1860 (Extension to Arunachal Pradesh Act 1978) and under Niti Ayug No. AR/2022/0329083.</p>
          <h2>Watch this video now</h2>
        </div>
        <div class="video-box">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="64" height="64">
            <path d="M8 5v14l11-7z"></path>
          </svg>
        </div>
      </div>
    </section>

    <!-- Impact / Counters -->
    <section class="section-pad">
      <h1 class="section-title">Impact Created So Far</h1>
      <?php include 'src/includes/counterup.php'; ?>
    </section>

    <!-- Chairman's Message -->
    <section class="section-pad">
      <h1 class="section-title">Join The Movement</h1>
      <h2 style="text-align:center;color:var(--gray);font-size:1.3rem;font-weight:400;margin-bottom:40px">Chairman's Message</h2>
      <div class="flex" style="gap:48px;align-items:flex-start">
        <div class="join-img" style="min-width:280px"></div>
        <div class="join-content">
          <p>"The foundation of the Donyi Sanggo Culture Preservation Society rests upon a philosophy of service — protecting the age-old rich cultural heritage of the tribal society from extinction."</p>
          <p><em>"Our goal is to be at the forefront of the society, to preserve what our ancestors left us and to ensure our youth can stand tall with pride in their identity."</em></p>
          <p class="signature">&#8212; Shri Kabang Taki, Chairman, DSCPS</p>
        </div>
      </div>
    </section>

    <!-- What's New -->
    <section class="section-pad">
      <h1 class="section-title">What's New?</h1>
      <div class="news-grid">
        <div class="news-card">
          <div class="news-img news-img-1"></div>
          <h3>Visit to Your Village</h3>
          <p>Continuing our village outreach programme, covering 2–3 villages annually in far-flung interior areas with no proper road or telecom access.</p>
        </div>
        <div class="news-card">
          <div class="news-img news-img-2"></div>
          <h3>Awareness Programme</h3>
          <p>Raising awareness on Drug Abuse, Alcoholism, Child Marriage and other social issues through audio-video shows in unreached villages.</p>
        </div>
        <div class="news-card">
          <div class="news-img news-img-3"></div>
          <h3>Training & Workshops</h3>
          <p>Organising training and workshop programmes in collaboration with govt. and non-govt. departments, CBOs and NGOs for knowledge dissemination.</p>
        </div>
      </div>
    </section>

    <!-- Contact -->
    <section class="section-pad" id="contact">
      <h1 class="section-title">Contact Us</h1>

      <?php if (isset($_GET['success'])): ?>
        <div class="msg-success">Thank you! Your message has been sent.</div>
      <?php endif; ?>
      <?php if (isset($_GET['error'])): ?>
        <div class="msg-error">Something went wrong. Please try again.</div>
      <?php endif; ?>

      <div class="contact-grid">
        <div class="contact-form-box">
          <h3>Send Us a Message</h3>
          <form action="<?= BASE ?>/src/pages/contact-process.php" method="POST">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="tel" name="contact" placeholder="Phone Number" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="text" name="country" placeholder="Country" required>
            <input type="text" name="state" placeholder="State" required>
            <input type="text" name="city" placeholder="City" required>
            <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
            <button type="submit">Send Message &#x2192;</button>
          </form>
        </div>
        <div class="contact-info-box">
          <div class="card">
            <h3 style="margin-bottom:16px">Contact Information</h3>
            <div class="contact-row">
              <div class="contact-icon">&#x1F4CD;</div>
              <div>
                <h4>Location</h4>
                <p>Head Office-Pangin, Siang District; Camp Office-Chimpu, Itanagar, Papumpare District, Arunachal Pradesh.</p>
              </div>
            </div>
            <div class="contact-row">
              <div class="contact-icon">&#x1F4DE;</div>
              <div>
                <h4>Phone</h4>
                <p>+91 12345 67890</p>
              </div>
            </div>
            <div class="contact-row">
              <div class="contact-icon">&#x2709;&#xFE0F;</div>
              <div>
                <h4>Email</h4>
                <p>info@dscps.org</p>
              </div>
            </div>
            
          </div>
          <div class="card">
            <h3 style="margin-bottom:16px">Follow Us</h3>
            <div class="social-links">
              <a href="#" aria-label="Facebook">
                <svg viewBox="0 0 512 509.64" xmlns="http://www.w3.org/2000/svg">
                  <path d="M115.613 0h280.774C459.974 0 512 52.026 512 115.612v278.415c0 63.588-52.026 115.613-115.613 115.613H287.015V332.805h69.253l14.365-78.229h-83.618v-27.667c0-41.341 16.218-57.241 58.194-57.241 13.04 0 23.533.317 29.576.953V99.706c-11.448-3.18-39.434-6.361-55.651-6.361-85.545 0-124.977 40.388-124.977 127.522v33.709h-52.79v78.229h52.79V509.64h-78.544C52.026 509.64 0 457.615 0 394.027V115.612C0 52.026 52.026 0 115.613 0z"></path>
                </svg>
              </a>
              <a href="#" aria-label="X/Twitter">
                <svg viewBox="0 0 512 509.64" xmlns="http://www.w3.org/2000/svg">
                  <rect width="512" height="509.64" rx="115.61" ry="115.61"></rect>
                  <path fill="#fff" d="M323.74 148.35h36.12l-78.91 90.2 92.83 122.73h-72.69l-56.93-74.43-65.15 74.43h-36.14l84.4-96.47-89.05-116.46h74.53l51.46 68.04 59.53-68.04zm-12.68 191.31h20.02l-129.2-170.82H180.4l130.66 170.82z"></path>
                </svg>
              </a>
              <a href="#" aria-label="Instagram">
                <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                  <path d="M170.663 256.157c-.083-47.121 38.055-85.4 85.167-85.482 47.121-.092 85.407 38.029 85.499 85.159.091 47.13-38.047 85.4-85.176 85.492-47.112.09-85.399-38.039-85.49-85.169zm-46.108.092c.141 72.602 59.106 131.327 131.69 131.185 72.592-.14 131.35-59.089 131.209-131.691-.141-72.577-59.114-131.336-131.715-131.194-72.585.141-131.325 59.114-131.184 131.7zm237.104-137.092c.033 16.954 13.817 30.682 30.772 30.649 16.961-.034 30.689-13.811 30.664-30.765-.033-16.954-13.818-30.69-30.78-30.656-16.962.033-30.689 13.818-30.656 30.772zm-208.696 345.4c-24.958-1.086-38.511-5.234-47.543-8.709-11.961-4.628-20.496-10.177-29.479-19.093-8.966-8.951-14.532-17.461-19.202-29.397-3.508-9.033-7.73-22.569-8.9-47.527-1.269-26.983-1.559-35.078-1.683-103.433-.133-68.338.116-76.434 1.294-103.441 1.069-24.941 5.242-38.512 8.709-47.536 4.628-11.977 10.161-20.496 19.094-29.478 8.949-8.983 17.459-14.532 29.403-19.202 9.025-3.526 22.561-7.715 47.511-8.9 26.998-1.278 35.085-1.551 103.423-1.684 68.353-.133 76.448.108 103.456 1.294 24.94 1.086 38.51 5.217 47.527 8.709 11.968 4.628 20.503 10.145 29.478 19.094 8.974 8.95 14.54 17.443 19.21 29.413 3.524 8.999 7.714 22.552 8.892 47.494 1.285 26.998 1.576 35.094 1.7 103.432.132 68.355-.117 76.451-1.302 103.442-1.087 24.957-5.226 38.52-8.709 47.56-4.629 11.953-10.161 20.488-19.103 29.471-8.941 8.949-17.451 14.531-29.403 19.201-9.009 3.517-22.561 7.714-47.494 8.9-26.998 1.269-35.086 1.56-103.448 1.684-68.338.133-76.424-.124-103.431-1.294zM149.977 1.773c-27.239 1.286-45.843 5.648-62.101 12.019-16.829 6.561-31.095 15.353-45.286 29.603C28.381 57.653 19.655 71.944 13.144 88.79c-6.303 16.299-10.575 34.912-11.778 62.168C.172 178.264-.102 186.973.031 256.489c.133 69.508.439 78.234 1.741 105.548 1.302 27.231 5.649 45.827 12.019 62.092 6.569 16.83 15.353 31.089 29.611 45.289 14.25 14.2 28.55 22.918 45.404 29.438 16.282 6.294 34.902 10.583 62.15 11.777 27.305 1.203 36.022 1.468 105.521 1.336 69.532-.133 78.25-.44 105.555-1.734 27.239-1.302 45.826-5.664 62.1-12.019 16.829-6.585 31.095-15.353 45.288-29.611 14.191-14.251 22.917-28.55 29.428-45.404 6.304-16.282 10.592-34.904 11.777-62.134 1.195-27.323 1.478-36.049 1.344-105.557-.133-69.516-.447-78.225-1.741-105.522-1.294-27.256-5.657-45.844-12.019-62.118-6.577-16.829-15.352-31.08-29.602-45.288-14.25-14.192-28.55-22.935-45.404-29.429-16.29-6.304-34.903-10.6-62.15-11.778C333.747.164 325.03-.101 255.506.031c-69.507.133-78.224.431-105.529 1.742z"></path>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>

  <?php include 'src/includes/footer.php'; ?>
  <script src="<?= ASSETS ?>/js/main.js"></script>
</body>

</html>
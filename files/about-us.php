<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/files/connection.php';
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Learn about Yaafta — Karachi's honest, locally-run restaurant discovery platform. Find out how we review restaurants, who we are, and why thousands of Karachi diners trust us." />
  <meta name="keywords" content="about Yaafta, Karachi food guide, restaurant reviews Karachi, honest restaurant listings Pakistan" />
  <meta name="author" content="Yaafta Editorial Team" />
  <meta name="robots" content="index, follow" />
  <link rel="canonical" href="https://yaafta.com/files/about-us">
   <link rel="icon" href="images/favicon.svg" type="image/svg+xml">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/x-icon" href="images/yaafta_favicon.ico">
    <link rel="manifest" href="images/site.webmanifest">
  <title>About Us | Yaafta — Karachi's Honest Restaurant Guide</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>

<!-- Google tag -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-4R19BFTQEM"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-4R19BFTQEM');
</script>

<body>

  <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/files/layout/header.php';
  ?>

  <!-- =====================
       HERO
  ===================== -->
  <section class="about-hero">
    <div class="container">
      <div class="about-hero-inner">
        <span class="badge">About Yaafta</span>
        <h1 class="about-hero-title">
          Karachi's Restaurant Guide — <em>Built by Locals, for Locals</em>
        </h1>
        <p class="about-hero-sub">
          We started Yaafta because finding a genuinely good restaurant in Karachi 
          shouldn't require scrolling through paid ads and outdated listings for 20 minutes. 
          Everything on this site is researched, visited, and written by people who actually 
          live and eat here.
        </p>
        <div class="about-hero-stats">
          <div class="about-stat">
            <span class="about-stat-num">120+</span>
            <span class="about-stat-label">Restaurants Reviewed</span>
          </div>
          <div class="about-stat-divider"></div>
          <div class="about-stat">
            <span class="about-stat-num">10+</span>
            <span class="about-stat-label">Karachi Areas Covered</span>
          </div>
          <div class="about-stat-divider"></div>
          <div class="about-stat">
            <span class="about-stat-num">10k+</span>
            <span class="about-stat-label">Monthly Readers</span>
          </div>
          <div class="about-stat-divider"></div>
          <div class="about-stat">
            <span class="about-stat-num">2019</span>
            <span class="about-stat-label">Year Founded</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- =====================
       OUR STORY
  ===================== -->
  <section class="section">
    <div class="container">
      <div class="about-story-grid">

        <div class="about-story-text">
          <span class="eeat-tag">Our Story</span>
          <h2 class="about-section-heading">Why We Built This</h2>
          <p class="about-text">
            Karachi has one of the most diverse food scenes in South Asia — from the 
            smoky charcoal grills of Burns Road to the modern brunch spots of DHA and 
            Clifton. But for years, finding reliable information about those places meant 
            wading through Google Maps reviews with no context, Facebook posts from 2018, 
            or blogs that hadn't been updated since the restaurant closed.
          </p>
          <p class="about-text">
            Yaafta was started in 2019 by a small group of Karachi-based food 
            enthusiasts who wanted a single, trustworthy place to answer the question: 
            <strong>"Where should we eat tonight?"</strong> — without the noise.
          </p>
          <p class="about-text">
            Today we cover 10+ neighbourhoods, with every listing personally verified 
            by our team before it goes live. We update listings when menus change, 
            when restaurants close, or when quality drops. We don't take shortcuts 
            because our readers don't deserve shortcuts.
          </p>
        </div>

        <div class="about-story-aside">
          <div class="about-values-card">
            <h3 class="about-values-title">What We Stand For</h3>
            <ul class="about-values-list">
              <li>
                <span class="about-values-icon">🚫</span>
                <div>
                  <strong>No paid rankings</strong>
                  <p>Restaurants cannot pay to appear higher or remove negative feedback</p>
                </div>
              </li>
              <li>
                <span class="about-values-icon">✅</span>
                <div>
                  <strong>In-person visits only</strong>
                  <p>We dine before we write — every single time</p>
                </div>
              </li>
              <li>
                <span class="about-values-icon">🔄</span>
                <div>
                  <strong>Regular updates</strong>
                  <p>Listings are reviewed and refreshed — not abandoned after publishing</p>
                </div>
              </li>
              <li>
                <span class="about-values-icon">🗣️</span>
                <div>
                  <strong>Reader corrections welcome</strong>
                  <p>Spotted something wrong? We act on flagged listings within 72 hours</p>
                </div>
              </li>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- =====================
       HOW WE REVIEW
  ===================== -->
  <section class="section about-review-section">
    <div class="container">
      <div class="about-review-header">
        <span class="eeat-tag">Our Process</span>
        <h2 class="about-section-heading">How We Review a Restaurant</h2>
        <p class="about-text" style="max-width:60ch;">
          Every listing follows the same process — no exceptions, no shortcuts, 
          regardless of whether it's a small dhaba or an upscale dinner spot.
        </p>
      </div>

      <div class="about-steps">
        <div class="about-step">
          <div class="about-step-num">01</div>
          <h3>We visit in person</h3>
          <p>A member of our team visits unannounced, orders from the regular menu, and pays the full price. Restaurants are never told in advance.</p>
        </div>
        <div class="about-step">
          <div class="about-step-num">02</div>
          <h3>We assess 5 key areas</h3>
          <p>Food quality, portion size, value for money, service, and hygiene are each scored individually — not lumped into one vague star rating.</p>
        </div>
        <div class="about-step">
          <div class="about-step-num">03</div>
          <h3>We write it honestly</h3>
          <p>The review is written by the person who visited. No rewrites from the restaurant, no "sponsored content" disclaimers hiding paid promotion.</p>
        </div>
        <div class="about-step">
          <div class="about-step-num">04</div>
          <h3>An editor reviews it</h3>
          <p>Before publishing, a second team member checks facts — address, hours, price range — against current information to catch anything outdated.</p>
        </div>
        <div class="about-step">
          <div class="about-step-num">05</div>
          <h3>We keep it current</h3>
          <p>Published listings are flagged for re-review every 6 months, or immediately when a reader reports a significant change.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- =====================
       WHO WE SERVE
  ===================== -->
  <section class="section">
    <div class="container">
      <span class="eeat-tag">Who It's For</span>
      <h2 class="about-section-heading" style="margin: 12px 0 28px;">
        Built for Every Kind of Karachi Diner
      </h2>
      <div class="about-audience-grid">
        <div class="about-audience-card">
          <span class="about-audience-icon">👨‍👩‍👧</span>
          <h3>Families</h3>
          <p>Looking for a comfortable, kid-friendly spot for a weekend lunch without the guesswork.</p>
        </div>
        <div class="about-audience-card">
          <span class="about-audience-icon">💼</span>
          <h3>Professionals</h3>
          <p>Need a reliable lunch spot near the office or a decent place to take a client for dinner.</p>
        </div>
        <div class="about-audience-card">
          <span class="about-audience-icon">🎓</span>
          <h3>Students</h3>
          <p>Want good food on a budget without ending up somewhere disappointing.</p>
        </div>
        <div class="about-audience-card">
          <span class="about-audience-icon">🌍</span>
          <h3>Visitors</h3>
          <p>New to Karachi or just visiting a different area and need a trustworthy local recommendation.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- =====================
       FULL E-EAT SECTION
  ===================== -->
  <section class="section eeat-section" id="eeat">
    <div class="container">
      <div class="eeat-box">
        <div class="eeat-header">
          <div class="eeat-header-left">
            <span class="eeat-tag">Editorial Standards</span>
            <h2 class="eeat-title">How We Meet Google's E-EAT Standards</h2>
            <p class="eeat-desc">
              Yaafta follows 
              <a href="https://developers.google.com/search/docs/fundamentals/creating-helpful-content"
                 target="_blank" rel="noopener" class="eeat-link">Google's E-EAT guidelines</a> 
              — Experience, Expertise, Authoritativeness, and Trustworthiness — as a framework 
              for every piece of content we publish. Here's exactly what that means in practice.
            </p>
          </div>
          <div class="eeat-score">
            <span class="eeat-score-num">4.7</span>
            <span class="eeat-score-stars">★★★★★</span>
            <span class="eeat-score-label">Editor Rating Average</span>
            <span class="eeat-score-sub">Across 120+ reviewed listings</span>
          </div>
        </div>

        <div class="eeat-grid">
          <div class="eeat-card">
            <div class="eeat-card-icon">🧭</div>
            <h3>Experience</h3>
            <p>Our reviewers physically visit and dine at every restaurant before writing. We have logged <strong>300+ restaurant visits</strong> across Karachi — from Burns Road dhabas to upscale DHA dining rooms. No stock photos, no owner-submitted copy.</p>
            <div class="eeat-card-footer"><span class="eeat-pill">✓ In-Person Visits Only</span></div>
          </div>
          <div class="eeat-card">
            <div class="eeat-card-icon">🎓</div>
            <h3>Expertise</h3>
            <p>Our team has covered Karachi's food scene since 2019. We understand how cuisine quality, pricing, and service vary across neighbourhoods. Every published piece is reviewed by an editor with direct local knowledge of the area.</p>
            <div class="eeat-card-footer"><span class="eeat-pill">✓ 5+ Years Local Coverage</span></div>
          </div>
          <div class="eeat-card">
            <div class="eeat-card-icon">🏅</div>
            <h3>Authoritativeness</h3>
            <p>Our neighbourhood guides are referenced by local food bloggers and rank organically because they are written for real diners. Listings are cross-checked and updated whenever a restaurant changes ownership, menu, or closes.</p>
            <div class="eeat-card-footer"><span class="eeat-pill">✓ Regularly Fact-Checked</span></div>
          </div>
          <div class="eeat-card">
            <div class="eeat-card-icon">🔒</div>
            <h3>Trustworthiness</h3>
            <p>We never accept payment for listings, rankings, or reviews. Our ratings combine an editorial score with verified reader submissions — moderated before going live. What you read is what we genuinely found.</p>
            <div class="eeat-card-footer"><span class="eeat-pill">✓ No Paid Placements — Ever</span></div>
          </div>
        </div>

        <div class="eeat-footer-note">
          <span class="eeat-footer-icon">📋</span>
          <p>
            Found outdated information or a restaurant that has closed? 
            <a href="<?php echo BASE_URL; ?>files/contact" class="eeat-link">Let us know</a> 
            — we aim to update flagged listings within 72 hours.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- =====================
       CONTACT CTA
  ===================== -->
  <section class="section">
    <div class="container">
      <div class="about-cta-box">
        <h2 class="about-cta-title">Have a Restaurant We Should Cover?</h2>
        <p class="about-cta-sub">
          Know a hidden gem in Karachi that deserves more attention? We're always 
          looking for new places to visit and review. Drop us a message and our 
          team will check it out.
        </p>
        <div class="about-cta-actions">
          <a href="<?php echo BASE_URL; ?>files/contact" class="btn btn-primary">Suggest a Restaurant</a>
          <a href="<?php echo BASE_URL; ?>" class="btn btn-outline">Browse Listings</a>
        </div>
      </div>
    </div>
  </section>

  <?php include_once 'layout/footer.php'; ?>
  <script src="../index.js"></script>

</body>
</html>
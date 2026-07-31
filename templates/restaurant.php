<?php
// connection.php already included by router.php ($con available)

$citySlug       = $_GET['city_slug'] ?? '';
$areaSlug       = $_GET['area_slug'] ?? '';
$restaurantSlug = $_GET['restaurant_slug'] ?? '';

$stmt = $con->prepare("
    SELECT r.*, a.name AS area_name, a.slug AS area_slug,
           c.name AS city_name, c.slug AS city_slug
    FROM restaurants r
    JOIN areas a ON a.id = r.area_id
    JOIN cities c ON c.id = a.city_id
    WHERE r.slug = ? AND a.slug = ? AND c.slug = ?
");
$stmt->bind_param("sss", $restaurantSlug, $areaSlug, $citySlug);
$stmt->execute();
$restaurant = $stmt->get_result()->fetch_assoc();

if (!$restaurant) {
    http_response_code(404);
    include __DIR__ . '/404.php';
    exit;
}

$restaurantId       = $restaurant['id'];
$restaurantName     = $restaurant['name'];
$restaurantArea     = $restaurant['area_name'];
$restaurantAreaSlug = $restaurant['area_slug'];
$restaurantCitySlug = $restaurant['city_slug'];
$restaurantCityName = $restaurant['city_name'];
$restaurantCuisine  = $restaurant['cuisine'];

// categories for this restaurant (many-to-many)
$catStmt = $con->prepare("
    SELECT c.name, c.slug FROM categories c
    JOIN restaurant_categories rc ON rc.category_id = c.id
    WHERE rc.restaurant_id = ?
");
$catStmt->bind_param("i", $restaurantId);
$catStmt->execute();
$categories = $catStmt->get_result()->fetch_all(MYSQLI_ASSOC);

// images: hero (is_hero=1) + up to 3 gallery images, matches every existing page's 4-image gallery
$imgStmt = $con->prepare("SELECT image_path, alt_text, is_hero FROM restaurant_images WHERE restaurant_id = ? ORDER BY is_hero DESC, sort_order ASC");
$imgStmt->bind_param("i", $restaurantId);
$imgStmt->execute();
$allImages = $imgStmt->get_result()->fetch_all(MYSQLI_ASSOC);
$heroImage = $restaurant['image_url'] ?: (($allImages[0]['image_path'] ?? null));
$galleryImages = array_slice($allImages, 0, 4); // hero + up to 3 more, matches existing pages

// real imported Google reviews
$grStmt = $con->prepare("SELECT reviewer_name, review_date_text, star_rating, review_text FROM restaurant_google_reviews WHERE restaurant_id = ? ORDER BY sort_order ASC, id ASC");
$grStmt->bind_param("i", $restaurantId);
$grStmt->execute();
$googleReviews = $grStmt->get_result()->fetch_all(MYSQLI_ASSOC);

// highlights / what people say: stored one-per-line
$highlightsList = array_filter(array_map('trim', explode("\n", $restaurant['highlights'] ?? '')));
$quotesList     = array_filter(array_map('trim', explode("\n", $restaurant['what_people_say'] ?? '')));

$pageTitle = htmlspecialchars($restaurantName) . ' ' . htmlspecialchars($restaurantArea) . ' Karachi | Yaafta';
$metaDesc  = htmlspecialchars($restaurant['meta_description'] ?: ($restaurantName . ' in ' . $restaurantArea . ', Karachi. Read reviews, menu, location, and photos on Yaafta.'));
$metaKeywords = htmlspecialchars($restaurant['meta_keywords'] ?: '');
$canonical = BASE_URL . $restaurantCitySlug . '/' . $restaurantAreaSlug . '/' . $restaurantSlug;

$backUrl = BASE_URL;
if (!empty($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], parse_url(BASE_URL, PHP_URL_HOST)) !== false) {
    $backUrl = $_SERVER['HTTP_REFERER'];
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="<?php echo $metaDesc; ?>" />
  <?php if ($metaKeywords): ?>
  <meta name="keywords" content="<?php echo $metaKeywords; ?>" />
  <?php endif; ?>
  <meta name="author" content="Yaafta" />
  <meta name="robots" content="index, follow" />
  <link rel="icon" href="<?php echo BASE_URL; ?>files/images/favicon.svg" type="image/svg+xml">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE_URL; ?>files/images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL; ?>files/images/favicon-16x16.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASE_URL; ?>files/images/apple-touch-icon.png">
  <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL; ?>files/images/yaafta_favicon.ico">
  <link rel="manifest" href="<?php echo BASE_URL; ?>files/images/site.webmanifest">
  <link rel="canonical" href="<?php echo htmlspecialchars($canonical); ?>">
  <title><?php echo $pageTitle; ?></title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css" />

  <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "@id": "<?php echo htmlspecialchars($canonical); ?>#breadcrumb",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Home", "item": "<?php echo BASE_URL; ?>" },
    { "@type": "ListItem", "position": 2, "name": "<?php echo htmlspecialchars($restaurantArea); ?> Restaurants", "item": "<?php echo BASE_URL . $restaurantCitySlug . '/' . $restaurantAreaSlug; ?>" },
    { "@type": "ListItem", "position": 3, "name": "<?php echo htmlspecialchars($restaurantName); ?>", "item": "<?php echo htmlspecialchars($canonical); ?>" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "@id": "<?php echo BASE_URL; ?>#website",
  "url": "<?php echo BASE_URL; ?>",
  "name": "Yaafta",
  "alternateName": "Yafta",
  "description": "Discover the best restaurants in Karachi with detailed reviews, menus, prices, photos, locations, and dining guides.",
  "inLanguage": "en-PK",
  "publisher": { "@type": "Organization", "@id": "<?php echo BASE_URL; ?>#organization" }
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "@id": "<?php echo BASE_URL; ?>#organization",
  "name": "Yaafta",
  "url": "<?php echo BASE_URL; ?>",
  "logo": { "@type": "ImageObject", "url": "<?php echo BASE_URL; ?>files/images/logo-3.png" },
  "sameAs": ["https://www.facebook.com/yourpage", "https://www.instagram.com/yourpage"]
}
</script>
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-4R19BFTQEM"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-4R19BFTQEM');
</script>
<body>

  <?php include __DIR__ . '/../files/layout/header.php'; ?>

  <section class="restaurant-hero">
    <div class="container">
      <nav class="breadcrumb">
        <a href="<?php echo BASE_URL ?>">Home</a>
        <span>›</span>
        <a href="<?php echo BASE_URL . $restaurantCitySlug . '/' . $restaurantAreaSlug; ?>"><?php echo htmlspecialchars($restaurantArea); ?></a>
        <span>›</span>
        <span><?php echo htmlspecialchars($restaurantName); ?></span>
        <span class="breadcrumb-divider">|</span>
        <a href="<?php echo htmlspecialchars($backUrl); ?>" class="back-nav-link">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M15 18l-6-6 6-6" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          Back
        </a>
      </nav>

      <div class="restaurant-hero-grid">
        <div class="restaurant-info">
          <h1 class="restaurant-title"><?php echo htmlspecialchars($restaurantName); ?></h1>

          <div class="restaurant-meta">
            <?php if ($restaurant['display_rating']): ?>
              <span>⭐ <?php echo htmlspecialchars($restaurant['display_rating']); ?> Rating</span>
            <?php endif; ?>
            <?php if ($restaurantCuisine): ?>
              <span>🍽️ <?php echo htmlspecialchars($restaurantCuisine); ?></span>
            <?php endif; ?>
            <?php if ($restaurant['review_count_text']): ?>
              <span><?php echo htmlspecialchars($restaurant['review_count_text']); ?></span>
            <?php endif; ?>
          </div>

          <?php if ($restaurant['description']): ?>
            <p class="restaurant-description"><?php echo nl2br(htmlspecialchars($restaurant['description'])); ?></p>
          <?php endif; ?>

          <div class="restaurant-actions">
            <?php if ($restaurant['google_maps_url']): ?>
              <a href="<?php echo htmlspecialchars($restaurant['google_maps_url']); ?>" class="btn btn-primary">Get Directions</a>
            <?php endif; ?>
            <?php if ($restaurant['menu_url']): ?>
              <a href="<?php echo htmlspecialchars($restaurant['menu_url']); ?>" class="btn btn-outline">View Menu</a>
            <?php endif; ?>
            <?php if ($restaurant['phone']): ?>
              <a href="tel:<?php echo htmlspecialchars($restaurant['phone']); ?>" class="btn btn-outline">Call: <?php echo htmlspecialchars($restaurant['phone']); ?></a>
            <?php endif; ?>
          </div>
        </div>

        <div class="restaurant-image">
          <?php if ($heroImage): ?>
            <img src="<?php echo htmlspecialchars($heroImage); ?>" alt="<?php echo htmlspecialchars($restaurantName); ?> ambiance and food" loading="eager" fetchpriority="high" decoding="async" />
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>

  <?php include __DIR__ . '/../files/layout/quicknav.php'; ?>

  <section class="section">
    <div class="container restaurant-details">
      <div class="details-grid">

        <div class="details-main">

          <?php if ($restaurant['about_content']): ?>
            <h2>About <?php echo htmlspecialchars($restaurantName); ?></h2>
            <?php foreach (array_filter(explode("\n\n", $restaurant['about_content'])) as $para): ?>
              <p><?php echo nl2br(htmlspecialchars(trim($para))); ?></p>
            <?php endforeach; ?>
          <?php endif; ?>

          <?php if ($highlightsList): ?>
            <h2>Why Visit <?php echo htmlspecialchars($restaurantName); ?>?</h2>
            <ul class="restaurant-highlights">
              <?php foreach ($highlightsList as $h): ?>
                <li>✔ <?php echo htmlspecialchars($h); ?></li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>

          <?php if ($quotesList): ?>
            <h3>What People Are Saying</h3>
            <ul class="reviews-list">
              <?php foreach ($quotesList as $q): ?>
                <li>"<?php echo htmlspecialchars($q); ?>"</li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>

          <?php if ($restaurant['signature_dishes']): ?>
            <h3>Signature Dishes and Menu Highlights</h3>
            <?php foreach (array_filter(explode("\n\n", $restaurant['signature_dishes'])) as $para): ?>
              <p><?php echo nl2br(htmlspecialchars(trim($para))); ?></p>
            <?php endforeach; ?>
          <?php endif; ?>

          <?php if ($restaurant['pricing_value']): ?>
            <h3>Pricing and Value</h3>
            <?php foreach (array_filter(explode("\n\n", $restaurant['pricing_value'])) as $para): ?>
              <p><?php echo nl2br(htmlspecialchars(trim($para))); ?></p>
            <?php endforeach; ?>
          <?php endif; ?>

          <?php if ($restaurant['ambience_experience']): ?>
            <h3>Ambience and Experience</h3>
            <?php foreach (array_filter(explode("\n\n", $restaurant['ambience_experience'])) as $para): ?>
              <p><?php echo nl2br(htmlspecialchars(trim($para))); ?></p>
            <?php endforeach; ?>
          <?php endif; ?>

          <?php if ($restaurant['best_time_to_visit']): ?>
            <h3>Best Time to Visit</h3>
            <?php foreach (array_filter(explode("\n\n", $restaurant['best_time_to_visit'])) as $para): ?>
              <p><?php echo nl2br(htmlspecialchars(trim($para))); ?></p>
            <?php endforeach; ?>
          <?php endif; ?>

          <?php if ($restaurant['final_thoughts']): ?>
            <h3>Final Thoughts</h3>
            <?php foreach (array_filter(explode("\n\n", $restaurant['final_thoughts'])) as $para): ?>
              <p><?php echo nl2br(htmlspecialchars(trim($para))); ?></p>
            <?php endforeach; ?>
          <?php endif; ?>

          <?php if ($restaurant['last_updated']): ?>
            <p class="post-updated-simple">
              🗓️ Last updated: <strong><?php echo date('F Y', strtotime($restaurant['last_updated'])); ?></strong>
            </p>
          <?php endif; ?>
        </div>

        <aside class="details-sidebar">
          <?php if ($restaurant['address'] || $restaurant['timing'] || $restaurant['price_range'] || $restaurant['phone']): ?>
          <div class="info-card" id="restaurant-info-card">
            <h3>Restaurant Info</h3>
            <?php if ($restaurant['address']): ?><p><strong>Location:</strong> <?php echo htmlspecialchars($restaurant['address']); ?></p><?php endif; ?>
            <?php if ($restaurant['timing']): ?><p><strong>Timing:</strong> <?php echo htmlspecialchars($restaurant['timing']); ?></p><?php endif; ?>
            <?php if ($restaurant['price_range']): ?><p><strong>Price Range:</strong> <?php echo htmlspecialchars($restaurant['price_range']); ?></p><?php endif; ?>
            <?php if ($restaurant['phone']): ?><p><strong>Phone Number:</strong> <?php echo htmlspecialchars($restaurant['phone']); ?></p><?php endif; ?>
          </div>
          <?php endif; ?>

          <?php if ($restaurant['map_embed_query']): ?>
          <div class="info-card map-card" id="map-card">
            <h3>Find <?php echo htmlspecialchars($restaurantName); ?> on the Map</h3>
            <div class="map-embed-wrapper">
              <iframe
                src="https://www.google.com/maps?q=<?php echo urlencode($restaurant['map_embed_query']); ?>&output=embed"
                width="100%" height="250" style="border:0; border-radius:8px;"
                allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                title="<?php echo htmlspecialchars($restaurantName); ?> location map">
              </iframe>
            </div>
          </div>
          <?php endif; ?>

          <?php if ($restaurant['menu_url'] || $restaurant['google_maps_url'] || $restaurant['instagram_url'] || $restaurant['facebook_url'] || $restaurant['foodpanda_url']): ?>
          <div class="info-card" id="quick-links-card">
            <h3>Quick Links</h3>
            <?php if ($restaurant['menu_url']): ?><a href="<?php echo htmlspecialchars($restaurant['menu_url']); ?>">View Menu</a><?php endif; ?>
            <?php if ($restaurant['google_maps_url']): ?><a href="<?php echo htmlspecialchars($restaurant['google_maps_url']); ?>">Google Maps</a><?php endif; ?>
            <?php if ($restaurant['instagram_url']): ?><a href="<?php echo htmlspecialchars($restaurant['instagram_url']); ?>">Instagram</a><?php endif; ?>
            <?php if ($restaurant['facebook_url']): ?><a href="<?php echo htmlspecialchars($restaurant['facebook_url']); ?>">Facebook</a><?php endif; ?>
            <?php if ($restaurant['foodpanda_url']): ?><a href="<?php echo htmlspecialchars($restaurant['foodpanda_url']); ?>">Foodpanda</a><?php endif; ?>
          </div>
          <?php endif; ?>

          <?php if ($googleReviews): ?>
          <div class="info-card rs-card" id="reviews-card">
            <h3>
              <svg width="14" height="14" viewBox="0 0 48 48" style="vertical-align:-2px;margin-right:5px;" aria-hidden="true">
                <path fill="#EA4335" d="M24 9.5c3.3 0 6.2 1.1 8.5 3.3l6.4-6.4C34.9 2.8 29.8.5 24 .5 14.8.5 6.9 5.9 3.1 13.9l7.4 5.8C12.4 13.1 17.7 9.5 24 9.5z"/>
                <path fill="#4285F4" d="M46.5 24.5c0-1.6-.1-3.1-.4-4.5H24v8.5h12.7c-.6 3-2.3 5.5-4.9 7.2l7.6 5.9c4.4-4.1 7.1-10.1 7.1-17.1z"/>
                <path fill="#FBBC05" d="M10.5 28.3A15 15 0 0 1 9.5 24c0-1.5.3-3 .7-4.3L2.8 13.9A23.5 23.5 0 0 0 .5 24c0 3.7.9 7.2 2.3 10.3l7.7-6z"/>
                <path fill="#34A853" d="M24 47.5c5.8 0 10.7-1.9 14.3-5.2l-7.6-5.9c-2 1.3-4.5 2.1-6.7 2.1-6.3 0-11.6-3.6-13.5-9.2l-7.7 6C6.9 42.1 14.8 47.5 24 47.5z"/>
              </svg>
              Google Reviews
            </h3>

            <?php if ($restaurant['display_rating']): ?>
            <div class="rs-summary">
              <span class="rs-score"><?php echo htmlspecialchars($restaurant['display_rating']); ?></span>
              <div>
                <div class="rs-stars"><?php
                  $full = round($restaurant['display_rating']);
                  echo str_repeat('★', $full) . str_repeat('☆', 5 - $full);
                ?></div>
                <div class="rs-count"><?php echo htmlspecialchars($restaurant['review_count_text'] ?: ''); ?></div>
              </div>
              <?php if ($restaurant['google_maps_url']): ?>
                <a href="<?php echo htmlspecialchars($restaurant['google_maps_url']); ?>" class="rs-view-all" target="_blank" rel="noopener noreferrer">View all →</a>
              <?php endif; ?>
            </div>
            <?php endif; ?>

            <div class="rs-outer">
              <div class="rs-track" id="rs-track" role="list">
                <?php foreach ($googleReviews as $gr): ?>
                  <div class="rs-review" role="listitem">
                    <div class="rs-reviewer">
                      <div class="rs-avatar"><?php echo htmlspecialchars(mb_substr($gr['reviewer_name'], 0, 1)); ?></div>
                      <div>
                        <div class="rs-name"><?php echo htmlspecialchars($gr['reviewer_name']); ?></div>
                        <div class="rs-date"><?php echo htmlspecialchars($gr['review_date_text']); ?></div>
                      </div>
                    </div>
                    <div class="rs-review-stars" aria-label="<?php echo (int)$gr['star_rating']; ?> out of 5 stars"><?php echo str_repeat('★', (int)$gr['star_rating']) . str_repeat('☆', 5 - (int)$gr['star_rating']); ?></div>
                    <p class="rs-text"><?php echo htmlspecialchars($gr['review_text']); ?></p>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>

            <div class="rs-controls">
              <button class="rs-btn" id="rs-prev" aria-label="Previous review">&#8249;</button>
              <div class="rs-dots" id="rs-dots" role="tablist" aria-label="Review navigation"></div>
              <button class="rs-btn" id="rs-next" aria-label="Next review">&#8250;</button>
            </div>
          </div>
          <?php endif; ?>

          <div class="nl-rest info-card">
            <div class="nl-rest-top">
              <span class="nl-tag-small">Exclusive deals</span>
              <h3>Get deals & updates from this restaurant</h3>
              <p>Be the first to know about discounts, new menu items, and events.</p>
            </div>
            <div class="nl-rest-body">
              <form action="<?php echo BASE_URL ?>files/newsletter.php" method="POST">
                <input type="email" name="email" placeholder="Your email address" required />
                <input type="hidden" name="return_url" value="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
                <button class="btn btn-primary" type="submit" style="width:100%; margin-top:10px;">✉ Get deals</button>
              </form>
              <ul class="nl-rest-perks">
                <li>🏷 Discount codes & offers</li>
                <li>🍽 New menu alerts</li>
                <li>📅 Special events & deals</li>
              </ul>
              <p class="nl-privacy">Unsubscribe anytime.</p>
            </div>
          </div>
        </aside>

      </div>

      <?php if ($galleryImages): ?>
      <section class="section" id="restaurant-gallery">
        <div class="container">
          <div class="section-header">
            <div>
              <h2 class="section-title"><?php echo htmlspecialchars($restaurantName); ?> Restaurant Photos</h2>
              <p class="section-subtitle">A visual look at the restaurant, seating, food, and ambiance.</p>
            </div>
          </div>
          <div class="grid simple-gallery">
            <?php foreach ($galleryImages as $img): ?>
              <a href="<?php echo htmlspecialchars($img['image_path']); ?>" class="lightbox">
                <img loading="lazy" src="<?php echo htmlspecialchars($img['image_path']); ?>" alt="<?php echo htmlspecialchars($img['alt_text'] ?: $restaurantName); ?>">
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </section>
      <?php endif; ?>

      <?php $excludeAreaId = $restaurant['area_id']; include __DIR__ . '/../files/layout/categories-list.php'; ?>
    </div>
  </section>

  <?php
  include __DIR__ . '/../files/layout/review-widget.php';
  include __DIR__ . '/../files/layout/footer.php';
  ?>

  <script src="<?php echo BASE_URL; ?>index.js"></script>
</body>
</html>
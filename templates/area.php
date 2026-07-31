<?php
// connection.php already included by router.php ($con available)

$citySlug = $_GET['city_slug'] ?? '';
$areaSlug = $_GET['area_slug'] ?? '';

$stmt = $con->prepare("
    SELECT a.*, c.name AS city_name, c.slug AS city_slug
    FROM areas a
    JOIN cities c ON c.id = a.city_id
    WHERE a.slug = ? AND c.slug = ?
");
$stmt->bind_param("ss", $areaSlug, $citySlug);
$stmt->execute();
$area = $stmt->get_result()->fetch_assoc();

if (!$area) {
    http_response_code(404);
    include __DIR__ . '/404.php';
    exit;
}

$areaId = $area['id'];

$rStmt = $con->prepare("
    SELECT id, slug, name, cuisine, image_url, display_rating
    FROM restaurants
    WHERE area_id = ?
    ORDER BY display_rating DESC, name ASC
    LIMIT 10
");
$rStmt->bind_param("i", $areaId);
$rStmt->execute();
$restaurants = $rStmt->get_result()->fetch_all(MYSQLI_ASSOC);

$faqStmt = $con->prepare("SELECT question, answer FROM area_faqs WHERE area_id = ? ORDER BY sort_order ASC, id ASC");
$faqStmt->bind_param("i", $areaId);
$faqStmt->execute();
$faqs = $faqStmt->get_result()->fetch_all(MYSQLI_ASSOC);

$pageTitle = 'Best Restaurants in ' . htmlspecialchars($area['name']) . ' Karachi | Yaafta';
$metaDesc  = htmlspecialchars($area['meta_description'] ?: ('Discover the best restaurants in ' . $area['name'] . ' Karachi. Explore top cafes, fine dining spots, menus, reviews, and contact details.'));
$metaKeywords = htmlspecialchars($area['meta_keywords'] ?: '');
$canonical = BASE_URL . $area['city_slug'] . '/' . $area['slug'];
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

  <?php if ($faqs): ?>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
      <?php foreach ($faqs as $i => $f): ?>
      {
        "@type": "Question",
        "name": <?php echo json_encode($f['question']); ?>,
        "acceptedAnswer": { "@type": "Answer", "text": <?php echo json_encode($f['answer']); ?> }
      }<?php echo $i < count($faqs) - 1 ? ',' : ''; ?>
      <?php endforeach; ?>
    ]
  }
  </script>
  <?php endif; ?>
</head>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-4R19BFTQEM"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-4R19BFTQEM');
</script>
<body>

  <?php include __DIR__ . '/../files/layout/header.php'; ?>

  <main id="home">
    <section class="hero">
      <div class="container">
        <h1 class="hero-title">Best Restaurants in <?php echo htmlspecialchars($area['name']); ?> Karachi</h1>
        <p class="hero-subtitle">
          <?php echo $area['hero_subtitle']
            ? htmlspecialchars($area['hero_subtitle'])
            : 'Discover the best restaurants in ' . htmlspecialchars($area['name']) . ' Karachi: in-depth details, locations, reviews, and everything you need to decide where to eat.'; ?>
        </p>
        <div class="search-wrapper">
          <div class="search-box">
            <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"/>
              <path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <span class="search-spinner" id="searchSpinner"></span>
            <input type="text" id="restaurantSearch" placeholder="Search restaurants, cuisines..." />
            <button class="search-clear" id="searchClear" aria-label="Clear search" type="button">&times;</button>
          </div>
          <p class="search-empty" id="searchEmpty">No restaurants match your search.</p>
        </div>
      </div>
    </section>

    <section class="section" id="featured">
      <div class="container">
        <div class="section-header">
          <div>
            <h2 class="section-title">Top <?php echo count($restaurants); ?> restaurants in <?php echo htmlspecialchars($area['name']); ?></h2>
          </div>
        </div>

        <div class="grid featured-grid">
          <?php if (empty($restaurants)): ?>
            <p>No restaurants listed in <?php echo htmlspecialchars($area['name']); ?> yet.</p>
          <?php else: ?>
            <?php foreach ($restaurants as $r): ?>
              <article class="card">
                <div class="thumb">
                  <?php if ($r['image_url']): ?>
                    <img src="<?php echo htmlspecialchars($r['image_url']); ?>" alt="<?php echo htmlspecialchars($r['name']); ?>" />
                  <?php endif; ?>
                </div>
                <div class="content">
                  <h3 class="mini-title"><?php echo htmlspecialchars($r['name']); ?></h3>
                  <?php if ($r['cuisine']): ?>
                    <div class="meta"><span>Cuisine: <?php echo htmlspecialchars($r['cuisine']); ?></span></div>
                  <?php endif; ?>
                  <?php if ($r['display_rating']): ?>
                    <div class="rating">★ <?php echo htmlspecialchars($r['display_rating']); ?></div>
                  <?php endif; ?>
                  <a class="btn btn-primary view-btn" href="<?php echo BASE_URL . $area['city_slug'] . '/' . $areaSlug . '/' . htmlspecialchars($r['slug']); ?>">View Details</a>
                </div>
              </article>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <?php if ($area['intro_content']): ?>
    <section class="section" id="about-area">
      <div class="container">
        <?php foreach (array_filter(explode("\n\n", $area['intro_content'])) as $para): ?>
          <p><?php echo nl2br(htmlspecialchars(trim($para))); ?></p>
        <?php endforeach; ?>
      </div>
    </section>
    <?php endif; ?>

    <?php if ($faqs): ?>
    <section class="section" id="faq">
      <div class="container">
        <div class="section-header">
          <div>
            <h2 class="section-title">Frequently Asked <span style="color:#00f5d4">Questions</span></h2>
            <p class="section-subtitle">Common questions about eating out in <?php echo htmlspecialchars($area['name']); ?>, Karachi.</p>
          </div>
        </div>
        <div class="faq-wrapper">
          <?php foreach ($faqs as $i => $f): ?>
            <details class="faq-item"<?php echo $i === 0 ? ' open' : ''; ?>>
              <summary><?php echo htmlspecialchars($f['question']); ?></summary>
              <p><?php echo nl2br(htmlspecialchars($f['answer'])); ?></p>
            </details>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
    <?php endif; ?>
  </main>

  <?php include __DIR__ . '/../files/layout/footer.php'; ?>

  <script src="<?php echo BASE_URL; ?>index.js"></script>
</body>
</html>

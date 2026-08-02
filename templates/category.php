<?php
// connection.php already included by router.php ($con available)

$categorySlug = $_GET['category_slug'] ?? '';

$stmt = $con->prepare("SELECT * FROM categories WHERE slug = ?");
$stmt->bind_param("s", $categorySlug);
$stmt->execute();
$category = $stmt->get_result()->fetch_assoc();

if (!$category) {
    http_response_code(404);
    include __DIR__ . '/404.php';
    exit;
}

$categoryId = $category['id'];

$rStmt = $con->prepare("
    SELECT r.id, r.slug, r.name, r.cuisine, r.image_url, r.display_rating, a.slug AS area_slug
    FROM restaurants r
    JOIN restaurant_categories rc ON rc.restaurant_id = r.id
    LEFT JOIN areas a ON a.id = r.area_id
    WHERE rc.category_id = ?
    ORDER BY r.display_rating DESC, r.name ASC
");
$rStmt->bind_param("i", $categoryId);
$rStmt->execute();
$restaurants = $rStmt->get_result()->fetch_all(MYSQLI_ASSOC);

$faqStmt = $con->prepare("SELECT question, answer FROM category_faqs WHERE category_id = ? ORDER BY sort_order ASC, id ASC");
$faqStmt->bind_param("i", $categoryId);
$faqStmt->execute();
$faqs = $faqStmt->get_result()->fetch_all(MYSQLI_ASSOC);

$pageTitle = htmlspecialchars($category['name']) . ' in Karachi | Yaafta';
$metaDesc  = htmlspecialchars($category['meta_description'] ?: ($category['intro_content'] ?: ('Discover the best ' . $category['name'] . ' in Karachi.')));
$metaKeywords = htmlspecialchars($category['meta_keywords'] ?: '');
$canonical = BASE_URL . 'category/' . $category['slug'];
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
  <meta name="robots" content="index, follow" />
  <link rel="canonical" href="<?php echo htmlspecialchars($canonical); ?>">
   <link rel="icon" href="<?php echo BASE_URL; ?>files/images/favicon.svg" type="image/svg+xml">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE_URL; ?>files/images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL; ?>files/images/favicon-16x16.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASE_URL; ?>files/images/apple-touch-icon.png">
  <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL; ?>files/images/yaafta_favicon.ico">
  <link rel="manifest" href="<?php echo BASE_URL; ?>files/images/site.webmanifest">
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
<body>

  <?php include __DIR__ . '/../files/layout/header.php'; ?>

  <main id="home">
    <section class="hero">
      <div class="container">
        <h1 class="hero-title"><?php echo htmlspecialchars($category['name']); ?> in Karachi</h1>
        <?php if ($category['intro_content']): ?>
          <p class="hero-subtitle"><?php echo htmlspecialchars($category['intro_content']); ?></p>
        <?php endif; ?>
        <div class="search-wrapper">
          <div class="search-box">
            <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"/>
              <path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <input type="text" id="restaurantSearch" placeholder="Search restaurants...">
            <button class="search-clear" id="searchClear" aria-label="Clear search" type="button">&times;</button>
          </div>
        </div>
      </div>
    </section>

    <section class="section" id="featured">
      <div class="container">
        <div class="section-header">
          <div>
            <h2 class="section-title">Top <?php echo count($restaurants); ?> <?php echo htmlspecialchars(strtolower($category['name'])); ?></h2>
          </div>
        </div>
        <div class="grid featured-grid">
          <?php if (empty($restaurants)): ?>
            <p>No restaurants in this category yet.</p>
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
                  <?php if ($r['cuisine']): ?><div class="meta"><span>Cuisine: <?php echo htmlspecialchars($r['cuisine']); ?></span></div><?php endif; ?>
                  <?php if ($r['display_rating']): ?><div class="rating">★ <?php echo htmlspecialchars($r['display_rating']); ?></div><?php endif; ?>
                  <?php if ($r['area_slug']): ?>
                    <a class="btn btn-primary view-btn" href="<?php echo BASE_URL . 'karachi/' . $r['area_slug'] . '/' . htmlspecialchars($r['slug']); ?>">View Details</a>
                  <?php endif; ?>
                </div>
              </article>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <?php if ($faqs): ?>
    <section class="section" id="faq">
      <div class="container">
        <div class="section-header">
          <div>
            <h2 class="section-title">Frequently Asked <span style="color:#00f5d4">Questions</span></h2>
            <p class="section-subtitle">Common questions about <?php echo htmlspecialchars(strtolower($category['name'])); ?> in Karachi.</p>
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
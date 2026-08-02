<?php
// connection.php already included by router.php ($con available)

$posts = $con->query("SELECT slug, title, excerpt, image_url, published_at FROM blog_posts ORDER BY published_at DESC")->fetch_all(MYSQLI_ASSOC);
$pageTitle = 'Blog | Yaafta';
$canonical = BASE_URL . 'blog';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Guides, comparisons, and recommendations for eating out in Karachi.">
  <link rel="canonical" href="<?php echo htmlspecialchars($canonical); ?>">
   <link rel="icon" href="<?php echo BASE_URL; ?>files/images/favicon.svg" type="image/svg+xml">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE_URL; ?>files/images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL; ?>files/images/favicon-16x16.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASE_URL; ?>files/images/apple-touch-icon.png">
  <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL; ?>files/images/yaafta_favicon.ico">
  <link rel="manifest" href="<?php echo BASE_URL; ?>files/images/site.webmanifest">
  <title><?php echo $pageTitle; ?></title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css" />
</head>
<body>
  <?php include __DIR__ . '/../files/layout/header.php'; ?>

  <main id="home">
    <section class="hero">
      <div class="container">
        <h1 class="hero-title">Yaafta Blog</h1>
        <p class="hero-subtitle">Guides, comparisons, and recommendations for eating out in Karachi.</p>
      </div>
    </section>

    <section class="section">
      <div class="container">
        <div class="grid blog-grid">
          <?php foreach ($posts as $p): ?>
            <article class="post">
              <div class="thumb">
                <?php if ($p['image_url']): ?>
                  <img src="<?php echo htmlspecialchars($p['image_url']); ?>" alt="<?php echo htmlspecialchars($p['title']); ?>">
                <?php endif; ?>
              </div>
              <div class="content">
                <h3><?php echo htmlspecialchars($p['title']); ?></h3>
                <?php if ($p['excerpt']): ?><p><?php echo htmlspecialchars($p['excerpt']); ?></p><?php endif; ?>
                <a class="read-more" href="<?php echo BASE_URL . 'blog/' . htmlspecialchars($p['slug']); ?>">Read More →</a>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  </main>

  <?php include __DIR__ . '/../files/layout/footer.php'; ?>
  <script src="<?php echo BASE_URL; ?>index.js"></script>
</body>
</html>

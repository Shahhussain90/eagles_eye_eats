<?php
// connection.php already included by router.php ($con available)

$blogSlug = $_GET['blog_slug'] ?? '';

$stmt = $con->prepare("SELECT * FROM blog_posts WHERE slug = ?");
$stmt->bind_param("s", $blogSlug);
$stmt->execute();
$post = $stmt->get_result()->fetch_assoc();

if (!$post) {
    http_response_code(404);
    include __DIR__ . '/404.php';
    exit;
}

$pageTitle = htmlspecialchars($post['title']) . ' | Yaafta';
$metaDesc  = htmlspecialchars($post['meta_description'] ?: $post['excerpt']);
$canonical = BASE_URL . 'blog/' . $post['slug'];

// render content: line-by-line, grouping consecutive plain lines into
// paragraphs — robust regardless of exact blank-line spacing in storage
$rawLines = explode("\n", str_replace("\r\n", "\n", $post['content'] ?? ''));
$blocks = []; // each: ['type' => 'h2'|'h3'|'ul'|'p', 'content' => string or array]
$paragraphBuffer = [];

function flush_paragraph(&$blocks, &$buffer) {
    if ($buffer) {
        $blocks[] = ['type' => 'p', 'content' => implode(' ', $buffer)];
        $buffer = [];
    }
}

$ulBuffer = [];
function flush_ul(&$blocks, &$buffer) {
    if ($buffer) {
        $blocks[] = ['type' => 'ul', 'content' => $buffer];
        $buffer = [];
    }
}

foreach ($rawLines as $line) {
    $line = trim($line);
    if ($line === '') {
        flush_paragraph($blocks, $paragraphBuffer);
        flush_ul($blocks, $ulBuffer);
        continue;
    }
    if (strpos($line, '### ') === 0) {
        flush_paragraph($blocks, $paragraphBuffer);
        flush_ul($blocks, $ulBuffer);
        $blocks[] = ['type' => 'h3', 'content' => substr($line, 4)];
    } elseif (strpos($line, '## ') === 0) {
        flush_paragraph($blocks, $paragraphBuffer);
        flush_ul($blocks, $ulBuffer);
        $blocks[] = ['type' => 'h2', 'content' => substr($line, 3)];
    } elseif (strpos($line, '- ') === 0) {
        flush_paragraph($blocks, $paragraphBuffer);
        $ulBuffer[] = substr($line, 2);
    } else {
        flush_ul($blocks, $ulBuffer);
        $paragraphBuffer[] = $line;
    }
}
flush_paragraph($blocks, $paragraphBuffer);
flush_ul($blocks, $ulBuffer);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="<?php echo $metaDesc; ?>" />
  <meta name="robots" content="index, follow" />
  <link rel="canonical" href="<?php echo htmlspecialchars($canonical); ?>">
  <title><?php echo $pageTitle; ?></title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css" />
</head>
<body>
  <?php include __DIR__ . '/../files/layout/header.php'; ?>

  <section class="restaurant-hero">
    <div class="container">
      <nav class="breadcrumb">
        <a href="<?php echo BASE_URL; ?>">Home</a> <span>›</span>
        <a href="<?php echo BASE_URL; ?>blog">Blog</a> <span>›</span>
        <span><?php echo htmlspecialchars($post['title']); ?></span>
      </nav>
      <div class="restaurant-hero-grid">
        <div class="restaurant-info">
          <h1 class="restaurant-title"><?php echo htmlspecialchars($post['title']); ?></h1>
          <?php if ($post['excerpt']): ?>
            <p class="restaurant-description"><?php echo htmlspecialchars($post['excerpt']); ?></p>
          <?php endif; ?>
        </div>
        <?php if ($post['image_url']): ?>
          <div class="restaurant-image">
            <img src="<?php echo htmlspecialchars($post['image_url']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container restaurant-details">
      <div class="details-main" style="max-width:800px;">
        <?php foreach ($blocks as $block): ?>
          <?php if ($block['type'] === 'h2'): ?>
            <h2><?php echo htmlspecialchars($block['content']); ?></h2>
          <?php elseif ($block['type'] === 'h3'): ?>
            <h3><?php echo htmlspecialchars($block['content']); ?></h3>
          <?php elseif ($block['type'] === 'ul'): ?>
            <ul>
              <?php foreach ($block['content'] as $li): ?>
                <li><?php echo htmlspecialchars($li); ?></li>
              <?php endforeach; ?>
            </ul>
          <?php else: ?>
            <p><?php echo htmlspecialchars($block['content']); ?></p>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php include __DIR__ . '/../files/layout/footer.php'; ?>
  <script src="<?php echo BASE_URL; ?>index.js"></script>
</body>
</html>
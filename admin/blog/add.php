<?php
include_once __DIR__ . '/../../files/connection.php';
include_once __DIR__ . '/../auth_check.php';

$formError = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify()) { die('Invalid or expired form submission. Please go back and try again.'); }
    $title = trim($_POST['title'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $excerpt = trim($_POST['excerpt'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $metaDesc = trim($_POST['meta_description'] ?? '');

    if ($title === '' || $slug === '') {
        $formError = 'Title and slug are required.';
    } else {
        $imageUrl = null;
        if (!empty($_FILES['cover_image']['tmp_name']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['cover_image']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                $destDir = UPLOAD_DIR . 'blog/';
                if (!is_dir($destDir)) mkdir($destDir, 0755, true);
                $filename = uniqid('blog_') . '.' . ($ext === 'jpeg' ? 'jpg' : $ext);
                if (resize_and_save_image($_FILES['cover_image']['tmp_name'], $destDir . $filename)) {
                    $imageUrl = UPLOAD_URL . 'blog/' . $filename;
                }
            }
        }

        $stmt = $con->prepare("INSERT INTO blog_posts (slug, title, excerpt, content, image_url, meta_description) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $slug, $title, $excerpt, $content, $imageUrl, $metaDesc);
        $stmt->execute();
        header('Location: list.php?saved=1');
        exit;
    }
}
$p = $_POST;

$adminPageTitle = 'Add Blog Post';
include __DIR__ . '/../layout/admin_header.php';
?>
<div class="admin-topbar">
  <h1>Add Blog Post</h1>
  <a href="list.php">← Back to list</a>
</div>
<?php if ($formError): ?><div class="admin-flash" style="background:#fdecea;color:#d32f2f;"><?php echo htmlspecialchars($formError); ?></div><?php endif; ?>
<form method="POST" enctype="multipart/form-data" class="admin-form">
  <?php echo csrf_field(); ?>
  <div class="admin-card">
    <label>Title *</label>
    <input type="text" name="title" required value="<?php echo htmlspecialchars($p['title'] ?? ''); ?>">

    <label>URL Slug *</label>
    <input type="text" name="slug" required value="<?php echo htmlspecialchars($p['slug'] ?? ''); ?>">
    <div class="hint">Lowercase, hyphens only. URL: /blog/{slug}</div>

    <label>Excerpt (shown on blog listing page)</label>
    <textarea name="excerpt"><?php echo htmlspecialchars($p['excerpt'] ?? ''); ?></textarea>

    <label>Meta Description</label>
    <textarea name="meta_description"><?php echo htmlspecialchars($p['meta_description'] ?? ''); ?></textarea>

    <label>Cover Image</label>
    <input type="file" name="cover_image" accept="image/*">
  </div>

  <div class="admin-card">
    <label>Content</label>
    <textarea name="content" style="min-height:300px; font-family:monospace;"><?php echo htmlspecialchars($p['content'] ?? ''); ?></textarea>
    <div class="hint">Use "## Heading" for a section heading, "- item" for a bullet, blank lines between paragraphs.</div>
  </div>

  <div class="admin-btn-row">
    <button class="btn btn-primary" type="submit">Create Post</button>
    <a class="btn btn-outline" href="list.php">Cancel</a>
  </div>
</form>
<?php include __DIR__ . '/../layout/admin_footer.php'; ?>
<?php
include_once __DIR__ . '/../../files/connection.php';
include_once __DIR__ . '/../auth_check.php';

$postId = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
if (!$postId) { header('Location: list.php'); exit; }

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
        $p = $_POST;
    } else {
        $newImageUrl = null;
        if (!empty($_FILES['cover_image']['tmp_name']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['cover_image']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                $destDir = UPLOAD_DIR . 'blog/';
                if (!is_dir($destDir)) mkdir($destDir, 0755, true);
                $filename = uniqid('blog_') . '.' . ($ext === 'jpeg' ? 'jpg' : $ext);
                if (resize_and_save_image($_FILES['cover_image']['tmp_name'], $destDir . $filename)) {
                    $newImageUrl = UPLOAD_URL . 'blog/' . $filename;
                }
            }
        }

        if ($newImageUrl) {
            $stmt = $con->prepare("UPDATE blog_posts SET slug=?, title=?, excerpt=?, content=?, meta_description=?, image_url=? WHERE id=?");
            $stmt->bind_param("ssssssi", $slug, $title, $excerpt, $content, $metaDesc, $newImageUrl, $postId);
        } else {
            $stmt = $con->prepare("UPDATE blog_posts SET slug=?, title=?, excerpt=?, content=?, meta_description=? WHERE id=?");
            $stmt->bind_param("sssssi", $slug, $title, $excerpt, $content, $metaDesc, $postId);
        }
        $stmt->execute();
        header('Location: list.php?saved=1');
        exit;
    }
} else {
    $stmt = $con->prepare("SELECT * FROM blog_posts WHERE id = ?");
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $p = $stmt->get_result()->fetch_assoc();
    if (!$p) { header('Location: list.php'); exit; }
}

$adminPageTitle = 'Edit ' . ($p['title'] ?? '');
include __DIR__ . '/../layout/admin_header.php';
?>
<div class="admin-topbar">
  <h1>Edit: <?php echo htmlspecialchars($p['title'] ?? ''); ?></h1>
  <a href="list.php">← Back to list</a>
</div>
<?php if ($formError): ?><div class="admin-flash" style="background:#fdecea;color:#d32f2f;"><?php echo htmlspecialchars($formError); ?></div><?php endif; ?>
<form method="POST" enctype="multipart/form-data" class="admin-form">
  <?php echo csrf_field(); ?>
  <input type="hidden" name="id" value="<?php echo $postId; ?>">
  <div class="admin-card">
    <label>Title *</label>
    <input type="text" name="title" required value="<?php echo htmlspecialchars($p['title'] ?? ''); ?>">

    <label>URL Slug *</label>
    <input type="text" name="slug" required value="<?php echo htmlspecialchars($p['slug'] ?? ''); ?>">

    <label>Excerpt</label>
    <textarea name="excerpt"><?php echo htmlspecialchars($p['excerpt'] ?? ''); ?></textarea>

    <label>Meta Description</label>
    <textarea name="meta_description"><?php echo htmlspecialchars($p['meta_description'] ?? ''); ?></textarea>

    <?php if (!empty($p['image_url'])): ?>
      <label>Current Cover Image</label>
      <img src="<?php echo htmlspecialchars($p['image_url']); ?>" style="max-width:220px;border-radius:8px;display:block;margin-bottom:10px;">
    <?php endif; ?>
    <label>Upload New Cover Image</label>
    <input type="file" name="cover_image" accept="image/*">
    <div class="hint">Leave empty to keep the current image.</div>
  </div>

  <div class="admin-card">
    <label>Content</label>
    <textarea name="content" style="min-height:300px; font-family:monospace;"><?php echo htmlspecialchars($p['content'] ?? ''); ?></textarea>
    <div class="hint">Use "## Heading" for a section heading, "- item" for a bullet, blank lines between paragraphs.</div>
  </div>

  <div class="admin-btn-row">
    <button class="btn btn-primary" type="submit">Save Changes</button>
    <a class="btn btn-outline" href="list.php">Cancel</a>
  </div>
</form>
<?php include __DIR__ . '/../layout/admin_footer.php'; ?>
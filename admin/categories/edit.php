<?php
include_once __DIR__ . '/../../files/connection.php';
include_once __DIR__ . '/../auth_check.php';

$catId = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
if (!$catId) { header('Location: list.php'); exit; }

$formError = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify()) { die('Invalid or expired form submission. Please go back and try again.'); }
    $name = trim($_POST['name'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $intro = trim($_POST['intro_content'] ?? '');
    if ($name === '' || $slug === '') {
        $formError = 'Name and slug are required.';
        $c = $_POST;
    } else {
        $stmt = $con->prepare("UPDATE categories SET slug=?, name=?, intro_content=? WHERE id=?");
        $stmt->bind_param("sssi", $slug, $name, $intro, $catId);
        $stmt->execute();
        header('Location: list.php?saved=1');
        exit;
    }
} else {
    $stmt = $con->prepare("SELECT * FROM categories WHERE id = ?");
    $stmt->bind_param("i", $catId);
    $stmt->execute();
    $c = $stmt->get_result()->fetch_assoc();
    if (!$c) { header('Location: list.php'); exit; }
}

$adminPageTitle = 'Edit ' . ($c['name'] ?? '');
include __DIR__ . '/../layout/admin_header.php';
?>
<div class="admin-topbar">
  <h1>Edit: <?php echo htmlspecialchars($c['name'] ?? ''); ?></h1>
  <a href="list.php">← Back to list</a>
</div>
<?php if ($formError): ?><div class="admin-flash" style="background:#fdecea;color:#d32f2f;"><?php echo htmlspecialchars($formError); ?></div><?php endif; ?>
<form method="POST" class="admin-form">
  <?php echo csrf_field(); ?>
  <input type="hidden" name="id" value="<?php echo $catId; ?>">
  <div class="admin-card">
    <label>Category Name *</label>
    <input type="text" name="name" required value="<?php echo htmlspecialchars($c['name'] ?? ''); ?>">

    <label>URL Slug *</label>
    <input type="text" name="slug" required value="<?php echo htmlspecialchars($c['slug'] ?? ''); ?>">

    <label>Description</label>
    <textarea name="intro_content"><?php echo htmlspecialchars($c['intro_content'] ?? ''); ?></textarea>
  </div>
  <div class="admin-btn-row">
    <button class="btn btn-primary" type="submit">Save Changes</button>
    <a class="btn btn-outline" href="list.php">Cancel</a>
  </div>
</form>
<?php include __DIR__ . '/../layout/admin_footer.php'; ?>
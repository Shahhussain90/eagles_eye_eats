<?php
include_once __DIR__ . '/../../files/connection.php';
include_once __DIR__ . '/../auth_check.php';

$formError = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $intro = trim($_POST['intro_content'] ?? '');
    if ($name === '' || $slug === '') {
        $formError = 'Name and slug are required.';
    } else {
        $stmt = $con->prepare("INSERT INTO categories (slug, name, intro_content) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $slug, $name, $intro);
        $stmt->execute();
        header('Location: list.php?saved=1');
        exit;
    }
}
$c = $_POST;

$adminPageTitle = 'Add Category';
include __DIR__ . '/../layout/admin_header.php';
?>
<div class="admin-topbar">
  <h1>Add Category</h1>
  <a href="list.php">← Back to list</a>
</div>
<?php if ($formError): ?><div class="admin-flash" style="background:#fdecea;color:#d32f2f;"><?php echo htmlspecialchars($formError); ?></div><?php endif; ?>
<form method="POST" class="admin-form">
  <div class="admin-card">
    <label>Category Name *</label>
    <input type="text" name="name" required value="<?php echo htmlspecialchars($c['name'] ?? ''); ?>">

    <label>URL Slug *</label>
    <input type="text" name="slug" required value="<?php echo htmlspecialchars($c['slug'] ?? ''); ?>">
    <div class="hint">Lowercase, hyphens only. URL: /category/{slug}</div>

    <label>Description</label>
    <textarea name="intro_content"><?php echo htmlspecialchars($c['intro_content'] ?? ''); ?></textarea>
  </div>
  <div class="admin-btn-row">
    <button class="btn btn-primary" type="submit">Create Category</button>
    <a class="btn btn-outline" href="list.php">Cancel</a>
  </div>
</form>
<?php include __DIR__ . '/../layout/admin_footer.php'; ?>

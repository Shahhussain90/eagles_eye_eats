<?php
include_once __DIR__ . '/../../files/connection.php';
include_once __DIR__ . '/../auth_check.php';

$formError = null;
$restaurantId = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify()) { die('Invalid or expired form submission. Please go back and try again.'); }
    include __DIR__ . '/save_handler.php';
    if (!$formError) {
        if (!empty($uploadWarnings)) {
            $_SESSION['admin_upload_warnings'] = $uploadWarnings;
            header('Location: edit.php?id=' . $restaurantId);
        } else {
            header('Location: list.php?saved=1');
        }
        exit;
    }
}

$allAreas = $con->query("SELECT id, name FROM areas ORDER BY name ASC")->fetch_all(MYSQLI_ASSOC);
$allCategories = $con->query("SELECT id, name FROM categories ORDER BY name ASC")->fetch_all(MYSQLI_ASSOC);
$selectedCategoryIds = $_POST['category_ids'] ?? [];
$r = $_POST; // repopulate form with submitted values if validation failed
$images = [];
$reviews = [];
$faqs = [];

$adminPageTitle = 'Add Restaurant';
include __DIR__ . '/../layout/admin_header.php';
?>
<div class="admin-topbar">
  <h1>Add Restaurant</h1>
  <a href="list.php">← Back to list</a>
</div>

<?php if ($formError): ?>
  <div class="admin-flash" style="background:#fdecea;color:#d32f2f;"><?php echo htmlspecialchars($formError); ?></div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="admin-form">
  <?php echo csrf_field(); ?>
  <?php include __DIR__ . '/form_fields.php'; ?>
  <div class="admin-btn-row">
    <button class="btn btn-primary" type="submit">Create Restaurant</button>
    <a class="btn btn-outline" href="list.php">Cancel</a>
  </div>
</form>

<?php include __DIR__ . '/../layout/admin_footer.php'; ?>
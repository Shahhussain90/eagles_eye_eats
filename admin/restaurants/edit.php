<?php
include_once __DIR__ . '/../../files/connection.php';
include_once __DIR__ . '/../auth_check.php';

$restaurantId = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
if (!$restaurantId) {
    header('Location: list.php');
    exit;
}

$formError = null;

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
    $r = $_POST;
    $selectedCategoryIds = array_map('intval', $_POST['category_ids'] ?? []);
} else {
    $stmt = $con->prepare("SELECT * FROM restaurants WHERE id = ?");
    $stmt->bind_param("i", $restaurantId);
    $stmt->execute();
    $r = $stmt->get_result()->fetch_assoc();
    if (!$r) {
        header('Location: list.php');
        exit;
    }
    $catRows = $con->query("SELECT category_id FROM restaurant_categories WHERE restaurant_id = $restaurantId")->fetch_all(MYSQLI_ASSOC);
    $selectedCategoryIds = array_map(fn($row) => (int)$row['category_id'], $catRows);
}

$allAreas = $con->query("SELECT id, name FROM areas ORDER BY name ASC")->fetch_all(MYSQLI_ASSOC);
$allCategories = $con->query("SELECT id, name FROM categories ORDER BY name ASC")->fetch_all(MYSQLI_ASSOC);
$images = $con->query("SELECT id, image_path FROM restaurant_images WHERE restaurant_id = $restaurantId ORDER BY sort_order ASC")->fetch_all(MYSQLI_ASSOC);
$reviews = $con->query("SELECT reviewer_name, review_date_text, star_rating, review_text FROM restaurant_google_reviews WHERE restaurant_id = $restaurantId ORDER BY sort_order ASC")->fetch_all(MYSQLI_ASSOC);
$faqs = $con->query("SELECT question, answer FROM restaurant_faqs WHERE restaurant_id = $restaurantId ORDER BY sort_order ASC")->fetch_all(MYSQLI_ASSOC);

$adminPageTitle = 'Edit ' . ($r['name'] ?? '');
include __DIR__ . '/../layout/admin_header.php';
?>
<div class="admin-topbar">
  <h1>Edit: <?php echo htmlspecialchars($r['name'] ?? ''); ?></h1>
  <a href="list.php">← Back to list</a>
</div>

<?php if ($formError): ?>
  <div class="admin-flash" style="background:#fdecea;color:#d32f2f;"><?php echo htmlspecialchars($formError); ?></div>
<?php endif; ?>
<?php if (!empty($_SESSION['admin_upload_warnings'])): ?>
  <div class="admin-flash" style="background:#fff8e1;color:#8a6300;">
    <?php foreach ($_SESSION['admin_upload_warnings'] as $w): ?>
      <div><?php echo htmlspecialchars($w); ?></div>
    <?php endforeach; ?>
    <div style="margin-top:6px;">Everything else was saved successfully.</div>
  </div>
  <?php unset($_SESSION['admin_upload_warnings']); ?>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="admin-form">
  <?php echo csrf_field(); ?>
  <input type="hidden" name="id" value="<?php echo $restaurantId; ?>">
  <?php include __DIR__ . '/form_fields.php'; ?>
  <div class="admin-btn-row">
    <button class="btn btn-primary" type="submit">Save Changes</button>
    <a class="btn btn-outline" href="list.php">Cancel</a>
  </div>
</form>

<?php include __DIR__ . '/../layout/admin_footer.php'; ?>
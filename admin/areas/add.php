<?php
include_once __DIR__ . '/../../files/connection.php';
include_once __DIR__ . '/../auth_check.php';

$formError = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    if ($name === '' || $slug === '') {
        $formError = 'Name and slug are required.';
    } else {
        $stmt = $con->prepare("INSERT INTO areas (city_id, slug, name, meta_description, meta_keywords, hero_subtitle, intro_content) VALUES (1, ?, ?, ?, ?, ?, ?)");
        $metaDesc = trim($_POST['meta_description'] ?? '');
        $metaKw = trim($_POST['meta_keywords'] ?? '');
        $heroSub = trim($_POST['hero_subtitle'] ?? '');
        $intro = trim($_POST['intro_content'] ?? '');
        $stmt->bind_param("ssssss", $slug, $name, $metaDesc, $metaKw, $heroSub, $intro);
        $stmt->execute();
        $areaId = $con->insert_id;

        if (!empty($_POST['faq_question'])) {
            $faqStmt = $con->prepare("INSERT INTO area_faqs (area_id, question, answer, sort_order) VALUES (?, ?, ?, ?)");
            foreach ($_POST['faq_question'] as $i => $q) {
                $q = trim($q);
                $ans = trim($_POST['faq_answer'][$i] ?? '');
                if ($q === '' || $ans === '') continue;
                $faqStmt->bind_param("issi", $areaId, $q, $ans, $i);
                $faqStmt->execute();
            }
        }

        header('Location: list.php?saved=1');
        exit;
    }
}

$a = $_POST;
$faqs = [];

$adminPageTitle = 'Add Area';
include __DIR__ . '/../layout/admin_header.php';
?>
<div class="admin-topbar">
  <h1>Add Area</h1>
  <a href="list.php">← Back to list</a>
</div>
<?php if ($formError): ?><div class="admin-flash" style="background:#fdecea;color:#d32f2f;"><?php echo htmlspecialchars($formError); ?></div><?php endif; ?>
<form method="POST" class="admin-form">
  <?php include __DIR__ . '/form_fields.php'; ?>
  <div class="admin-btn-row">
    <button class="btn btn-primary" type="submit">Create Area</button>
    <a class="btn btn-outline" href="list.php">Cancel</a>
  </div>
</form>
<?php include __DIR__ . '/../layout/admin_footer.php'; ?>

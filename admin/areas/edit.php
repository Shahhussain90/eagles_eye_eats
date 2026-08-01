<?php
include_once __DIR__ . '/../../files/connection.php';
include_once __DIR__ . '/../auth_check.php';

$areaId = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
if (!$areaId) { header('Location: list.php'); exit; }

$formError = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    if ($name === '' || $slug === '') {
        $formError = 'Name and slug are required.';
        $a = $_POST;
    } else {
        $metaDesc = trim($_POST['meta_description'] ?? '');
        $metaKw = trim($_POST['meta_keywords'] ?? '');
        $heroSub = trim($_POST['hero_subtitle'] ?? '');
        $intro = trim($_POST['intro_content'] ?? '');
        $stmt = $con->prepare("UPDATE areas SET slug=?, name=?, meta_description=?, meta_keywords=?, hero_subtitle=?, intro_content=? WHERE id=?");
        $stmt->bind_param("ssssssi", $slug, $name, $metaDesc, $metaKw, $heroSub, $intro, $areaId);
        $stmt->execute();

        $con->query("DELETE FROM area_faqs WHERE area_id = $areaId");
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
} else {
    $stmt = $con->prepare("SELECT * FROM areas WHERE id = ?");
    $stmt->bind_param("i", $areaId);
    $stmt->execute();
    $a = $stmt->get_result()->fetch_assoc();
    if (!$a) { header('Location: list.php'); exit; }
}

$faqs = $con->query("SELECT question, answer FROM area_faqs WHERE area_id = $areaId ORDER BY sort_order ASC")->fetch_all(MYSQLI_ASSOC);

$adminPageTitle = 'Edit ' . ($a['name'] ?? '');
include __DIR__ . '/../layout/admin_header.php';
?>
<div class="admin-topbar">
  <h1>Edit: <?php echo htmlspecialchars($a['name'] ?? ''); ?></h1>
  <a href="list.php">← Back to list</a>
</div>
<?php if ($formError): ?><div class="admin-flash" style="background:#fdecea;color:#d32f2f;"><?php echo htmlspecialchars($formError); ?></div><?php endif; ?>
<form method="POST" class="admin-form">
  <input type="hidden" name="id" value="<?php echo $areaId; ?>">
  <?php include __DIR__ . '/form_fields.php'; ?>
  <div class="admin-btn-row">
    <button class="btn btn-primary" type="submit">Save Changes</button>
    <a class="btn btn-outline" href="list.php">Cancel</a>
  </div>
</form>
<?php include __DIR__ . '/../layout/admin_footer.php'; ?>

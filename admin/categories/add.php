<?php
include_once __DIR__ . '/../../files/connection.php';
include_once __DIR__ . '/../auth_check.php';

$formError = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify()) { die('Invalid or expired form submission. Please go back and try again.'); }
    $name = trim($_POST['name'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $intro = trim($_POST['intro_content'] ?? '');
    $metaDesc = trim($_POST['meta_description'] ?? '');
    $metaKw = trim($_POST['meta_keywords'] ?? '');
    if ($name === '' || $slug === '') {
        $formError = 'Name and slug are required.';
    } else {
        $stmt = $con->prepare("INSERT INTO categories (slug, name, intro_content, meta_description, meta_keywords) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $slug, $name, $intro, $metaDesc, $metaKw);
        $stmt->execute();
        $categoryId = $con->insert_id;

        if (!empty($_POST['faq_question'])) {
            $faqStmt = $con->prepare("INSERT INTO category_faqs (category_id, question, answer, sort_order) VALUES (?, ?, ?, ?)");
            foreach ($_POST['faq_question'] as $i => $q) {
                $q = trim($q);
                $ans = trim($_POST['faq_answer'][$i] ?? '');
                if ($q === '' || $ans === '') continue;
                $faqStmt->bind_param("issi", $categoryId, $q, $ans, $i);
                $faqStmt->execute();
            }
        }

        header('Location: list.php?saved=1');
        exit;
    }
}
$c = $_POST;
$faqs = [];

$adminPageTitle = 'Add Category';
include __DIR__ . '/../layout/admin_header.php';
?>
<div class="admin-topbar">
  <h1>Add Category</h1>
  <a href="list.php">← Back to list</a>
</div>
<?php if ($formError): ?><div class="admin-flash" style="background:#fdecea;color:#d32f2f;"><?php echo htmlspecialchars($formError); ?></div><?php endif; ?>
<form method="POST" class="admin-form">
  <?php echo csrf_field(); ?>
  <div class="admin-card">
    <label>Category Name *</label>
    <input type="text" name="name" required value="<?php echo htmlspecialchars($c['name'] ?? ''); ?>">

    <label>URL Slug *</label>
    <input type="text" name="slug" required value="<?php echo htmlspecialchars($c['slug'] ?? ''); ?>">
    <div class="hint">Lowercase, hyphens only. URL: /category/{slug}</div>

    <label>Description (shown on the category page)</label>
    <textarea name="intro_content"><?php echo htmlspecialchars($c['intro_content'] ?? ''); ?></textarea>

    <label>Meta Description</label>
    <textarea name="meta_description"><?php echo htmlspecialchars($c['meta_description'] ?? ''); ?></textarea>

    <label>Meta Keywords</label>
    <input type="text" name="meta_keywords" value="<?php echo htmlspecialchars($c['meta_keywords'] ?? ''); ?>" placeholder="comma, separated, keywords">
  </div>

  <div class="admin-card">
    <h2>FAQs</h2>
    <div id="faq-rows">
      <?php foreach ($faqs as $f): ?>
        <div class="admin-repeat-row faq-row">
          <input type="text" name="faq_question[]" placeholder="Question" value="<?php echo htmlspecialchars($f['question']); ?>">
          <input type="text" name="faq_answer[]" placeholder="Answer" value="<?php echo htmlspecialchars($f['answer']); ?>">
          <button type="button" class="admin-remove-btn" onclick="this.parentElement.remove()">✕</button>
        </div>
      <?php endforeach; ?>
    </div>
    <button type="button" class="admin-add-btn" onclick="addFaqRow()">+ Add FAQ</button>
  </div>

  <div class="admin-btn-row">
    <button class="btn btn-primary" type="submit">Create Category</button>
    <a class="btn btn-outline" href="list.php">Cancel</a>
  </div>
</form>

<script>
function addFaqRow() {
  const wrap = document.getElementById('faq-rows');
  const row = document.createElement('div');
  row.className = 'admin-repeat-row faq-row';
  row.innerHTML = `
    <input type="text" name="faq_question[]" placeholder="Question">
    <input type="text" name="faq_answer[]" placeholder="Answer">
    <button type="button" class="admin-remove-btn" onclick="this.parentElement.remove()">✕</button>`;
  wrap.appendChild(row);
}
</script>

<?php include __DIR__ . '/../layout/admin_footer.php'; ?>
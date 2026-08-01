<div class="admin-card">
  <label>Area Name *</label>
  <input type="text" name="name" required value="<?php echo htmlspecialchars($a['name'] ?? ''); ?>">

  <label>URL Slug *</label>
  <input type="text" name="slug" required value="<?php echo htmlspecialchars($a['slug'] ?? ''); ?>">
  <div class="hint">Lowercase, hyphens only, e.g. <code>clifton</code>. URL: /karachi/{slug}</div>

  <label>Meta Description</label>
  <textarea name="meta_description"><?php echo htmlspecialchars($a['meta_description'] ?? ''); ?></textarea>

  <label>Meta Keywords</label>
  <input type="text" name="meta_keywords" value="<?php echo htmlspecialchars($a['meta_keywords'] ?? ''); ?>">

  <label>Hero Subtitle</label>
  <textarea name="hero_subtitle"><?php echo htmlspecialchars($a['hero_subtitle'] ?? ''); ?></textarea>

  <label>About This Area (essay, shown below restaurant grid)</label>
  <textarea name="intro_content" style="min-height:160px;"><?php echo htmlspecialchars($a['intro_content'] ?? ''); ?></textarea>
  <div class="hint">Separate paragraphs with a blank line.</div>
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

<?php
// Expects in scope: $r (restaurant assoc array, empty-string defaults for add),
// $allAreas, $allCategories, $selectedCategoryIds, $images, $reviews, $faqs
?>
<div class="admin-card">
  <h2>Basics</h2>

  <label>Restaurant Name *</label>
  <input type="text" name="name" required value="<?php echo htmlspecialchars($r['name'] ?? ''); ?>">

  <label>URL Slug *</label>
  <input type="text" name="slug" required value="<?php echo htmlspecialchars($r['slug'] ?? ''); ?>">
  <div class="hint">Lowercase, hyphens only, e.g. <code>aylanto</code>. Used in the URL: /karachi/{area}/{slug}</div>

  <label>Area *</label>
  <select name="area_id" required>
    <option value="">— Select Area —</option>
    <?php foreach ($allAreas as $a): ?>
      <option value="<?php echo $a['id']; ?>" <?php echo (isset($r['area_id']) && $r['area_id'] == $a['id']) ? 'selected' : ''; ?>>
        <?php echo htmlspecialchars($a['name']); ?>
      </option>
    <?php endforeach; ?>
  </select>

  <label>Categories</label>
  <div class="admin-checkbox-grid">
    <?php foreach ($allCategories as $c): ?>
      <label>
        <input type="checkbox" name="category_ids[]" value="<?php echo $c['id']; ?>"
          <?php echo in_array($c['id'], $selectedCategoryIds) ? 'checked' : ''; ?>>
        <?php echo htmlspecialchars($c['name']); ?>
      </label>
    <?php endforeach; ?>
  </div>

  <label>Cuisine</label>
  <input type="text" name="cuisine" value="<?php echo htmlspecialchars($r['cuisine'] ?? ''); ?>" placeholder="e.g. Mediterranean / Italian">

  <label>Description (short, shown in hero)</label>
  <textarea name="description"><?php echo htmlspecialchars($r['description'] ?? ''); ?></textarea>
</div>

<div class="admin-card">
  <h2>SEO</h2>
  <label>Meta Description</label>
  <textarea name="meta_description" maxlength="500"><?php echo htmlspecialchars($r['meta_description'] ?? ''); ?></textarea>

  <label>Meta Keywords</label>
  <input type="text" name="meta_keywords" value="<?php echo htmlspecialchars($r['meta_keywords'] ?? ''); ?>" placeholder="comma, separated, keywords">
</div>

<div class="admin-card">
  <h2>Hero Image</h2>
  <?php if (!empty($r['image_url'])): ?>
    <img src="<?php echo htmlspecialchars($r['image_url']); ?>" style="max-width:220px;border-radius:8px;display:block;margin-bottom:10px;">
  <?php endif; ?>
  <label>Upload New Hero Image</label>
  <input type="file" name="hero_image_file" accept="image/*">
  <div class="hint">Leave empty to keep the current hero image.</div>
</div>

<div class="admin-card">
  <h2>Gallery Photos</h2>
  <?php if (!empty($images)): ?>
    <div style="display:flex; gap:10px; flex-wrap:wrap; margin-bottom:14px;">
      <?php foreach ($images as $img): ?>
        <div style="text-align:center;">
          <img src="<?php echo htmlspecialchars($img['image_path']); ?>" style="width:100px;height:100px;object-fit:cover;border-radius:8px;">
          <div>
            <label style="font-weight:normal;font-size:0.75rem;">
              <input type="checkbox" name="delete_image_ids[]" value="<?php echo $img['id']; ?>"> Delete
            </label>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
  <label>Add Gallery Photos (up to 3 more, matches site's 4-photo gallery)</label>
  <input type="file" name="gallery_files[]" accept="image/*" multiple>
</div>

<div class="admin-card">
  <h2>Article Content</h2>

  <label>About</label>
  <textarea name="about_content" style="min-height:120px;"><?php echo htmlspecialchars($r['about_content'] ?? ''); ?></textarea>
  <div class="hint">Separate paragraphs with a blank line.</div>

  <label>Highlights (Why Visit — one per line)</label>
  <textarea name="highlights"><?php echo htmlspecialchars($r['highlights'] ?? ''); ?></textarea>

  <label>What People Are Saying (one quote per line)</label>
  <textarea name="what_people_say"><?php echo htmlspecialchars($r['what_people_say'] ?? ''); ?></textarea>

  <label>Menu Content (rich text — use ## for a subheading, - for a bullet)</label>
  <textarea name="menu_content" style="min-height:160px; font-family:monospace;"><?php echo htmlspecialchars($r['menu_content'] ?? ''); ?></textarea>

  <label>Best Time to Visit</label>
  <textarea name="best_time_to_visit"><?php echo htmlspecialchars($r['best_time_to_visit'] ?? ''); ?></textarea>

  <label>Final Thoughts</label>
  <textarea name="final_thoughts"><?php echo htmlspecialchars($r['final_thoughts'] ?? ''); ?></textarea>

  <label>Content Last Updated</label>
  <input type="date" name="last_updated" value="<?php echo htmlspecialchars($r['last_updated'] ?? ''); ?>">
</div>

<div class="admin-card">
  <h2>Info Card / Sidebar</h2>
  <label>Address</label>
  <input type="text" name="address" value="<?php echo htmlspecialchars($r['address'] ?? ''); ?>">

  <label>Timing</label>
  <input type="text" name="timing" value="<?php echo htmlspecialchars($r['timing'] ?? ''); ?>" placeholder="e.g. 12:00 PM – 12:00 AM">

  <label>Price Range</label>
  <input type="text" name="price_range" value="<?php echo htmlspecialchars($r['price_range'] ?? ''); ?>" placeholder="e.g. PKR 2,000–4,000">

  <label>Phone</label>
  <input type="tel" name="phone" value="<?php echo htmlspecialchars($r['phone'] ?? ''); ?>">

  <label>Map Search Text (used for the embedded map)</label>
  <input type="text" name="map_embed_query" value="<?php echo htmlspecialchars($r['map_embed_query'] ?? ''); ?>" placeholder="e.g. Aylanto Clifton Karachi">
</div>

<div class="admin-card">
  <h2>Links</h2>
  <label>Menu URL</label>
  <input type="url" name="menu_url" value="<?php echo htmlspecialchars($r['menu_url'] ?? ''); ?>">

  <label>Google Maps URL</label>
  <input type="url" name="google_maps_url" value="<?php echo htmlspecialchars($r['google_maps_url'] ?? ''); ?>">

  <label>Instagram URL</label>
  <input type="url" name="instagram_url" value="<?php echo htmlspecialchars($r['instagram_url'] ?? ''); ?>">

  <label>Facebook URL</label>
  <input type="url" name="facebook_url" value="<?php echo htmlspecialchars($r['facebook_url'] ?? ''); ?>">

  <label>Foodpanda URL</label>
  <input type="url" name="foodpanda_url" value="<?php echo htmlspecialchars($r['foodpanda_url'] ?? ''); ?>">
</div>

<div class="admin-card">
  <h2>Rating Display</h2>
  <label>Display Rating (0–5)</label>
  <input type="number" name="display_rating" step="0.1" min="0" max="5" value="<?php echo htmlspecialchars($r['display_rating'] ?? ''); ?>">

  <label>Review Count Text</label>
  <input type="text" name="review_count_text" value="<?php echo htmlspecialchars($r['review_count_text'] ?? ''); ?>" placeholder="e.g. 5,000+ Reviews">
</div>

<div class="admin-card">
  <h2>Google Reviews</h2>
  <div id="review-rows">
    <?php $ri = 0; foreach ($reviews as $rv): ?>
      <div class="admin-repeat-row review-row">
        <input type="text" name="review_name[]" placeholder="Reviewer name" value="<?php echo htmlspecialchars($rv['reviewer_name']); ?>">
        <input type="text" name="review_date[]" placeholder="e.g. 1 month ago" value="<?php echo htmlspecialchars($rv['review_date_text']); ?>">
        <input type="number" name="review_stars[]" min="1" max="5" value="<?php echo (int)$rv['star_rating']; ?>">
        <input type="text" name="review_text[]" placeholder="Review text" value="<?php echo htmlspecialchars($rv['review_text']); ?>">
        <button type="button" class="admin-remove-btn" onclick="this.parentElement.remove()">✕</button>
      </div>
    <?php $ri++; endforeach; ?>
  </div>
  <button type="button" class="admin-add-btn" onclick="addReviewRow()">+ Add Review</button>
</div>

<div class="admin-card">
  <h2>Restaurant FAQs</h2>
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
function addReviewRow() {
  const wrap = document.getElementById('review-rows');
  const row = document.createElement('div');
  row.className = 'admin-repeat-row review-row';
  row.innerHTML = `
    <input type="text" name="review_name[]" placeholder="Reviewer name">
    <input type="text" name="review_date[]" placeholder="e.g. 1 month ago">
    <input type="number" name="review_stars[]" min="1" max="5" value="5">
    <input type="text" name="review_text[]" placeholder="Review text">
    <button type="button" class="admin-remove-btn" onclick="this.parentElement.remove()">✕</button>`;
  wrap.appendChild(row);
}
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

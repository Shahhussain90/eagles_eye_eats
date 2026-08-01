<?php
// Requires $restaurantId to be set BEFORE this include (restaurant.php already
// has it after looking up the restaurant by slug/area/city).
if (empty($restaurantId)) { echo '<!-- review-widget: missing $restaurantId -->'; return; }

$agg = $con->prepare("SELECT COUNT(*) AS n, AVG(rating) AS avg_rating, AVG(recommend_pct) AS avg_recommend FROM reviews WHERE restaurant_id = ?");
$agg->bind_param("i", $restaurantId);
$agg->execute();
$stats = $agg->get_result()->fetch_assoc();

$reviewsPerPage = 25;
$currentPage = isset($_GET['review_page']) ? max(1, (int)$_GET['review_page']) : 1;
$offset = ($currentPage - 1) * $reviewsPerPage;

$totalPages = $stats['n'] > 0 ? (int)ceil($stats['n'] / $reviewsPerPage) : 1;
if ($currentPage > $totalPages) {
    $currentPage = $totalPages;
    $offset = ($currentPage - 1) * $reviewsPerPage;
}

$list = $con->prepare("
    SELECT rv.id, rv.rating, rv.recommend_pct, rv.body, rv.created_at,
           u.name AS user_name, u.avatar_url
    FROM reviews rv JOIN users u ON u.id = rv.user_id
    WHERE rv.restaurant_id = ?
    ORDER BY rv.created_at DESC
    LIMIT ? OFFSET ?
");
$list->bind_param("iii", $restaurantId, $reviewsPerPage, $offset);
$list->execute();
$reviews = $list->get_result()->fetch_all(MYSQLI_ASSOC);

foreach ($reviews as &$rv) {
    $img = $con->prepare("SELECT image_path FROM review_images WHERE review_id = ?");
    $img->bind_param("i", $rv['id']);
    $img->execute();
    $rv['images'] = array_column($img->get_result()->fetch_all(MYSQLI_ASSOC), 'image_path');
}
unset($rv);

$me = current_user();
$myExistingReview = null;
$accountTooNew = false;
if ($me) {
    $mine = $con->prepare("SELECT id FROM reviews WHERE user_id = ? AND restaurant_id = ?");
    $mine->bind_param("ii", $me['id'], $restaurantId);
    $mine->execute();
    $myExistingReview = $mine->get_result()->fetch_assoc();

    $ageStmt = $con->prepare("SELECT TIMESTAMPDIFF(HOUR, created_at, NOW()) AS hours_old FROM users WHERE id = ?");
    $ageStmt->bind_param("i", $me['id']);
    $ageStmt->execute();
    $ageRow = $ageStmt->get_result()->fetch_assoc();
    $accountTooNew = $ageRow && $ageRow['hours_old'] < 24;
}

$avgRating    = $stats['n'] > 0 ? round($stats['avg_rating'], 1) : 0;
$avgRecommend = $stats['n'] > 0 ? round($stats['avg_recommend']) : 0;
?>

<div class="revw-box" id="reviews-widget">
  <h2>Reviews &amp; Recommendations</h2>

  <div class="revw-summary">
    <div class="revw-avg-block">
      <div class="revw-avg"><?php echo $stats['n'] > 0 ? $avgRating : '—'; ?></div>
      <div class="revw-avg-sub">
        <div class="revw-avg-stars"><?php
          $full = $stats['n'] > 0 ? round($avgRating) : 0;
          echo str_repeat('★', $full) . str_repeat('☆', 5 - $full);
        ?></div>
        <div class="revw-avg-count"><?php echo $stats['n']; ?> review<?php echo $stats['n'] == 1 ? '' : 's'; ?></div>
      </div>
    </div>
    <div class="revw-summary-divider"></div>
    <div class="revw-recommend-block">
      <div class="revw-recommend-label">
        <span>Would recommend</span>
        <strong><?php echo $avgRecommend; ?>%</strong>
      </div>
      <div class="revw-bar-track">
        <div class="revw-bar-fill" style="width:<?php echo $avgRecommend; ?>%;"></div>
      </div>
    </div>
  </div>

  <?php if (!$me): ?>
    <div class="revw-signin-note">
      <a href="<?php echo BASE_URL; ?>files/signin">Sign in with Google</a> to leave a review with your own rating and photos.
    </div>
  <?php elseif ($accountTooNew): ?>
    <div class="revw-signin-note">Your account needs to be at least 24 hours old before posting a review — this helps keep reviews genuine.</div>
  <?php elseif ($myExistingReview): ?>
    <div class="revw-already-note">You've already reviewed this restaurant — thanks for sharing your experience!</div>
  <?php else: ?>
    <form class="revw-form" id="revwForm" enctype="multipart/form-data">
      <p class="revw-form-title">Leave a review</p>
      <input type="hidden" name="restaurant_id" value="<?php echo $restaurantId; ?>">

      <div class="revw-field">
        <span class="revw-field-label">Your rating</span>
        <div class="revw-stars">
          <input type="radio" name="rating" id="revwStar5" value="5"><label for="revwStar5" title="5 stars">★</label>
          <input type="radio" name="rating" id="revwStar4" value="4"><label for="revwStar4" title="4 stars">★</label>
          <input type="radio" name="rating" id="revwStar3" value="3"><label for="revwStar3" title="3 stars">★</label>
          <input type="radio" name="rating" id="revwStar2" value="2"><label for="revwStar2" title="2 stars">★</label>
          <input type="radio" name="rating" id="revwStar1" value="1"><label for="revwStar1" title="1 star">★</label>
        </div>
      </div>

      <div class="revw-field">
        <label class="revw-field-label" for="revwPct">Would you recommend this place? (<span id="revwPctLabel">70</span>%)</label>
        <input type="range" name="recommend_pct" id="revwPct" min="0" max="100" value="70">
      </div>

      <div class="revw-field">
        <label class="revw-field-label" for="revwBody">Your experience</label>
        <textarea name="body" id="revwBody" placeholder="Share your experience..." required></textarea>
      </div>

      <div class="revw-field">
        <span class="revw-field-label">Add photos (optional, up to 5)</span>
        <div class="revw-file-wrap">
          <input type="file" name="images[]" accept="image/jpeg,image/png,image/webp" multiple>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Post Review</button>
      <p class="revw-error" id="revwError"></p>
    </form>
  <?php endif; ?>

  <div class="revw-list">
    <?php if (!$reviews): ?>
      <p class="revw-empty">No reviews yet — be the first to share your experience.</p>
    <?php endif; ?>
    <?php foreach ($reviews as $rv): ?>
      <div class="revw-item">
        <div class="revw-item-head">
          <img src="<?php echo htmlspecialchars($rv['avatar_url'] ?: BASE_URL . 'files/images/default-avatar.png'); ?>" alt="<?php echo htmlspecialchars($rv['user_name']); ?>" onerror="this.onerror=null;this.src='<?php echo BASE_URL; ?>files/images/default-avatar.png';">
          <div>
            <div class="revw-item-name"><?php echo htmlspecialchars($rv['user_name']); ?></div>
            <div class="revw-item-meta">
              <span class="revw-item-stars"><?php echo str_repeat('★', $rv['rating']) . str_repeat('☆', 5 - $rv['rating']); ?></span>
              <span class="revw-item-recommend">Recommends <?php echo $rv['recommend_pct']; ?>%</span>
              <span class="revw-item-date"><?php echo date('M j, Y', strtotime($rv['created_at'])); ?></span>
            </div>
          </div>
        </div>
        <p class="revw-item-body"><?php echo nl2br(htmlspecialchars($rv['body'])); ?></p>
        <?php if ($rv['images']): ?>
          <div class="revw-item-imgs">
            <?php foreach ($rv['images'] as $img): ?>
              <a href="<?php echo htmlspecialchars($img); ?>" target="_blank" rel="noopener noreferrer">
                <img src="<?php echo htmlspecialchars($img); ?>" alt="Review photo">
              </a>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>

  <?php if ($totalPages > 1): ?>
    <div class="revw-pagination">
      <?php if ($currentPage > 1): ?>
        <a href="?review_page=<?php echo $currentPage - 1; ?>#reviews-widget" class="revw-page-btn">← Previous</a>
      <?php endif; ?>

      <span class="revw-page-info">Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?></span>

      <?php if ($currentPage < $totalPages): ?>
        <a href="?review_page=<?php echo $currentPage + 1; ?>#reviews-widget" class="revw-page-btn">Next →</a>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</div>

<script>
(function () {
  const form = document.getElementById('revwForm');
  if (!form) return;

  const pct = document.getElementById('revwPct');
  const pctLabel = document.getElementById('revwPctLabel');
  pct.addEventListener('input', () => pctLabel.textContent = pct.value);

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    const errEl = document.getElementById('revwError');
    errEl.style.display = 'none';

    const fileInput = form.querySelector('input[type="file"]');
    if (fileInput.files.length > 0) {
        const maxBytes = 8 * 1024 * 1024;
        for (const f of fileInput.files) {
            if (f.size > maxBytes) {
                errEl.textContent = `"${f.name}" is too large. Max size is 8MB per photo.`;
                errEl.style.display = 'block';
                return;
            }
        }
        if (fileInput.files.length > 5) {
            errEl.textContent = 'Please select at most 5 photos.';
            errEl.style.display = 'block';
            return;
        }
    }

    const ratingChecked = form.querySelector('input[name="rating"]:checked');
    if (!ratingChecked) {
      errEl.textContent = 'Please select a star rating.';
      errEl.style.display = 'block';
      return;
    }

    const fd = new FormData(form);
    const submitBtn = form.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.textContent = 'Posting...';

    fetch('<?php echo BASE_URL; ?>files/api/submit_review.php', { method: 'POST', body: fd })
      .then(r => r.json())
      .then(data => {
        if (data.success) {
          window.location.reload();
        } else {
          errEl.textContent = data.error || 'Something went wrong. Please try again.';
          errEl.style.display = 'block';
          submitBtn.disabled = false;
          submitBtn.textContent = 'Post Review';
        }
      })
      .catch(() => {
        errEl.textContent = 'Network error. Please try again.';
        errEl.style.display = 'block';
        submitBtn.disabled = false;
        submitBtn.textContent = 'Post Review';
      });
  });
})();
</script>
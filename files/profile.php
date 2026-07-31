<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/files/connection.php';
$user = current_user();
if (!$user) {
    header('Location: ' . BASE_URL . 'files/signin');
    exit;
}

        $avatarError = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar'])) {
            $file = $_FILES['avatar'];
            $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
            $mime = mime_content_type($file['tmp_name']);
        
            if ($file['error'] !== UPLOAD_ERR_OK) {
                $avatarError = 'Upload failed. Try again.';
            } elseif (!isset($allowed[$mime])) {
                $avatarError = 'Only JPG, PNG, or WEBP images allowed.';
            } elseif ($file['size'] > 3 * 1024 * 1024) {
                $avatarError = 'Image must be under 3MB.';
            } else {
                $ext = $allowed[$mime];
                $filename = 'avatar_' . $user['id'] . '_' . time() . '.' . $ext;
                $dest = UPLOAD_DIR . 'avatars/' . $filename;
               if (resize_and_save_image($file['tmp_name'], $dest, 500, 500, 85)) {
            $url = UPLOAD_URL . 'avatars/' . $filename;
        
            // Delete the old avatar file before saving the new URL, but only if it's
            // one of ours (not the default placeholder, and not a Google-hosted photo)
            $oldAvatar = $user['avatar_url'];
            if ($oldAvatar && str_starts_with($oldAvatar, UPLOAD_URL . 'avatars/')) {
                $oldFilename = basename($oldAvatar);
                $oldPath = UPLOAD_DIR . 'avatars/' . $oldFilename;
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
        
            $upd = $con->prepare("UPDATE users SET avatar_url = ? WHERE id = ?");
            $upd->bind_param("si", $url, $user['id']);
            $upd->execute();
            header('Location: ' . BASE_URL . 'files/profile');
            exit;
        } else {
            $avatarError = 'Could not save image.';
        }
    }
}

// Pull this user's reviews with restaurant name + their images
$stmt = $con->prepare("
    SELECT r.id, r.rating, r.recommend_pct, r.body, r.created_at,
           rest.slug, rest.name AS restaurant_name
    FROM reviews r
    JOIN restaurants rest ON rest.id = r.restaurant_id
    WHERE r.user_id = ?
    ORDER BY r.created_at DESC
");
$stmt->bind_param("i", $user['id']);
$stmt->execute();
$myReviews = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

foreach ($myReviews as &$rev) {
    $imgStmt = $con->prepare("SELECT image_path FROM review_images WHERE review_id = ?");
    $imgStmt->bind_param("i", $rev['id']);
    $imgStmt->execute();
    $rev['images'] = array_column($imgStmt->get_result()->fetch_all(MYSQLI_ASSOC), 'image_path');
}
unset($rev);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In | Yaafta</title>
    <link rel="stylesheet" href="../css/style.css" />
     <link rel="icon" href="images/favicon.svg" type="image/svg+xml">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/x-icon" href="images/yaafta_favicon.ico">
    <link rel="manifest" href="images/site.webmanifest">
    <link rel="canonical" href="https://yaafta.com/files/profile">
</head>
<body>
  <div class="back-nav">
  <a href="javascript:void(0);" onclick="if (document.referrer && document.referrer.indexOf(window.location.host) !== -1) { window.history.back(); } else { window.location.href = '<?php echo BASE_URL; ?>'; }" class="back-nav-link">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M19 12H5M12 19l-7-7 7-7"/>
    </svg>
    Back
  </a>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/files/layout/header.php'; ?>

<section class="section auth-page">
  <div class="container" style="max-width:720px;">
      
      

    <div class="profile-header">
      <img class="profile-avatar"
           src="<?php echo htmlspecialchars($user['avatar_url'] ?: BASE_URL . 'files/images/default-avatar.png'); ?>"
           alt="Profile"
           onerror="this.onerror=null;this.src='<?php echo BASE_URL; ?>files/images/default-avatar.png';">
      <div class="profile-info">
        <h2><?php echo htmlspecialchars($user['name']); ?></h2>
        <p><?php echo htmlspecialchars($user['email']); ?></p>
      </div>
      <div class="profile-header-actions">
        <a href="<?php echo BASE_URL; ?>files/auth/logout.php" class="btn btn-outline">Log Out</a>
      </div>
    </div>

    <form method="POST" enctype="multipart/form-data" class="avatar-upload-form">
      <input type="file" name="avatar" accept="image/jpeg,image/png,image/webp" required>
      <button class="btn btn-primary" type="submit">Update Photo</button>
    </form>
    <?php if ($avatarError): ?>
      <p class="auth-error" style="display:block;"><?php echo htmlspecialchars($avatarError); ?></p>
    <?php endif; ?>

    <h3 class="profile-section-title">Your Reviews</h3>

    <?php if (!$myReviews): ?>
      <p class="review-empty">You haven't reviewed any restaurants yet.</p>
    <?php endif; ?>

  <?php foreach ($myReviews as $rev): ?>
      <div class="review-card" id="review-card-<?php echo $rev['id']; ?>">
        <div class="review-card-top">
          <div class="review-card-name"><?php echo htmlspecialchars($rev['restaurant_name']); ?></div>
          <button
            type="button"
            class="review-delete-btn"
            data-review-id="<?php echo $rev['id']; ?>"
            title="Delete this review"
          >Delete</button>
        </div>
        <div class="review-card-stars">
          <?php echo str_repeat('★', $rev['rating']) . str_repeat('☆', 5 - $rev['rating']); ?>
        </div>
        <div class="review-card-recommend">
          <div class="review-card-recommend-label">
            <span>Recommends</span>
            <strong><?php echo $rev['recommend_pct']; ?>%</strong>
          </div>
          <div class="review-card-bar-track">
            <div class="review-card-bar-fill" style="width:<?php echo $rev['recommend_pct']; ?>%;"></div>
          </div>
        </div>
        <p class="review-card-body"><?php echo nl2br(htmlspecialchars($rev['body'])); ?></p>
        <?php if ($rev['images']): ?>
          <div class="review-card-images">
            <?php foreach ($rev['images'] as $img): ?>
              <img src="<?php echo htmlspecialchars($img); ?>" alt="Review photo">
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>

  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/files/layout/footer.php'; ?>

<script>
document.querySelectorAll('.review-delete-btn').forEach(btn => {
  btn.addEventListener('click', function () {
    if (!confirm('Delete this review? This cannot be undone.')) return;

    const reviewId = this.dataset.reviewId;
    this.disabled = true;
    this.textContent = 'Deleting...';

    fetch('<?php echo BASE_URL; ?>files/api/delete_review.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: 'review_id=' + encodeURIComponent(reviewId)
    })
      .then(r => r.json())
      .then(data => {
        if (data.success) {
          const card = document.getElementById('review-card-' + reviewId);
          if (card) card.remove();
        } else {
          alert(data.error || 'Could not delete review.');
          this.disabled = false;
          this.textContent = 'Delete Review';
        }
      })
      .catch(() => {
        alert('Network error. Please try again.');
        this.disabled = false;
        this.textContent = 'Delete';
      });
  });
});
</script>

<script src="../index.js"></script>
</body>

</html>
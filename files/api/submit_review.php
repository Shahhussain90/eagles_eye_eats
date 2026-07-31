<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/files/connection.php';
header('Content-Type: application/json');

$user = current_user();
if (!$user) {
    echo json_encode(['success' => false, 'error' => 'Not signed in']);
    exit;
}

$restaurantId = (int)($_POST['restaurant_id'] ?? 0);
$rating = (int)($_POST['rating'] ?? 0);
$recommendPct = (int)($_POST['recommend_pct'] ?? 0);
$body = trim($_POST['body'] ?? '');

if ($restaurantId <= 0 || $rating < 1 || $rating > 5 || $body === '') {
    echo json_encode(['success' => false, 'error' => 'Invalid review data']);
    exit;
}
$recommendPct = max(0, min(100, $recommendPct));

$ageCheck = $con->prepare("SELECT TIMESTAMPDIFF(HOUR, created_at, NOW()) AS hours_old FROM users WHERE id = ?");
$ageCheck->bind_param("i", $user['id']);
$ageCheck->execute();
$ageRow = $ageCheck->get_result()->fetch_assoc();
if (!$ageRow || $ageRow['hours_old'] < 24) {
    echo json_encode(['success' => false, 'error' => 'Your account must be at least 24 hours old to post a review']);
    exit;
}

// Enforce one review per user per restaurant at app level too (DB unique key backs this up)
$check = $con->prepare("SELECT id FROM reviews WHERE user_id = ? AND restaurant_id = ?");
$check->bind_param("ii", $user['id'], $restaurantId);
$check->execute();
if ($check->get_result()->fetch_assoc()) {
    echo json_encode(['success' => false, 'error' => 'You already reviewed this restaurant']);
    exit;
}

$ins = $con->prepare("INSERT INTO reviews (user_id, restaurant_id, rating, recommend_pct, body) VALUES (?, ?, ?, ?, ?)");
$ins->bind_param("iiiis", $user['id'], $restaurantId, $rating, $recommendPct, $body);

if (!$ins->execute()) {
    echo json_encode(['success' => false, 'error' => 'Could not save review']);
    exit;
}
$reviewId = $con->insert_id;

// Handle up to 5 images
$allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
$savedCount = 0;
if (!empty($_FILES['images']['name'][0])) {
    $count = min(count($_FILES['images']['name']), 5);
    for ($i = 0; $i < $count; $i++) {
        if ($_FILES['images']['error'][$i] !== UPLOAD_ERR_OK) continue;
        $tmp = $_FILES['images']['tmp_name'][$i];
        $mime = mime_content_type($tmp);
        if (!isset($allowed[$mime])) continue;
        if ($_FILES['images']['size'][$i] > 8 * 1024 * 1024) continue;

        $ext = ($mime === 'image/png') ? 'png' : 'jpg';
        $filename = 'review_' . $reviewId . '_' . $i . '_' . time() . '.' . $ext;
        $dest = UPLOAD_DIR . 'reviews/' . $filename;

        if (resize_and_save_image($tmp, $dest, 1400, 1400, 82)) {
            $url = UPLOAD_URL . 'reviews/' . $filename;
            $imgIns = $con->prepare("INSERT INTO review_images (review_id, image_path) VALUES (?, ?)");
            $imgIns->bind_param("is", $reviewId, $url);
            $imgIns->execute();
            $savedCount++;
        }
    }
}
echo json_encode(['success' => true, 'images_saved' => $savedCount]);
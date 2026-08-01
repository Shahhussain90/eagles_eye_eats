<?php
include_once __DIR__ . '/../connection.php';
header('Content-Type: application/json');

$user = current_user();
if (!$user) {
    echo json_encode(['success' => false, 'error' => 'Not signed in']);
    exit;
}

$reviewId = (int)($_POST['review_id'] ?? 0);
if ($reviewId <= 0) {
    echo json_encode(['success' => false, 'error' => 'Invalid review']);
    exit;
}

// Confirm this review actually belongs to the logged-in user before touching anything
$check = $con->prepare("SELECT id FROM reviews WHERE id = ? AND user_id = ?");
$check->bind_param("ii", $reviewId, $user['id']);
$check->execute();
$owned = $check->get_result()->fetch_assoc();

if (!$owned) {
    echo json_encode(['success' => false, 'error' => 'Review not found or not yours']);
    exit;
}

// Delete image files from disk before removing DB rows
$imgStmt = $con->prepare("SELECT image_path FROM review_images WHERE review_id = ?");
$imgStmt->bind_param("i", $reviewId);
$imgStmt->execute();
$images = $imgStmt->get_result()->fetch_all(MYSQLI_ASSOC);

foreach ($images as $img) {
    if (strpos($img['image_path'], UPLOAD_URL . 'reviews/') === 0) {
        $filename = basename($img['image_path']);
        $filePath = UPLOAD_DIR . 'reviews/' . $filename;
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
    }
}

// review_images rows are removed automatically via ON DELETE CASCADE
$del = $con->prepare("DELETE FROM reviews WHERE id = ? AND user_id = ?");
$del->bind_param("ii", $reviewId, $user['id']);

if ($del->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Could not delete review']);
}
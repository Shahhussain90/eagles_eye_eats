<?php
include_once __DIR__ . '/../../files/connection.php';
include_once __DIR__ . '/../auth_check.php';

$id = (int)($_GET['id'] ?? 0);
if ($id) {
    // FK ON DELETE CASCADE handles restaurant_images, restaurant_categories,
    // restaurant_google_reviews, restaurant_faqs automatically.
    $stmt = $con->prepare("DELETE FROM restaurants WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
header('Location: list.php?deleted=1');
exit;

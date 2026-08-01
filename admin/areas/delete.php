<?php
include_once __DIR__ . '/../../files/connection.php';
include_once __DIR__ . '/../auth_check.php';

$id = (int)($_GET['id'] ?? 0);
if ($id) {
    // restaurants.area_id has ON DELETE SET NULL, so restaurants aren't deleted,
    // just unlinked from this area — area_faqs cascade-delete automatically.
    $stmt = $con->prepare("DELETE FROM areas WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
header('Location: list.php?deleted=1');
exit;

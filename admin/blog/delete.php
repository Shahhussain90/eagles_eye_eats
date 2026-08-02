<?php
include_once __DIR__ . '/../../files/connection.php';
include_once __DIR__ . '/../auth_check.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_verify()) {
    header('Location: list.php');
    exit;
}
$id = (int)($_POST['id'] ?? 0);
if ($id) {
    $stmt = $con->prepare("DELETE FROM blog_posts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
header('Location: list.php?deleted=1');
exit;
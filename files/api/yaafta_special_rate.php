<?php
include_once __DIR__ . '/../connection.php';
header('Content-Type: application/json');

if (!rate_limit_check('ysr_rate', 5, 60)) {
    echo json_encode(['success' => false, 'error' => 'too_many_requests']);
    exit;
}

$restaurantId = (int)($_POST['restaurant_id'] ?? 0);
$valueForMoney = (int)($_POST['value_for_money'] ?? -1);
$influencerAccuracy = (int)($_POST['influencer_accuracy'] ?? -1);
$recommendPct = (int)($_POST['recommend_pct'] ?? -1);

$currentUser = current_user();
$userId = $currentUser ? $currentUser['id'] : null;

if (!isset($_COOKIE['yaafta_anon_id'])) {
    $anonId = bin2hex(random_bytes(16));
    setcookie('yaafta_anon_id', $anonId, time() + (86400 * 365), '/');
} else {
    $anonId = $_COOKIE['yaafta_anon_id'];
}

if ($restaurantId <= 0 || $valueForMoney < 0 || $valueForMoney > 100
    || $influencerAccuracy < 0 || $influencerAccuracy > 100
    || $recommendPct < 0 || $recommendPct > 100) {
    echo json_encode(['success' => false, 'error' => 'invalid_data']);
    exit;
}

$ins = $con->prepare("INSERT INTO yaafta_special_ratings (restaurant_id, value_for_money, influencer_accuracy, recommend_pct, user_id, anon_id) VALUES (?, ?, ?, ?, ?, ?)");
$ins->bind_param("iiiiis", $restaurantId, $valueForMoney, $influencerAccuracy, $recommendPct, $userId, $anonId);
$ins->execute();

$agg = $con->prepare("
    SELECT COUNT(*) AS n,
           AVG(value_for_money) AS avg_value,
           AVG(influencer_accuracy) AS avg_influencer,
           AVG(recommend_pct) AS avg_recommend
    FROM yaafta_special_ratings WHERE restaurant_id = ?
");
$agg->bind_param("i", $restaurantId);
$agg->execute();
$stats = $agg->get_result()->fetch_assoc();

$overallAvg = round(($stats['avg_value'] + $stats['avg_influencer'] + $stats['avg_recommend']) / 3);

echo json_encode([
    'success' => true,
    'vote_count' => $stats['n'],
    'avg_value' => round($stats['avg_value']),
    'avg_influencer' => round($stats['avg_influencer']),
    'avg_recommend' => round($stats['avg_recommend']),
    'overall_avg' => $overallAvg
]);
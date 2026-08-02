<?php
include_once __DIR__ . '/../connection.php';
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$credential = $input['credential'] ?? null;

if (!$credential) {
    echo json_encode(['success' => false, 'error' => 'Missing credential']);
    exit;
}

if (!rate_limit_check('google_callback', 15, 300)) {
    echo json_encode(['success' => false, 'error' => 'Too many requests. Please try again shortly.']);
    exit;
}

// Verify token with Google (no SDK needed)
$verifyUrl = 'https://oauth2.googleapis.com/tokeninfo?id_token=' . urlencode($credential);
$ch = curl_init($verifyUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode !== 200) {
    echo json_encode(['success' => false, 'error' => 'Token verification failed']);
    exit;
}

$payload = json_decode($response, true);

// Critical checks — do not skip these
if (($payload['aud'] ?? '') !== GOOGLE_CLIENT_ID) {
    echo json_encode(['success' => false, 'error' => 'Invalid audience']);
    exit;
}
if (!in_array($payload['iss'] ?? '', ['accounts.google.com', 'https://accounts.google.com'])) {
    echo json_encode(['success' => false, 'error' => 'Invalid issuer']);
    exit;
}
if (($payload['exp'] ?? 0) < time()) {
    echo json_encode(['success' => false, 'error' => 'Token expired']);
    exit;
}

$sub     = $payload['sub'];
$email   = $payload['email'] ?? '';
$name    = $payload['name'] ?? explode('@', $email)[0];
$picture = $payload['picture'] ?? null;

// Upsert user
$stmt = $con->prepare("SELECT id FROM users WHERE google_sub = ?");
$stmt->bind_param("s", $sub);
$stmt->execute();
$existing = $stmt->get_result()->fetch_assoc();

if ($existing) {
    $userId = $existing['id'];
    $upd = $con->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
    $upd->bind_param("ssi", $name, $email, $userId);
    $upd->execute();
} else {
    $ins = $con->prepare("INSERT INTO users (google_sub, email, name, avatar_url) VALUES (?, ?, ?, ?)");
    $ins->bind_param("ssss", $sub, $email, $name, $picture);
    $ins->execute();
    $userId = $con->insert_id;
}

$_SESSION['user_id'] = $userId;
session_regenerate_id(true);

echo json_encode(['success' => true, 'redirect' => BASE_URL . 'files/profile']);
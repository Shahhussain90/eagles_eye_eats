<?php
// Change this depending on environment
define('BASE_URL', 'http://localhost/yaafta/');



// Database connection settingsmysql
// $con = mysqli_connect('localhost', 'root', '', 'u722300345_eagles_eye_eat');
$con = new mysqli('localhost', 'root', '', 'yaafta_local');

if (!$con) {
    die("Database connection failed: " . $con->connect_error);
}   


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('GOOGLE_CLIENT_ID', '64634114234-u6lhebqidqi3aij19q38vgthb7t1v3c3.apps.googleusercontent.com');
define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'] . '/files/uploads/');
define('UPLOAD_URL', BASE_URL . 'files/uploads/');

function current_user() {
    global $con;
    if (!isset($_SESSION['user_id'])) return null;
    static $cached = null;
    if ($cached !== null) return $cached;
    $stmt = $con->prepare("SELECT id, email, name, avatar_url FROM users WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $cached = $stmt->get_result()->fetch_assoc();
    return $cached;
}


function resize_and_save_image($tmpPath, $destPath, $maxWidth = 1200, $maxHeight = 1200, $quality = 82) {
    $info = getimagesize($tmpPath);
    if (!$info) return false;

    [$width, $height, $type] = $info;

    switch ($type) {
        case IMAGETYPE_JPEG:
            $src = imagecreatefromjpeg($tmpPath);
            break;
        case IMAGETYPE_PNG:
            $src = imagecreatefrompng($tmpPath);
            break;
        case IMAGETYPE_WEBP:
            $src = imagecreatefromwebp($tmpPath);
            break;
        default:
            return false;
    }
    if (!$src) return false;

    $ratio = min($maxWidth / $width, $maxHeight / $height, 1);
    $newWidth = (int) round($width * $ratio);
    $newHeight = (int) round($height * $ratio);

    $dst = imagecreatetruecolor($newWidth, $newHeight);

    if ($type === IMAGETYPE_PNG) {
        imagealphablending($dst, false);
        imagesavealpha($dst, true);
    }

    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    $saved = false;
    if ($type === IMAGETYPE_PNG) {
        $saved = imagepng($dst, $destPath, 6);
    } else {
        $saved = imagejpeg($dst, $destPath, $quality);
    }

    imagedestroy($src);
    imagedestroy($dst);

    return $saved;
}

function rate_limit_check($actionKey, $maxAttempts, $windowSeconds) {
    global $con;
    
    // Occasionally clean up old rows (roughly 1 in 50 calls) so the table doesn't grow forever
    if (rand(1, 50) === 1) {
        $con->query("DELETE FROM rate_limit_log WHERE created_at < (NOW() - INTERVAL 1 DAY)");
    }

    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $identifier = $actionKey . ':' . $ip;

    $stmt = $con->prepare("SELECT COUNT(*) AS n FROM rate_limit_log WHERE identifier = ? AND created_at > (NOW() - INTERVAL ? SECOND)");
    $stmt->bind_param("si", $identifier, $windowSeconds);
    $stmt->execute();
    $count = $stmt->get_result()->fetch_assoc()['n'];

    if ($count >= $maxAttempts) {
        return false;
    }

    $ins = $con->prepare("INSERT INTO rate_limit_log (identifier, created_at) VALUES (?, NOW())");
    $ins->bind_param("s", $identifier);
    $ins->execute();

    return true;
}

?>
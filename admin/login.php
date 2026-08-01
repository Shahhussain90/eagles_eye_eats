<?php
include_once __DIR__ . '/../files/connection.php';

if (isset($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $con->prepare("SELECT id, username, password_hash FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $admin = $stmt->get_result()->fetch_assoc();

    if ($admin && password_verify($password, $admin['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];
        header('Location: dashboard.php');
        exit;
    }
    $error = 'Invalid username or password.';
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Login | Yaafta</title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css" />
  <style>
    body { background: #f6f7f9; color: #1a1a1a; }
    .admin-auth-wrap { max-width: 380px; margin: 80px auto; padding: 32px; border-radius: 12px; background: #fff; box-shadow: 0 2px 20px rgba(0,0,0,0.08); color: #1a1a1a; }
    .admin-auth-wrap h1 { font-size: 1.4rem; margin-bottom: 20px; color: #1a1a1a; }
    .admin-auth-wrap input { width: 100%; padding: 10px 12px; margin-bottom: 12px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; color: #1a1a1a; background: #fff; }
    .admin-auth-wrap button { width: 100%; padding: 10px; }
    .admin-auth-error { color: #d32f2f; font-size: 0.9rem; margin-bottom: 12px; }
  </style>
</head>
<body>
  <div class="admin-auth-wrap">
    <h1>Yaafta Admin</h1>
    <?php if ($error): ?><p class="admin-auth-error"><?php echo htmlspecialchars($error); ?></p><?php endif; ?>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required autofocus>
      <input type="password" name="password" placeholder="Password" required>
      <button class="btn btn-primary" type="submit">Log In</button>
    </form>
  </div>
</body>
</html>
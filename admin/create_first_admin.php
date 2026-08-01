<?php
// ONE-TIME USE: visit this in your browser once to create your admin login,
// then DELETE this file (don't leave it accessible).
include_once __DIR__ . '/../files/connection.php';

$done = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($username === '' || strlen($password) < 6) {
        $error = 'Username required, password must be at least 6 characters.';
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $con->prepare("INSERT INTO admins (username, password_hash) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hash);
        if ($stmt->execute()) {
            $done = true;
        } else {
            $error = 'Could not create admin (username may already exist).';
        }
    }
}
?>
<!doctype html>
<html><head><title>Create Admin</title></head>
<body style="font-family:sans-serif; max-width:400px; margin:60px auto;">
<h2>Create First Admin</h2>
<?php if ($done): ?>
  <p style="color:green;">Admin created. <strong>Delete this file now</strong>, then log in at <a href="login.php">login.php</a>.</p>
<?php else: ?>
  <?php if ($error): ?><p style="color:red;"><?php echo htmlspecialchars($error); ?></p><?php endif; ?>
  <form method="POST">
    <input type="text" name="username" placeholder="Username" required style="width:100%;padding:8px;margin-bottom:10px;"><br>
    <input type="password" name="password" placeholder="Password (min 6 chars)" required style="width:100%;padding:8px;margin-bottom:10px;"><br>
    <button type="submit">Create Admin</button>
  </form>
<?php endif; ?>
</body></html>

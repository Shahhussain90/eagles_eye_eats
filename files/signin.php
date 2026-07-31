<?php
 include __DIR__ . '/connection.php';
if (current_user()) {
    header('Location: ' . BASE_URL . 'files/profile');
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In | Yaafta</title>
    <link rel="stylesheet" href="../css/style.css" />
     <link rel="icon" href="images/favicon.svg" type="image/svg+xml">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/x-icon" href="images/yaafta_favicon.ico">
    <link rel="manifest" href="images/site.webmanifest">
    <link rel="canonical" href="https://yaafta.com/files/signin">
</head>
<body>
<?php  include __DIR__ . '/layout/header.php'; ?>

<script src="https://accounts.google.com/gsi/client" async defer></script>

<section class="section auth-page">
  <div class="container">
    <div class="auth-card">
      <h1>Sign in to Yaafta</h1>
      <p>Sign in with Google to leave reviews and photos.</p>

      <div id="g_id_onload"
         data-client_id="<?php echo GOOGLE_CLIENT_ID; ?>"
         data-callback="handleGoogleCredential"
         data-auto_prompt="false">
    </div>
    <div class="g_id_signin"
         data-type="standard"
         data-theme="filled_black"
         data-size="large"
         data-shape="pill"
         style="display:flex; justify-content:center;">
    </div>

    <p class="auth-consent-note">
      By signing in, you agree to Yaafta's
      <a href="<?php echo BASE_URL; ?>files/termsandconditions">Terms</a>
      and
      <a href="<?php echo BASE_URL; ?>files/privacy">Privacy Policy</a>.
    </p>

      <p id="signinError" class="auth-error"></p>
    </div>
  </div>
</section>

<script>
function handleGoogleCredential(response) {
  fetch('<?php echo BASE_URL; ?>files/auth/google_callback.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ credential: response.credential })
  })
  .then(r => r.json())
  .then(data => {
    if (data.success) {
      window.location = data.redirect || '<?php echo BASE_URL; ?>files/profile';
    } else {
      const el = document.getElementById('signinError');
      el.textContent = data.error || 'Sign in failed. Please try again.';
      el.style.display = 'block';
    }
  });
}
</script>

<?php  include __DIR__ . '/layout/footer.php'; ?>

<script src="../index.js"></script>
</body>

</html>
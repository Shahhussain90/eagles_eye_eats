<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Page Not Found | Yaafta</title>
   <link rel="icon" href="<?php echo BASE_URL; ?>files/images/favicon.svg" type="image/svg+xml">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE_URL; ?>files/images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL; ?>files/images/favicon-16x16.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASE_URL; ?>files/images/apple-touch-icon.png">
  <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL; ?>files/images/yaafta_favicon.ico">
  <link rel="manifest" href="<?php echo BASE_URL; ?>files/images/site.webmanifest">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css" />
</head>
<body>
  <?php include __DIR__ . '/../files/layout/header.php'; ?>
  <section class="section">
    <div class="container" style="text-align:center; padding: 60px 0;">
      <h1>404 — Page Not Found</h1>
      <p>The page you're looking for doesn't exist or may have been moved.</p>
      <a class="btn btn-primary" href="<?php echo BASE_URL; ?>">Back to Home</a>
    </div>
  </section>
  <?php include __DIR__ . '/../files/layout/footer.php'; ?>
</body>
</html>

<?php
require_once 'connection.php';

$statusMsg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['contact_btn'])) {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || $email === '' || $message === '') {
        $statusMsg = 'error';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $statusMsg = 'invalid_email';
    } else {
        $stmt = $con->prepare(
            "INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)"
        );
        $ip = $_SERVER['REMOTE_ADDR'] ?? null;
        $stmt->bind_param("sss", $name, $email, $message);

        $statusMsg = $stmt->execute() ? 'success' : 'error';
    }

    // Redirect back to this same page (POST-redirect-GET pattern)
    header("Location: " . $_SERVER['PHP_SELF'] . "?status=" . $statusMsg);
    exit;
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Eagles Eye Eats helps you discover the best restaurants in Karachi, Pakistan. Browse top eateries by area, cuisine, and category."
    />
    <meta
      name="keywords"
      content="Karachi restaurants, best restaurants in Karachi, cafes in Karachi, Karachi food guide, restaurant directory Pakistan"
    />
    <meta name="author" content="Eagles Eye Eats" />
    <meta name="robots" content="index, follow" />
    <link rel="icon" href="images/favicon.svg" type="image/svg+xml">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/x-icon" href="images/yaafta_favicon.ico">
    <link rel="manifest" href="images/site.webmanifest">
    <link rel="canonical" href="https://yaafta.com/files/contact">
    <title>Eagles Eye Eats | Discover the Best Restaurants in Karachi</title>
    <link rel="stylesheet" href="../css/style.css" />
    <script src="https://quge5.com/88/tag.min.js" data-zone="249441" async data-cfasync="false"></script>
  </head>
  <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-4R19BFTQEM"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-4R19BFTQEM');
</script>

  <body>
    <!-- =========================
       Header / Navigation
  ========================== -->
     <?php

// error_reporting(E_ALL);
// ini_set('display_errors', 1);
    include __DIR__ . '/layout/header.php';
  ?>

    <section class="contact-page">
  <div class="container contact-container">

    <!-- Heading -->
    <div class="contact-header">
      <?php if (isset($_GET['status'])): ?>
        <?php if ($_GET['status'] === 'success'): ?>
          <p class="form-success">Thanks — your message has been sent!</p>
        <?php elseif ($_GET['status'] === 'invalid_email'): ?>
          <p class="form-error">Please enter a valid email address.</p>
        <?php else: ?>
          <p class="form-error">Something went wrong. Please try again.</p>
        <?php endif; ?>
      <?php endif; ?>
      <h1>Contact Eagles Eye Eats</h1>
      <p>
        Have a restaurant to list, a suggestion, or a partnership idea? 
        We'd love to hear from you.
      </p>
    </div>

    <!-- Contact Grid -->
    <div class="contact-grid">

      <!-- FORM -->
      <form class="contact-form" action="<?php echo BASE_URL; ?>files/contact.php" method="POST">

        <div class="form-group">
          <label>Your Name</label>
          <input type="text" placeholder="Enter your name" name="name" required />
        </div>

        <div class="form-group">
          <label>Email Address</label>
          <input type="email" placeholder="Enter your email" name="email" required />
        </div>

        <div class="form-group">
          <label>Message</label>
          <textarea rows="5" placeholder="Write your message..." name="message"></textarea>
        </div>

        <button type="submit" name="contact_btn" class="btn btn-primary contact-btn">
          Send Message
        </button>

      </form>

      <!-- SIDE INFO -->
      <div class="contact-info">

        <!-- <div class="info-box">
          <h3>Email</h3>
          <p>support@eagleseyeeats.com</p>
        </div> -->

        <div class="info-box">
          <h3>Location</h3>
          <p>Karachi, Pakistan</p>
        </div>

        <div class="info-box">
          <h3>Response Time</h3>
          <p>Within 24 hours</p>
        </div>

      </div>

    </div>

  </div>
</section>
  
<?php
    include_once 'layout/footer.php';
    ?>
    <script src="../index.js"></script>
  </body>
</html>
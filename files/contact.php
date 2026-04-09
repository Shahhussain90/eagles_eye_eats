
<?php 
   require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['contact_btn'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];


    $sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";
    if ($con->query($sql) === TRUE) {
      echo "<script>alert('Message sent successfully!');</script>";
    } else {
      echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

  }
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
    <title>Eagles Eye Eats | Discover the Best Restaurants in Karachi</title>
    <link rel="stylesheet" href="../css/style.css" />
  </head>
  <body>
    <!-- =========================
       Header / Navigation
  ========================== -->
    <?php
    include_once 'connection.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/eagles_eye_eats/files/layout/header.php'; 
    ?>

    <section class="contact-page">
  <div class="container contact-container">

    <!-- Heading -->
    <div class="contact-header">
      <h1>Contact Eagles Eye Eats</h1>
      <p>
        Have a restaurant to list, a suggestion, or a partnership idea? 
        We'd love to hear from you.
      </p>
    </div>

    <!-- Contact Grid -->
    <div class="contact-grid">

      <!-- FORM -->
      <form class="contact-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

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

        <div class="info-box">
          <h3>Email</h3>
          <p>support@eagleseyeeats.com</p>
        </div>

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
    <script src="../../index.js"></script>
  </body>
</html>

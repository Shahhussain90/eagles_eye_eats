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
      <form class="contact-form">

        <div class="form-group">
          <label>Your Name</label>
          <input type="text" placeholder="Enter your name" required />
        </div>

        <div class="form-group">
          <label>Email Address</label>
          <input type="email" placeholder="Enter your email" required />
        </div>

        <div class="form-group">
          <label>Subject</label>
          <input type="text" placeholder="e.g. Add my restaurant" />
        </div>

        <div class="form-group">
          <label>Message</label>
          <textarea rows="5" placeholder="Write your message..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary contact-btn">
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
    <!-- =========================
       Footer
  ========================== -->
    <footer>
      <div class="container">
        <div class="footer-grid">
          <div class="footer-panel">
            <h3>Eagles Eye Eats</h3>
            <p style="margin-top: 0; color: var(--muted)">
              Discover Karachi’s best restaurants, cafes, and food spots by area
              and category.
            </p>
            <div class="socials" aria-label="Social media links placeholder">
              <a href="#" aria-label="Facebook">f</a>
              <a href="#" aria-label="Instagram">ig</a>
              <a href="#" aria-label="X / Twitter">x</a>
              <a href="#" aria-label="YouTube">yt</a>
            </div>
          </div>

          <div class="footer-panel">
            <h4>Quick Links</h4>
            <ul class="footer-links">
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
              <li><a href="#">Privacy</a></li>
              <li><a href="#">Terms</a></li>
            </ul>
          </div>

          <div class="footer-panel">
            <h4>Newsletter</h4>
            <p style="margin-top: 0; color: var(--muted)">
              Get weekly updates on new restaurants, top lists, and food guides.
            </p>
            <form class="newsletter" action="#">
              <input
                type="email"
                placeholder="Enter your email"
                aria-label="Newsletter email"
              />
              <button class="btn btn-primary" type="submit">Subscribe</button>
            </form>
          </div>

          <!-- <div class="footer-panel">
            <h4>AdSense Footer Ad</h4>
            <div class="ad-slot" style="min-height: 160px">
              <div>
                <span class="ad-label">Footer AdSense Unit</span>
                <div>300 × 250 / Responsive Ad Placeholder</div>
              </div>
            </div>
          </div> -->
        </div>

        <div class="copyright">
          <span>© 2026 Eagles Eye Eats. All rights reserved.</span>
          <span>Karachi, Pakistan</span>
        </div>
      </div>
    </footer>

    <script src="../../index.js"></script>
  </body>
</html>

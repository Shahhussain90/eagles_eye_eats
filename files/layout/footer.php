<!-- =========================
       Footer
  ========================== -->
  
 <!--success messages-->
  
  <?php if (!empty($_GET['status']) || !empty($_GET['error'])): ?>

<div style="position:fixed; bottom:20px; right:20px; z-index:99999; max-width:300px;">

    <?php if (($_GET['status'] ?? '') === 'subscribed'): ?>
        <div style="padding:12px; background:#d1fae5; color:#065f46; border-radius:6px; margin-bottom:8px;">
            ✔ Subscribed successfully!
        </div>

    <?php elseif (($_GET['status'] ?? '') === 'already_subscribed'): ?>
        <div style="padding:12px; background:#fef3c7; color:#92400e; border-radius:6px; margin-bottom:8px;">
            ⚠ Already subscribed
        </div>

    <?php elseif (($_GET['error'] ?? '') === 'invalid_email'): ?>
        <div style="padding:12px; background:#fee2e2; color:#991b1b; border-radius:6px;">
            ❌ Invalid email
        </div>
    <?php endif; ?>

</div>

<?php endif; ?>
  
  <script>
setTimeout(() => {
    const el = document.querySelector("div[style*='position:fixed']");
    if (el) el.style.display = "none";
}, 3000);
</script>
  
  
  
    <footer>
      <div class="container">
        <div class="footer-grid">
            
            <div class="footer-imgg">
                 <img src="<?php echo BASE_URL; ?>files/images/logo-3.png" alt="Yaafta Logo" />
            </div>
            
          <div class="footer-panel">
            <h3>Yaafta</h3>
            <p style="margin-top: 0; color: var(--muted)">
              Discover Karachi’s best restaurants, cafes, and food spots by area
              and category.
            </p>
            <!-- <div class="socials" aria-label="Social media links placeholder">
              <a href="#" aria-label="Facebook">f</a>
              <a href="#" aria-label="Instagram">ig</a>
              <a href="#" aria-label="X / Twitter">x</a>
              <a href="#" aria-label="YouTube">yt</a>
            </div> -->
          </div>

          <div class="footer-panel">
            <h4>Quick Links</h4>
            <ul class="footer-links">
              <li><a href="<?php echo BASE_URL; ?>files/about-us">About</a></li>
              <li><a href="<?php echo BASE_URL; ?>files/contact">Contact</a></li>
              <li><a href="<?php echo BASE_URL; ?>files/privacy">Privacy</a></li>
              <li><a href="<?php echo BASE_URL; ?>files/termsandconditions">Terms</a></li>
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
          <span>© 2026 Yaafta. All rights reserved.</span>
          <span>Karachi, Pakistan</span>
        </div>
      </div>
    </footer>
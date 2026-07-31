<header>
  <div class="container nav-wrap">
    <a href="<?php echo BASE_URL; ?>#home" class="logo" aria-label="Yaafta homepage">
      <img src="<?php echo BASE_URL; ?>files/images/logo-3.png" alt="Yaafta Logo" />
    </a>
    <nav class="main-nav" aria-label="Primary navigation">
      <ul class="menu">
        <li><a href="<?php echo BASE_URL; ?>">Home</a></li>
        <!--<li><a href="<?php echo BASE_URL; ?>#areas">Areas</a></li>-->
        <!--<li><a href="<?php echo BASE_URL; ?>#blog">Blog</a></li>-->
        <li><a href="<?php echo BASE_URL; ?>files/about-us">About</a></li>
        <li><a href="<?php echo BASE_URL; ?>files/contact">Contact</a></li>
      </ul>
    </nav>
    <div class="nav-right">
      <form class="nav-search" action="#" role="search" aria-label="Site search">
        <svg class="nav-search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
          <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"/>
          <path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
        <input
          type="search"
          id="searchInput"
          placeholder="Search by name, cuisine, rating, or area…"
          aria-label="Search restaurants"
          autocomplete="off"
        />
      </form>
      <div id="searchResults" class="search-results"></div>
      
      <?php $headerUser = current_user(); ?>
      <?php if ($headerUser): ?>
        <a href="<?php echo BASE_URL; ?>files/profile" class="nav-avatar-link" title="Your profile">
         <img
            src="<?php echo htmlspecialchars($headerUser['avatar_url'] ?: BASE_URL . 'files/images/default-avatar.png'); ?>"
            alt="<?php echo htmlspecialchars($headerUser['name']); ?>"
            class="nav-avatar"
            onerror="this.onerror=null;this.src='<?php echo BASE_URL; ?>files/images/default-avatar.png';"
          />
        </a>
      <?php else: ?>
        <a href="<?php echo BASE_URL; ?>files/signin" class="nav-signin-btn">Sign In</a>
      <?php endif; ?>
      
      
      <button
        class="nav-toggle"
        aria-label="Toggle navigation"
        aria-expanded="false"
        aria-controls="mobile-menu"
      >
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </div>
  <!-- Mobile drawer -->
  <div id="mobile-menu" class="mobile-menu" aria-hidden="true">
    <form class="mobile-search" action="#" role="search" aria-label="Mobile site search">
      <svg class="nav-search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
        <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"/>
        <path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
      </svg>
      <input
        type="search"
        id="searchInputMobile"
        placeholder="Search restaurants…"
        aria-label="Search restaurants"
        autocomplete="off"
      />
    </form>
    <div id="searchResultsMobile" class="search-results search-results-mobile"></div>
    <ul class="mobile-nav-list">
         <?php if ($headerUser): ?>
        <li><a href="<?php echo BASE_URL; ?>files/profile">My Profile</a></li>
      <?php else: ?>
        <li><a href="<?php echo BASE_URL; ?>files/signin">Sign In</a></li>
      <?php endif; ?>
      <li><a href="<?php echo BASE_URL; ?>">Home</a></li>
      <!--<li><a href="<?php echo BASE_URL; ?>#areas">Areas</a></li>-->
      <!--<li><a href="<?php echo BASE_URL; ?>#blog">Blog</a></li>-->
      <li><a href="<?php echo BASE_URL; ?>files/about-us">About</a></li>
      <li><a href="<?php echo BASE_URL; ?>files/contact">Contact</a></li>
    </ul>
  </div>
</header>
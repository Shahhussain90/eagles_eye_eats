   <header>
      <div class="container nav-wrap">
        <a href="#home" class="logo" aria-label="Eagles Eye Eats homepage">
          <img src="<?php echo BASE_URL; ?>files/images/logo-3.png" alt="Eagles Eye Eats Logo" />
        </a>

        <nav aria-label="Primary navigation">
          <ul class="menu">
            <li><a href="<?php echo BASE_URL; ?>index.php">Home</a></li>
            <li><a href="<?php echo BASE_URL; ?>#areas">Areas</a></li>
            <li><a href="<?php echo BASE_URL; ?>#categories">Categories</a></li>
            <li><a href="<?php echo BASE_URL; ?>#blog">Blog</a></li>
            <li><a href="<?php echo BASE_URL; ?>#about">About</a></li>
            <li><a href="<?php echo BASE_URL; ?>files/contact.php">Contact</a></li>
          </ul>
        </nav>

        <form
          class="nav-search"
          action="#"
          role="search"
          aria-label="Site search"
        >
          <input
            type="search"
            id="searchInput"
            placeholder="Search restaurants by name, cuisine, or area"
            aria-label="Search restaurants by name, cuisine, or area"
          />
        </form>
        <!-- Search Results Dropdown -->
        <div id="searchResults" class="search-results"></div>

        <!-- <div class="auth-actions">
        <a class="btn btn-outline" href="#login">Login</a>
        <a class="btn btn-primary" href="#signup">Signup</a>
      </div> -->
      </div>
    </header>
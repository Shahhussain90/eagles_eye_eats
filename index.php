<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta
    name="description"
    content=" Give up the search. Start enjoying. Need a restaurant in Karachi for a family evening or want to discover some of the citys best-kept secrets? We've ranked Karachis restaurants by location, cuisine and vibe." />
  <meta
    name="keywords"
    content="Karachi restaurants, karachi food, karachi's best restaurants,top 10 restaurants in karachi,best restaurants in Karachi, cafes in Karachi, Karachi food guide, restaurant directory Pakistan" />
  <meta name="author" content="Eagles Eye Eats" />
  <meta name="robots" content="index, follow" />
  <link rel="canonical" href="https://www.eagleseyeeats.com/">
  <title>Eagles Eye Eats | The Best Food Guide for Karachi</title>

  <!-- =========================
     Favicon
    ========================= -->
  <link rel="icon" href="/favicon.ico" type="image/x-icon">

  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "Eagles Eye Eats",
      "url": "https://www.eagleseyeeats.com/",
      "logo": "https://www.eagleseyeeats.com/images/logo.png",
      "sameAs": [
        "https://www.facebook.com/EaglesEyeEats",
        "https://twitter.com/EaglesEyeEats",
        "https://www.instagram.com/EaglesEyeEats"
      ],
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+92-XXX-XXXXXXX",
        "contactType": "customer service",
        "areaServed": "PK"
      }
    }
  </script>

  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <!-- =========================
       Header / Navigation
  ========================== -->

  <?php
  include_once 'files/connection.php';
  include $_SERVER['DOCUMENT_ROOT'] . '/eagles_eye_eats/files/layout/header.php';
  ?>


  <main id="home">
    <!-- <div class="container ad-top">
      AdSense Top Banner Placeholder
      <div class="ad-slot" aria-label="Advertisement placeholder top banner">
        <div>
          <span class="ad-label">AdSense Banner Ad</span>
          <div>728 × 90 / Responsive Banner Placeholder</div>
        </div>
      </div>
    </div> -->

    <!-- =========================
         Hero Section
    ========================== -->
    <section class="hero">
      <div class="container hero-grid">
        <div class="hero-copy">
          <span class="badge">The Best Food Guide for Karachi</span>
          <h1>The Best Restaurants in Karachi, Pakistan—Handpicked for You</h1>
          <p>
            Give up the search. Start enjoying. Need a restaurant in Karachi for a family evening or want to discover some of the citys best-kept secrets? We've ranked Karachis restaurants by location, cuisine and vibe.
          </p>

          <form
            class="hero-search"
            action="#"
            role="search"
            aria-label="Search restaurants">
            <input
              type="search"
              placeholder="Search restaurants, cuisines, areas..."
              aria-label="Search restaurants, cuisines, or areas" />
            <button class="btn btn-primary" type="submit">Search Now</button>
          </form>

          <div class="hero-cta-row">
            <span>✓ Local listings</span>
            <span>✓ restaurant location</span>
            <span>✓ Reviews</span>
          </div>
        </div>

        <div
          class="hero-card"
          aria-label="discover best restaurants in Karachi, foods, and dining experiences">
          <div class="hero-overlay">
            <strong>Handpicked dining experiences</strong>
            <span>From rooftop dining in Clifton to street food gems in
              Gulshan.</span>
          </div>
        </div>
      </div>
    </section>

    <!-- =========================
         Area Highlights Section
    ========================== -->
    <section class="section" id="areas">
      <div class="container">
        <div class="section-header">
          <div>
            <h2 class="section-title">Explore Karachi’s Most Popular Food Areas</h2>
            <p class="section-subtitle">
             Discover top restaurants in Karachi’s most searched neighborhoods. Browse by area to find the best eateries, cafes, and dining spots each location has to offer.
            </p>
          </div>
          <!-- <a class="btn btn-outline" href="#">View All Areas</a> -->
        </div>

        <div class="grid areas-grid">
          <a class="tile" href="<?php echo BASE_URL; ?>files/northnazimabad/NorthNazimabad10.php">
            <div class="thumb">
              <img src="files/images/north-nazimabad.PNG" />
            </div>
            <div class="content">
              <p class="area-name">North Nazimabad</p>
            </div>
          </a>
          <a class="tile" href="#">
            <div class="thumb"><img src="files/images/clifton.jpg" /></div>
            <div class="content">
              <p class="area-name">Clifton</p>
            </div>
          </a>
          <a class="tile" href="#">
            <div class="thumb">
              <img src="files/images/Bahadurabad Chorangi.jpg" />
            </div>
            <div class="content">
              <p class="area-name">Bahadurabad</p>
            </div>
          </a>
          <a class="tile" href="#">
            <div class="thumb"><img src="files/images/korangi.PNG" /></div>
            <div class="content">
              <p class="area-name">Korangi</p>
            </div>
          </a>
          <a class="tile" href="#">
            <div class="thumb">
              <img src="files/images/dha.PNG" />
            </div>
            <div class="content">
              <p class="area-name">DHA</p>
            </div>
          </a>
          <a class="tile" href="#">
            <div class="thumb">
              <img src="files/images/hussainabad.PNG" />
            </div>
            <div class="content">
              <p class="area-name">Bahadurabad</p>
            </div>
          </a>
        </div>
      </div>
    </section>

    <!-- =========================
         Featured Restaurants Section
    ========================== -->
    <section class="section" id="featured">
      <div class="container">
        <div class="section-header">
          <div>
            <h2 class="section-title">Featured Restaurants</h2>
            <p class="section-subtitle">
              A curated selection of popular restaurants across Karachi with
              quick details for faster browsing.
            </p>
          </div>
          <a class="btn btn-outline" href="#">See More Restaurants</a>
        </div>

        <div class="grid featured-grid">
          <article class="card">
            <div class="thumb">Restaurant Image</div>
            <div class="content">
              <h3 class="mini-title">The Blue Lagoon Bistro</h3>
              <div class="meta">
                <span>Cuisine: Continental</span><span>Area: Clifton</span>
              </div>
              <div class="rating">★ 4.8</div>
              <a class="btn btn-primary view-btn" href="#">View Details</a>
            </div>
          </article>

          <article class="card">
            <div class="thumb">Restaurant Image</div>
            <div class="content">
              <h3 class="mini-title">Spice Harbor</h3>
              <div class="meta">
                <span>Cuisine: Pakistani</span><span>Area: DHA</span>
              </div>
              <div class="rating">★ 4.7</div>
              <a class="btn btn-primary view-btn" href="#">View Details</a>
            </div>
          </article>

          <article class="card">
            <div class="thumb">Restaurant Image</div>
            <div class="content">
              <h3 class="mini-title">Cafe Aroma Karachi</h3>
              <div class="meta">
                <span>Cuisine: Cafe / Bakery</span><span>Area: Gulshan</span>
              </div>
              <div class="rating">★ 4.6</div>
              <a class="btn btn-primary view-btn" href="#">View Details</a>
            </div>
          </article>

          <article class="card">
            <div class="thumb">Restaurant Image</div>
            <div class="content">
              <h3 class="mini-title">The Flame Grill House</h3>
              <div class="meta">
                <span>Cuisine: Fast Food</span><span>Area: Bahadurabad</span>
              </div>
              <div class="rating">★ 4.5</div>
              <a class="btn btn-primary view-btn" href="#">View Details</a>
            </div>
          </article>

          <article class="card">
            <div class="thumb">Restaurant Image</div>
            <div class="content">
              <h3 class="mini-title">Saffron Table</h3>
              <div class="meta">
                <span>Cuisine: Fine Dining</span><span>Area: Clifton</span>
              </div>
              <div class="rating">★ 4.9</div>
              <a class="btn btn-primary view-btn" href="#">View Details</a>
            </div>
          </article>

          <article class="card">
            <div class="thumb">Restaurant Image</div>
            <div class="content">
              <h3 class="mini-title">Bakers Street Karachi</h3>
              <div class="meta">
                <span>Cuisine: Bakery</span><span>Area: North Nazimabad</span>
              </div>
              <div class="rating">★ 4.6</div>
              <a class="btn btn-primary view-btn" href="#">View Details</a>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- AdSense In-content Placeholder -->
    <!-- <section class="section" aria-label="In-content advertisement">
        <div class="container">
          <div class="ad-slot">
            <div>
              <span class="ad-label">In-Content AdSense Unit</span>
              <div>Responsive Banner / Rectangle Ad Placeholder</div>
            </div>
          </div>
        </div>
      </section> -->

    <!-- =========================
         Popular Categories Section
    ========================== -->
    <section class="section" id="categories">
      <div class="container">
        <div class="section-header">
          <div>
            <h2 class="section-title">Popular Categories</h2>
            <p class="section-subtitle">
              Quickly jump to the dining style you are looking for with
              category-based browsing.
            </p>
          </div>
          <a class="btn btn-outline" href="#">Browse Categories</a>
        </div>

        <div class="grid categories-grid">
          <a class="category" href="#">
            <div class="category-icon">🍽️</div>
            <h3>Fine Dining</h3>
          </a>
          <a class="category" href="#">
            <div class="category-icon">☕</div>
            <h3>Cafes</h3>
          </a>
          <a class="category" href="#">
            <div class="category-icon">🍔</div>
            <h3>Fast Food</h3>
          </a>
          <a class="category" href="#">
            <div class="category-icon">🥐</div>
            <h3>Bakeries</h3>
          </a>
          <a class="category" href="#">
            <div class="category-icon">🌶️</div>
            <h3>Street Food</h3>
          </a>
        </div>
      </div>
    </section>

    <!-- =========================
         Blog Section
    ========================== -->
    <section class="section" id="blog">
      <div class="container">
        <div class="section-header">
          <div>
            <h2 class="section-title">Latest Blog Posts</h2>
            <p class="section-subtitle">
              Helpful guides, neighborhood highlights, and food discovery tips
              for Karachi diners.
            </p>
          </div>
          <a class="btn btn-outline" href="#">Visit Blog</a>
        </div>

        <div class="grid blog-grid">
          <article class="post">
            <div class="thumb">Blog Thumbnail</div>
            <div class="content">
              <h3>Top Rooftop Restaurants in Clifton for Sunset Dining</h3>
              <p>
                Explore scenic dining spots in Clifton that pair great food
                with a beautiful skyline experience.
              </p>
              <a class="read-more" href="<?php echo BASE_URL; ?>files/blog/blog-1.php">Read More →</a>
            </div>
          </article>

          <article class="post">
            <div class="thumb">Blog Thumbnail</div>
            <div class="content">
              <h3>Best Cafes in Gulshan for Study, Work, and Catch-Ups</h3>
              <p>
                A curated list of cozy cafes with calm ambiance, great coffee,
                and laptop-friendly seating.
              </p>
              <a class="read-more" href="#">Read More →</a>
            </div>
          </article>

          <article class="post">
            <div class="thumb">Blog Thumbnail</div>
            <div class="content">
              <h3>Where to Find the Best Street Food in Karachi</h3>
              <p>
                Discover must-try street food spots and local favorites that
                food lovers keep coming back to.
              </p>
              <a class="read-more" href="#">Read More →</a>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- =========================
         About / Contact Mini Sections
    ========================== -->
   <section class="section about-enhanced" id="about">
  <div class="container about-container">
    <div class="section-header about-header">
      <div class="about-header-content">
        <h2 class="section-title about-title">
          About Eagles Eye Eats – Karachi Restaurant Guide
        </h2>

        <p class="section-subtitle about-subtitle">
          Eagles Eye Eats is a Karachi-based restaurant directory helping you 
          discover the best restaurants, cafes, and eateries across every area 
          of the city — quickly and effortlessly.
        </p>

        <!-- Feature Badges -->
        <div class="about-features">
          <span class="about-badge">✓ Browse by area in Karachi</span>
          <span class="about-badge">✓ Filter by cuisine & category</span>
          <span class="about-badge">✓ Discover trending restaurants</span>
          <span class="about-badge">✓ SEO-optimized listings</span>
        </div>
      </div>
    </div>

    <!-- Content Panel -->
    <div class="footer-panel about-panel">
      <div class="about-content">
        <p class="about-text">
          Eagles Eye Eats is built to make restaurant discovery in Karachi 
          simple, fast, and reliable. Whether you're looking for the best 
          restaurants in North Nazimabad, top cafes in DHA, or hidden food 
          spots near you, our platform organizes everything in one place.
        </p>

        <p class="about-text">
          We focus on structured, area-based listings combined with smart 
          filtering so users can easily find restaurants based on location, 
          cuisine, and popularity. Our goal is to help food lovers explore 
          Karachi while helping local restaurants grow their online visibility.
        </p>

        <p class="about-text">
          With a clean user experience and search engine optimized pages, 
          Eagles Eye Eats is designed to rank for local food searches and 
          deliver consistent organic traffic.
        </p>
      </div>

      <!-- Highlight Box -->
      <div class="about-highlight">
        <p>
          A modern Karachi food directory built for scalability, organic growth, 
          and monetization through search traffic and AdSense.
        </p>
      </div>
    </div>
  </div>
</section>



    <section class="section" id="contact">
      <div class="container">
        <div class="section-header">
          <div>
            <h2 class="section-title">Contact / Submit a Restaurant</h2>
            <p class="section-subtitle">
              Add your restaurant, suggest updates, or contact the team for
              partnerships and listings.
            </p>
          </div>
        </div>
        <div class="footer-panel">
          <form
            class="newsletter"
            action="#"
            aria-label="Contact or submit restaurant form">
            <input
              type="text"
              placeholder="Your name"
              aria-label="Your name" />
            <input
              type="email"
              placeholder="Your email"
              aria-label="Your email" />
            <input
              type="text"
              placeholder="Restaurant name or message"
              aria-label="Restaurant name or message" />
            <button class="btn btn-primary" type="submit">
              Send Message
            </button>
          </form>
        </div>
      </div>
    </section>
  </main>

  <!-- =========================
       Footer
  ========================== -->
  <?php
  include_once 'files/layout/footer.php'
  ?>

  <script src="index.js"></script>
</body>

</html>
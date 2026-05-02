<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
        name="description"
        content="Eagles Eye Eats helps you discover the best restaurants in Karachi, Pakistan. Browse top eateries by area, cuisine, and category." />
    <meta
        name="keywords"
        content="Karachi restaurants, best restaurants in Karachi, cafes in Karachi, Karachi food guide, restaurant directory Pakistan" />
    <meta name="author" content="Eagles Eye Eats" />
    <meta name="robots" content="index, follow" />

    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

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
    <section class="section about-enhanced">
        <div class="container">

            <!-- Header -->
            <div class="about-header">
                <div class="about-header-content">
                    <span class="badge">About Us</span>
                    <h1 class="section-title">Discover Karachi, One Bite at a Time</h1>
                    <p class="section-subtitle about-subtitle">
                        At Eagles Eye Eats, we make it easier to find the best restaurants in Karachi
                         whether it’s a well-known favorite or a hidden spot you haven’t tried yet.
                    </p>

                    <div class="about-features">
                        <span class="about-badge">🍽️ Food Discovery</span>
                        <span class="about-badge">📍 Explore by Area</span>
                        <span class="about-badge">⭐ Honest Insights</span>
                    </div>
                </div>
            </div>

            <!-- What We Do -->
            <div class="about-panel">
                <h2 class="section-title">What We Do</h2>
                <div class="about-content">
                    <p class="about-text">
                        Karachi has no shortage of great food, but finding the right place can be overwhelming. That’s where we come in.
                    </p>
                    <p class="about-text">
                        We organize restaurants by area, cuisine, and real dining experiences so you can quickly discover places that actually match what you're in the mood for.
                    </p>
                </div>
            </div>

            <!-- Mission -->
            <div class="about-panel">
                <h2 class="section-title">Our Mission</h2>
                <p class="about-text">
                    Our aim is simple — to become a trusted go-to platform for food discovery in Karachi by sharing honest, useful, and easy-to-understand restaurant recommendations.
                </p>
            </div>

            <!-- Who It's For -->
            <div class="about-panel">
                <h2 class="section-title">Who It's For</h2>
                <div class="about-content">
                    <p class="about-text">If you love trying new food spots around the city</p>
                    <p class="about-text">If you're planning a family dinner or a casual meetup</p>
                    <p class="about-text">If you're always searching for your next favorite place</p>
                    <p class="about-text">Or if you just want reliable suggestions without the guesswork</p>
                </div>
            </div>

            <!-- Why Choose Us -->
            <div class="about-panel">
                <h2 class="section-title">Why Choose Us</h2>
                <div class="about-content">
                    <p class="about-text">We focus only on Karachi, so the content stays relevant and local</p>
                    <p class="about-text">Everything is kept simple, clean, and easy to browse</p>
                    <p class="about-text">We regularly update listings to keep things fresh</p>
                    <p class="about-text">We highlight both popular spots and underrated gems</p>
                </div>
            </div>

            <!-- Highlight -->
            <div class="about-highlight">
                Eagles Eye Eats isn’t just a directory it’s your shortcut to finding great food in Karachi without the hassle.
            </div>

        </div>
    </section>

    <?php
    include_once 'layout/footer.php';
    ?>

    <script src="../../index.js"></script>
</body>

</html>
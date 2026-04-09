<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Eagles Eye Eats Blog - Food, Restaurants & Tips</title>
    <meta name="description" content="Read the latest food articles, restaurant reviews, and dining tips on Eagles Eye Eats Blog. Discover new eateries and cuisines in your city.">
    <meta name="keywords" content="Eagles Eye Eats, blog, food articles, restaurant reviews, dining tips, foodie guide">
    <link rel="canonical" href="">


    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <?php
        include_once '../connection.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/eagles_eye_eats/files/layout/header.php';
    ?>

    <main class="blog-page">
        <section class="hero-blog">
            <div class="container">
                <h1>Eagles Eye Eats Blog</h1>
                <p>Discover the latest restaurant reviews, food trends, and dining tips in your city.</p>
            </div>
        </section>

        <section class="blog-list container">
            <!-- Example Blog Card -->
            <article class="blog-card">
                <img src="<?php echo BASE_URL; ?>files/images/dha.PNG" alt="Best Street Food in Karachi">
                <div class="blog-content">
                    <h2><a href="blog-post.php?id=1">Top 10 Street Foods You Must Try in Karachi</a></h2>
                    <p>From spicy chaats to delicious fried treats, explore the street food culture of Karachi...</p>
                    <a href="blog-post.php?id=1" class="read-more">Read More →</a>
                </div>
            </article>

            <article class="blog-card">
                <img src="images/blog2.jpg" alt="Healthy Cafes in North Nazimabad">
                <div class="blog-content">
                    <h2><a href="blog-post.php?id=2">Healthy Cafes in North Nazimabad You’ll Love</a></h2>
                    <p>Looking for nutritious meals and cozy vibes? Check out these cafes serving healthy delights...</p>
                    <a href="blog-post.php?id=2" class="read-more">Read More →</a>
                </div>
            </article>

            <!-- More blog cards can be added dynamically here -->
        </section>
    </main>

    <?php
        include_once '../layout/footer.php';
    ?>
     <script src="../../index.js"></script>
</body>

</html>
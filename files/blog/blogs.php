<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/files/connection.php';

$blogPosts = [
    [
        'title' => 'Top Street Food in Karachi',
        'excerpt' => 'Explore the wide variety of food of Karachi from fast food to Chinese cuisine.',
        'image' => 'blog-1-top10sfoods.jpg',
        'url' => BASE_URL . 'files/blog/Top-Street-Food-in-Karachi',
    ],
    [
        'title' => "Best Pizza Chains & Street Food in Karachi",
        'excerpt' => 'Every major pizza chain compared on taste, value, and delivery — plus the 10 street foods that define this city.',
        'image' => 'best_pizza_chains_in_karachi_2026.webp',
        'url' => BASE_URL . 'files/blog/best-pizza-chains-karachi-compared',
    ],
    [
        'title' => 'Coffee Guide: Espresso, Latte, Cappuccino, Flat White & Mocha Explained',
        'excerpt' => 'Learn the differences between espresso, latte, cappuccino, flat white, and mocha. Discover ingredients, milk ratios, flavor profiles, and find the perfect coffee for your taste.',
        'image' => 'coffee-guide-espresso-latte-cappuccino.webp',
        'url' => BASE_URL . 'files/blog/coffee-guide-espresso-latte-cappuccino',
    ],
    [
        'title' => 'Best Family Restaurants in DHA, Karachi',
        'excerpt' => 'Kababjees, BBQ Tonight, Kolachi, Xanders Café, Charcoal, and Johnny & Jugnu compared for your next family outing in DHA.',
        'image' => 'Best-family-restaurants-dha.webp',
        'url' => BASE_URL . 'files/blog/Best-family-restaurants-dha',
    ],
    [
        'title' => 'Best Rooftop Restaurants in Karachi',
        'excerpt' => 'Kolachi, BBQ Tonight, Flamme, Roof Yard, Etcetera Café, and Avari Sky BBQ compared for the best views and food in the city.',
        'image' => 'Best-rooftop-restaurants-karachi.webp',
        'url' => BASE_URL . 'files/blog/Best-rooftop-restaurants-karachi',
    ],
    [
        'title' => 'Best Family Restaurants in Clifton, Karachi',
        'excerpt' => 'Kolachi, BBQ Tonight, Cafe Flo, Xanders Clifton, Café Aylanto, and Saltanat Restaurant compared for your next family outing in Clifton.',
        'image' => 'Best-family-restaurants-clifton.webp',
        'url' => BASE_URL . 'files/blog/Best-family-restaurants-clifton',
    ],
    [
        'title' => 'Best Restaurants in Karachi for Family Dinners',
        'excerpt' => 'Kolachi, BBQ Tonight, Cafe Aylanto, Saltanat, and Clock Tower compared for upscale places to bring the whole family.',
        'image' => 'Best-restaurants-karachi-family-dinners.webp',
        'url' => BASE_URL . 'files/blog/Best-Restaurants-in-Karachi-for-Family-Dinners',
    ],
    [
        'title' => 'Where to Take International Guests for Fine Dining in Karachi',
        'excerpt' => 'Cafe Aylanto, Okra, Kolachi, Cafe Flo, and Lotus Court compared for the best high-end spots to impress visitors.',
        'image' => 'Fine-dining-for-international-guests-karachi.webp',
        'url' => BASE_URL . 'files/blog/Fine-dining-for-international-guests-karachi',
    ],
    [
        'title' => 'Top BBQ Restaurants in Karachi',
        'excerpt' => 'BBQ Tonight, Shaikh Abdul Ghaffar Kabab House, Mehran Sajji House, and Red Apple Grill compared for the best grilled meat in the city.',
        'image' => 'Top-bbq-restaurants-karachi.webp',
        'url' => BASE_URL . 'files/blog/Top-bbq-restaurants-karachi',
    ],
    [
        'title' => 'Best Burger Places in Karachi',
        'excerpt' => 'No Lies Fries, Johnny & Jugnu, Howdy, Mr. Burger, and Burger O\'Clock compared for the city\'s best quality burgers.',
        'image' => 'Best-burger-places-karachi.webp',
        'url' => BASE_URL . 'files/blog/Best-burger-places-karachi',
    ],
    [
        'title' => 'Fine Dining Restaurants in DHA Karachi',
        'excerpt' => 'Okra, Cafe Aylanto, Xanders, Ala Rahi, and Sakura compared for the best upscale dining options in DHA.',
        'image' => 'Fine-dining-restaurants-dha-karachi.webp',
        'url' => BASE_URL . 'files/blog/Fine-dining-restaurants-dha-karachi',
    ],
];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Read Yaafta's guides to Karachi's food scene — street food, cafes, pizza chains, coffee culture, and neighbourhood dining tips." />
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="<?php echo BASE_URL; ?>files/blog/blogs">
    <title>Karachi Food Guides & Blog | Yaafta</title>
    <link rel="icon" href="../images/favicon.svg" type="image/svg+xml">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png">
    <link rel="icon" type="image/x-icon" href="../images/yaafta_favicon.ico">
    <link rel="manifest" href="../images/site.webmanifest">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css" />
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/files/layout/header.php'; ?>

<section class="restaurant-hero">
    <div class="container">
        <nav class="breadcrumb">
            <a href="<?php echo BASE_URL; ?>">Home</a>
            <span>›</span>
            <span>Blog</span>
        </nav>

        <div style="text-align:center; max-width:640px; margin:0 auto;">
            <h1 class="restaurant-title" style="font-size:2.2rem;">Yaafta <span style="color:#00f5d4">Blog</span></h1>
            <p class="restaurant-description" style="text-align:center;">
                Guides, comparisons, and neighbourhood picks from Karachi's food scene — written for people who actually eat here.
            </p>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="grid blog-grid">
            <?php foreach ($blogPosts as $post): ?>
            <article class="post">
                <a href="<?php echo htmlspecialchars($post['url']); ?>">
                    <div class="thumb">
                        <img loading="lazy" src="<?php echo BASE_URL; ?>files/images/<?php echo htmlspecialchars($post['image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
                    </div>
                </a>
                <div class="content">
                    <h3><a href="<?php echo htmlspecialchars($post['url']); ?>"><?php echo htmlspecialchars($post['title']); ?></a></h3>
                    <p><?php echo htmlspecialchars($post['excerpt']); ?></p>
                    <a class="read-more" href="<?php echo htmlspecialchars($post['url']); ?>">Read More →</a>
                </div>
            </article>
            <?php endforeach; ?>
        </div>

        <?php if (empty($blogPosts)): ?>
            <p class="review-empty">No blog posts yet — check back soon.</p>
        <?php endif; ?>
    </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/files/layout/footer.php'; ?>
<script src="<?php echo BASE_URL; ?>index.js"></script>
</body>
</html>
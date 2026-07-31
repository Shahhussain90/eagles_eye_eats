<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/files/connection.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Best pizza chains in Karachi compared — Broadway Pizza, Pizza Max, Domino's, and more. Plus the top 10 street foods every Karachiite loves." />
    <meta name="keywords" content="best pizza in Karachi, pizza chains Karachi, street food Karachi, bun kabab Karachi, Broadway Pizza, Pizza Max, Domino's Karachi, Karachi food guide 2026" />
    <meta name="author" content="Yaafta" />
    <meta name="robots" content="index, follow" />
     <link rel="icon" href="../images/favicon.svg" type="image/svg+xml">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png">
    <link rel="icon" type="image/x-icon" href="../images/yaafta_favicon.ico">
    <link rel="manifest" href="../images/site.webmanifest">
    <link rel="canonical" href="https://yaafta.com/files/blog/best-pizza-chains-karachi-compared">
    <meta property="og:type" content="article">
    <meta property="og:title" content="Best Pizza Chains & Street Food in Karachi (2026)">
    <meta property="og:description" content="Compare the best pizza chains in Karachi and discover the city's top street foods.">
    <meta property="og:image" content="https://yaafta.com/images/best_pizza_chains_in_karachi_2026.webp">
    <meta property="og:url" content="https://yaafta.com/files/blog/best-pizza-chains-karachi-compared">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Best Pizza Chains & Street Food in Karachi (2026)">
    <meta name="twitter:description" content="Compare Karachi's best pizza chains and discover iconic street foods.">
    <meta name="twitter:image" content="https://yaafta.com/images/best_pizza_chains_in_karachi_2026.webp">
    <title>Best Pizza Chains &amp; Street Food in Karachi (2026) | Yaafta</title>
    <link rel="stylesheet" href="../../css/style.css" />

    <script type="application/ld+json">
    {"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[{"@type":"ListItem","position":1,"name":"Home","item":"https://yaafta.com/"}, {
      "@type": "ListItem",
      "position": 2,
      "name": "Blog",
      "item": "https://yaafta.com/files/blog/blogs"
    },{"@type":"ListItem","position":3,"name":"Karachi Food Guide","item":"https://yaafta.com/files/blog/best-pizza-chains-karachi-compared"}]}
    </script>
    <script type="application/ld+json">
    {"@context":"https://schema.org","@type":"Article","headline":"Best Pizza Chains & Street Food in Karachi (2026)","description":"A complete comparison of Karachi's top pizza chains and a guide to the city's most popular street foods.","author":{"@type":"Organization","name":"Yaafta"},"publisher":{"@type":"Organization","name":"Yaafta"},"datePublished":"2026-01-01","dateModified":"2026-06-01","inLanguage":"en","url":"https://yaafta.com/files/blog/best-pizza-chains-karachi-compared"}
    </script>
    <script type="application/ld+json">
    {"@context":"https://schema.org","@type":"FAQPage","mainEntity":[{"@type":"Question","name":"Which pizza chain is best in Karachi?","acceptedAnswer":{"@type":"Answer","text":"Broadway Pizza is widely considered the top choice for generous portions, stuffed crust, and variety. For value, Pizza Max is hard to beat."}},{"@type":"Question","name":"Which pizza chain delivers fastest in Karachi?","acceptedAnswer":{"@type":"Answer","text":"Domino's Pizza is known for the fastest and most reliable delivery across Karachi."}},{"@type":"Question","name":"What is the most popular street food in Karachi?","acceptedAnswer":{"@type":"Answer","text":"Bun kabab is widely considered the defining street food of Karachi, followed by biryani, gol gappa, and chaat."}},{"@type":"Question","name":"Which pizza chain is cheapest in Karachi?","acceptedAnswer":{"@type":"Answer","text":"Pizza Max consistently offers the most affordable deals and family bundles."}},{"@type":"Question","name":"Which pizza chain has the best stuffed crust in Karachi?","acceptedAnswer":{"@type":"Answer","text":"Broadway Pizza is especially known for its stuffed crust varieties, widely regarded as the best in the city."}}]}
    </script>

    <style>
        /* ── Responsive table base ── */
        .blog-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
            margin: 16px 0;
        }
        .blog-table thead tr {
            background: var(--text);
            color: #fff;
        }
        .blog-table th {
            text-align: left;
            padding: 12px 14px;
            white-space: nowrap;
        }
        .blog-table td {
            padding: 11px 14px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }
        .blog-table tbody tr:nth-child(even) {
            background: var(--bg);
        }
        .blog-table .chain-name {
            font-weight: 700;
            white-space: nowrap;
        }

        /* ── Ratings table: scroll on tablet, cards on mobile ── */
        .table-scroll-wrap {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            margin: 16px 0;
        }
        .table-ratings {
            min-width: 560px;
        }

        /* ── Mobile: hide ratings table, show cards instead ── */
        .ratings-cards {
            display: none;
        }

        @media (max-width: 600px) {
            /* Hide the scroll table on small phones */
            .table-scroll-wrap.ratings-wrap {
                display: none;
            }

            /* Show stacked cards instead */
            .ratings-cards {
                display: flex;
                flex-direction: column;
                gap: 12px;
                margin: 16px 0;
            }
            .rating-card {
                background: var(--surface);
                border: 1px solid var(--border);
                border-radius: var(--radius);
                padding: 14px 16px;
                box-shadow: var(--shadow);
            }
            .rating-card-name {
                font-size: 1rem;
                font-weight: 800;
                color: var(--text);
                margin: 0 0 4px;
            }
            .rating-card-price {
                font-size: 0.82rem;
                color: var(--muted);
                margin: 0 0 10px;
            }
            .rating-card-stats {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 6px;
            }
            .rating-stat {
                font-size: 0.82rem;
            }
            .rating-stat span {
                display: block;
                font-size: 0.72rem;
                color: var(--muted);
                text-transform: uppercase;
                letter-spacing: 0.04em;
                margin-bottom: 1px;
            }

            /* Quick comparison table: allow scroll on mobile too */
            .table-scroll-wrap.compare-wrap {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            .table-compare {
                min-width: 420px;
                font-size: 0.82rem;
            }
            .blog-table th,
            .blog-table td {
                padding: 9px 10px;
            }
        }
    </style>
</head>

<script async src="https://www.googletagmanager.com/gtag/js?id=G-4R19BFTQEM"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-4R19BFTQEM');
</script>

<body>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/files/layout/header.php';
    ?>

    <!-- HERO -->
    <section class="restaurant-hero">
        <div class="container">
            <nav class="breadcrumb">
                <a href="<?php echo BASE_URL ?>">Home</a>
               <span>›</span>
            <a href="<?php echo BASE_URL ?>files/blog/blogs">Blog</a>
                <span>›</span>
                <span>Best Pizza Chains &amp; Street Food in Karachi</span>
            </nav>
            <div class="restaurant-hero-grid">
                <div class="restaurant-info">
                    <h1 class="restaurant-title">
                        Best Pizza Chains &amp; Street Food in Karachi (2026)
                    </h1>
                    <div class="restaurant-meta">
                        <span>📍 Karachi Food Guide</span>
                        <span>🍕 Pizza + Street Food</span>
                        <span>📅 Updated 2026</span>
                    </div>
                    <p class="restaurant-description">
                        From cheesy stuffed crusts to sizzling bun kababs, Karachi is a food lover's dream.
                        This guide compares every major pizza chain and covers the top 10 street foods
                        you absolutely must try — so you always know where to eat next.
                    </p>
                </div>
                <div class="restaurant-image">
                    <img src="../images/best_pizza_chains_in_karachi_2026.webp" alt="Best pizza chains and street food in Karachi 2026" />
                </div>
            </div>
        </div>
    </section>

    <!-- CONTENT -->
    <section class="section">
        <div class="container restaurant-details">
            <div class="details-grid">
                <div class="details-main">

                    <h2>Best Pizza Chains in Karachi Compared</h2>
                    <p>
                        If you're searching for the <strong>best pizza in Karachi</strong>, you're spoiled for choice. From cheesy stuffed
                        crusts to giant New York-style slices and loaded toppings, Karachi is home to some of Pakistan's most
                        popular pizza chains. Here's how they all stack up on taste, price, and overall value.
                    </p>

                    <!-- ── RATINGS TABLE (desktop/tablet) ── -->
                    <h3>Price &amp; Ratings Comparison</h3>
                    <p>Ratings are based on overall customer experience, value for money, taste, and delivery across Karachi.</p>

                    <div class="table-scroll-wrap ratings-wrap">
                        <table class="blog-table table-ratings">
                            <thead>
                                <tr>
                                    <th>Pizza Chain</th>
                                    <th>Price Range (PKR)</th>
                                    <th>Overall</th>
                                    <th>Taste</th>
                                    <th>Value</th>
                                    <th>Delivery</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="chain-name">Broadway Pizza</td>
                                    <td>900 – 2,800</td>
                                    <td>⭐ 4.5</td><td>⭐ 4.6</td><td>⭐ 4.0</td><td>⭐ 3.8</td>
                                </tr>
                                <tr>
                                    <td class="chain-name">Pizza Max</td>
                                    <td>500 – 1,800</td>
                                    <td>⭐ 4.2</td><td>⭐ 4.1</td><td>⭐ 4.8</td><td>⭐ 4.0</td>
                                </tr>
                                <tr>
                                    <td class="chain-name">California Pizza</td>
                                    <td>600 – 2,000</td>
                                    <td>⭐ 4.1</td><td>⭐ 4.3</td><td>⭐ 4.2</td><td>⭐ 3.7</td>
                                </tr>
                                <tr>
                                    <td class="chain-name">Pizza Hut</td>
                                    <td>900 – 3,000</td>
                                    <td>⭐ 4.3</td><td>⭐ 4.4</td><td>⭐ 3.8</td><td>⭐ 4.1</td>
                                </tr>
                                <tr>
                                    <td class="chain-name">Domino's Pizza</td>
                                    <td>800 – 2,500</td>
                                    <td>⭐ 4.2</td><td>⭐ 4.0</td><td>⭐ 3.9</td><td>⭐ 4.7</td>
                                </tr>
                                <tr>
                                    <td class="chain-name">14th Street Pizza</td>
                                    <td>1,200 – 3,500</td>
                                    <td>⭐ 4.4</td><td>⭐ 4.5</td><td>⭐ 3.6</td><td>⭐ 3.9</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- ── RATINGS CARDS (mobile only, shown via CSS) ── -->
                    <div class="ratings-cards">

                        <div class="rating-card">
                            <p class="rating-card-name">Broadway Pizza</p>
                            <p class="rating-card-price">PKR 900 – 2,800</p>
                            <div class="rating-card-stats">
                                <div class="rating-stat"><span>Overall</span>⭐ 4.5 / 5</div>
                                <div class="rating-stat"><span>Taste</span>⭐ 4.6</div>
                                <div class="rating-stat"><span>Value</span>⭐ 4.0</div>
                                <div class="rating-stat"><span>Delivery</span>⭐ 3.8</div>
                            </div>
                        </div>

                        <div class="rating-card">
                            <p class="rating-card-name">Pizza Max</p>
                            <p class="rating-card-price">PKR 500 – 1,800</p>
                            <div class="rating-card-stats">
                                <div class="rating-stat"><span>Overall</span>⭐ 4.2 / 5</div>
                                <div class="rating-stat"><span>Taste</span>⭐ 4.1</div>
                                <div class="rating-stat"><span>Value</span>⭐ 4.8</div>
                                <div class="rating-stat"><span>Delivery</span>⭐ 4.0</div>
                            </div>
                        </div>

                        <div class="rating-card">
                            <p class="rating-card-name">California Pizza</p>
                            <p class="rating-card-price">PKR 600 – 2,000</p>
                            <div class="rating-card-stats">
                                <div class="rating-stat"><span>Overall</span>⭐ 4.1 / 5</div>
                                <div class="rating-stat"><span>Taste</span>⭐ 4.3</div>
                                <div class="rating-stat"><span>Value</span>⭐ 4.2</div>
                                <div class="rating-stat"><span>Delivery</span>⭐ 3.7</div>
                            </div>
                        </div>

                        <div class="rating-card">
                            <p class="rating-card-name">Pizza Hut</p>
                            <p class="rating-card-price">PKR 900 – 3,000</p>
                            <div class="rating-card-stats">
                                <div class="rating-stat"><span>Overall</span>⭐ 4.3 / 5</div>
                                <div class="rating-stat"><span>Taste</span>⭐ 4.4</div>
                                <div class="rating-stat"><span>Value</span>⭐ 3.8</div>
                                <div class="rating-stat"><span>Delivery</span>⭐ 4.1</div>
                            </div>
                        </div>

                        <div class="rating-card">
                            <p class="rating-card-name">Domino's Pizza</p>
                            <p class="rating-card-price">PKR 800 – 2,500</p>
                            <div class="rating-card-stats">
                                <div class="rating-stat"><span>Overall</span>⭐ 4.2 / 5</div>
                                <div class="rating-stat"><span>Taste</span>⭐ 4.0</div>
                                <div class="rating-stat"><span>Value</span>⭐ 3.9</div>
                                <div class="rating-stat"><span>Delivery</span>⭐ 4.7</div>
                            </div>
                        </div>

                        <div class="rating-card">
                            <p class="rating-card-name">14th Street Pizza</p>
                            <p class="rating-card-price">PKR 1,200 – 3,500</p>
                            <div class="rating-card-stats">
                                <div class="rating-stat"><span>Overall</span>⭐ 4.4 / 5</div>
                                <div class="rating-stat"><span>Taste</span>⭐ 4.5</div>
                                <div class="rating-stat"><span>Value</span>⭐ 3.6</div>
                                <div class="rating-stat"><span>Delivery</span>⭐ 3.9</div>
                            </div>
                        </div>

                    </div>

                    <!-- ── QUICK COMPARISON TABLE ── -->
                    <h3>Quick Comparison</h3>
                    <div class="table-scroll-wrap compare-wrap">
                        <table class="blog-table table-compare">
                            <thead>
                                <tr>
                                    <th>Pizza Chain</th>
                                    <th>Best For</th>
                                    <th>Price</th>
                                    <th>Signature Style</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="chain-name">Broadway Pizza</td>
                                    <td>Families &amp; Giant Pizzas</td>
                                    <td>$$$</td>
                                    <td>Huge slices, stuffed crust</td>
                                </tr>
                                <tr>
                                    <td class="chain-name">Pizza Max</td>
                                    <td>Value Deals</td>
                                    <td>$$</td>
                                    <td>Thick crust, loaded toppings</td>
                                </tr>
                                <tr>
                                    <td class="chain-name">California Pizza</td>
                                    <td>Cheese Lovers</td>
                                    <td>$$</td>
                                    <td>Rich cheese and sauces</td>
                                </tr>
                                <tr>
                                    <td class="chain-name">Pizza Hut</td>
                                    <td>Classic Pan Pizza</td>
                                    <td>$$$</td>
                                    <td>Pan pizza, international recipes</td>
                                </tr>
                                <tr>
                                    <td class="chain-name">Domino's Pizza</td>
                                    <td>Fast Delivery</td>
                                    <td>$$$</td>
                                    <td>Thin crust, consistent quality</td>
                                </tr>
                                <tr>
                                    <td class="chain-name">14th Street Pizza</td>
                                    <td>New York Style</td>
                                    <td>$$$</td>
                                    <td>Large slices, premium toppings</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h3>1. Broadway Pizza</h3>
                    <p>
                        Broadway Pizza has become one of Karachi's most recognizable pizza chains thanks to its massive pizza
                        sizes, generous toppings, and stuffed crust options. Huge pizzas ideal for sharing, an excellent stuffed
                        crust, and wide variety of flavours make it the top overall pick — though premium pricing and slower
                        weekend delivery are worth keeping in mind.
                    </p>
                    <p>
                        <strong>Price Range:</strong> PKR 900 – 2,800 &nbsp;|&nbsp;
                        <strong>Overall Rating:</strong> ⭐ 4.5 / 5 &nbsp;|&nbsp;
                        <strong>Best For:</strong> Large family gatherings and pizza parties.
                    </p>

                    <h3>2. Pizza Max</h3>
                    <p>
                        Pizza Max is known for offering some of the best value-for-money deals in Karachi. It strikes a balance
                        between price and quality, making it a popular everyday choice. Affordable combo deals and wide menu
                        selection are its biggest strengths, though crust quality can vary by branch.
                    </p>
                    <p>
                        <strong>Price Range:</strong> PKR 500 – 1,800 &nbsp;|&nbsp;
                        <strong>Overall Rating:</strong> ⭐ 4.2 / 5 &nbsp;|&nbsp;
                        <strong>Best For:</strong> Budget-conscious customers.
                    </p>

                    <h3>3. California Pizza</h3>
                    <p>
                        California Pizza focuses on rich flavors, creamy sauces, and generous cheese, making it a favourite
                        among cheese lovers. Excellent cheese quality and flavourful specialty pizzas are what set it apart,
                        though its menu is smaller and branch availability more limited than competitors.
                    </p>
                    <p>
                        <strong>Price Range:</strong> PKR 600 – 2,000 &nbsp;|&nbsp;
                        <strong>Overall Rating:</strong> ⭐ 4.1 / 5 &nbsp;|&nbsp;
                        <strong>Best For:</strong> Cheese lovers and casual dinners.
                    </p>

                    <h3>4. Pizza Hut</h3>
                    <p>
                        Pizza Hut remains one of the world's most recognizable pizza brands and continues to attract customers
                        with its signature pan pizzas and family meals. Consistent quality and a reliable dine-in experience
                        are its strongest points, with higher prices being the main trade-off.
                    </p>
                    <p>
                        <strong>Price Range:</strong> PKR 900 – 3,000 &nbsp;|&nbsp;
                        <strong>Overall Rating:</strong> ⭐ 4.3 / 5 &nbsp;|&nbsp;
                        <strong>Best For:</strong> Traditional pizza lovers.
                    </p>

                    <h3>5. Domino's Pizza</h3>
                    <p>
                        Domino's is well known for quick delivery and a straightforward menu focused on consistency. Fast
                        delivery and a good online ordering experience make it the go-to when you need pizza quickly, though
                        portions can feel smaller for the price.
                    </p>
                    <p>
                        <strong>Price Range:</strong> PKR 800 – 2,500 &nbsp;|&nbsp;
                        <strong>Overall Rating:</strong> ⭐ 4.2 / 5 &nbsp;|&nbsp;
                        <strong>Best For:</strong> Quick delivery and simple pizza cravings.
                    </p>

                    <h3>6. 14th Street Pizza</h3>
                    <p>
                        14th Street Pizza specializes in oversized New York-style pizzas with premium ingredients. Giant slices,
                        premium toppings, and excellent specialty pizzas make it the best premium option in the city — just
                        expect to pay for it, as discounts here are rare.
                    </p>
                    <p>
                        <strong>Price Range:</strong> PKR 1,200 – 3,500 &nbsp;|&nbsp;
                        <strong>Overall Rating:</strong> ⭐ 4.4 / 5 &nbsp;|&nbsp;
                        <strong>Best For:</strong> Premium pizza experiences.
                    </p>

                    <h2>Which Pizza Chain Offers the Best Value?</h2>
                    <p>
                        If you're looking for the most pizza for your money, <strong>Pizza Max</strong> offers excellent value with its
                        regular deals and affordable pricing starting from PKR 500. For premium quality and larger portions,
                        <strong>Broadway Pizza</strong> and <strong>14th Street Pizza</strong> stand out — though you'll pay PKR 2,800–3,500 for
                        the larger sizes.
                    </p>

                    <h2>Which Pizza Chain Has the Best Cheese?</h2>
                    <p>
                        For rich, cheesy pizzas, California Pizza leads the pack with a taste rating of 4.3, followed by
                        Broadway Pizza (4.6 overall) and Pizza Hut. California Pizza's creamy sauces and cheese quality
                        consistently outperform its competitors in this category.
                    </p>

                    <h2>Which Pizza Chain Delivers the Fastest?</h2>
                    <p>
                        <strong>Domino's Pizza</strong> tops the delivery rating at 4.7 / 5, well ahead of the competition. Pizza Hut
                        (4.1) and Pizza Max (4.0) follow. Broadway Pizza and California Pizza tend to be slower,
                        especially during weekends and peak hours.
                    </p>

                    <h2>Best Pizza Chain by Category</h2>
                    <ul>
                        <li><strong>Best Overall:</strong> Broadway Pizza (4.5 / 5)</li>
                        <li><strong>Best Budget Option:</strong> Pizza Max — from PKR 500</li>
                        <li><strong>Best Cheese:</strong> California Pizza (taste: 4.3)</li>
                        <li><strong>Best Pan Pizza:</strong> Pizza Hut</li>
                        <li><strong>Fastest Delivery:</strong> Domino's Pizza (delivery: 4.7)</li>
                        <li><strong>Best Premium Pizza:</strong> 14th Street Pizza — from PKR 1,200</li>
                    </ul>

                    <h2>Frequently Asked Questions</h2>
                    <div class="faq-wrapper">
                        <details class="faq-item">
                            <summary>Which pizza chain is the best in Karachi?</summary>
                            <p>Broadway Pizza is widely considered one of the top choices for its generous portions, stuffed crust options, and variety. It holds an overall rating of 4.5 / 5.</p>
                        </details>
                        <details class="faq-item">
                            <summary>Which pizza chain is the cheapest?</summary>
                            <p>Pizza Max generally offers the most affordable deals and family bundles, with prices starting from PKR 500.</p>
                        </details>
                        <details class="faq-item">
                            <summary>Which pizza chain has the best stuffed crust?</summary>
                            <p>Broadway Pizza is especially popular for its stuffed crust varieties.</p>
                        </details>
                        <details class="faq-item">
                            <summary>Which pizza chain is best for delivery?</summary>
                            <p>Domino's Pizza is known for fast and reliable delivery across Karachi, with a delivery rating of 4.7 / 5.</p>
                        </details>
                        <details class="faq-item">
                            <summary>Which pizza chain offers the best value for families?</summary>
                            <p>Broadway Pizza and Pizza Max both provide family-sized pizzas and combo deals that offer strong value for groups. Pizza Max is the more affordable option starting from PKR 500.</p>
                        </details>
                        <details class="faq-item">
                            <summary>What is the most popular street food in Karachi?</summary>
                            <p>Bun kabab is widely considered the defining street food of Karachi, followed by biryani, gol gappa, and chaat.</p>
                        </details>
                    </div>

                    <h2>Final Thoughts</h2>
                    <p>
                        Choosing the best pizza in Karachi depends on what matters most to you. If you're feeding a large group,
                        Broadway Pizza (rated 4.5 / 5) is hard to beat. For affordable everyday meals starting from PKR 500,
                        Pizza Max offers the best value rating at 4.8. Cheese lovers should consider California Pizza, while
                        Pizza Hut delivers classic pan pizzas consistently. Domino's remains the top pick for fast delivery,
                        and 14th Street Pizza is ideal for a premium New York-style experience.
                    </p>
                    <p>
                        For more guides like this, keep exploring our <strong>Karachi food blog</strong> and discover the best places to eat
                        across the city.
                    </p>

                </div>
            </div>

           <?php
   
    include $_SERVER['DOCUMENT_ROOT'] . '/files/layout/categories-list.php';
  ?>
        </div>
    </section>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/files/layout/footer.php'; ?>
    <script src="../../index.js"></script>
</body>
</html>
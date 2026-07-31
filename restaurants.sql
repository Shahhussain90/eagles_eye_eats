-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 30, 2026 at 08:23 PM
-- Server version: 11.8.8-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u722300345_eagles_eye_eat`
--

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

CREATE TABLE `newsletter_subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newsletter_subscribers`
--

INSERT INTO `newsletter_subscribers` (`id`, `email`, `created_at`) VALUES
(1, 'shahhussain123.rizvi@gmail.com', '2026-06-21 15:51:03'),
(2, 'abc@gmail.com', '2026-06-21 15:53:14'),
(3, 'aa@gmail.com', '2026-06-21 15:54:29'),
(4, 'alimehdi395@hotmail.com', '2026-06-21 15:54:56'),
(5, 'faf@gmail.com', '2026-06-21 15:57:52'),
(6, 'ss@gmail.com', '2026-06-21 16:00:57'),
(7, 'ff@gmail.com', '2026-06-21 16:01:53'),
(8, 'ffa@gmail.com', '2026-06-21 16:07:31'),
(9, 'asdasd@gmail.com', '2026-06-21 17:06:33'),
(10, 'blaze.ai369@gmail.com', '2026-06-23 12:54:05'),
(11, 'hamza.rizwan200613@gmail.com', '2026-06-23 13:08:01');

-- --------------------------------------------------------

--
-- Table structure for table `rate_limit_log`
--

CREATE TABLE `rate_limit_log` (
  `id` int(11) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `page_url` varchar(500) DEFAULT NULL,
  `cuisine` varchar(255) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `image_url` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `slug`, `name`, `created_at`, `page_url`, `cuisine`, `area`, `image_url`) VALUES
(1, 'northnazimabad-nando', 'Nando\'s - North Nazimabad', '2026-07-15 15:33:49', 'https://yaafta.com/files/northnazimabad/Nando', 'Grilled Chicken / Healthy Dining', 'North Nazimabad', NULL),
(2, 'Clifton-Aylanto', 'aylanto - Clifton', '2026-07-17 12:58:41', 'https://yaafta.com/files/clifton/Aylanto', 'Mediterranean / Italian / Continental focus', 'Clifton', NULL),
(3, 'Bahadurabad-HotpotMinistry', 'hotpotministry - Bahadurabad', '2026-07-17 13:14:58', 'https://yaafta.com/files/bahadurabad/HotpotMinistry', 'hotpot / Chinese / Thai-style dining', 'Bahadurabad', NULL),
(4, 'northnazimabad-burgerlab', 'BurgerLab - North Nazimabad', '2026-07-17 18:29:10', 'https://yaafta.com/files/northnazimabad/burgerlab', 'Fast Food / Gourmet Burgers', 'North Nazimabad', NULL),
(5, 'Dha-kolachi', 'Kolachi - Dha', '2026-07-17 23:34:06', 'https://yaafta.com/files/dha/kolachi', 'Pakistani, BBQ, Seafood, Continental, Fast Food', 'Dha', NULL),
(6, 'Dha-okra', 'Okra - Dha', '2026-07-17 23:36:00', 'https://yaafta.com/files/dha/Okra', 'Mediterranean / European', 'Dha', NULL),
(7, 'Clifton-Cafeflo', 'cafeflo - Clifton', '2026-07-18 00:13:57', 'https://yaafta.com/files/clifton/Cafeflo', 'French / Continental', 'Clifton', NULL),
(8, 'Dha-xanders', 'Xanders - Dha', '2026-07-18 11:10:59', 'https://yaafta.com/files/dha/xanders', 'Modern Café / Casual Dining', 'Dha', NULL),
(9, 'Dha-chefstablepakistan', 'Chefstablepakistan - Dha', '2026-07-18 11:11:03', 'https://yaafta.com/files/dha/Chefstablepakistan', 'Modern Pakistani', 'Dha', NULL),
(10, 'Clifton-xanders', 'xanders - Clifton', '2026-07-18 11:11:23', 'https://yaafta.com/files/clifton/xanders', 'Café / Continental / All-Day Dining', 'Clifton', NULL),
(11, 'Clifton-Bar-bq-tonight-clifton', 'bar-bq-tonight-clifton - Clifton', '2026-07-18 11:11:25', 'https://yaafta.com/files/clifton/Bar-bq-tonight-clifton', 'BBQ', 'Clifton', NULL),
(12, 'Clifton-Terraza', 'terraza - Clifton', '2026-07-18 11:11:28', 'https://yaafta.com/files/clifton/terraza', 'Continental & Mediterranean', 'Clifton', NULL),
(13, 'Clifton-Sakura', 'sakura - Clifton', '2026-07-18 11:11:32', 'https://yaafta.com/files/clifton/Sakura', 'Japanese / Sushi / Teppanyaki', 'Clifton', NULL),
(14, 'northnazimabad-gulshinwari', 'gulshinwari - North Nazimabad', '2026-07-18 11:11:38', 'https://yaafta.com/files/northnazimabad/gulshinwari', 'Desi', 'North Nazimabad', NULL),
(15, 'northnazimabad-ginsoy', 'Ginsoy - North Nazimabad', '2026-07-18 11:11:41', 'https://yaafta.com/files/northnazimabad/ginsoy', 'Chinese', 'North Nazimabad', NULL),
(16, 'Bahadurabad-PekingChinese', 'pekingchinese - Bahadurabad', '2026-07-18 11:12:20', 'https://yaafta.com/files/bahadurabad/PekingChinese', 'Chinese', 'Bahadurabad', NULL),
(17, 'Bahadurabad-Ohmygrill', 'ohmygrill - Bahadurabad', '2026-07-18 11:12:22', 'https://yaafta.com/files/bahadurabad/Ohmygrill', 'Gourmet Burger', 'Bahadurabad', NULL),
(18, 'Bahadurabad-MandiHouse', 'mandihouse - Bahadurabad', '2026-07-18 11:12:25', 'https://yaafta.com/files/bahadurabad/mandihouse', 'Arabic', 'Bahadurabad', NULL),
(19, 'Bahadurabad-Mizaaj', 'mizaaj - Bahadurabad', '2026-07-18 11:12:28', 'https://yaafta.com/files/bahadurabad/Mizaaj', 'Pakistani Fine Dining', 'Bahadurabad', NULL),
(20, 'Korangi-bosscafe', 'BossCafe - Korangi', '2026-07-18 11:13:05', 'https://yaafta.com/files/korangi/boss-cafe', 'BBQ, handi, Chinese, steaks, burgers, and desserts', 'Korangi', NULL),
(21, 'Korangi-factorycafe', 'FactoryCafe - Korangi', '2026-07-18 11:13:07', 'https://yaafta.com/files/korangi/Factorycafe', 'Parmesan Chicken, Turkish Kabab, sandwiches', 'Korangi', NULL),
(22, 'korangi-cafeabaseen', 'Cafe Abaseen - Korangi Creek', '2026-07-25 02:48:33', 'https://yaafta.com/files/korangi/CafeAbaseen.php', 'Desi', 'Korangi Creek', NULL),
(23, 'korangi-zeenat', 'Zeenat Restaurant - Korangi', '2026-07-25 02:59:56', 'https://yaafta.com/files/korangi/Zeenat', 'Pakistani / Desi food', 'Korangi', NULL),
(24, 'korangi-meerjee', 'Meer Jee Restaurant - Korangi Creek', '2026-07-25 03:17:37', 'https://yaafta.com/files/korangi/Meerjee-Restaurant', 'Pakistani / Desi food', 'Korangi', NULL),
(25, 'dhaphase6-routine', 'Routine - Specialty Coffee & Dining - DHA Phase 6', '2026-07-25 05:57:51', 'https://yaafta.com/files/dha/Routine-Cafe', 'Coffee Shop', 'DHA Phase 6', NULL),
(26, 'dha-routinecafe', 'Routine - Specialty Coffee & Dining - DHa', '2026-07-25 06:14:53', 'https://yaafta.com/files/dha/Routine-Cafe', 'Coffee Shop', 'Dha', NULL),
(27, 'clifton-apollocoffee', 'Apollo Coffee - Clifton', '2026-07-25 06:22:01', 'https://yaafta.com/files/clifton/Apollo-cafe-clifton', 'Coffee Shop', 'Clifton', NULL),
(28, 'kdascheme1-1885coffee', '1885 Coffee - KDA Scheme 1', '2026-07-25 06:49:56', 'https://yaafta.com/files/categories/1885-Coffee', 'Coffee Shop', 'KDA Scheme 1', NULL),
(29, 'dha-flamme', 'Flamme - DHA', '2026-07-26 14:32:29', 'https://yaafta.com/files/dha/Flamme', 'Rooftop Cafe / Continental & International', 'DHA', NULL),
(30, 'Dha-clocktower', 'Clock Tower – Dha', '2026-07-26 14:50:38', 'https://yaafta.com/files/dha/Clocktower', 'Buffet / Pakistani, BBQ, Chinese & Continental', 'Dha', NULL),
(31, 'dhaphase8-altituderooftop', 'The Altitude Rooftop Lounge', '2026-07-26 14:58:32', 'https://yaafta.com/files/dha/Altitude', 'Rooftop Cafe / Burgers, Steaks & Continental', 'DHA Phase 8', NULL),
(32, 'Dha-altituderooftop', 'The Altitude Rooftop Lounge - Dha', '2026-07-26 15:03:55', 'https://yaafta.com/files/dha/Altitude', 'Rooftop Cafe / Burgers, Steaks & Continental', 'Dha', NULL),
(33, 'Kda-1885coffee', '1885 Coffee - Kda', '2026-07-26 15:11:33', 'https://yaafta.com/files/categories/1885-Coffee', 'Coffee Shop', 'Kda', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `recommend_pct` tinyint(4) NOT NULL,
  `body` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `restaurant_id`, `rating`, `recommend_pct`, `body`, `created_at`) VALUES
(7, 1, 2, 4, 73, 'nice place', '2026-07-17 11:07:24'),
(8, 3, 1, 5, 95, 'Went here with family on a Sunday evening, peri peri chicken was perfectly grilled. A bit pricey but worth it.', '2026-07-18 11:26:31'),
(9, 3, 4, 4, 80, 'Solid burger, patty was juicy. Service was a little slow during rush hour though.', '2026-07-18 11:26:31'),
(10, 3, 11, 5, 100, 'Best BBQ spot in Clifton hands down. The seekh kebabs are incredible.', '2026-07-18 11:26:31'),
(11, 4, 1, 4, 85, 'Good food but the wait time on a Friday night was almost 40 minutes. Worth it though.', '2026-07-18 11:26:31'),
(12, 4, 5, 5, 100, 'Kolachi never disappoints. The view alone is worth the visit, food is excellent too.', '2026-07-18 11:26:31'),
(13, 4, 12, 4, 75, 'Nice ambiance, ideal for a date night. Portions could be slightly bigger for the price.', '2026-07-18 11:26:31'),
(14, 5, 4, 5, 90, 'BurgerLab is criminally underrated. Best smash burger in North Nazimabad.', '2026-07-18 11:26:31'),
(15, 5, 15, 3, 55, 'Food was okay, nothing special. Service needs improvement.', '2026-07-18 11:26:31'),
(16, 5, 20, 4, 80, 'Great variety on the menu, the handi was flavorful.', '2026-07-16 11:26:31'),
(17, 6, 2, 4, 78, 'Nice continental spot, good for a quiet lunch. Bit expensive for what you get.', '2026-07-18 11:26:31'),
(18, 6, 8, 5, 95, 'Xander\'s DHA has become my go-to weekend brunch spot. Highly recommend the eggs benedict.', '2026-07-18 11:26:31'),
(19, 6, 9, 5, 92, 'The tasting menu at Chefs Table was an experience. Every course was thoughtfully done.', '2026-07-18 11:26:31'),
(20, 7, 3, 4, 82, 'Hotpot Ministry is great for groups, broth options are solid. Gets crowded fast so book ahead.', '2026-07-18 11:26:31'),
(21, 7, 16, 3, 60, 'Decent Chinese food, portions were smaller than expected for the price.', '2026-07-18 11:26:31'),
(22, 7, 19, 5, 96, 'Mizaaj is fantastic for a proper sit-down Pakistani meal. Staff were very attentive.', '2026-07-18 11:26:31'),
(23, 8, 5, 4, 85, 'Kolachi is a classic for a reason, the seafood platter was fresh and well seasoned.', '2026-07-18 11:26:31'),
(24, 8, 6, 4, 80, 'Okra has a lovely rooftop setup, food matched the vibe. Good for special occasions.', '2026-07-12 11:26:31'),
(25, 8, 13, 5, 90, 'Sakura sushi is genuinely good, rare to find quality Japanese food in Karachi.', '2026-07-18 11:26:31'),
(26, 9, 14, 3, 65, 'Gul Shinwari is decent for a quick karahi fix, nothing fancy but gets the job done.', '2026-07-18 11:26:31'),
(27, 9, 17, 4, 78, 'Oh My Grill has great burgers for the price point, good option for casual outings.', '2026-07-18 11:26:31'),
(28, 9, 21, 5, 94, 'Factory Cafe surprised me, the Turkish kabab wrap was excellent.', '2026-07-18 11:26:31'),
(29, 10, 7, 4, 82, 'Café Flo is a solid French-inspired spot, the desserts especially stood out.', '2026-07-18 11:26:31'),
(30, 10, 10, 3, 58, 'Xander\'s Clifton was okay, service felt rushed on a busy evening.', '2026-07-18 11:26:31'),
(31, 10, 18, 4, 76, 'Mandi House had generous portions, the mandi rice was well spiced.', '2026-07-18 11:26:31'),
(32, 11, 1, 3, 60, 'Nandos was fine but honestly overpriced compared to other grilled chicken spots nearby.', '2026-07-18 11:26:31'),
(33, 11, 11, 4, 84, 'BBQ Tonight Clifton branch is consistent, always a safe choice for BBQ cravings.', '2026-07-18 11:26:31'),
(34, 11, 20, 5, 98, 'Boss Cafe Korangi has one of the best steaks Ive had in the city, genuinely surprised.', '2026-07-18 11:26:31'),
(35, 12, 2, 5, 97, 'Aylanto is one of the finest dining experiences in Clifton, ambiance and food both top tier.', '2026-07-18 11:26:31'),
(36, 12, 9, 4, 80, 'Chefs Table Pakistan was pricey but the tasting portions justified it for a special night.', '2026-07-18 11:26:31'),
(37, 12, 4, 4, 88, 'BurgerLab North Nazimabad branch has quick service and consistently good burgers.', '2026-07-18 11:26:31'),
(219, 15, 1, 5, 92, 'Nando\'s never lets me down, the peri peri sauce is perfectly balanced every visit.', '2026-07-26 01:10:41'),
(220, 15, 3, 4, 80, 'Hotpot Ministry has solid broth options, great for a rainy evening.', '2026-07-26 01:10:41'),
(221, 15, 9, 5, 90, 'Chefs Table tasting menu was worth every rupee, loved the presentation.', '2026-07-26 01:10:41'),
(222, 15, 14, 3, 62, 'Gul Shinwari is fine for a quick karahi but nothing memorable.', '2026-07-26 01:10:41'),
(223, 15, 22, 4, 78, 'Cafe Abaseen had a cozy vibe, good desi breakfast spot.', '2026-07-26 01:10:41'),
(224, 16, 2, 5, 95, 'Aylanto is easily one of the best Mediterranean spots in Clifton.', '2026-07-26 01:10:41'),
(225, 16, 6, 4, 82, 'Okra rooftop is gorgeous at sunset, food was solid too.', '2026-07-26 01:10:41'),
(226, 16, 11, 5, 96, 'BBQ Tonight never disappoints, the mutton seekh is unbeatable.', '2026-07-26 01:10:41'),
(227, 16, 15, 3, 58, 'Ginsoy is okay but a bit overpriced for the portion sizes.', '2026-07-26 01:10:41'),
(228, 16, 23, 4, 75, 'Zeenat has that classic desi comfort food feel, very homely.', '2026-07-26 01:10:41'),
(229, 17, 4, 4, 84, 'BurgerLab smash burgers hit different, fries are crispy every time.', '2026-07-26 01:10:41'),
(230, 17, 8, 5, 93, 'Xander\'s DHA brunch is my weekend go-to now, love the ambiance.', '2026-07-26 01:10:41'),
(231, 17, 12, 4, 79, 'Terraza is great for a date night, quiet and well-lit.', '2026-07-26 01:10:41'),
(232, 17, 17, 3, 60, 'Oh My Grill is decent but service was slow on a weekday visit.', '2026-07-26 01:10:41'),
(233, 17, 24, 5, 91, 'Meer Jee has incredible nihari, best in Korangi Creek hands down.', '2026-07-26 01:10:41'),
(234, 18, 5, 5, 97, 'Kolachi is a Karachi classic for a reason, the view and food both deliver.', '2026-07-26 01:10:41'),
(235, 18, 7, 4, 81, 'Café Flo desserts are outstanding, especially the tiramisu.', '2026-07-26 01:10:41'),
(236, 18, 13, 5, 89, 'Sakura sushi quality genuinely surprised me, very fresh.', '2026-07-26 01:10:41'),
(237, 18, 16, 3, 55, 'Peking Chinese was average, wouldn\'t go out of my way again.', '2026-07-26 01:10:41'),
(238, 18, 25, 4, 83, 'Routine Cafe has excellent specialty coffee, great for working.', '2026-07-26 01:10:41'),
(239, 19, 1, 4, 85, 'Solid grilled chicken, slightly pricey but consistent quality.', '2026-07-26 01:10:41'),
(240, 19, 10, 3, 60, 'Xander\'s Clifton felt a bit rushed during peak hours.', '2026-07-26 01:10:41'),
(241, 19, 18, 4, 77, 'Mandi House portions are huge, great value for groups.', '2026-07-26 01:10:41'),
(242, 19, 20, 5, 94, 'Boss Cafe steaks are shockingly good for the price point.', '2026-07-26 01:10:41'),
(243, 19, 21, 4, 80, 'Factory Cafe Turkish kabab wrap was a pleasant surprise.', '2026-07-26 01:10:41'),
(244, 20, 2, 4, 86, 'Aylanto has lovely ambiance, perfect for special occasions.', '2026-07-26 01:10:41'),
(245, 20, 9, 4, 82, 'Chefs Table is pricey but the experience justifies it.', '2026-07-26 01:10:41'),
(246, 20, 19, 5, 95, 'Mizaaj Arabic food is authentic, the mezze platter is a must.', '2026-07-26 01:10:41'),
(247, 20, 22, 3, 64, 'Cafe Abaseen was decent, service could be quicker.', '2026-07-26 01:10:41'),
(248, 20, 3, 4, 78, 'Hotpot Ministry gets crowded but worth the wait.', '2026-07-26 01:10:41'),
(249, 21, 4, 5, 90, 'BurgerLab is consistently one of the best burger spots in the city.', '2026-07-26 01:10:41'),
(250, 21, 6, 3, 61, 'Okra was okay, expected a bit more for the price.', '2026-07-26 01:10:41'),
(251, 21, 11, 5, 98, 'BBQ Tonight Clifton branch is always packed for a good reason.', '2026-07-26 01:10:41'),
(252, 21, 14, 4, 76, 'Gul Shinwari karahi was flavorful, quick service too.', '2026-07-26 01:10:41'),
(253, 21, 24, 4, 84, 'Meer Jee is a hidden gem, authentic Pakistani flavors.', '2026-07-26 01:10:41'),
(254, 22, 5, 4, 88, 'Kolachi seafood platter was fresh and generously portioned.', '2026-07-26 01:10:41'),
(255, 22, 8, 4, 80, 'Xander\'s DHA has a great menu variety for brunch lovers.', '2026-07-26 01:10:41'),
(256, 22, 12, 3, 59, 'Terraza was fine, nothing that stood out particularly.', '2026-07-26 01:10:41'),
(257, 22, 16, 4, 74, 'Peking Chinese noodles were good, service was friendly.', '2026-07-26 01:10:41'),
(258, 22, 25, 5, 92, 'Routine Cafe has the best flat white I\'ve had in Karachi.', '2026-07-26 01:10:41'),
(259, 23, 1, 3, 65, 'Nando\'s was fine but I\'ve had better peri peri elsewhere.', '2026-07-26 01:10:41'),
(260, 23, 7, 5, 93, 'Café Flo is a hidden French gem, loved the croissants.', '2026-07-26 01:10:41'),
(261, 23, 13, 4, 81, 'Sakura teppanyaki show was fun, food was great too.', '2026-07-26 01:10:41'),
(262, 23, 17, 4, 79, 'Oh My Grill burgers are underrated, good value.', '2026-07-26 01:10:41'),
(263, 23, 23, 3, 63, 'Zeenat was decent, standard desi fare.', '2026-07-26 01:10:41'),
(264, 24, 2, 5, 96, 'Aylanto continues to impress every visit, top tier service.', '2026-07-26 01:10:41'),
(265, 24, 3, 3, 57, 'Hotpot Ministry broth was good but seating was tight.', '2026-07-26 01:10:41'),
(266, 24, 9, 5, 94, 'Chefs Table Pakistan is a must-try for special occasions.', '2026-07-26 01:10:41'),
(267, 24, 15, 4, 77, 'Ginsoy has decent Chinese options, quick delivery too.', '2026-07-26 01:10:41'),
(268, 24, 20, 4, 85, 'Boss Cafe has a great dessert menu alongside the mains.', '2026-07-26 01:10:41'),
(269, 25, 4, 4, 83, 'BurgerLab fries are addictive, will definitely be back.', '2026-07-26 01:10:41'),
(270, 25, 6, 5, 91, 'Okra European dishes were beautifully plated and tasty.', '2026-07-26 01:10:41'),
(271, 25, 10, 4, 78, 'Xander\'s Clifton has a lovely outdoor seating area.', '2026-07-26 01:10:41'),
(272, 25, 18, 3, 62, 'Mandi House was decent but a bit oily for my taste.', '2026-07-26 01:10:41'),
(273, 25, 21, 5, 90, 'Factory Cafe sandwiches are seriously underrated.', '2026-07-26 01:10:41'),
(274, 26, 5, 4, 86, 'Kolachi continental options are surprisingly good too, not just BBQ.', '2026-07-26 01:10:41'),
(275, 26, 8, 3, 60, 'Xander\'s DHA was crowded, had to wait for a table.', '2026-07-26 01:10:41'),
(276, 26, 12, 5, 92, 'Terraza date night experience was excellent, highly recommend.', '2026-07-26 01:10:41'),
(277, 26, 19, 4, 80, 'Mizaaj service was attentive, food came out fast.', '2026-07-26 01:10:41'),
(278, 26, 22, 4, 76, 'Cafe Abaseen breakfast platter was generous and tasty.', '2026-07-26 01:10:41'),
(279, 27, 1, 5, 94, 'Best Nando\'s branch in the city honestly, consistent every time.', '2026-07-26 01:10:41'),
(280, 27, 11, 4, 82, 'BBQ Tonight is great for groups, generous portions.', '2026-07-26 01:10:41'),
(281, 27, 14, 4, 75, 'Gul Shinwari is a solid budget-friendly desi option.', '2026-07-26 01:10:41'),
(282, 27, 17, 3, 58, 'Oh My Grill was average, fries were a bit soggy.', '2026-07-26 01:10:41'),
(283, 27, 24, 5, 93, 'Meer Jee nihari is genuinely some of the best in Karachi.', '2026-07-26 01:10:41'),
(284, 28, 2, 4, 87, 'Aylanto pasta dishes are consistently well executed.', '2026-07-26 01:10:41'),
(285, 28, 7, 4, 79, 'Café Flo pastries are a great treat for a slow afternoon.', '2026-07-26 01:10:41'),
(286, 28, 13, 3, 61, 'Sakura was good but pricier than I expected.', '2026-07-26 01:10:41'),
(287, 28, 16, 4, 73, 'Peking Chinese has a good lunch deal, solid portions.', '2026-07-26 01:10:41'),
(288, 28, 25, 4, 84, 'Routine Cafe interior is aesthetic, great for photos and coffee.', '2026-07-26 01:10:41'),
(289, 29, 3, 4, 81, 'Hotpot Ministry is great value for groups splitting a pot.', '2026-07-26 01:10:41'),
(290, 29, 9, 5, 96, 'Chefs Table Pakistan tasting experience was unforgettable.', '2026-07-26 01:10:41'),
(291, 29, 15, 3, 56, 'Ginsoy was okay, wouldn\'t be my first pick for Chinese.', '2026-07-26 01:10:41'),
(292, 29, 20, 5, 95, 'Boss Cafe is genuinely one of Korangi\'s best kept secrets.', '2026-07-26 01:10:41'),
(293, 29, 23, 4, 77, 'Zeenat has that authentic home-cooked desi taste.', '2026-07-26 01:10:41'),
(294, 15, 5, 4, 85, 'Kolachi is pricier but the quality backs it up every time.', '2026-07-26 01:10:41'),
(295, 15, 8, 5, 91, 'Xander\'s DHA is my favorite spot for weekday lunch meetings.', '2026-07-26 01:10:41'),
(296, 15, 12, 4, 79, 'Terraza has a lovely Mediterranean menu, very fresh ingredients.', '2026-07-26 01:10:41'),
(297, 15, 18, 3, 60, 'Mandi House was decent, service was a bit slow though.', '2026-07-26 01:10:41'),
(298, 15, 21, 4, 82, 'Factory Cafe has great value combos for lunch.', '2026-07-26 01:10:41'),
(299, 16, 1, 4, 86, 'Nando\'s spice levels are well calibrated, love the mild-hot balance.', '2026-07-26 01:10:41'),
(300, 16, 9, 4, 83, 'Chefs Table service staff were incredibly knowledgeable about the menu.', '2026-07-26 01:10:41'),
(301, 16, 16, 4, 74, 'Peking Chinese dim sum selection was better than expected.', '2026-07-26 01:10:41'),
(302, 16, 19, 5, 93, 'Mizaaj is a top pick for authentic Middle Eastern food in Karachi.', '2026-07-26 01:10:41'),
(303, 16, 25, 3, 62, 'Routine Cafe was nice but a bit small, hard to get seating.', '2026-07-26 01:10:41'),
(304, 17, 2, 5, 95, 'Aylanto remains my top choice for a special dinner in Clifton.', '2026-07-26 01:10:41'),
(305, 17, 7, 3, 58, 'Café Flo was good but slightly overpriced for portion size.', '2026-07-26 01:10:41'),
(306, 17, 10, 4, 78, 'Xander\'s Clifton has good coffee alongside solid brunch options.', '2026-07-26 01:10:41'),
(307, 17, 3, 4, 80, 'Hotpot Ministry is a great group option, the broth selection is genuinely impressive.', '2026-07-26 01:10:41'),
(308, 17, 22, 5, 90, 'Cafe Abaseen paratha rolls are seriously good value.', '2026-07-26 01:10:41');

-- --------------------------------------------------------

--
-- Table structure for table `review_images`
--

CREATE TABLE `review_images` (
  `id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `image_path` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `google_sub` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `avatar_url` varchar(500) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `google_sub`, `email`, `name`, `avatar_url`, `created_at`) VALUES
(1, '115764427832410270373', 'shahhussain123.rizvi@gmail.com', 'shah hussain', 'https://yaafta.com/files/uploads/avatars/avatar_1_1784202543.webp', '2026-07-15 14:05:01'),
(2, '109444694949455544514', 'codecrafter90@gmail.com', 'code crafter', 'https://lh3.googleusercontent.com/a/ACg8ocKc7T41L0WjDufV8dxltajOkgpdxJLFkWwdC7OS0NF-fitSeaQ=s96-c', '2026-07-17 23:35:48'),
(3, 'test_sub_001', 'ahmedraza@gmail.com', 'Ahmed Raza', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-18 11:25:34'),
(4, 'test_sub_002', 'fatima.sheikh@gmail.com', 'Fatima Sheikh', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-18 11:25:34'),
(5, 'test_sub_003', 'usman.malik@gmail.com', 'Usman Malik', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-18 11:25:34'),
(6, 'test_sub_004', 'ayesha1qureshi@gmail.com', 'Ayesha Qureshi', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-18 11:25:34'),
(7, 'test_sub_005', 'bilal.chaudhry@gmail.com', 'Bilal Chaudhry', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-18 11:25:34'),
(8, 'test_sub_006', 'sana.abbasi@gmail.com', 'Sana Abbasi', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-18 11:25:34'),
(9, 'test_sub_007', 'hassan.baig@gmail.com', 'Hassan Baig', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-18 11:25:34'),
(10, 'test_sub_008', 'mariam.farooq@gmail.com', 'Mariam Farooq', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-18 11:25:34'),
(11, 'test_sub_009', 'zeeshan.iqbal@gmail.com', 'Zeeshan Iqbal', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-18 11:25:34'),
(12, 'test_sub_010', 'noor.hashmi@gmail.com', 'Noor Hashmi', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-18 11:25:34'),
(13, 'test_sub_011', 'faisal_mirza@gmail.com', 'Faisal Mirza', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-18 11:25:34'),
(14, 'test_sub_012', 'iqrasiddiqui@gmail.com', 'Iqra Siddiqui', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-18 11:25:34'),
(15, 'demo_013', 'saad.jamali@gmail.com', 'Saad Jamali', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-26 01:08:54'),
(16, 'demo_014', 'hira.khan@hotmail.com', 'Hira Khan', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-26 01:08:54'),
(17, 'demo_015', 'omar.suleman@yahoo.com', 'Omar Suleman', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-26 01:08:54'),
(18, 'demo_016', 'zainab.ali@gmail.com', 'Zainab Ali', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-26 01:08:54'),
(19, 'demo_017', 'kamran.shaikh@outlook.com', 'Kamran Shaikh', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-26 01:08:54'),
(20, 'demo_018', 'rabia.tariq@gmail.com', 'Rabia Tariq', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-26 01:08:54'),
(21, 'demo_019', 'asad.nawaz@yahoo.com', 'Asad Nawaz', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-26 01:08:54'),
(22, 'demo_020', 'sadia.imran@gmail.com', 'Sadia Imran', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-26 01:08:54'),
(23, 'demo_021', 'waqas.ahmed@outlook.com', 'Waqas Ahmed', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-26 01:08:54'),
(24, 'demo_022', 'mahnoor.saleem@gmail.com', 'Mahnoor Saleem', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-26 01:08:54'),
(25, 'demo_023', 'junaid.rafiq@hotmail.com', 'Junaid Rafiq', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-26 01:08:54'),
(26, 'demo_024', 'alina.zaidi@gmail.com', 'Alina Zaidi', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-26 01:08:54'),
(27, 'demo_025', 'taha.aziz@yahoo.com', 'Taha Aziz', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-26 01:08:54'),
(28, 'demo_026', 'sana.parvez@gmail.com', 'Sana Parvez', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-26 01:08:54'),
(29, 'demo_027', 'bilawal.hussain@outlook.com', 'Bilawal Hussain', 'https://yaafta.com/files/uploads/default-avatar.png', '2026-07-26 01:08:54');

-- --------------------------------------------------------

--
-- Table structure for table `yaafta_special_ratings`
--

CREATE TABLE `yaafta_special_ratings` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `value_for_money` tinyint(4) NOT NULL,
  `influencer_accuracy` tinyint(4) NOT NULL,
  `recommend_pct` tinyint(4) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  `anon_id` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `yaafta_special_ratings`
--

INSERT INTO `yaafta_special_ratings` (`id`, `restaurant_id`, `value_for_money`, `influencer_accuracy`, `recommend_pct`, `created_at`, `user_id`, `anon_id`) VALUES
(1, 3, 53, 11, 70, '2026-07-25 00:01:43', NULL, NULL),
(2, 7, 70, 70, 100, '2026-07-25 00:34:22', 1, '0f8759dc45eb1830da61ac354da014b2'),
(3, 27, 52, 73, 100, '2026-07-26 20:49:43', NULL, '5222576c6f192058d0f47de08c7e9c30'),
(4, 26, 50, 71, 74, '2026-07-26 20:53:17', NULL, 'c3afee5b7533468681bfb180f43abacc'),
(5, 11, 70, 50, 71, '2026-07-26 21:29:36', NULL, 'c3afee5b7533468681bfb180f43abacc'),
(6, 5, 70, 67, 70, '2026-07-26 21:29:51', NULL, 'c3afee5b7533468681bfb180f43abacc'),
(7, 21, 57, 65, 78, '2026-07-26 21:30:14', NULL, 'c3afee5b7533468681bfb180f43abacc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `rate_limit_log`
--
ALTER TABLE `rate_limit_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_identifier_time` (`identifier`,`created_at`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `one_per_user_per_restaurant` (`user_id`,`restaurant_id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `review_images`
--
ALTER TABLE `review_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_id` (`review_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `google_sub` (`google_sub`);

--
-- Indexes for table `yaafta_special_ratings`
--
ALTER TABLE `yaafta_special_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`),
  ADD KEY `fk_ysr_user` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rate_limit_log`
--
ALTER TABLE `rate_limit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=309;

--
-- AUTO_INCREMENT for table `review_images`
--
ALTER TABLE `review_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `yaafta_special_ratings`
--
ALTER TABLE `yaafta_special_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `review_images`
--
ALTER TABLE `review_images`
  ADD CONSTRAINT `review_images_ibfk_1` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `yaafta_special_ratings`
--
ALTER TABLE `yaafta_special_ratings`
  ADD CONSTRAINT `fk_ysr_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `yaafta_special_ratings_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

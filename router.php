<?php
include_once __DIR__ . '/files/connection.php';

$path = trim(parse_url($_GET['path'] ?? '', PHP_URL_PATH), '/');
$segments = $path === '' ? [] : explode('/', $path);
$count = count($segments);

// /karachi/clifton/aylanto  -> 3 segments = restaurant
// /karachi/clifton          -> 2 segments = area
// /karachi                  -> 1 segment  = city
// /category/fine-dining     -> category
// /blog/some-post           -> blog

if ($count === 2 && $segments[0] === 'category') {
    $_GET['category_slug'] = $segments[1];
    include __DIR__ . '/templates/category.php';

} elseif ($count === 2 && $segments[0] === 'blog') {
    $_GET['blog_slug'] = $segments[1];
    include __DIR__ . '/templates/blog.php';

} elseif ($count === 3) {
    $_GET['city_slug'] = $segments[0];
    $_GET['area_slug'] = $segments[1];
    $_GET['restaurant_slug'] = $segments[2];
    include __DIR__ . '/templates/restaurant.php';

} elseif ($count === 2) {
    $_GET['city_slug'] = $segments[0];
    $_GET['area_slug'] = $segments[1];
    include __DIR__ . '/templates/area.php';

} elseif ($count === 1 && $segments[0] !== '') {
    $_GET['city_slug'] = $segments[0];
    include __DIR__ . '/templates/city.php';

} else {
    include __DIR__ . '/index.php';
}

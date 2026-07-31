<?php
// connection.php already included by router.php ($con available)

$citySlug = $_GET['city_slug'] ?? '';

$stmt = $con->prepare("SELECT * FROM cities WHERE slug = ?");
$stmt->bind_param("s", $citySlug);
$stmt->execute();
$city = $stmt->get_result()->fetch_assoc();

if (!$city) {
    http_response_code(404);
    echo "City not found.";
    exit;
}

$cityId = $city['id'];

$aStmt = $con->prepare("
    SELECT a.*, COUNT(r.id) AS restaurant_count
    FROM areas a
    LEFT JOIN restaurants r ON r.area_id = a.id
    WHERE a.city_id = ?
    GROUP BY a.id
    ORDER BY a.name ASC
");
$aStmt->bind_param("i", $cityId);
$aStmt->execute();
$areas = $aStmt->get_result()->fetch_all(MYSQLI_ASSOC);

$pageTitle = 'Restaurants in ' . htmlspecialchars($city['name']) . ' | Yaafta';
$metaDesc  = 'Browse restaurants by area in ' . htmlspecialchars($city['name']) . '.';
$canonical = BASE_URL . $city['slug'];
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="description" content="<?php echo $metaDesc; ?>" />
<link rel="canonical" href="<?php echo htmlspecialchars($canonical); ?>">
<title><?php echo $pageTitle; ?></title>
<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css" />
</head>
<body>

<?php include __DIR__ . '/../files/layout/header.php'; ?>

<section class="city-hero">
  <div class="container">
    <nav class="breadcrumb">
      <a href="<?php echo BASE_URL; ?>">Home</a> &rsaquo;
      <span><?php echo htmlspecialchars($city['name']); ?></span>
    </nav>
    <h1>Restaurants in <?php echo htmlspecialchars($city['name']); ?></h1>
  </div>
</section>

<section class="city-area-list">
  <div class="container area-grid">
    <?php if (empty($areas)): ?>
      <p>No areas added yet.</p>
    <?php else: ?>
      <?php foreach ($areas as $a): ?>
        <a class="area-card" href="<?php echo BASE_URL . $citySlug . '/' . htmlspecialchars($a['slug']); ?>">
          <h3><?php echo htmlspecialchars($a['name']); ?></h3>
          <p><?php echo (int)$a['restaurant_count']; ?> restaurants</p>
        </a>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>

<?php include __DIR__ . '/../files/layout/footer.php'; ?>

</body>
</html>

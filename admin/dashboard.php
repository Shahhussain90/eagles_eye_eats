<?php
include_once __DIR__ . '/../files/connection.php';
include_once __DIR__ . '/auth_check.php';

$restaurantCount = $con->query("SELECT COUNT(*) c FROM restaurants")->fetch_assoc()['c'];
$areaCount       = $con->query("SELECT COUNT(*) c FROM areas")->fetch_assoc()['c'];
$categoryCount   = $con->query("SELECT COUNT(*) c FROM categories")->fetch_assoc()['c'];
$blogCount       = $con->query("SELECT COUNT(*) c FROM blog_posts")->fetch_assoc()['c'];

$adminPageTitle = 'Dashboard';
include __DIR__ . '/layout/admin_header.php';
?>
<div class="admin-topbar">
  <h1>Dashboard</h1>
  <span>Welcome, <?php echo htmlspecialchars($_SESSION['admin_username'] ?? 'admin'); ?></span>
</div>

<div class="admin-card" style="display:flex; gap:24px; flex-wrap:wrap; color:black;">
  <div><strong style="font-size:1.6rem; "><?php echo $restaurantCount; ?></strong><div>Restaurants</div></div>
  <div><strong style="font-size:1.6rem; "><?php echo $areaCount; ?></strong><div>Areas</div></div>
  <div><strong style="font-size:1.6rem; "><?php echo $categoryCount; ?></strong><div>Categories</div></div>
  <div><strong style="font-size:1.6rem; "><?php echo $blogCount; ?></strong><div>Blog Posts</div></div>
</div>

<div class="admin-card">
  <a class="btn btn-primary" href="<?php echo BASE_URL; ?>admin/restaurants/add.php">+ Add New Restaurant</a>
</div>

<?php include __DIR__ . '/layout/admin_footer.php'; ?>

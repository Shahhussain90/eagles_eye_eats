<?php
include_once __DIR__ . '/../../files/connection.php';
include_once __DIR__ . '/../auth_check.php';

$restaurants = $con->query("
    SELECT r.id, r.name, r.slug, r.cuisine, a.name AS area_name
    FROM restaurants r
    LEFT JOIN areas a ON a.id = r.area_id
    ORDER BY r.name ASC
")->fetch_all(MYSQLI_ASSOC);

$adminPageTitle = 'Restaurants';
include __DIR__ . '/../layout/admin_header.php';
?>
<div class="admin-topbar">
  <h1>Restaurants (<?php echo count($restaurants); ?>)</h1>
  <a class="btn btn-primary" href="add.php">+ Add Restaurant</a>
</div>

<?php if (isset($_GET['deleted'])): ?>
  <div class="admin-flash">Restaurant deleted.</div>
<?php endif; ?>
<?php if (isset($_GET['saved'])): ?>
  <div class="admin-flash">Restaurant saved.</div>
<?php endif; ?>

<div class="admin-card">
  <table class="admin-table">
    <thead>
      <tr><th>Name</th><th>Area</th><th>Cuisine</th><th>Slug</th><th></th></tr>
    </thead>
    <tbody>
      <?php foreach ($restaurants as $r): ?>
        <tr>
          <td><?php echo htmlspecialchars($r['name']); ?></td>
          <td><?php echo htmlspecialchars($r['area_name'] ?: '—'); ?></td>
          <td><?php echo htmlspecialchars($r['cuisine'] ?: '—'); ?></td>
          <td><code><?php echo htmlspecialchars($r['slug']); ?></code></td>
          <td>
            <a href="edit.php?id=<?php echo $r['id']; ?>">Edit</a> ·
            <form method="POST" action="delete.php" style="display:inline;" onsubmit="return confirm('Delete this restaurant? This cannot be undone.');">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="id" value="<?php echo $r['id']; ?>">
              <button type="submit" style="background:none;border:none;color:#d32f2f;cursor:pointer;padding:0;font:inherit;text-decoration:underline;">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/../layout/admin_footer.php'; ?>
<?php
include_once __DIR__ . '/../../files/connection.php';
include_once __DIR__ . '/../auth_check.php';

$areas = $con->query("
    SELECT a.id, a.slug, a.name, COUNT(r.id) AS restaurant_count
    FROM areas a
    LEFT JOIN restaurants r ON r.area_id = a.id
    GROUP BY a.id
    ORDER BY a.name ASC
")->fetch_all(MYSQLI_ASSOC);

$adminPageTitle = 'Areas';
include __DIR__ . '/../layout/admin_header.php';
?>
<div class="admin-topbar">
  <h1>Areas (<?php echo count($areas); ?>)</h1>
  <a class="btn btn-primary" href="add.php">+ Add Area</a>
</div>

<?php if (isset($_GET['deleted'])): ?><div class="admin-flash">Area deleted.</div><?php endif; ?>
<?php if (isset($_GET['saved'])): ?><div class="admin-flash">Area saved.</div><?php endif; ?>

<div class="admin-card">
  <table class="admin-table">
    <thead><tr><th>Name</th><th>Slug</th><th>Restaurants</th><th></th></tr></thead>
    <tbody>
      <?php foreach ($areas as $a): ?>
        <tr>
          <td><?php echo htmlspecialchars($a['name']); ?></td>
          <td><code><?php echo htmlspecialchars($a['slug']); ?></code></td>
          <td><?php echo (int)$a['restaurant_count']; ?></td>
          <td>
            <a href="edit.php?id=<?php echo $a['id']; ?>">Edit</a> ·
            <form method="POST" action="delete.php" style="display:inline;" onsubmit="return confirm('Delete this area? Restaurants in it will lose their area link, not be deleted.');">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="id" value="<?php echo $a['id']; ?>">
              <button type="submit" style="background:none;border:none;color:#d32f2f;cursor:pointer;padding:0;font:inherit;text-decoration:underline;">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/../layout/admin_footer.php'; ?>
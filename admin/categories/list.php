<?php
include_once __DIR__ . '/../../files/connection.php';
include_once __DIR__ . '/../auth_check.php';

$categories = $con->query("
    SELECT c.id, c.slug, c.name, COUNT(rc.restaurant_id) AS restaurant_count
    FROM categories c
    LEFT JOIN restaurant_categories rc ON rc.category_id = c.id
    GROUP BY c.id
    ORDER BY c.name ASC
")->fetch_all(MYSQLI_ASSOC);

$adminPageTitle = 'Categories';
include __DIR__ . '/../layout/admin_header.php';
?>
<div class="admin-topbar">
  <h1>Categories (<?php echo count($categories); ?>)</h1>
  <a class="btn btn-primary" href="add.php">+ Add Category</a>
</div>

<?php if (isset($_GET['deleted'])): ?><div class="admin-flash">Category deleted.</div><?php endif; ?>
<?php if (isset($_GET['saved'])): ?><div class="admin-flash">Category saved.</div><?php endif; ?>

<div class="admin-card">
  <table class="admin-table">
    <thead><tr><th>Name</th><th>Slug</th><th>Restaurants</th><th></th></tr></thead>
    <tbody>
      <?php foreach ($categories as $c): ?>
        <tr>
          <td><?php echo htmlspecialchars($c['name']); ?></td>
          <td><code><?php echo htmlspecialchars($c['slug']); ?></code></td>
          <td><?php echo (int)$c['restaurant_count']; ?></td>
          <td>
            <a href="edit.php?id=<?php echo $c['id']; ?>">Edit</a> ·
            <form method="POST" action="delete.php" style="display:inline;" onsubmit="return confirm('Delete this category?');">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="id" value="<?php echo $c['id']; ?>">
              <button type="submit" style="background:none;border:none;color:#d32f2f;cursor:pointer;padding:0;font:inherit;text-decoration:underline;">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/../layout/admin_footer.php'; ?>
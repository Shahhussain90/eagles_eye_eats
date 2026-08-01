<?php
include_once __DIR__ . '/../../files/connection.php';
include_once __DIR__ . '/../auth_check.php';

$posts = $con->query("SELECT id, slug, title, published_at FROM blog_posts ORDER BY published_at DESC")->fetch_all(MYSQLI_ASSOC);

$adminPageTitle = 'Blog Posts';
include __DIR__ . '/../layout/admin_header.php';
?>
<div class="admin-topbar">
  <h1>Blog Posts (<?php echo count($posts); ?>)</h1>
  <a class="btn btn-primary" href="add.php">+ Add Post</a>
</div>

<?php if (isset($_GET['deleted'])): ?><div class="admin-flash">Post deleted.</div><?php endif; ?>
<?php if (isset($_GET['saved'])): ?><div class="admin-flash">Post saved.</div><?php endif; ?>

<div class="admin-card">
  <table class="admin-table">
    <thead><tr><th>Title</th><th>Slug</th><th>Published</th><th></th></tr></thead>
    <tbody>
      <?php foreach ($posts as $p): ?>
        <tr>
          <td><?php echo htmlspecialchars($p['title']); ?></td>
          <td><code><?php echo htmlspecialchars($p['slug']); ?></code></td>
          <td><?php echo date('M j, Y', strtotime($p['published_at'])); ?></td>
          <td>
            <a href="edit.php?id=<?php echo $p['id']; ?>">Edit</a> ·
            <a href="delete.php?id=<?php echo $p['id']; ?>" onclick="return confirm('Delete this blog post?');" style="color:#d32f2f;">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/../layout/admin_footer.php'; ?>

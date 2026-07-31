<?php
// Requires $con (from connection.php, already included by the calling page/template).
// Optionally set $excludeAreaId to hide the current area from its own explore list.
$excludeAreaId = $excludeAreaId ?? null;

if ($excludeAreaId) {
    $exploreStmt = $con->prepare("SELECT slug, name FROM areas WHERE id != ? ORDER BY name ASC LIMIT 8");
    $exploreStmt->bind_param("i", $excludeAreaId);
} else {
    $exploreStmt = $con->prepare("SELECT slug, name FROM areas ORDER BY name ASC LIMIT 8");
}
$exploreStmt->execute();
$exploreAreas = $exploreStmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<div class="explore-areas">
  <p class="explore-heading">Looking for more options?</p>
  <p class="explore-sub">Explore our curated restaurant guides across Karachi's top neighbourhoods.</p>
  <div class="explore-links">
    <?php foreach ($exploreAreas as $ea): ?>
      <a href="<?php echo BASE_URL . 'karachi/' . htmlspecialchars($ea['slug']); ?>" class="explore-chip">
        <span class="explore-icon">🍽️</span>
        <?php echo htmlspecialchars($ea['name']); ?>
      </a>
    <?php endforeach; ?>
  </div>
</div>

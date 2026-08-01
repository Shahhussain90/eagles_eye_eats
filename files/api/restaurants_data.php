<?php
// Replaces the old static files/data/restaurants.json — this generates the
// same shape live from the database, so search always reflects current data
// with no manual regeneration step needed.
include_once __DIR__ . '/../connection.php';

header('Content-Type: application/json');

$result = $con->query("
    SELECT r.name, r.cuisine, r.slug, a.name AS area, a.slug AS area_slug
    FROM restaurants r
    LEFT JOIN areas a ON a.id = r.area_id
");

$out = [];
while ($row = $result->fetch_assoc()) {
    $pageUrl = $row['area_slug']
        ? BASE_URL . 'karachi/' . $row['area_slug'] . '/' . $row['slug']
        : '#';
    $out[] = [
        'name'     => $row['name'],
        'cuisine'  => $row['cuisine'],
        'area'     => $row['area'],
        'page_url' => $pageUrl,
    ];
}

echo json_encode($out);

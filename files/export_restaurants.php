<?php
require_once 'connection.php';

global $con;

if (!$con) {
    die("❌ Database connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($con, "
    SELECT slug, name, cuisine, area, page_url, image_url 
    FROM restaurants 
    ORDER BY name ASC
");

if (!$result) {
    die("❌ Query failed: " . mysqli_error($con));
}

$rows = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}

$dataDir = __DIR__ . '/data';
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

$outFile = $dataDir . '/restaurants.json';
$written = file_put_contents(
    $outFile,
    json_encode($rows, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
);

if ($written === false) {
    die("❌ Failed to write JSON file. Check that files/data/ is writable.");
}

echo "✅ Exported " . count($rows) . " restaurants at " . date('Y-m-d H:i:s');
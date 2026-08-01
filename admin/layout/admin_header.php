<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title><?php echo isset($adminPageTitle) ? htmlspecialchars($adminPageTitle) . ' | ' : ''; ?>Yaafta Admin</title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css" />
  <style>
    body { background: #f6f7f9; }
    .admin-shell { display: flex; min-height: 100vh; }
    .admin-sidebar { width: 220px; background: #16181d; color: #eee; padding: 20px 0; flex-shrink: 0; }
    .admin-sidebar a { display: block; padding: 10px 24px; color: #ccc; text-decoration: none; font-size: 0.95rem; }
    .admin-sidebar a:hover, .admin-sidebar a.active { background: #22252c; color: #fff; }
    .admin-sidebar .brand { padding: 0 24px 20px; font-weight: 700; font-size: 1.1rem; color: #fff; }
    .admin-main { flex: 1; padding: 28px 32px; max-width: 1100px; }
    .admin-topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
    .admin-card { background: #fff; border-radius: 10px; padding: 20px; box-shadow: 0 1px 4px rgba(0,0,0,0.06); margin-bottom: 20px; }
    table.admin-table { width: 100%; border-collapse: collapse; }
    table.admin-table th, table.admin-table td { text-align: left; padding: 10px 8px; border-bottom: 1px solid #eee; font-size: 0.92rem; }
    table.admin-table th { color: #888; font-weight: 600; font-size: 0.8rem; text-transform: uppercase; }
    .admin-form label { display: block; font-weight: 600; margin: 16px 0 6px; font-size: 0.88rem; }
    .admin-form input[type=text], .admin-form input[type=number], .admin-form input[type=date],
    .admin-form input[type=url], .admin-form input[type=tel], .admin-form select, .admin-form textarea {
      width: 100%; padding: 9px 10px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; font-family: inherit; font-size: 0.92rem;
    }
    .admin-form textarea { min-height: 90px; resize: vertical; }
    .admin-form .hint { color: #888; font-size: 0.8rem; margin-top: 4px; }
    .admin-form fieldset { border: 1px solid #eee; border-radius: 8px; padding: 16px; margin: 20px 0; }
    .admin-form legend { padding: 0 8px; font-weight: 700; }
    .admin-checkbox-grid { display: flex; flex-wrap: wrap; gap: 10px; }
    .admin-checkbox-grid label { display: flex; align-items: center; gap: 6px; font-weight: normal; background: #f2f2f2; padding: 6px 10px; border-radius: 20px; font-size: 0.85rem; margin: 0; }
    .admin-btn-row { margin-top: 24px; display: flex; gap: 10px; }
    .admin-repeat-row { display: grid; grid-template-columns: 1fr 1fr 90px 1fr auto; gap: 8px; align-items: start; margin-bottom: 8px; }
    .admin-repeat-row.faq-row { grid-template-columns: 1fr 2fr auto; }
    .admin-remove-btn { background: #fdecea; color: #d32f2f; border: none; border-radius: 6px; padding: 8px 10px; cursor: pointer; height: fit-content; }
    .admin-add-btn { background: #eef7f2; color: #007a4d; border: none; border-radius: 6px; padding: 8px 14px; cursor: pointer; margin-top: 6px; }
    .admin-flash { background: #eef7f2; color: #0a6e3a; padding: 10px 14px; border-radius: 6px; margin-bottom: 16px; }
  </style>
</head>
<body>
<div class="admin-shell">
  <aside class="admin-sidebar">
    <div class="brand">Yaafta Admin</div>
    <a href="<?php echo BASE_URL; ?>admin/dashboard.php">Dashboard</a>
    <a href="<?php echo BASE_URL; ?>admin/restaurants/list.php">Restaurants</a>
    <a href="<?php echo BASE_URL; ?>admin/areas/list.php">Areas</a>
    <a href="<?php echo BASE_URL; ?>admin/categories/list.php">Categories</a>
    <a href="<?php echo BASE_URL; ?>admin/blog/list.php">Blog Posts</a>
    <a href="<?php echo BASE_URL; ?>admin/logout.php">Log Out</a>
  </aside>
  <main class="admin-main">

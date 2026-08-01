<?php
// Expects: $con, $restaurantId (int or null for new), $_POST, $_FILES
// Returns the restaurant id (new or existing) on success.

$uploadWarnings = [];

function admin_upload_image($fileKey, $index = null) {
    global $uploadWarnings;
    $file = $index === null ? ($_FILES[$fileKey] ?? null) : [
        'name' => $_FILES[$fileKey]['name'][$index] ?? '',
        'type' => $_FILES[$fileKey]['type'][$index] ?? '',
        'tmp_name' => $_FILES[$fileKey]['tmp_name'][$index] ?? '',
        'error' => $_FILES[$fileKey]['error'][$index] ?? UPLOAD_ERR_NO_FILE,
        'size' => $_FILES[$fileKey]['size'][$index] ?? 0,
    ];
    if (!$file || empty($file['tmp_name'])) {
        return null; // no file actually chosen — not an error
    }
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $uploadWarnings[] = "Upload failed for \"{$file['name']}\" (PHP upload error code {$file['error']}).";
        return null;
    }
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
        $uploadWarnings[] = "\"{$file['name']}\" was skipped — only JPG, PNG, and WEBP are supported.";
        return null;
    }
    $destDir = UPLOAD_DIR . 'restaurants/';
    if (!is_dir($destDir)) {
        mkdir($destDir, 0755, true);
    }
    $filename = uniqid('rest_') . '.' . ($ext === 'jpeg' ? 'jpg' : $ext);
    $destPath = $destDir . $filename;

    if (resize_and_save_image($file['tmp_name'], $destPath)) {
        return UPLOAD_URL . 'restaurants/' . $filename;
    }
    $uploadWarnings[] = "\"{$file['name']}\" could not be saved — check that files/uploads/restaurants/ is writable.";
    return null;
}

// ---- basic fields ----
$name              = trim($_POST['name'] ?? '');
$slug              = trim($_POST['slug'] ?? '');
$areaId            = (int)($_POST['area_id'] ?? 0);
$cuisine           = trim($_POST['cuisine'] ?? '');
$description       = trim($_POST['description'] ?? '');
$metaDescription   = trim($_POST['meta_description'] ?? '');
$metaKeywords      = trim($_POST['meta_keywords'] ?? '');
$aboutContent      = trim($_POST['about_content'] ?? '');
$highlights        = trim($_POST['highlights'] ?? '');
$whatPeopleSay     = trim($_POST['what_people_say'] ?? '');
$menuContent       = trim($_POST['menu_content'] ?? '');
$bestTimeToVisit   = trim($_POST['best_time_to_visit'] ?? '');
$finalThoughts     = trim($_POST['final_thoughts'] ?? '');
$lastUpdated       = !empty($_POST['last_updated']) ? $_POST['last_updated'] : null;
$address           = trim($_POST['address'] ?? '');
$timing            = trim($_POST['timing'] ?? '');
$priceRange        = trim($_POST['price_range'] ?? '');
$phone             = trim($_POST['phone'] ?? '');
$mapEmbedQuery     = trim($_POST['map_embed_query'] ?? '');
$menuUrl           = trim($_POST['menu_url'] ?? '');
$googleMapsUrl     = trim($_POST['google_maps_url'] ?? '');
$instagramUrl      = trim($_POST['instagram_url'] ?? '');
$facebookUrl       = trim($_POST['facebook_url'] ?? '');
$foodpandaUrl      = trim($_POST['foodpanda_url'] ?? '');
$displayRating     = $_POST['display_rating'] !== '' ? (float)$_POST['display_rating'] : null;
$reviewCountText   = trim($_POST['review_count_text'] ?? '');

if ($name === '' || $slug === '' || !$areaId) {
    $formError = 'Name, slug, and area are required.';
} else {
    // hero image upload (optional — keeps existing if not re-uploaded)
    $newHeroUrl = admin_upload_image('hero_image_file');

    if ($restaurantId) {
        if ($newHeroUrl) {
            $stmt = $con->prepare("
                UPDATE restaurants SET
                  name=?, slug=?, area_id=?, cuisine=?, description=?,
                  meta_description=?, meta_keywords=?, image_url=?,
                  about_content=?, highlights=?, what_people_say=?, menu_content=?,
                  best_time_to_visit=?, final_thoughts=?, last_updated=?,
                  address=?, timing=?, price_range=?, phone=?, map_embed_query=?,
                  menu_url=?, google_maps_url=?, instagram_url=?, facebook_url=?, foodpanda_url=?,
                  display_rating=?, review_count_text=?
                WHERE id=?
            ");
            $stmt->bind_param(
                "ssisssssssssssssssssssssdssi",
                $name, $slug, $areaId, $cuisine, $description,
                $metaDescription, $metaKeywords, $newHeroUrl,
                $aboutContent, $highlights, $whatPeopleSay, $menuContent,
                $bestTimeToVisit, $finalThoughts, $lastUpdated,
                $address, $timing, $priceRange, $phone, $mapEmbedQuery,
                $menuUrl, $googleMapsUrl, $instagramUrl, $facebookUrl, $foodpandaUrl,
                $displayRating, $reviewCountText, $restaurantId
            );
        } else {
            $stmt = $con->prepare("
                UPDATE restaurants SET
                  name=?, slug=?, area_id=?, cuisine=?, description=?,
                  meta_description=?, meta_keywords=?,
                  about_content=?, highlights=?, what_people_say=?, menu_content=?,
                  best_time_to_visit=?, final_thoughts=?, last_updated=?,
                  address=?, timing=?, price_range=?, phone=?, map_embed_query=?,
                  menu_url=?, google_maps_url=?, instagram_url=?, facebook_url=?, foodpanda_url=?,
                  display_rating=?, review_count_text=?
                WHERE id=?
            ");
            $stmt->bind_param(
                "ssisssssssssssssssssssssdsi",
                $name, $slug, $areaId, $cuisine, $description,
                $metaDescription, $metaKeywords,
                $aboutContent, $highlights, $whatPeopleSay, $menuContent,
                $bestTimeToVisit, $finalThoughts, $lastUpdated,
                $address, $timing, $priceRange, $phone, $mapEmbedQuery,
                $menuUrl, $googleMapsUrl, $instagramUrl, $facebookUrl, $foodpandaUrl,
                $displayRating, $reviewCountText, $restaurantId
            );
        }
        $stmt->execute();
    } else {
        $heroUrl = $newHeroUrl; // may be null for a brand new restaurant
        $stmt = $con->prepare("
            INSERT INTO restaurants
              (name, slug, area_id, cuisine, description, meta_description, meta_keywords, image_url,
               about_content, highlights, what_people_say, menu_content,
               best_time_to_visit, final_thoughts, last_updated,
               address, timing, price_range, phone, map_embed_query,
               menu_url, google_maps_url, instagram_url, facebook_url, foodpanda_url,
               display_rating, review_count_text)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
        ");
        $stmt->bind_param(
            "ssissssssssssssssssssssssds",
            $name, $slug, $areaId, $cuisine, $description, $metaDescription, $metaKeywords, $heroUrl,
            $aboutContent, $highlights, $whatPeopleSay, $menuContent,
            $bestTimeToVisit, $finalThoughts, $lastUpdated,
            $address, $timing, $priceRange, $phone, $mapEmbedQuery,
            $menuUrl, $googleMapsUrl, $instagramUrl, $facebookUrl, $foodpandaUrl,
            $displayRating, $reviewCountText
        );
        $stmt->execute();
        $restaurantId = $con->insert_id;
    }

    // ---- categories (replace all links) ----
    $con->query("DELETE FROM restaurant_categories WHERE restaurant_id = $restaurantId");
    if (!empty($_POST['category_ids'])) {
        $catStmt = $con->prepare("INSERT INTO restaurant_categories (restaurant_id, category_id) VALUES (?, ?)");
        foreach ($_POST['category_ids'] as $catId) {
            $catId = (int)$catId;
            $catStmt->bind_param("ii", $restaurantId, $catId);
            $catStmt->execute();
        }
    }

    // ---- delete selected gallery images ----
    if (!empty($_POST['delete_image_ids'])) {
        foreach ($_POST['delete_image_ids'] as $imgId) {
            $imgId = (int)$imgId;
            $del = $con->prepare("DELETE FROM restaurant_images WHERE id = ? AND restaurant_id = ?");
            $del->bind_param("ii", $imgId, $restaurantId);
            $del->execute();
        }
    }

    // ---- add new gallery images ----
    if (!empty($_FILES['gallery_files']['name'][0])) {
        $countExisting = $con->query("SELECT COUNT(*) c FROM restaurant_images WHERE restaurant_id = $restaurantId")->fetch_assoc()['c'];
        foreach ($_FILES['gallery_files']['name'] as $i => $fname) {
            if ($fname === '') continue;
            $url = admin_upload_image('gallery_files', $i);
            if ($url) {
                $sortOrder = $countExisting + $i;
                $ins = $con->prepare("INSERT INTO restaurant_images (restaurant_id, image_path, alt_text, is_hero, sort_order) VALUES (?, ?, ?, 0, ?)");
                $ins->bind_param("issi", $restaurantId, $url, $name, $sortOrder);
                $ins->execute();
            }
        }
    }

    // ---- google reviews (replace all) ----
    $con->query("DELETE FROM restaurant_google_reviews WHERE restaurant_id = $restaurantId");
    if (!empty($_POST['review_name'])) {
        $revStmt = $con->prepare("INSERT INTO restaurant_google_reviews (restaurant_id, reviewer_name, review_date_text, star_rating, review_text, sort_order) VALUES (?, ?, ?, ?, ?, ?)");
        foreach ($_POST['review_name'] as $i => $rname) {
            $rname = trim($rname);
            $rtext = trim($_POST['review_text'][$i] ?? '');
            if ($rname === '' || $rtext === '') continue;
            $rdate = trim($_POST['review_date'][$i] ?? '');
            $rstars = (int)($_POST['review_stars'][$i] ?? 5);
            $revStmt->bind_param("issisi", $restaurantId, $rname, $rdate, $rstars, $rtext, $i);
            $revStmt->execute();
        }
    }

    // ---- FAQs (replace all) ----
    $con->query("DELETE FROM restaurant_faqs WHERE restaurant_id = $restaurantId");
    if (!empty($_POST['faq_question'])) {
        $faqStmt = $con->prepare("INSERT INTO restaurant_faqs (restaurant_id, question, answer, sort_order) VALUES (?, ?, ?, ?)");
        foreach ($_POST['faq_question'] as $i => $q) {
            $q = trim($q);
            $a = trim($_POST['faq_answer'][$i] ?? '');
            if ($q === '' || $a === '') continue;
            $faqStmt->bind_param("issi", $restaurantId, $q, $a, $i);
            $faqStmt->execute();
        }
    }

    $formError = null;
}
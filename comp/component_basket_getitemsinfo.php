<?php
/* Filter POST datas */
$article = filter_var(stripslashes($article), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$count = filter_var(stripslashes($count), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
/* Get info about each item from DB */
$stmt = $pdo->prepare('
                       SELECT * FROM items 
                       WHERE article = :item_article
                      ');
$stmt->execute(['item_article' => $article]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);
/* Discount time actuality */
$discount_now = strtotime("now") . "<br />";
$discount_start = strtotime($item['discount_price_time_start']) . "<br />";
$discount_end = strtotime($item['discount_price_time_end']) . "<br />";
if (($discount_now >= $discount_start)&&($discount_now <= $discount_end)&&($item['discount_price'] > 0)) {
    $is_discount = true;
} else {
    $is_discount = false;
}
$item_price = $is_discount ? $item['discount_price'] : $item['price'];
/* Unserialize images from DB */
$item['image_path'] = unserialize($item['image_path']);
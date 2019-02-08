<?php
/* Discount time actuality */
$discount_now = strtotime("now") . "<br />";
$discount_start = strtotime($item['discount_price_time_start']) . "<br />";
$discount_end = strtotime($item['discount_price_time_end']) . "<br />";
if (($discount_now >= $discount_start)&&($discount_now <= $discount_end)&&($item['discount_price'] > 0)) {
    $is_discount = true;
} else {
    $is_discount = false;
}
/* Unserialize images from DB */
$item['image_path'] = unserialize($item['image_path']);
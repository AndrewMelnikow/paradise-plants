<?php
session_start();
/* Adding items to cart */
if (!isset($_SESSION['basket']['items'])) $_SESSION['basket']['items'] = [];
$_SESSION['basket']['items'][$_POST['article']] = $_POST['count'];
/* Total item count */
$_SESSION['basket']['total-count'] = 0;

foreach($_SESSION['basket']['items'] as $k => $v) {
    $_SESSION['basket']['total-count'] += $v;
}
/* Output total item count in header */
echo $_SESSION['basket']['total-count'];
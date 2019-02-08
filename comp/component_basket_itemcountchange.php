<?php
session_start();
if (is_numeric($_POST['count'])) {    
    /* Check the input data */
    $_POST['article'] = filter_var(stripslashes($_POST['article']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    /* Set new count of item, if count = 0 then remove item from basket */
    $_SESSION['basket']['items'][$_POST['article']] = $_POST['count'];
    if ($_SESSION['basket']['items'][$_POST['article']] == 0) {
        unset($_SESSION['basket']['items'][$_POST['article']]);
    }
    /* Unset array if basket is empty */
    if (!array_filter($_SESSION['basket']['items'])) {
        unset($_SESSION['basket']['items']);
    }
    /* Total item count */
    $_SESSION['basket']['total-count'] = 0;
    foreach ($_SESSION['basket']['items'] as $k => $v) {
        $_SESSION['basket']['total-count'] += $v;
    }
}
header("Location: ../basket.php");
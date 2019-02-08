<?php
if (isset($_GET['name'])) {
    $f = fopen("stat/items/" . $_GET['id'] . ".log", "a+");
    flock($f, LOCK_EX);
    $count = fread($f, 100);
    @$count++;
    ftruncate($f, 0);
    fwrite($f, $count);
    fflush($f);
    flock($f, LOCK_UN);
    fclose($f);
}
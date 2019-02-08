<?php
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=eshop', //'mysql:host=localhost;dbname=id8169918_eshop',
        'root', //'id8169918_admin', 
        '', //'kengurukenguru1',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
} catch (PDOException $e) {
    echo '<div class="alert alert-danger">';
    echo '<strong>Kļūda! Nevar savienoties ar datu bāzi</strong>';
    echo '</div>';
}
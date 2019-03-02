<?php
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=eshop', 
        'root',
        '',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
} catch (PDOException $e) {
    echo '<div class="alert alert-danger">';
    echo '<strong>Kļūda! Nevar savienoties ar datu bāzi</strong>';
    echo '</div>';
}

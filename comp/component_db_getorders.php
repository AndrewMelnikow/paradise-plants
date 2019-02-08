<?php
try {
    $stmt = $pdo->prepare('
                           SELECT * FROM orders
                           ORDER BY id DESC
                          ');
    $stmt->execute();
    $all_orders = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Vaicājuma izpildes kļūda: " . $e->getMessage();
}
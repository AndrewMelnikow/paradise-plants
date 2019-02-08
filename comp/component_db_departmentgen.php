<?php
try {
    $stmt = $pdo->prepare('
                           SELECT * FROM items
                           WHERE department = :item_department
                           AND is_visible = "yes"
                           ORDER BY item_id DESC
                          ');
    $_GET['name'] = filter_var(stripslashes($_GET['name']),FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $stmt->execute(['item_department' => $_GET['name']]);
    $items = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Vaicājuma izpildes kļūda: " . $e->getMessage();
}
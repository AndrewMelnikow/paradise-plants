<?php
try {
    $stmt = $pdo->prepare('
                           SELECT * FROM items
                           WHERE department = :item_department
                           AND item_id != :item_id
                           AND is_visible = "yes"
                           ORDER BY RAND() DESC
                           LIMIT 3
                          ');
    $stmt->execute(['item_id' => intval($_GET['id']),
                    'item_department' => $item['department']]);
    $items = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Vaicājuma izpildes kļūda: " . $e->getMessage();
}
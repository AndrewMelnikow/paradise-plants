<?php
try {
    $stmt = $pdo->prepare('
                           SELECT * FROM items
                           ORDER BY is_visible DESC
                          ');
    $stmt->execute();
    $items = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Vaicājuma izpildes kļūda: " . $e->getMessage();
}
foreach ($items as $item) {
    foreach ($item as $option => $value) {
        $option = filter_var(stripslashes($value),FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
}
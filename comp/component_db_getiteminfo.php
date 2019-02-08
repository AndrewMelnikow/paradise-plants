<?php
try {
    $stmt = $pdo->prepare('
                           SELECT * FROM items 
                           WHERE item_id = :item_id
                          ');
    $stmt->execute(['item_id' => intval($_GET['id'])]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Vaicājuma izpildes kļūda: " . $e->getMessage();
}

// This variables is used for JS script
$item_article = $item['article'];
if (isset($_SESSION['basket']['items'][$item['article']])) {
    $item_count_at_start = $_SESSION['basket']['items'][$item['article']];
} else {
    $item_count_at_start = 0;
}
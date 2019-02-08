<?php
try {
    $stmt = $pdo->prepare('
                           SELECT * FROM items 
                           WHERE article = :item_article
                          ');
    $stmt->execute(['item_article' => filter_var(stripslashes($_GET['search_article']),FILTER_SANITIZE_FULL_SPECIAL_CHARS)]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Vaicājuma izpildes kļūda: " . $e->getMessage();
}
    
if (!isset($item['article'])) exit("Kļūda! Tāda artikula neeksistē. <a href=\"admininventorysearch.php\">Atgriezties</a>");

foreach ($item as $option => $value) {
    $option = filter_var(stripslashes($value),FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}
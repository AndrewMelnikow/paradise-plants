<?php
if (!empty($_POST['submit'])) {
    require_once "model_orders.php";
    $order = new Order\CreateOrder($_POST);
    $order->filterData();
    $order->createClientInfo();
    $order->insertInDatabase();
    foreach ($_SESSION['basket']['items'] as $article => $ordered_count) {
            $item = $pdo->prepare('
                           SELECT * FROM items
                           WHERE article = :item_article
                          ');
            $item->execute(['item_article' => $article]);
            $item = $item->fetch(PDO::FETCH_ASSOC);
            $old_count = $item['item_count'];
            
            $article = filter_var(stripslashes($article), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $ordered_count = filter_var(stripslashes($ordered_count), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $query = "UPDATE items SET item_count = :item_count
                                    WHERE article = :item_article";
            $items = $pdo->prepare($query);
            $items->execute([
                               'item_article' => $article,
                               'item_count' => ($old_count - $ordered_count)
                            ]);
    }
    $order->unsetBasket();
    $order->redirect();
}
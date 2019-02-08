<?php
$files = glob('stat/items/*.{log}', GLOB_BRACE);
foreach($files as $file) {

    $f = fopen($file, "rt") or die;
    $data = fread ($f, filesize($file));

    $filename = basename($file, ".log").PHP_EOL;

    try {
        $stmt = $pdo->prepare('
                               SELECT * FROM items 
                               WHERE item_id = :item_id
                              ');
        $stmt->execute(['item_id' => $filename]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Vaicājuma izpildes kļūda: " . $e->getMessage();
    }

    echo "<tr>";
    echo "<td class=\"table-small\"><a href='item.php?id=" . $item['item_id'] . "&name=" . $item['name'] . "'>" . $item['name'] . "</a></td>";
    echo "<td class=\"table-small\">$data</td>";
    echo "</tr>";
    fclose($f);

    if (!isset($all_guests)) $all_guests = 0;
    $all_guests += $data;
}
echo "Preču apmeklējumi kopā: " . intval($all_guests);
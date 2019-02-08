<?php
try {
    $stmt = $pdo->prepare('
                           SELECT * FROM departments
                           ORDER BY is_visible
                          ');
    $stmt->execute();
    $deps = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Vaicājuma izpildes kļūda: " . $e->getMessage();
}
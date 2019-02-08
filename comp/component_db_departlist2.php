<?php
/* This file used by html-templates/header.php and html-templates/footer.php for generating list of departments */
try {
    $stmt = $pdo->prepare('
                           SELECT * FROM departments
                           WHERE is_visible = "yes"
                          ');
    $stmt->execute();
    $deps = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Vaicājuma izpildes kļūda: " . $e->getMessage();
}
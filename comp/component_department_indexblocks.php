<?php
$stmt = $pdo->prepare('
                       SELECT * FROM departments
                       WHERE is_visible = "yes"
                      ');
$stmt->execute();
$datas = $stmt->fetchAll();
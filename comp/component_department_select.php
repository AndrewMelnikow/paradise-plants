<?php
$stmt = $pdo->prepare('
                       SELECT * FROM departments
                      ');
$stmt->execute();
$datas = $stmt->fetchAll();
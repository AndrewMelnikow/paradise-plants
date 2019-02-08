<?php
require_once "component_nocache.php";
require_once "component_sessioncookie.php";
require_once "component_connectdb.php";

if ($_SESSION['user'] == 'admin') {
    require_once "model_department.php";    
    $newdep = new Department\AddDepartment($_POST['dep_name'], $_POST['dep_visible'], $_FILES['upload']);
    $newdep->filterName();
    $newdep->filterImage();
    $newdep->loadImage(); 
    $newdep->insertInDB();
} else {
    exit('Jums nav tiesību apskatīt šo lapu!');
}
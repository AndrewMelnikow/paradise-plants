<?php
if (!empty($_POST['edit_item'])) {
    require_once "comp/model_item.php";
    if ($_SESSION['user'] == 'admin') { 
        $edititem = new Item\EditItem($_POST['item'], $_FILES['file_upload']); 
        $edititem->checkInputData();
        $del_images = isset($_POST['del_images']) ? $_POST['del_images'] : null;
        $edititem->deleteSelectedImages($_POST['all_images'], $del_images);
        if (!empty($_FILES['file_upload']['name'][0])) {
            $edititem->imageHandler();
        }
        $edititem->insertInDB();
    } else {
        exit('Jums nav tiesību apskatīt šo lapu!');
    }
}
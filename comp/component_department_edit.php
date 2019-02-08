<?php
require_once(__DIR__ . '/vendor/autoload.php'); 
use \Gumlet\ImageResize;

if (!empty($_REQUEST['edit_department'])) {
    $session_user = filter_var(stripslashes($_SESSION['user']),FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if ($session_user == 'admin') {  

        try {

          foreach ($_POST['dep'] as $k => $v) {
              foreach ($v as $z) {

                  /* Check the input data */

                  if(!isset($_POST['dep'][$k]['name'])) exit("Nedrīkst atstāt tukšos laukumus");
                  if(!isset($_POST['dep'][$k]['visible'])) exit("Nedrīkst atstāt tukšos laukumus");
                  if(!isset($_POST['dep'][$k]['id'])) exit("Nedrīkst atstāt tukšos laukumus");
                  
                  /* Load changed images */
                  
                  if (!empty($_FILES['file_upload']['name'][$k])) {
                        $fileName  = $_FILES['file_upload']['name'][$k];
                        $filePath  = $_FILES['file_upload']['tmp_name'][$k];
                        $fileType  = $_FILES['file_upload']['type'][$k];
                        $errorCode = $_FILES['file_upload']['error'][$k];
    
                        if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {
                            $errorMessages = [
                                UPLOAD_ERR_NO_FILE    => "e[]=$fileName - Nav augšupielādēts attēls&",
                                UPLOAD_ERR_CANT_WRITE => "e[]=$fileName - Nesanāca ierakstīt failu&",
                                UPLOAD_ERR_EXTENSION  => "e[]=$fileName - PHP-paplašinājums apstādīja attēla augšupielādēšanu&",
                            ];
                            $unknownMessage = "e[]=$fileName - Nezināmā kļūda&";
                            $input_alert = null;
                            $input_alert .= isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;
                        }
    
                        $fi = finfo_open(FILEINFO_MIME_TYPE);
                        $mime = (string) finfo_file($fi, $filePath);
                        if (strpos($mime, 'image') === false) $input_alert .= "e[]=$fileName - Var augšupielādēt tikai attēlus&";
    
                        if (!isset($input_alert)) {
                            $image = getimagesize($filePath);
                            $limitWidth  = 500;
                            $limitHeight = 500;
                            if ($image[1] < $limitHeight)          $input_alert .= "e[]=Attēla $fileName augstumam ir jābūt lielākam par 500 pikseļiem&";
                            if ($image[0] < $limitWidth)           $input_alert .= "e[]=Attēla $fileName šaurumam ir jābūt lielākam par 500 pikseļiem&";
    
                            $file_name = md5_file($filePath);

                            $image = new ImageResize($filePath);
                            $image->resizeToHeight(500);
                            $image->crop(500, 500);
                            $image->save('images/departments/' . $file_name . '.jpg');
                            
                            $query = "UPDATE departments SET image = :image
                                      WHERE id = :dep_id";
                            $items = $pdo->prepare($query);
                            $items->execute([
                                       'image' => $file_name, 
                                       'dep_id' => filter_var(stripslashes($_POST['dep'][$k]['id']),FILTER_SANITIZE_FULL_SPECIAL_CHARS)
                                        ]);
                        }
                  }
    
                /* Update datas in database */
    
                $query = "UPDATE departments SET name = :dep_name, 
                                           is_visible = :dep_visible
                          WHERE id = :dep_id";
                $items = $pdo->prepare($query);
                $items->execute([
                               'dep_name' => filter_var(stripslashes($_POST['dep'][$k]['name']),FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                               'dep_visible' => filter_var(stripslashes($_POST['dep'][$k]['visible']),FILTER_SANITIZE_FULL_SPECIAL_CHARS), 
                               'dep_id' => filter_var(stripslashes($_POST['dep'][$k]['id']),FILTER_SANITIZE_FULL_SPECIAL_CHARS)
                                ]);
                  
              }
          }

          header("Location: admindepartments.php");

        } catch (PDOException $e) {
          echo "Vaicājuma izpildes kļūda: " . $e->getMessage();
        }

    } else {
        exit('Jums nav tiesību apskatīt šo lapu!');
    }
}
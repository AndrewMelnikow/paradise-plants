<?php
namespace Department;
class AddDepartment
{
    private $dep_name, $file_path, $file_name, $file_type, $file_errorcode, $input_error;
    
    
    public function __construct($dep_name, $dep_visible, $file)
    {
        $this->dep_name = filter_var(stripslashes($dep_name),FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $this->file_name = $file['name'];
        $this->file_path = $file['tmp_name'];
        $this->file_type = $file['type'];
        $this->file_errorcode = $file['error'];
    }
    
    public function filterName()
    {
        if (empty($this->dep_name)) $this->input_error .= 'emptyname&';
    }
    
    public function filterImage()
    {
        if ($this->file_errorcode !== UPLOAD_ERR_OK || !is_uploaded_file($this->file_path)) {
            $error_messages = [
                UPLOAD_ERR_NO_FILE    => 'Nav augšupielādēts attēls',
                UPLOAD_ERR_CANT_WRITE => 'Nesanāca ierakstīt failu',
                UPLOAD_ERR_EXTENSION  => 'PHP-paplašinājums apstādīja attēla augšupielādēšanu',
            ];
            $unknown_message = 'Nezināmā kļūda';
            $output_message = isset($error_messages[$this->file_errorcode]) ? $error_messages[$this->file_errorcode] : $unknown_message;
            $this->input_error .= "fileerror=$output_message&";
            
            if (empty($this->file_path)) {
                return 'no';
            }
      }
         
    }
    
    public function loadImage()
    {
        if (!empty($this->file_path)) {
            $fi = finfo_open(FILEINFO_MIME_TYPE);
            $mime = (string) finfo_file($fi, $this->file_path);
            if (strpos($mime, 'image') === false) $this->input_error .= 'filetypeerror&';
            $image = getimagesize($this->file_path);
            $limitWidth  = 500;
            $limitHeight = 500;
            if ($image[1] < $limitHeight) $this->input_error .= 'imageheighterror&';
            if ($image[0] < $limitWidth) $this->input_error .= 'imagewidtherror&';
            $this->file_name = md5_file($this->file_path);
            require_once "component_department_image_resize.php";
        }
    }
    
    public function insertInDB()
    {
        if (!empty($this->file_path)) {
            global $pdo;
            $query = "INSERT INTO departments VALUES (
                                                  NULL, 
                                                  :dep_name, 
                                                  :dep_image_path,
                                                  :dep_visible
                                                  )";
            $items = $pdo->prepare($query);
            $items->execute([
                             'dep_name' => filter_var(stripslashes($this->dep_name),FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                             'dep_image_path' => $this->file_name, 
                             'dep_visible' => filter_var(stripslashes($this->dep_visible),FILTER_SANITIZE_FULL_SPECIAL_CHARS)]);
        }
        header("Location: ../admindepartments.php?$this->input_error");
    }
}  
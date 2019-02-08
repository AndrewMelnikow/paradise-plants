<?php
namespace Item;
use \DateTime;
class Item
{
    protected $item_prop; 
    protected $input_alert;
    protected $img_array; 
    
    public function __construct($item_prop)
    {
        $this->item_prop = $item_prop;
    }
    
    public function checkInputData()
    {
        
        /* Filter the input data */
        foreach ($this->item_prop as $prop => $val) {
            $this->item_prop["$prop"] = filter_var
                (stripslashes($val),FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (strlen($this->item_prop["$prop"]) > 64) {
                $this->input_alert .= 'e[]=Visiem laukumiem jāsatur ne vairāk par 64 simboliem&';
            }
        }
        if (empty($this->item_prop['name'])) 
            $this->input_alert .= 'e[]=Laukam "Nosaukums" jāsatur 1-64 simbolu&';
        if (empty($this->item_prop['article'])) 
            $this->input_alert .= 'e[]=Laukam "Artikuls" jāsatur 1-64 simbolu&';
        if (!is_numeric($this->item_prop['price'])||($this->item_prop['price']) <= 0) 
            $this->input_alert .= 'e[]=Laukam "Cena" jāsatur skaitli&';
        if (!(empty($this->item_prop['discount_price']) && empty($this->item_prop['discount_price_time_start']) && empty($this->item_prop['discount_price_time_end'])) && !((!empty($this->item_prop['discount_price']) && !empty($this->item_prop['discount_price_time_start']) && !empty($this->item_prop['discount_price_time_end'])))) 
            $this->input_alert .= 'e[]=Laukiem "Akcijas cenas termiņa sākums" un "beigas" jābūt aizpildītiem, ja lauks "Akcijas cena" ir aizpildīts&';
        if (!is_numeric($this->item_prop['count'])) 
            $this->input_alert .= 'e[]=Laukam "Daudzums" jāsatur veselo skaitli&';
        
    }
    
}
class AddItem extends Item
{
    private $images;
    
    public function uploadImages($images)
    {
        $this->images = $images;
    }
    
    public function imageHandler()
    {
        if (count($this->images['name']) > 6) {
            $this->input_alert .= 'e[]=Maksimālais attēlu skaits - 6';
        } else {
            foreach ($this->images['name'] as $images => $image) {                
                $fileName  = $this->images['name'][$images];
                $filePath  = $this->images['tmp_name'][$images];
                $fileType  = $this->images['type'][$images];
                $errorCode = $this->images['error'][$images];
                if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {
                    $errorMessages = [
                        UPLOAD_ERR_NO_FILE    => "e[]=$fileName - Nav augšupielādēts attēls&",
                        UPLOAD_ERR_CANT_WRITE => "e[]=$fileName - Nesanāca ierakstīt failu&",
                        UPLOAD_ERR_EXTENSION  => "e[]=$fileName - PHP-paplašinājums apstādīja attēla augšupielādēšanu&",
                    ];
                    $unknownMessage = "e[]=$fileName - Nezināmā kļūda&";
                    $this->input_alert .= isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;
                }
                $fi = finfo_open(FILEINFO_MIME_TYPE);
                $mime = (string) finfo_file($fi, $filePath);
                if (strpos($mime, 'image') === false) $this->input_alert .= "e[]=$fileName - Var augšupielādēt tikai attēlus&";
                if (!isset($this->input_alert)) {
                    $image = getimagesize($filePath);
                    $limitWidth  = 500;
                    $limitHeight = 500;
                    if ($image[1] < $limitHeight)          $this->input_alert .= "e[]=Attēla $fileName augstumam ir jābūt lielākam par 500 pikseļiem&";
                    if ($image[0] < $limitWidth)           $this->input_alert .= "e[]=Attēla $fileName šaurumam ir jābūt lielākam par 500 pikseļiem&";
                    $file_name = md5_file($filePath);
                    require "comp/component_image_resize.php";
                    $this->img_array[] .= $file_name;   
                }
            }
        }     
    }
    
    public function insertInDB()
    {
        if (!isset($this->input_alert)) {
            global $pdo;
            $img_array = serialize($this->img_array);
            /* Insert datas in database */
            $query = "INSERT INTO items VALUES (
                                                NULL, 
                                                :item_article,
                                                :item_name, 
                                                :item_descr,
                                                :item_image_path,
                                                :item_collection,
                                                :item_dimensions,
                                                :item_color,
                                                :item_material,
                                                :item_department,
                                                :item_price,
                                                :item_discount_price,
                                                :item_discount_price_time_start,
                                                :item_discount_price_time_end,
                                                :item_count,
                                                :item_is_visible
                                                )";
            $items = $pdo->prepare($query);
            $items->execute([
                           'item_article' => $this->item_prop['article'],
                           'item_name' => $this->item_prop['name'],
                           'item_descr' => $this->item_prop['descr'], 
                           'item_image_path' => $img_array, 
                           'item_collection' => $this->item_prop['collection'],
                           'item_dimensions' => $this->item_prop['dimensions'], 
                           'item_color' => $this->item_prop['color'], 
                           'item_material' => $this->item_prop['material'], 
                           'item_department' => $this->item_prop['department'], 
                           'item_price' => $this->item_prop['price'],
                           'item_discount_price' => $this->item_prop['discount_price'],
                           'item_discount_price_time_start' => $this->item_prop['discount_price_time_start'],
                           'item_discount_price_time_end' => $this->item_prop['discount_price_time_end'], 
                           'item_count' => $this->item_prop['count'],
                           'item_is_visible' => $this->item_prop['is_visible']]);               
            header("Location: adminadditem.php?success");
        } else {
            $itemprops = null;
            foreach ($this->item_prop as $v) {
                $itemprops .= "p[]=$v&";
            }
            header("Location: adminadditem.php?$this->input_alert&$itemprops");
        }
    }
}
class EditItem extends Item
{
    
    private $new_images;
    
    public function __construct($item_prop, $new_images)
    {
        parent::__construct($item_prop);
        $this->new_images = $new_images;
    }
    
    public function deleteSelectedImages($all_images, $del_images = null)
    {      
        if (count($all_images) - count($del_images) == 0) {
            $this->input_alert .= 'e[]=Minimālais attēlu skaits - 1';
        } else {
            foreach ($all_images as $k => $v) { 
                if (empty($del_images[$k])) {
                    $this->img_array[] .= $k; 
                }
            }
        }
    }
    
    public function imageHandler()
    {
        if (count($this->new_images['name']) > 6 - count($this->img_array)) {
            $this->input_alert .= 'e[]=Maksimālais attēlu skaits - 6';
        } else {
            foreach ($this->new_images['name'] as $images => $image) {                
                $fileName  = $this->new_images['name'][$images];
                $filePath  = $this->new_images['tmp_name'][$images];
                $fileType  = $this->new_images['type'][$images];
                $errorCode = $this->new_images['error'][$images];
                if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {
                    $errorMessages = [
                        UPLOAD_ERR_NO_FILE    => "e[]=$fileName - Nav augšupielādēts attēls&",
                        UPLOAD_ERR_CANT_WRITE => "e[]=$fileName - Nesanāca ierakstīt failu&",
                        UPLOAD_ERR_EXTENSION  => "e[]=$fileName - PHP-paplašinājums apstādīja attēla augšupielādēšanu&",
                    ];
                    $unknownMessage = "e[]=$fileName - Nezināmā kļūda&";
                    $this->input_alert .= isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;
                }
                $fi = finfo_open(FILEINFO_MIME_TYPE);
                $mime = (string) finfo_file($fi, $filePath);
                if (strpos($mime, 'image') === false) $this->input_alert .= "e[]=$fileName - Var augšupielādēt tikai attēlus&";
                if (!isset($this->input_alert)) {
                    $image = getimagesize($filePath);
                    $limitWidth  = 500;
                    $limitHeight = 500;
                    if ($image[1] < $limitHeight)          $this->input_alert .= "e[]=Attēla $fileName augstumam ir jābūt lielākam par 500 pikseļiem&";
                    if ($image[0] < $limitWidth)           $this->input_alert .= "e[]=Attēla $fileName šaurumam ir jābūt lielākam par 500 pikseļiem&";
                    $file_name = md5_file($filePath);
                    require "comp/component_image_resize.php";
                    $this->img_array[] .= $file_name; 
                }
            }
        }               
    }
    
    public function insertInDB()
    {
        if (!isset($this->input_alert)) {
            global $pdo;
            $img_array = serialize($this->img_array);
            
            /* Insert datas in database */
            $query = "UPDATE items SET name = :item_name, 
                                       description = :item_descr,
                                       image_path = :item_image_path,
                                       collection = :item_collection,
                                       dimensions = :item_dimensions,
                                       color = :item_color,
                                       material = :item_material,
                                       department = :item_department,
                                       price = :item_price,
                                       discount_price = :item_discount_price,
                                       discount_price_time_start = :item_discount_price_time_start,
                                       discount_price_time_end = :item_discount_price_time_end,
                                       item_count = :item_count,
                                       is_visible = :item_is_visible
                      WHERE article = :item_article";
            $items = $pdo->prepare($query);
            $items->execute([
                               'item_article' => $this->item_prop['article'],
                               'item_name' => $this->item_prop['name'],
                               'item_descr' => $this->item_prop['descr'], 
                               'item_image_path' => $img_array, 
                               'item_collection' => $this->item_prop['collection'],
                               'item_dimensions' => $this->item_prop['dimensions'], 
                               'item_color' => $this->item_prop['color'], 
                               'item_material' => $this->item_prop['material'], 
                               'item_department' => $this->item_prop['department'], 
                               'item_price' => $this->item_prop['price'],
                               'item_discount_price' => $this->item_prop['discount_price'],
                               'item_discount_price_time_start' => $this->item_prop['discount_price_time_start'],
                               'item_discount_price_time_end' => $this->item_prop['discount_price_time_end'], 
                               'item_count' => $this->item_prop['count'],
                               'item_is_visible' => $this->item_prop['is_visible']]);
            header("Location: admininventorysearch.php?success");
        } else {
            $itemprops = null;
            foreach ($this->item_prop as $v) {
                $itemprops .= "p[]=$v&";
            }
            header("Location: admininventory.php?search_article=" . $this->item_prop['article']  . "&search_submit=go&$this->input_alert&$itemprops");
        }
    }
    
}
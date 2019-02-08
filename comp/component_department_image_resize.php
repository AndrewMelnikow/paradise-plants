<?php
/* This composer used for resize images */
require_once(__DIR__ . '/vendor/autoload.php'); 
use \Gumlet\ImageResize;
$image = new ImageResize($this->file_path);
$image->resizeToHeight(500);
$image->crop(500, 500);
$image->save('../images/departments/' . $this->file_name . '.jpg');
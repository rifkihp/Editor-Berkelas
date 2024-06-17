<?php
    $root = "../";
    include $root."includes/php/initial.php";
    
    $url = realpath($root).str_replace(HOME_URL, "", $_GET['url']);
    $new_height = $_GET['height'];
    $new_width = $_GET['width'];
    
    $ext = strtolower(substr($url, strrpos($url, '.') + 1));
    header("content-type: image/".$ext);
    
    if($ext=="gif") {
        $image = imagecreatefromgif($url);
    } else if($ext=="png") {
        $image = imagecreatefrompng($url);
    } else if($ext=="jpg" OR $ext=="jpeg") {
        $image = imagecreatefromjpeg($url);
    }
        
    // Load
    $thumb = imagecreatetruecolor($new_width, $new_height);
    imagealphablending($thumb, false);
    imagesavealpha($thumb, true);
    
    /***** kalo mau transparant *********/
    $transparent = imagecolorallocatealpha($thumb, 255, 255, 255, 127);
    imagefilledrectangle($thumb, 0, 0, $new_width, $new_height, $transparent);
    /******************************/
    
    /*** untuk kasih background ***/
    //$backgroundColor = imagecolorallocate($thumb, 234, 232, 232);
    //imagefill($thumb, 0, 0, $backgroundColor);
    /******************************/
    
    $orig_width = imagesx($image);
    $orig_height = imagesy($image);
    
    if ($orig_width > $orig_height) {
        $percent = ($new_width / $orig_width);
    } else {
        $percent = ($new_height / $orig_height);
    }
    
    $width = ceil($orig_width * $percent);
    $height = ceil($orig_height * $percent);
    
    $x = 0;
    if($width<$new_width) {
        $x = ceil(($new_width-$width)/2);
    }
    
    $y = 0;
    if($height<$new_width) {
        $y = ceil(($new_width-$height)/2);
    }
    imagecopyresized($thumb, $image, $x, $y, 0, 0, $width, $height, $orig_width, $orig_height);
    
    imagejpeg($thumb);
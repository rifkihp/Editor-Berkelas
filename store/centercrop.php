<?php
    $root = "../";
    include $root."includes/php/initial.php";
    
    $url = realpath($root).str_replace(HOME_URL, "", $_GET['url']);
    $new_height = $_GET['height'];
    $new_width = $_GET['width'];
    
    $ext = strtolower(substr($url, strrpos($url, '.') + 1));
    
    if($ext=="gif") {
        $image = imagecreatefromgif($url);
    } else if($ext=="png") {
        $image = imagecreatefrompng($url);
    } else if($ext=="jpg" OR $ext=="jpeg") {
        $image = imagecreatefromjpeg($url);
    }
     
    $orig_width = imagesx($image);
    $orig_height = imagesy($image);
    
    $width = $new_width;
    $height = $new_height;
    
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
    
    /*if ($orig_width > $orig_height) {
        $percent = ($new_width / $orig_width);
    } else {
        $percent = ($new_height / $orig_height);
    }
    
    $width = ceil($orig_width * $percent);
    $height = ceil($orig_height * $percent);
    
    
    $x = ceil(($new_width-$width)/2);
    $y = ceil(($new_width-$height)/2);
    */
    
    imagecopyresized($thumb, $image, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);
    $color = imagecolorallocate($thumb, 255, 255, 255);
    $x1 = 0;
    $y1 = 0;
    $x2 = ImageSX($thumb) - 1;
    $y2 = ImageSY($thumb) - 1;

    for($i = 0; $i < 1; $i++) {
        ImageRectangle($thumb, $x1++, $y1++, $x2--, $y2--, $color);
    }


    
    header('Content-Type: image/jpeg');
    imagejpeg($thumb, NULL, 100);
    imagedestroy($thumb);


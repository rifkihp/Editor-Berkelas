<?php
    $root = "../";
    include $root."includes/php/initial.php";
    
    $url = realpath($root).str_replace(HOME_URL, "", $_GET['url']);
    $height = $_GET['height'];
    $width_set = $_GET['width'];
    
    $ext = strtolower(substr($url, strrpos($url, '.') + 1));
    header("content-type: image/".$ext);
    
    if($ext=="gif") {
        $image = imagecreatefromgif($url);
    } else if($ext=="png") {
        $image = imagecreatefrompng($url);
    } else if($ext=="jpg" OR $ext=="jpeg") {
        $image = imagecreatefromjpeg($url);
    }
        
    $orig_width = imagesx($image);
    $orig_height = imagesy($image);

    //Calc the new height
    //$height = (($orig_height * $width) / $orig_width);
    $width = (($orig_width * $height) / $orig_height);
    
    // Create new image to display
    $new_image = imagecreatetruecolor($width, $height);

    // Create new image with changed dimensions
    imagecopyresampled($new_image, $image,
        0, 0, 0, 0,
        $width, $height,
        $orig_width, $orig_height
    );

    $new_new_image = imagecreatetruecolor($width_set, $height);

    // Create new image with changed dimensions
    imagecopyresampled($new_new_image, $new_image,
        0, 0, ($width-$width_set)/2, 0,
        $width, $height,
        $width, $height
    );

    // Print image
    imagejpeg($new_new_image);
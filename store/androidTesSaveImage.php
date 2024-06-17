<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    $db = new classUtama();
    $db->mysql_connect(true);
    
    
    $_user_picture = "https://graph.facebook.com/1902381803325281/picture?type=large&redirect=false";
    $context = stream_context_create(array("http"=>array(
        "method" => "GET",
        "header" => "Accept: xml/*, text/*, */*\r\n",
        "ignore_errors" => false,
        "timeout" => 50,
    )));

    print "aaa  ".file_get_contents($_user_picture, false, $context, 0, 1000);
    
    
    $image = json_decode(file_get_contents($_user_picture), true);
    foreach ($image as $key => $value) {
        echo($key . "11<br />");
    }
    //die(print_r($image));
    
    $_photo = "default.png";
    if(strlen($_user_picture)>0) {
        $upload_directory = realpath($root) . "/uploads/member";
        $_photo = $db->create_kode_unik().'.jpg';
        
        file_put_contents($upload_directory."/".$_photo, file_get_contents($image['data']['url']));
    }
    
    
    die(json_encode(array("success" => true, "message" => $image['data']['url'])));
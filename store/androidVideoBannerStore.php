<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $_limit     = 10;
    $_page      = $_POST["page"];
    $_id_banner = $_POST["category"];

    $filter = array("A.is_aktif"=>1, "B.id_banner" => $_id_banner);
    
    $data = $db->getFieldValue("video_to_banner AS B LEFT JOIN video AS A ON A.id=B.id_video", array("A.id", "A.videoId", "A.title", "A.duration"), $filter, array(), $_limit, $_limit*($_page-1), " A.id DESC "); 
    $db->mysql_close();
     
    $result = array(
        "topics" => $data,
        "next_page" => $_page+(count($data)==0?0:1)
    );
    
    die(json_encode($result));
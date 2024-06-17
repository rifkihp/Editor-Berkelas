<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $_limit    = 10;
    $_page     = $_POST["page"];
    $_id_grup  = $_POST["category"];

    $filter = array();
    if($_id_grup==1) {
        $filter = array("A.is_aktif"=>1, "A.culture" => 1);
    } else 
    if($_id_grup==2) {
        $filter = array("A.is_aktif"=>1, "A.politics" => 1);
    } else 
    if($_id_grup==3) {
        $filter = array("A.is_aktif"=>1, "A.entertainment" => 1);
    } else 
    if($_id_grup==4) {
        $filter = array("A.is_aktif"=>1, "A.`others`" => 1);
    }
    
    $data = $db->getFieldValue("video AS A", array("A.id", "A.videoId", "A.title", "A.duration"), $filter, array(), $_limit, $_limit*($_page-1), " A.id DESC "); 
    $db->mysql_close();
     
    $result = array(
        "topics" => $data,
        "next_page" => $_page+(count($data)==0?0:1)
    );
    
    die(json_encode($result));
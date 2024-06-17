<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $_limit    = 10;
    $_page     = $_POST["page"];
    $_id_grup  = $_POST["id_grup"];

    $filter = array();
    if($_id_grup==1) {
        $filter = array("A.is_aktif"=>1, "A.tv_show" => 1);
    } else 
    if($_id_grup==2) {
        $filter = array("A.is_aktif"=>1, "A.movies" => 1);
    }
    
    $data = $db->getFieldValue("video AS A", array("A.id", "A.videoId", "A.title", "A.tanggal", "A.konten", "A.link_download", "A.banner", "A.duration"), $filter, array(), $_limit, $_limit*($_page-1), " A.id DESC "); 
    foreach($data as $key => $value) {
        $data[$key]["tanggal"] = $db->dateDiff(date("Y-m-d H:i:s"), $value["tanggal"]);
    }
    $db->mysql_close();
     
    $result = array(
        "topics" => $data,
        "next_page" => $_page+(count($data)==0?0:1)
    );
    
    die(json_encode($result));
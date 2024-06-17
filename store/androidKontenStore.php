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
        $filter = array("A.is_aktif"=>1, "A.tabpanel_1" => 1);
    } else 
    if($_id_grup==2) {
        $filter = array("A.is_aktif"=>1, "A.tabpanel_2" => 1);
    } else 
    if($_id_grup==3) {
        $filter = array("A.is_aktif"=>1, "A.tabpanel_3" => 1);
    } else 
    if($_id_grup==4) {
        $filter = array("A.is_aktif"=>1, "A.tabpanel_4" => 1);
    } else 
    if($_id_grup==5) {
        $filter = array("A.is_aktif"=>1, "A.tabpanel_5" => 1);
    } else 
    if($_id_grup==6) {
        $filter = array("A.is_aktif"=>1, "A.tabpanel_6" => 1);
    }
    
    $data = $db->getFieldValue("konten AS A", array(
        "A.id", 
        "A.title", 
        "A.tanggal_create", 
        "A.konten", 
        "A.link_download AS download",
        "A.banner", 
        "A.thumbnail",
        "A.videoId", 
        "A.duration"
    ), $filter, array(), $_limit, $_limit*($_page-1), " A.id DESC "); 
    foreach($data as $key => $value) {
        $data[$key]["tanggal"] = $db->dateDiff(date("Y-m-d H:i:s"), $value["tanggal_create"]);
        $data[$key]["konten"]  = preg_replace( "/\r|\n/", "", $value["konten"]);
    }
    $db->mysql_close();
     
    $result = array(
        "topics" => $data,
        "next_page" => $_page+(count($data)==0?0:1)
    );
    
    die(json_encode($result));
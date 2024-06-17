<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $_limit    = 10;
    $_page     = $_POST["page"];
    $_id_cat   = $_POST["category"];

    $filter = array("A.is_aktif"=>1, "B.id_kategori" => $_id_cat);
    
    $data = $db->getFieldValue("konten_to_category AS B LEFT JOIN konten AS A ON A.id=B.id_konten", array(
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
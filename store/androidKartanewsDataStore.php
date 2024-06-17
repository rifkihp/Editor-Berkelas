<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $_limit    = 10;
    $_page     = $_POST["page"];
    
    $data = $db->getFieldValue("kartanews AS A", array("A.id", "DATE_FORMAT(A.tanggal, '%d.%m.%Y') AS tanggal", "A.judul", "A.konten", "A.gambar"), array(), array(), $_limit, $_limit*($_page-1), " A.tanggal DESC "); 
    foreach($data as $key => $value) {
        $data[$key]["header"]  = preg_replace( "/\r|\n/", "", $db->limitTextKonten($value["konten"], 90));
        $data[$key]["konten"]  = "";
    } 
    $db->mysql_close();
     
    $result = array(
        "topics" => $data,
        "next_page" => $_page+(count($data)==0?0:1)
    );
    
    die(json_encode($result));
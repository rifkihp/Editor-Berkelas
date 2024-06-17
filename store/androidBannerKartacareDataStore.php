<?php
    $root = "../";
    include $root."includes/php/initial.php";    
    include $root."includes/php/classUtama.php";
        
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
           
    $data_banner = $db->getFieldValue("kartacare_gambar", array("id", "nama_file AS nama", "urutan AS kategori", "nama_file AS banner"), array("id_kartacare" => $_POST["id_kartacare"]));
    
    $db->mysql_close();
    die(json_encode(array(
        "banner" => $data_banner
    )));
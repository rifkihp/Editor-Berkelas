<?php
    $root = "../";
    include $root."includes/php/initial.php";    
    include $root."includes/php/classUtama.php";
        
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);

    $data_banner   = $db->getFieldValue("banner", array("id", "nama", "id_kategori AS kategori", "filename AS banner"), array("is_aktif" => "Y"));
    $data_kategori = $db->getFieldValue("category", array("id", "nama", "header"), array(), array(), 0, 0, "id");
    $data_tabmenu  = $db->getFieldValue("tabpanel", array("id", "nama"), array("is_aktif" => 1));
    $data_header   = $db->getFieldValue("umum", array("judul", "tagline subjudul", "website subscribe"));
    
    $db->mysql_close();

    $result = array( 
        "banner"   => $data_banner, 
        "category" => $data_kategori, 
        "tabpanel"  => $data_tabmenu,
        "header"   => $data_header[0]
    );
        
    die(json_encode($result));
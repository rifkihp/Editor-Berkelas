<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $data = array(
        array("id" => 1, "nama" => "Bayar Listrik", "header" => "Bayar_Listrik.png"),
        array("id" => 2, "nama" => "Telepon Pascabayar", "header" => "Telepon.png"),
        array("id" => 3, "nama" => "P D A M", "header" => "PDAM.png"),
        array("id" => 4, "nama" => "TV Berlangganan", "header" => "TV_Kabel.png"),
        array("id" => 5, "nama" => "Finance", "header" => "Finance.png"),
        array("id" => 6, "nama" => "B P J S", "header" => "BPJS.png"),
        array("id" => 7, "nama" => "Donasi", "header" => "Donasi.png")
        
    );    
        
    $db->mysql_close();
     
    $rasult = array(
        //"banner" => $data_banner, 
        "topics" => $data
    );
    
    die(json_encode($rasult));
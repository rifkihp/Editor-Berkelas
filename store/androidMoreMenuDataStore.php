<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $data_menu = $db->getFieldValue("menu_page AS A", array("A.id", "A.id AS kode", "A.judul AS nama", "A.img_src AS image"), array("A.posisi" => "TM", "A.is_aktif" => "Y"), array(),0, 0, "A.urutan " );
    $db->mysql_close();
    
    die(json_encode(array("totalCount" => count($menu), "topics" => $data_menu)));
<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $detail = $db->getFieldValue("menu_page AS A", array("A.konten"), array("A.id" => $_POST["id_menu"]));
    $db->mysql_close();
    
    die(json_encode(array("detail" => $detail[0]["konten"])));
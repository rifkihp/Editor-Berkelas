<?php
    $root = "../";
    include $root."includes/php/initial.php";    
    include $root."includes/php/classUtama.php";
        
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $result = array("topics" => $db->getFieldValue("ekspedisi", array("id", "kode", "nama"), array("is_aktif" => 'Y')));
    $db->mysql_close();

    die(json_encode($result));
<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    $db = new classUtama();
    $db->mysql_connect();
    
    if(!isset($_SESSION[SESSION_NAME])) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Kesalahan login! Silahkan logout.")));
    }
    
    $sql = "SELECT * FROM mokes_iklan WHERE aktif='1' ORDER BY RAND() LIMIT 1";
    $db->mysql_query($sql, $rec_count, $iklan);
    $db->mysql_close();
    
    die(json_encode(array("success" => $rec_count>0, "iklan" => $iklan[0])));
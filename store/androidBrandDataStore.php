<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $data = $db->getFieldValue("brands", array("id", "kode", "nama", "logo"));
    $db->mysql_close();
     
    $rasult = array(
        "topics" => $data
    );
    
    die(json_encode($rasult));
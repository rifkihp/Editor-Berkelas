<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $data = $db->getFieldValue("category AS A", array("A.id", "A.nama", "A.header"), array(), array(), 0, 0, "A.id");    
    $db->mysql_close();
     
    $rasult = array(
        "topics" => $data
    );
    
    die(json_encode($rasult));
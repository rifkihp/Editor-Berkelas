<?php
    $root = "../";
    include $root."includes/php/initial.php";    
    include $root."includes/php/classUtama.php";
        
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $data = $db->getFieldValue("umum AS A", array("A.syarat_kondisi AS term_kondisi"), array("id" => 1));
    $db->mysql_close();
    
    die(json_encode($data[0]));
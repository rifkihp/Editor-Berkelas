<?php
    $root = "../";
    include $root."includes/php/initial.php";    
    include $root."includes/php/classUtama.php";
        
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $user_id = $_POST["user_id"];
    $sort_by   = $_POST["sort_by"];
    
    $alamat = $db->getFieldValue("customer_address", array("*"), array("id_member" => $user_id), array(), 0, 0, ($sort_by==2?"nama DESC":"nama ASC"));
    
    $db->mysql_close();
    die(json_encode(array("topics" => $alamat)));
<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama(CLIENT_SESSION_NAME);
    $db->mysql_connect(true);
    $data_alamat = $db->getFieldValue("customer_address", array("*"), array("id" => $_POST["id"]));
    
    $db->mysql_close();
    die(json_encode(array("alamat" => $data_alamat[0])));
<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $data = $db->getFieldValue("umum", array("logo", "bg", "app_ver_no", "app_ver_name", "app_desc", "landing_page"));
    $db->mysql_close();
    
    echo(json_encode($data[0]));
<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    //id banner update
    $id = $_POST["id"];
    $status = $_POST["status"];
    //update data banner
    $db->mysql_update(
        "mafellas_template_widget_right", 
        array("aktif" => $status), 
        array("id" => $id)
    );
        
    $db->mysql_close();
    die(json_encode(array("success" => true, "message" => "Ganti status ".($status==1?"aktif":"non aktif")." berhasil.")));
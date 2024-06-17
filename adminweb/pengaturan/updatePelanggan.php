<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    //update data pengaturan
    $db->mysql_update("umum", $_POST);
    
    $db->mysql_close();
    die(json_encode(array("success" => true, "message" => "Update pengaturan registrasi pelanggan berhasil.")));
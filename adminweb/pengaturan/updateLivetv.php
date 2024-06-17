<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    //validasi-validasi
    if(strlen($_POST["videoId"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Video ID harus diisi.")));
    }
    
    //update data pengaturan
    $db->mysql_update("livetv", $_POST);
    
    $db->mysql_close();
    die(json_encode(array("success" => true, "message" => "Update Live TV berhasil.")));
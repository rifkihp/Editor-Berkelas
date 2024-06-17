<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    
        
    $db->mysql_close();
    $_SESSION["alert_success"] = "Hapus data halaman menu berhasil.";
    die(json_encode(array("success" => true, "message" => "Hapus data halaman menu berhasil.")));
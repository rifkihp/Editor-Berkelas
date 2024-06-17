<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    $id = explode(",", $_POST["id"]);    
    $db->mysql_delete("usergrup", array("id" => $id));
    $db->mysql_delete("usergrup_modul_akses", array("idgrup" => $id));
    $db->mysql_close();
        
    $_SESSION["alert_success"] = "Hapus data jenis user berhasil.";
    die(json_encode(array("success" => true, "message" => "Hapus data jenis user berhasil.")));
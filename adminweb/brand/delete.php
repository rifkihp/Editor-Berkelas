<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    //id brand transfer
    $id = explode(",", $_POST["id"]);
    $data = $db->getFieldValue("brand", array("logo"), array("id" => $id));
    foreach ($data as $key => $value) {    
        if(file_exists(realpath($root)."/uploads/brand/".$value["logo"])) {
            unlink(realpath($root)."/uploads/brand/".$value["logo"]);
        }
    }
    $db->mysql_delete("brand", array("id" => $id));
        
    $db->mysql_close();
    $_SESSION["alert_success"] = "Hapus data brand berhasil.";
    die(json_encode(array("success" => true, "message" => "Hapus data brand berhasil.")));
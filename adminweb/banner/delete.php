<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    //id banner
    $id = explode(",", $_POST["id"]);
    $data = $db->getFieldValue("banner", array("filename", "gambar"), array("id" => $id));
    
    foreach ($data as $key => $value) {    
        if(file_exists(realpath($root)."/uploads/banner/".$value["gambar"])) {
            unlink(realpath($root)."/uploads/banner/".$value["gambar"]);
        }

        if(file_exists(realpath($root)."/uploads/banner/".$value["filename"])) {
            unlink(realpath($root)."/uploads/banner/".$value["filename"]);
        }
    }
    $db->mysql_delete("banner", array("id" => $id));
        
    $db->mysql_close();
    $_SESSION["alert_success"] = "Hapus banner berhasil.";
    die(json_encode(array("success" => true, "message" => "Hapus banner berhasil.")));
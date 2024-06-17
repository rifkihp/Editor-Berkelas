<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    //validasi-validasi
    if(strlen($_POST["old_password"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Password lama harus diisi.")));
    }
    
    if(strlen($_POST["new_password"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Password baru harus diisi.")));
    }
    
    if(strlen($_POST["new_password"])<6) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Password baru minimal 6 digit.")));
    }
    
    if($_POST["new_password"]!=$_POST["konfirmasi_password"]) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Konfirmasi password tidak benar.")));
    }
    
    $data = $db->getFieldValue(
        "user", 
        array("*"), 
        array(
            "id" => $_SESSION[ADMIN_SESSION_NAME]["user"]["id"],
            "password" => $db->acakpassword($_POST["old_password"])
        )
    );
    
    if(count($data)==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Password lama tidak benar.")));
    }
        
    if($_SESSION[ADMIN_SESSION_NAME]["user"]["id"]==$data[0]["id"] && $db->acakpassword($_POST["old_password"])==$data[0]["password"]) {
        $db->mysql_update("user", array("password" => $db->acakpassword($_POST["new_password"])), array("id" => $_SESSION[ADMIN_SESSION_NAME]["user"]["id"]));
    
        $db->mysql_close();
        die(json_encode(array("success" => true, "message" => "Proses ganti password berhasil.")));    
    } else {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Password lama tidak benar.")));    
    }
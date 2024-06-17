<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $id_member = $_POST["id_user"];
    $old_pass   = $_POST["password_lama"];
    $password   = $_POST["password_baru"];
    $konfirmasi = $_POST["password_konf"];
    
        
    if(strlen($password)==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Password harus diisi!")));
    } else
    if(strlen($password)<6) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Password baru minimal harus 6 karakter.")));
    }
    
    if($password!=$konfirmasi) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Konfirmasi tidak cocok!")));
    } 
    
    $db->mysql_update("member", array(
        "password" => $db->acakpassword($password),
    ), array(
        "id" => $id_member
    ));
    
    $db->mysql_close(); 
    die(json_encode(array("success" => true, "message" => array("Proses ganti password berhasil!"))));
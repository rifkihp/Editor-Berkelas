<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $id_member = $_POST["id_user"];
    $_message = array();
    $data_user = $db->getFieldValue("member AS A LEFT JOIN jenis_user AS B ON B.id=A.jenis_user", array("A.id", " A.first_name", " A.last_name", "A.email", "A.phone", "B.nama AS jenis_user", "A.password", "A.photo", "A.aktif"), array("A.id" => $id_member));
    $_photo = $data_user[0]["photo"];
    
    $old_pass       = $_POST["password_lama"];
    $password       = $_POST["password_baru"];
    $konfirmasi     = $_POST["password_konf"];
        
    include $root."includes/php/MCrypt.php";
    $mcrypt = new MCrypt();

    if($data_user[0]["password"]!=$mcrypt->encrypt($old_pass)) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Password lama ditak sesuai!")));
    }

    if(strlen($password)<6) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Password baru minimal harus 6 karakter.")));
    }

    if($password!=$konfirmasi) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Konfirmasi password tidak sesuai!")));
    }

    $db->mysql_update("member", array(
        "password" => $db->encrypt($password),
    ), array(
        "id" => $id_member
    ));
    
    $db->mysql_close();
    die(json_encode(array("success" => true, "id" => $id_member, "message" => "Edit profile berhasil.")));
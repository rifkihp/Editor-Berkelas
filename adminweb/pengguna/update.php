<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    //id banner update
    $id = $_POST["id"];    
    //validasi-validasi
    if(strlen($_POST["nama"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Nama lengkap harus diisi.")));
    }
    
    if(strlen($_POST["email"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Email harus diisi.")));
    } else 
    if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Email tidak valid.")));
    } else {
        $email_count = $db->getFieldValue("user", array("COUNT(*) AS TOTAL"), array("email" => $_POST["email"]), array(), 0, 0, "", "id<>'$id'");
        if($email_count[0]["TOTAL"]>0) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Email sudah terpakai.")));
        }
    }
    
    if(strlen($_POST["userid"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "User ID harus diisi.")));
     } else {
        $userid_count = $db->getFieldValue("user", array("COUNT(*) AS TOTAL"), array("userid" => $_POST["userid"]), array(), 0, 0, "", "id<>'$id'");
        if($userid_count[0]["TOTAL"]>0) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "User ID sudah terpakai.")));
        }
    }
    
    if(strlen($_POST["usergrup"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Grup User harus diisi.")));
    }
    
    
    if(strlen($_POST["password"])>0 || strlen($_POST["konfirmasi"])>0) {
        if($_POST["password"]!=$_POST["konfirmasi"]) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Password tidak valid.")));
        } else if(strlen($_POST["password"])<6) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Password harus 6 karakter atau lebih.")));
        }
    }
        
    //get data banner update
    $data = $db->getFieldValue(
        "user", 
        array(
            "password"
        ), 
        array("id" => $id)
    );
    $_new_password = strlen($_POST["password"])>0?$db->acakpassword($_POST["password"]):$data[0]["password"];
    
    //update data user
    $db->mysql_update(
        "user", 
        array(
            "nama" => $_POST["nama"],
            "email" => $_POST["email"],
            "idgrup" => $_POST["usergrup"],
            "userid" => $_POST["userid"],
            "password" => $_new_password
        ), 
        array("id" => $id)
    );
    
    //INSERT MENU AKSES
    $db->mysql_delete("user_menu_akses", array("id_user" => $id));
    $db->mysql_execute("INSERT INTO user_menu_akses SELECT '".$id."', idmodul, akses FROM usergrup_modul_akses WHERE idgrup='".$_POST["usergrup"]."'");
    
    $_SESSION["alert_success"] = "Edit user berhasil.";
    $db->mysql_close();
    die(json_encode(array("success" => true)));
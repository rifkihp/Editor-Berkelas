<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

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
        $email_count = $db->getFieldValue("user", array("COUNT(*) AS TOTAL"), array("email" => $_POST["email"]));
        if($email_count[0]["TOTAL"]>0) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Email sudah terpakai.")));
        }
    }
    
    if(strlen($_POST["userid"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "User ID harus diisi.")));
     } else {
        $userid_count = $db->getFieldValue("user", array("COUNT(*) AS TOTAL"), array("userid" => $_POST["userid"]));
        if($userid_count[0]["TOTAL"]>0) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "User ID sudah terpakai.")));
        }
    }
    
    if(strlen($_POST["usergrup"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Grup User harus diisi.")));
    }
    
    if(strlen($_POST["password"])<6) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Password minimal 6 karakter atau lebih.")));
    } else  if($_POST["password"]!=$_POST["konfirmasi"]) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Password tidak valid.")));
    }
    
    //INSERT USER ADMIN
    $id_user = $db->getLastNumber("user", "id");
    $db->mysql_insert(
        "user", 
        array(
            "id" => $id_user,
            "nama" => $_POST["nama"],
            "email" => $_POST["email"],
            "idgrup" => $_POST["usergrup"],
            "userid" => $_POST["userid"],
            "password" => $db->acakpassword($_POST["password"])
        )
    );
    
    //INSERT MENU AKSES
    $db->mysql_execute("INSERT INTO user_menu_akses SELECT '".$id_user."', idmodul, akses FROM usergrup_modul_akses WHERE idgrup='".$_POST["usergrup"]."'");
    $_SESSION["alert_success"] = "Tambah user baru berhasil.";
    $db->mysql_close();
    die(json_encode(array("success" => true)));
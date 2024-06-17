<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $id_member = $_POST["id_user"];
    $_message = array();
    if(strlen($_POST["first_name"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Nama depan harus diisi!")));
    }
    
    if(strlen($_POST["email"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Email harus diisi!")));
    } else 
    if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Email tidak valid!")));
    } else {
        $email_count = $db->getFieldValue("member", array("COUNT(*) AS TOTAL"), array("email" => $_POST["email"]), array(), 0, 0, "", "id<>'".$id_member."'");
        if($email_count[0]["TOTAL"]>0) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Alamat email sudah terpakai.")));
        }
    }
    
    if(strlen($_POST["phone"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "No HP harus diisi.")));
    }
    
    
   $db->mysql_update("member", array(
        "first_name" => $_POST["first_name"],
        "last_name" => $_POST["last_name"],
        "email" => $_POST["email"],
        "phone" => $_POST["phone"]
    ), array(
        "id" => $id_member
    ));
    
    $db->mysql_close();
    die(json_encode(array("success" => true, "id" => $id_member, "first_name" => $_POST["first_name"], "last_name" => $_POST["last_name"], "email" => $_POST["email"], "phone" => $_POST["phone"], "message" => "Edit profile berhasil.")));
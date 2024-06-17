<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    if(strlen($_POST["nama"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Nama harus diisi.")));
    }
    
    if(strlen($_POST["email"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Email harus diisi.")));
    } else {
        $data = $db->getFieldValue("user",  array("COUNT(*) AS TOTAL"), array("email" => $_POST["email"]), array(), 0, 0, "", "id<>'".$_SESSION[ADMIN_SESSION_NAME]["user"]["id"]."'");
        if($data[0]["TOTAL"]>0) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Email sudah digunakan.")));
        }
    }
        
    $db->mysql_update("user", array("nama" => $_POST["nama"], "email" => $_POST["email"]), array("id" => $_SESSION[ADMIN_SESSION_NAME]["user"]["id"]));
    $db->mysql_close();
    
    die(json_encode(array("success" => true, "message" => "Proses edit profile berhasil.")));
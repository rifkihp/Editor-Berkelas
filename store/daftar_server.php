<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $data = $db->getFieldValue("mokes_server", array("COUNT(*) AS TOTAL"), array("no_telepon" => $_POST["no_telepon"]));
    if($data[0]["TOTAL"]>0) {
       $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "No. handphone sudah terpakai.")));
    }
    
    $_POST["id"]        = $db->getLastNumber("mokes_server", "id"); 
    $_POST["password"]  = $db->acakpassword($_POST["password"]);
    $_POST["gcm_regid"] = "";
    $_POST["aktif"]     = 1;
    
    $db->mysql_insert("mokes_server", $_POST);
    $db->mysql_close();
    
    die(json_encode(array("success" => true, "message" => "Proses daftar server berhasi!")));
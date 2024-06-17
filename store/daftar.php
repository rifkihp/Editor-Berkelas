<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $data = $db->getFieldValue("mokes_pengguna", array("COUNT(*) AS TOTAL"), array("email" => $_POST["email"]));
    if($data[0]["TOTAL"]>0) {
       $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Email sudah terpakai.")));
    }
     
    $data = $db->getFieldValue("mokes_pengguna", array("COUNT(*) AS TOTAL"), array("nama_pengguna" => $_POST["nama_pengguna"]));
    if($data[0]["TOTAL"]>0) {
       $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Nama pengguna sudah terpakai.")));
    }
    
    $_POST["id"]        = $db->getLastNumber("mokes_pengguna", "id"); 
    $_POST["password"]  = $db->acakpassword($_POST["password"]);
    $_POST["gcm_regid"] = "";
    $_POST["aktif"]     = 1;
    $_POST["saldo"]     = 0;
    
    //upload photo
    $_POST["photo"] = "default.png";
    if(!empty($_FILES["photo"])) {
        $file = $_FILES["photo"];
        $ext = substr($file['name'], strrpos($file['name'], '.') + 1); 
        $_POST["photo"] = $db->create_kode_unik().'.'.$ext;         
        $upload_directory = realpath("../") . "/uploads/pengguna/";
        move_uploaded_file($file['tmp_name'], $upload_directory."/".$_POST["photo"]);
    }  
    
    $db->mysql_insert("mokes_pengguna", $_POST);
    $db->mysql_close();
    
    die(json_encode(array("success" => true, "message" => "Proses daftar berhasi!")));
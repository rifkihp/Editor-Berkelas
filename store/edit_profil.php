<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    $db = new classUtama();
    $db->mysql_connect();
    
    if(!isset($_SESSION[SESSION_NAME])) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Kesalahan login! Silahkan logout.")));
    }
        
    $data_user  = $db->getFieldValue("mokes_pengguna", array("*"), array("id" => $_SESSION[SESSION_NAME]["id"]));        
    
    //upload photo
    if(!empty($_FILES["photo"])) {
        $file = $_FILES["photo"];
        $ext = substr($file['name'], strrpos($file['name'], '.') + 1); 
        $_POST["photo"] = $db->create_kode_unik().'.'.$ext;         
        $upload_directory = realpath("../") . "/uploads/pengguna/";
        move_uploaded_file($file['tmp_name'], $upload_directory."/".$_POST["photo"]);
    }  
    
    if($data_user[0]["photo"]!="default.png" && file_exists(realpath($root)."/uploads/pengguna/".$data_user[0]["photo"])) {
        unlink(realpath($root)."/uploads/pengguna/".$data_user[0]["photo"]);
    }
    
    
    $db->mysql_update("mokes_pengguna", $_POST, array("id" => $data_user[0]["id"]));
    $db->mysql_close();
    
    die(json_encode(array("success" => true, "message" => "Edit profil berhasi!")));
<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    //validasi-validasi
    if(strlen($_POST["judul"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Judul website harus diisi.")));
    }
    
    if(strlen($_POST["tagline"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Tag line harus diisi.")));
    }
    
    if(strlen($_POST["email"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Email harus diisi.")));
    }
    
    /*if(strlen($_POST["telepon"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Telepon harus diisi.")));
    }
    
    if(strlen($_POST["no_hp"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "No HP harus diisi.")));
    }*/
    
    $filename = "default_avatar.png";
    if(strlen($_POST['filename_avatar'])>0) {
        $img = $_POST['filename_avatar'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $upload_directory=realpath($root) . "/uploads/umum/";            
        $filename = $db->create_kode_unik(4).".png";
        file_put_contents($upload_directory.$filename, $data);
    }
    unset($_POST['filename_avatar']);
    $_POST["avatar"] = $filename;
    
    $filename = "default_logo.png";
    if(strlen($_POST['filename_logo'])>0) {
        $img = $_POST['filename_logo'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $upload_directory=realpath($root) . "/uploads/umum/";            
        $filename = $db->create_kode_unik(4).".png";
        file_put_contents($upload_directory.$filename, $data);
    }
    unset($_POST['filename_logo']);
    $_POST["logo"] = $filename;
    
    $filename = "default_bg.png";
    if(strlen($_POST['filename_bg'])>0) {
        $img = $_POST['filename_bg'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $upload_directory=realpath($root) . "/uploads/umum/";            
        $filename = $db->create_kode_unik(4).".png";
        file_put_contents($upload_directory.$filename, $data);
    }
    unset($_POST['filename_bg']);
    $_POST["bg"] = $filename;
    
    $data = $db->getFieldValue("umum", array("logo"));
    
    //DELETE OLD AVATAR
    if(file_exists(realpath($root)."/uploads/umum/".$data[0]["avatar"]) && $data[0]["logo"]!="default_avatar.png") {
        unlink(realpath($root)."/uploads/umum/".$data[0]["avatar"]);
    }
    
    //DELETE OLD LOGO
    if(file_exists(realpath($root)."/uploads/umum/".$data[0]["logo"]) && $data[0]["logo"]!="default_logo.png") {
        unlink(realpath($root)."/uploads/umum/".$data[0]["logo"]);
    }
        
    //DELETE OLD BG
    if(file_exists(realpath($root)."/uploads/umum/".$data[0]["bg"]) && $data[0]["bg"]!="default_bg.png") {
        unlink(realpath($root)."/uploads/umum/".$data[0]["bg"]);
    }

    //UPDATE UMUM
    $db->mysql_update("umum", $_POST);
    
    
    
    $db->mysql_close();
    die(json_encode(array("success" => true, "message" => "Update Utama berhasil.")));
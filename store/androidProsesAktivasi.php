<?php
    $root = "../";
    include $root."includes/php/initial.php";
    if(strlen($_SESSION['security_code'])==0 || !isset($_SESSION['security_code']) || $_POST["security_code"]!=$_SESSION['security_code']) {
    	die(json_encode(array("success" => false, "message" => "Maaf! Token tidak valid!")));
    }
    unset($_SESSION['security_code']);

    include $root."includes/php/classUtama.php";
    
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $_error_message = "";
    $_nohp = $_POST["no_hp"];
    $_kode_aktivasi = $_POST["kode_aktivasi"];
    
    if(strlen($_nohp)==0) {
        $_error_message.= "No. HP tidak valid.\n";
        
    } else if(strlen($_kode_aktivasi)==0) {
        $_error_message.= "Kode aktivasi harus diisi.\n";
        
    } else {
        
        include $root."includes/php/MCrypt.php";
        $mcrypt = new MCrypt();
    
        $_result = $db->getFieldValue("member", array("*"), array("phone" => $_nohp));
        if(count($_result)==0) {
            $_error_message.= "Akun tidak terdaftar.\n";
        } else if($_result[0]["aktif"]==1) {
            $_error_message.= "Akun sudah aktif.\n";            
        } else if($_result[0]["hash"]!=$mcrypt->encrypt($_kode_aktivasi)) {
            $_error_message.= "Kode aktivasi tidak sesuai.\n";            
        }        
    }
    
    if(strlen($_error_message)>0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => $_error_message)));
    }
    
    $db->mysql_update("member", array("aktif" => 1), array("id" => $_result[0]["id"]));
    $db->mysql_close();

    die(json_encode(array("success" => true, "message" => "Proses aktivasi berhasil.")));
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
    
    if(strlen($_nohp)==0) {
        $_error_message.= "No. HP tidak valid.\n";        
    } else {        
        $_result = $db->getFieldValue("member", array("*"), array("phone" => $_nohp));
        if(count($_result)==0) {
            $_error_message.= "Akun tidak terdaftar.\n";
        } else if($_result[0]["aktif"]==1) {
            $_error_message.= "Akun sudah aktif.\n";            
        }        
    }
    
    if(strlen($_error_message)>0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => $_error_message)));
    }
    
    include $root."includes/php/MCrypt.php";
    $mcrypt = new MCrypt();
    
    $_kode_aktivasi = $mcrypt->decrypt($_result[0]["hash"]);
    $db->sendSms($_nohp, "Kode Aktivasi registrasi Karangtarunaku adalah ".$_kode_aktivasi.".");
    
    $db->mysql_close();

    die(json_encode(array("success" => true, "message" => "Kirim ulang kode aktivasi berhasil.")));
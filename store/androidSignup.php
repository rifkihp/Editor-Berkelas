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
    
    $_first_name     = $_POST["first_name"];
    $_last_name      = $_POST["last_name"];
    $_email          = $_POST["email"];
    $_nohp           = $_POST["nohp"];
    $_password       = $_POST["password"];
    $_konfirmasi     = $_POST["konfirmasi"];
    $_referensi      = $_POST["referensi"];
    $_id_propinsi    = $_POST["id_propinsi"];
    $_nama_propinsi  = $_POST["nama_propinsi"];
    $_id_kota        = $_POST["id_kota"];
    $_nama_kota      = $_POST["nama_kota"];
    $_id_kecamatan   = $_POST["id_kecamatan"];
    $_nama_kecamatan = $_POST["nama_kecamatan"];
    $_user_picture   = $_POST["user_picture"];
    
    
    $_error_message = "";
    if(strlen($_first_name)==0) {
        $_error_message.= "Nama depan harus diisi.\n";
    }
    
    if(strlen($_nohp)==0) {
        $_error_message.= "No. handphone harus diisi.\n";
    } else {
        $_result = $db->getFieldValue("member", array("COUNT(*) AS TOTAL"), array("phone" => $_nohp, "aktif" => 1));
        if($_result[0]["TOTAL"]>0) {
            $_error_message.= "No. handphone sudah digunakan.\n";
        }
    }
    
    if(strlen($_email)==0) {
        $_error_message.= "Email harus diisi.\n";
    } else if(!filter_var($_email, FILTER_VALIDATE_EMAIL)) {
        $_error_message.= "Penulisan email tidak valid.\n";
    } else {
        $_result = $db->getFieldValue("member", array("COUNT(*) AS TOTAL"), array("email" => $_email, "aktif" => 1));
        if($_result[0]["TOTAL"]>0) {
            $_error_message.= "Email sudah digunakan.\n";
        }
    }
    
    if(strlen($_password)<6) {
        $_error_message.= "Password minimal 6 karater.\n";
    } else if($_password!=$_konfirmasi) {
        $_error_message.= "Konfirmasi tidak sesuai dengan password.\n";
    }
    
    if(strlen($_error_message)>0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => $_error_message)));
    }
    
    function generateCode($characters) {
        /* list all possible characters, similar looking characters and vowels have been removed */
        $possible = '23456789bcdfhkmnrstvwx';
        $code = '';
        $i = 0;
        while ($i < $characters) {
                $code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
                $i++;
        }
        return $code;
    }

    include $root."includes/php/MCrypt.php";
    $mcrypt = new MCrypt();
    $_kode_aktivasi = generateCode(4);

    //get last id
    $id = $db->getLastNumber("member", "id");
    //registrasi
    
    $_photo = "default.png";
//    if(strlen($_user_picture)>0) {
//        $upload_directory = realpath($root) . "/uploads/member";
//        $_photo = $db->create_kode_unik().'.png';
//        
//        file_put_contents($upload_directory."/".$_photo, file_get_contents($_user_picture));
//    }
    
    $sql = "DELETE FROM member WHERE aktif=0 AND (email='".$_email."' OR phone='".$_nohp."')";
    $db->mysql_execute($sql);
    
    $db->mysql_insert("member", array(
        "id" => $id,
        "first_name" => $_first_name,
        "last_name" => $_last_name,
        "phone" => $_nohp,
        "email" => $_email,
        "password" => $mcrypt->encrypt($_password),         
        "jenis_user" => 1,
        "referensi" => $_referensi,
        "id_propinsi" => $_id_propinsi,
        "nama_propinsi" => $_nama_propinsi,
        "id_kota" => $_id_kota,
        "nama_kota" => $_nama_kota,
        "id_kecamatan" => $_id_kecamatan,
        "nama_kecamatan" => $_nama_kecamatan,
        "photo" => $_photo,
        "tanggal_jam_create" => date('Y-m-d H:i:s'),
        "hash" => $mcrypt->encrypt($_kode_aktivasi),
        "aktif" => 0,
        "admin" => 1
    ));
    
    $db->sendSms($_nohp, "Kode Aktivasi registrasi Karangtarunaku adalah ".$_kode_aktivasi.".");
    
    $subject = "wtvindonesia - Aktivasi User";
    $detail_message = "Kode Aktivasi registrasi Karangtarunaku adalah ".$_kode_aktivasi.".";
        
    $email_from = "admin@aplikasikarta.com";
    $from_alias = "wtvindonesia";
    $email_to = $_email;
    $to_alias = trim($_first_name." ".$_last_name);
    
    $success = $db->sendEmailToServer($root, $email_to, $to_alias, $subject, $detail_message, $email_from, $from_alias);
    
    $db->mysql_close();
    
    die(json_encode(array("success" => true, "message" => "Registrasi berhasil. Silahkan melakukan aktivasi.", "aktivasi_sms" => $data_umum[0]["aktivasi_sms"])));
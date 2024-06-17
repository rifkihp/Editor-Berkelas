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
    
    $_error_message = "";
    $_error_field = "";
    foreach ($_POST as $key => $value) {
        if($key=='bank_pengirim') {
            if(strlen($value)==0) {
                $_error_field = "bank_pengirim"; 
                $_error_message = "Bank pengirim harus diisi.";
            
                break;
            }
        }
        
        if($key=='nama_pemilik_rekening') {
            if(strlen($value)==0) {
                $_error_field = "nama_pemilik_rekening"; 
                $_error_message = "Nama pemilik rekening harus diisi.";
                
                break;
            }
        }
        
        if($key=='nominal_top_up') {
            if(strlen($value)==0) {
                $_error_field = "nominal_top_up"; 
                $_error_message = "Nominal top up harus diisi.";
            
                break;
            }
        }
    }
        
    if(strlen($_error_message)>0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => $_error_message, "field" => $_error_field)));
    }
    
    //upload photo
    if(!empty($_FILES["photo"])) {
        $file = $_FILES["photo"];
        $ext = substr($file['name'], strrpos($file['name'], '.') + 1); 
        $photo = $db->create_kode_unik().'.'.$ext;         
        $upload_directory = realpath("../") . "/uploads/konfirmasi/";
        move_uploaded_file($file['tmp_name'], $upload_directory."/".$photo);
    }   
    
    $_POST["tanggal_jam"]  = date("Y-m-d H:i:s");
    $_POST["photo"] = $photo;
    $_POST["id_user"] = $_SESSION[SESSION_NAME]["id"];
    $db->mysql_insert("mokes_konfirmasi_pembayaran", $_POST);
    
    $data_admin = $db->getFieldValue("admin_users", array("email"));
    $to = $data_admin[0]["email"];
    $subject = "MOKES: KONFIRMASI PEMBAYARAN"; 
    $message = "Pengguna " . $_SESSION[SESSION_NAME]["nama_pengguna"] . " melakukan konfirmasi pembayaran 
                sebesar Rp. ".number_format($_POST["nominal_top_up"], 0, ".", ",")." melalui " . $_POST["bank_pengirim"] . " 
                atas nama ".$_POST["nama_pemilik_rekening"]." pada tanggal ".$_POST["tanggal_jam"].".";
        
    require $root."/includes/PHPMailer-master/PHPMailerAutoload.php";

    $mail = new PHPMailer;
    $mail->isSendmail();
    $mail->setFrom('noreply@mokes.com', 'MOKES');
    $mail->addReplyTo($to, $to);
    $mail->addAddress($to, $to);
    $mail->Subject = $subject;
    $mail->AltBody = $message;
    $mail->Body = $message;
    $mail->send();
    
    $db->mysql_close();
    die(json_encode(array("success" => true, "message" => "Konfirmasi pembayaran berhasil.\nMohon tunggu verifikasi admin!")));
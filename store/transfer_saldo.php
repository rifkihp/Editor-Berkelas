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
    
    $_nama_pengguna = $_POST["nama_pengguna"];
    $_nominal_transfer = $_POST["nominal_transfer"];
    $_tulis_pesan = $_POST["tulis_pesan"];
    
    $data_user     = $db->getFieldValue("mokes_pengguna", array("*"), array("id" => $_SESSION[SESSION_NAME]["id"]));
    $data_pengguna = $db->getFieldValue("mokes_pengguna", array("*"), array("nama_pengguna" => mysql_escape_string($_nama_pengguna)));
    
    $password = $db->acakpassword($_POST["password"]);
    if($password!=$data_user[0]["password"]) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Password yang dimasukan tidak benar.")));
    }
    unset($_POST["password"]);
    
    if(count($data_pengguna)==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Nama pengguna tidak valid.")));
    }
    
    if($_nominal_transfer<=0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Nominal transfer tidak valid.")));
    }
            
    if($data_user[0]["saldo"]<$_nominal_transfer) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Saldo anda tidak mencukupi.")));
    }
    
    //INSERT TRANSAKSI TRANSFER SALDO
    $_POST["id"]           = $db->getLastNumber("mokes_transaksi_transfer_saldo", "id");
    $_POST["tanggal_jam"]  = date("Y-m-d H:i:s");
    $_POST["id_user"]      = $_SESSION[SESSION_NAME]["id"];
    $_POST["id_penerima"]  = $data_pengguna[0]["id"];
    $_POST["status_valid"] = "Y";
    $db->mysql_insert("mokes_transaksi_transfer_saldo", $_POST);
    
    //INSERT HISTORI TRANSAKSI USER
    $db->mysql_insert(
        "mokes_histori_transaksi", 
        array(
            "id_user" => $data_user[0]["id"],
            "id_ref" => $_POST["id"],
            "tanggal_jam" => $_POST["tanggal_jam"],
            "transaksi" => "TRANSFER PULSA (OUT)",
            "debet" => $_nominal_transfer,
            "kredit" => 0,
            "saldo" => ($data_user[0]["saldo"]-$_nominal_transfer)
        )
    );        
       
    //INSERT HISTORI TRANSAKSI PENGGUNA
    $db->mysql_insert(
        "mokes_histori_transaksi", 
        array(
            "id_user" => $data_pengguna[0]["id"],
            "id_ref" => $_POST["id"],
            "tanggal_jam" => $_POST["tanggal_jam"],
            "transaksi" => "TRANSFER PULSA (IN)",
            "debet" => 0,
            "kredit" => $_nominal_transfer,
            "saldo" => ($data_pengguna[0]["saldo"]+$_nominal_transfer)
        )
    );        
    
    //UPDATE SALDO USER
    $db->mysql_update(
        "mokes_pengguna", 
        array(
            "saldo" => ($data_user[0]["saldo"]-$_nominal_transfer)      
        ),      
        array("id" => $data_user[0]["id"])
    );
    
    //UPDATE SALDO PENGGUNA
    $db->mysql_update(
        "mokes_pengguna", 
        array(
            "saldo" => ($data_pengguna[0]["saldo"]+$_nominal_transfer)      
        ),      
        array("id" => $data_pengguna[0]["id"])
    );
        
    include $root."includes/php/GCM.php";    
    $gcm = new GCM();            
    //PUSH NOTIFICATION USER
    if(strlen($data_user[0]["gcm_regid"])>0) {
        $data_transfer = array(
            "success" => true,
            "tanggal_jam" => $_POST["tanggal_jam"],
            "title" => "MOKES: TRANSFER SALDO",
            "konten" => "Anda telah berhasil mentransfer saldo kepada ".$data_pengguna[0]["nama_lengkap"]." (".$data_pengguna[0]["nama_pengguna"].") sebesar ".number_format($_nominal_transfer, 0, '.', ',')."."
        );
        $gcmRegIds = array();
        array_push($gcmRegIds, $data_user[0]['gcm_regid']);        
        if(count($gcmRegIds)>0) {
            $message = json_encode($data_transfer);            
            $result = $gcm->send_notification($gcmRegIds, array("tipe" => "transfer_saldo", "message" => $message));
            $db->mysql_update(
                "mokes_transaksi_transfer_saldo", 
                array(
                    "push_result_user" => $result           
                ),
                array("id" => $_POST["id"])
            );
            //echo($result);
        }
    }
    
    //PUSH NOTIFICATION PENGGUNA
    if(strlen($data_pengguna[0]["gcm_regid"])>0) {
        $data_transfer = array(
            "success" => true,
            "tanggal_jam" => $_POST["tanggal_jam"],
            "title" => "MOKES: TRANSFER SALDO",
            "konten" => "Anda telah ditransfer saldo sebesar ".number_format($_nominal_transfer, 0, '.', ',')." oleh ".$data_user[0]["nama_lengkap"]." (".$data_user[0]["nama_pengguna"].")."
        );
        $gcmRegIds = array();
        array_push($gcmRegIds, $data_pengguna[0]['gcm_regid']);        
        if(count($gcmRegIds)>0) {
            $message = json_encode($data_transfer);            
            $result = $gcm->send_notification($gcmRegIds, array("tipe" => "transfer_saldo", "message" => $message));
            $db->mysql_update(
                "mokes_transaksi_transfer_saldo", 
                array(
                    "push_result_penerima" => $result           
                ),
                array("id" => $_POST["id"])
            );
            //echo($result);
        }
    }
    
    $data_admin = $db->getFieldValue("admin_users", array("email"));
    $to = $data_admin[0]["email"];
    $subject = "MOKES: TRANSFER SALDO"; 
    $message = "Pengguna " . $data_user[0]["nama_pengguna"] . " melakukan transfer saldo kepada pengguna " .
                $data_pengguna[0]["nama_pengguna"] . " sebesar Rp. " . number_format($_nominal_transfer, 0, '.', ',') . " 
                pada tanggal ".$_POST["tanggal_jam"].".";
        
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
    
    die(json_encode(array("success" => true, "message" => "Proses transfer saldo berhasil.")));
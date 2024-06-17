<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $_email  = mysql_escape_string($_POST["email"]);
    $_result = $db->getFieldValue("mokes_pengguna", array("COUNT(*) AS TOTAL"), array("email" => $_email));
    if($_result[0]["TOTAL"]==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Email tidak terdaftar.")));
    }
    
    $kode_reset_password = $db->create_kode_unik();
    
    $db->mysql_update("mokes_pengguna", array(
            "kode_reset_password" => $kode_reset_password
        ),
        array("email" => $_email)
    );
        
    $to = $_POST["email"]; // Send email to our user
        $subject = 'MOKES: Reset Password'; // Give the email a subject 
        $message = '
            Untuk melalukan reset password silhakan klik url berikut ini untuk melanjutkan:
            '.ADMINWEB_URL.'/reset_password.php?email='.$_POST["email"].'&hash='.$kode_reset_password;
        
        require $root."/includes/PHPMailer-master/PHPMailerAutoload.php";

        $mail = new PHPMailer;
        $mail->isSendmail();
        $mail->setFrom('noreply@temmy.com', 'MOKES');
        $mail->addReplyTo($to, $to);
        $mail->addAddress($to, $to);
        $mail->Subject = $subject;
        $mail->AltBody = $message;
        $mail->Body = $message;
        $mail->send();
    
    $db->mysql_close();
    
    die(json_encode(array("success" => true, "message" => "Proses permintaan reset password berhasil.\nSilahkan cek email untuk melanjutkan!")));
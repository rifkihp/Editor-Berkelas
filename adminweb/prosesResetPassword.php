<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $_message = array();
    
    if(strlen($_POST["email"])==0) {
        $_message[count($_message)] = "Email harus diisi!";
    } else {
        $data = $db->getFieldValue("mokes_pengguna", array("COUNT(*) AS TOTAL"), array("email" => $_POST["email"], "kode_reset_password" => $_POST["kode_reset"]));
        if($data[0]["TOTAL"]==0) {
            $_message[count($_message)] = "Email tidak valid!";
        }    
    }
    
    if(strlen($_POST["password"])==0) {
        $_message[count($_message)] = "Password diperlukan!";
    }
    
    if($_POST["password"]!=$_POST["password_lagi"]) {
        $_message[count($_message)] = "Konfirmasi password tidak valid!";
    }
    if(count($_message)==0) {        
        $db->mysql_update("mokes_pengguna", array("password" => $db->acakpassword($_POST["password"]), "kode_reset_password" => ""), array("email" => $_POST["email"]));
    }
    
    $db->mysql_close();
    
    if(count($_message)==0) {
        header("location: ".ADMINWEB_URL."/suksesGantiPassword.php");    
    } else {
        $_SESSION['loginusers'] = array("error" => $_message);
        header("location: ".ADMINWEB_URL."/reset_password.php?email=".$_POST["email"]."&hash=".$_POST["kode_reset"]);
    }
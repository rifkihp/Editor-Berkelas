<?php

    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama(CLIENT_SESSION_NAME);
    $db->mysql_connect(true);
    
    $_message = array();
    
    if(strlen($_POST["email"])==0) {
        $_message[count($_message)] = "Nama diperlukan!";
    }
    
    if(strlen($_POST["password"])==0) {
        $_message[count($_message)] = "Password diperlukan!";
    }
    
    if(strlen($_POST["email"])>0 && strlen($_POST["password"])>0) {
        $sql = "SELECT id, nama, email, jenis_user, photo FROM member WHERE email='".$_POST["email"]."' AND password='".$db->acakpassword($_POST["password"])."'";
        $db->mysql_query($sql, $rec_count, $data_login);
        if($data_login[0]["email"]==$_POST["email"] && $data_login[0]["password"]==md5($_POST["password"])) {
            unset($data_login[0]["password"]);            
        } else {
            $_message[count($_message)] = "Login tidak valid!";            
        }
    }
    
    if(count($_message)==0) {
        $_SESSION[CLIENT_SESSION_NAME] = array("is_login" => true, "user" => $data_login[0]);
    } else {
        //unset($_SESSION[CLIENT_SESSION_NAME]);
        $_SESSION['loginusers'] = array("error" => $_message, "field" => $_POST);
    }
    $db->mysql_close();
    
    header("location: ".ADMINWEB_URL."/index.php");
    
    
    

    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $_email    = $_POST["email"];
    $_password  = $_POST["password"];
    
    $sql = "SELECT id, nama, email, jenis_user, photo FROM member WHERE email='".$_email."' AND password='".$db->acakpassword($_password)."'";
    $db->mysql_query($sql, $rec_count, $rs);
    $db->mysql_close();
           
    if($rs[0]["email"]==$_email && $rs[0]["password"]==$db->acakpassword($_password)) {
        $_SESSION[CLIENT_SESSION_NAME] = array("is_login" => true, "id" => $rs[0]["id"], "nama" => $rs[0]["nama"], "email" => $rs[0]["email"], "jenis_user" => $rs[0]["jenis_user"], "photo" => $rs[0]["photo"]);
        $result = array("success" => true, "message" => "Proses login berhasil!");
    } else {
        unset($_SESSION[CLIENT_SESSION_NAME]);
        $result = array("success" => false, "message" => "Email dan password tidak sesuai!");        
    }
    
    
    die(json_encode($result));        
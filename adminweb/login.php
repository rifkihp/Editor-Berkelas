<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect(true);
    
    $_message = array();
    
    if(strlen($_POST["username"])==0) {
        $_message[count($_message)] = "Nama diperlukan!";
    }
    
    if(strlen($_POST["password"])==0) {
        $_message[count($_message)] = "Password diperlukan!";
    }
    
    if(strlen($_POST["username"])>0 && strlen($_POST["password"])>0) {
        $data_login = $db->getFieldValue("user", array("id", "nama", "email", "userid", "password", "'ADMIN' AS tipe_user"), array("userid" => $_POST["username"], "password" => $db->acakpassword($_POST["password"])));
        if($data_login[0]["userid"]==$_POST["username"] && $data_login[0]["password"]==$db->acakpassword($_POST["password"])) {
            unset($data_login[0]["password"]);            
        } else {
            $_message[count($_message)] = "Login tidak valid!";            
        }
    }
    
    if(count($_message)==0) {
        $_SESSION[ADMIN_SESSION_NAME] = array("is_login" => true, "user" => $data_login[0]);
    } else {
        unset($_SESSION[ADMIN_SESSION_NAME]);
        $_SESSION['loginusers'] = array("error" => $_message, "field" => $_POST);
    }
    $db->mysql_close();
    
    header("location: ".ADMINWEB_URL."/index.php");
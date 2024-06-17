<?php
    $root = "../";
    include $root."includes/php/initial.php";
    
    $is_login = false;
    if($_SESSION[CLIENT_SESSION_NAME]["is_login"] && $_SESSION[CLIENT_SESSION_NAME]["user"]["id"]==$_POST["id"] && $_SESSION[CLIENT_SESSION_NAME]["user"]["email"]==$_POST["email"]) {
        $is_login = true;
    }
    
    die(json_encode(array("is_login" => $is_login)));
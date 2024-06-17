<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $_no_telepon = $_POST["no_telepon"];
    $_password   = $_POST["password"];
    
    $sql = "SELECT * FROM mokes_server WHERE no_telepon='".$_no_telepon."' AND password='".$db->acakpassword($_password)."'";
    $db->mysql_query($sql, $rec_count, $rs);
    $db->mysql_close();
           
    if($rs[0]["no_telepon"]==$_no_telepon && $rs[0]["password"]==$db->acakpassword($_password)) {
        $_SESSION[SESSION_NAME] = array("success" => true, "id" => $rs[0]["id"], "nama_server" => $rs[0]["nama_server"], "no_telepon" => $rs[0]["no_telepon"], "message" => "Login berhasi!");
        die(json_encode($_SESSION[SESSION_NAME]));
    } else {
        unset($_SESSION[SESSION_NAME]);
        $result = array("success" => false, "message" => "No. handphone dan password tidak sesuai!");        
        die(json_encode($result));        
    }
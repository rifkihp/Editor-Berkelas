<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    $id_produk = $db->checkIntegerRange($_POST["id"])?$_POST["id"]:0;
    $status = $db->checkIntegerRange($_POST["status"])?($_POST["status"]==0?1:0):0;
    $jenis = $_POST["jenis"];
    
    $db->mysql_update("produk", array("produk_".$jenis => $status), array("id" => $id));
    $db->mysql_close();
        
    die(json_encode(array("success" => true)));
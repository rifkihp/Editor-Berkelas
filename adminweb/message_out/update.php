<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    $konten = ($_POST["konten"]);
    
    $db->mysql_update(
        "mokes_detail_pembayaran", 
        array(
            "detail" => $konten      
        )
    );
    $db->mysql_close();
    
    die(json_encode(array("success" => true, "message" => "Proses update berhasil.")));
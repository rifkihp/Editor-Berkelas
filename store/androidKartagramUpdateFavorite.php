<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    if($_POST["status"]==1) {
        $db->mysql_insert("kartagram_like", array("id_kartagram" => $_POST["id"], "id_member" => $_POST["id_user"]));
    } else {
        $db->mysql_delete("kartagram_like", array("id_kartagram" => $_POST["id"], "id_member" => $_POST["id_user"]));
        
    }
    $db->mysql_close();
    
    die(json_encode(array("success" => true, "message" => "Proses update kartagram berhasil.")));
<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    foreach($_POST["arrayorder"] as $urutan => $id) {
        $sql = "UPDATE widget SET urutan='".($urutan+1)."' WHERE id='".$id."'";
        $db->mysql_execute($sql);
    }
    $db->mysql_close();
    die(json_encode(array("success" => true)));
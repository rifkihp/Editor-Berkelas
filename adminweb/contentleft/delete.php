<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    //id banner update
    $id = $_POST["id"];
    $db->mysql_delete("widget", array("id" => $id));        
    $sql = "SELECT * FROM widget WHERE letak='Kiri' ORDER BY urutan";
    $db->mysql_query($sql, $rec_count, $data);
    $posisi=1;
    for($i=0; $i<$rec_count; $i++) {
        $sql = "UPDATE widget SET urutan='".$posisi."' WHERE id='".$data[$i]["id"]."'";
        $db->mysql_execute($sql);
        $posisi++;        
    }    
    
    $db->mysql_close();
    $_SESSION["alert_success"] = "Hapus data widget kiri berhasil.";
    die(json_encode(array("success" => true, "message" => "Hapus data widget kiri berhasil.")));
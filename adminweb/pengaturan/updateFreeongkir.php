<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    //INSERT CATEGORY
    $db->mysql_delete("freeongkir_kurir");
    $kurir = explode(",", $_POST["id_kurir"]);
    foreach($kurir as $i => $value) {
        $db->mysql_insert("freeongkir_kurir", array(
            "id" => $i+1,
            "id_kurir" => $value
        ));
    }
    unset($_POST["id_kurir"]);
    
    $db->mysql_delete("freeongkir_tujuan");
    $tujuan = explode("\n", $_POST["detail_tujuan"]);
    foreach($tujuan as $i => $value) {
        $col = explode("\t", $value);
        $db->mysql_insert("freeongkir_tujuan", array(
            "id" => $i+1,
            "id_propinsi" => $col[0],
            "propinsi"  => $col[1],
            "id_kota" => $col[2],
            "kota"  => $col[3]
        ));
    }
    unset($_POST["detail_tujuan"]);
    
    //update data pengaturan
    $db->mysql_update("freeongkir_setting", $_POST);
    
    $db->mysql_close();
    die(json_encode(array("success" => true, "message" => "Update Free Ongkir berhasil.")));
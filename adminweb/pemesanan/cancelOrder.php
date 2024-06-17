<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    $data_umum = $db->getFieldValue("umum", array("website", "mask_email"));
    $email_from = $data_umum[0]["mask_email"];
    $from_alias = $data_umum[0]["website"];
    
    $id = explode(",", $_POST["id"]);
    $db->mysql_update("customer_order_header", array("status" => 4, "date_update_status" => date("Y-m-d H:i:s"), "is_open" => "N"), array("id" => $id));
    
    $data_pemesanan = $db->getFieldValue("customer_order_header", array("*"), array("id" => $id));
    $tanggal_jam = date("Y-m-d H:i:s");
    foreach ($data_pemesanan as $key => $value) {
        $db->mysql_insert("histori_status_pemesanan", array(
            "id" => $db->getLastNumber("histori_status_pemesanan", "id"),
            "id_pemesanan" => $value["id"],
            "tanggal_jam" => $tanggal_jam,
            "penjelasan" => "Admin membatalkan pesanan customer."
        ));
        
        $data_order  = $db->getFieldValue("customer_order_header", array("*"), array("id" => $value["id"]));
        $id_member   = $data_order[0]["id_member"];
        $id_guest    = $data_order[0]["id_guest"];
        $kode_order  = $data_order[0]["kode"]; 

        $data_user = $db->getFieldValue("member", array("*"), array("id" => $id_member));
        
        $data_notifikasi = array(
            "tanggal_jam" => $tanggal_jam,
            "judul"       => "Status Pesanan",
            "konten"      => "Pemesanan nomer #".$kode_order." dibatalkan."
        );
    }
        
    $db->mysql_close();
    $_SESSION["alert_success"] = "Pembatalan pesanan berhasil.";
    die(json_encode(array("success" => true, "message" => "Pembatalan pesanan berhasil.")));
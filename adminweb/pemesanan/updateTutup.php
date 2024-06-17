<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    if(strlen($_POST["nama_penerima"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Nama penerima paket harus diisi.")));
    }
    
    $db->mysql_update("customer_order_ongkir", array("nama_penerima" => $_POST["nama_penerima"]), array("id_header" => $_POST["id"]));    
    $db->mysql_update("customer_order_header", array("status" => 5), array("id" => $_POST["id"]));    
    
    $db->mysql_insert("histori_status_pemesanan", array(
        "id" => $db->getLastNumber("histori_status_pemesanan", "id"),
        "id_pemesanan" => $_POST["id"],
        "tanggal_jam" => date("Y-m-d H:i:s"),
        "penjelasan" => "Admin menutup pesanan. Transaksi dianggap selesai."
    ));
    
    $data_order  = $db->getFieldValue("customer_order_header", array("*"), array("id" => $_POST["id"]));
    $id_member   = $data_order[0]["id_member"];
    $id_guest    = $data_order[0]["id_guest"];
    $kode_order  = $data_order[0]["kode"]; 
    
    $data_user = $db->getFieldValue("member", array("*"), array("id" => $id_member));
    
    $data_notifikasi = array(
        "tanggal_jam" => $tanggal_jam,
        "judul"       => "Status Pesanan",
        "konten"      => "Pesanan dengan nomer #".$kode_order." ditutup. Transaksi dianggap selesai."
    );
    
    $gcmRegIds = array();
    if(strlen($data_user[0]["id"])>0) {
        foreach ($data_user as $key => $value) {
            if(strlen($value['gcm_regid'])>0) {
                array_push($gcmRegIds, $value['gcm_regid']);
            }
        }
    } else {
        $result_gcm = $db->getFieldValue("guest AS A", array("A.gcm_regid"), array("A.id" => $id_guest), array(), 0, 0, "", "LENGTH(A.gcm_regid)>0"); 
        foreach ($result_gcm as $key => $value) {
            array_push($gcmRegIds, $value['gcm_regid']);
        }
    }

    if(count($gcmRegIds)>0) {
        include $root."includes/php/GCM.php";    
        $gcm = new GCM();
        $message = json_encode($data_notifikasi);            
        $result = $gcm->send_notification($gcmRegIds, array("tipe" => "pemesanan", "message" => $message));
        $db->mysql_insert(
            "push_notification", 
            array(
                "tipe" => "pemesanan",
                "message" => $message,
                "result" => $result
            )
        );
    }
        
    $db->mysql_close();
    die(json_encode(array("success" => true)));
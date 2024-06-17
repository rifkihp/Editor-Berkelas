<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    $id = ($db->checkIntegerRange($_POST["id"])?$_POST["id"]:"");
    $status = ($db->checkIntegerRange($_POST["status"])?$_POST["status"]:"");
    $tanggal_jam =  date("Y-m-d H:i:s");
    
    //get data konfirmasi
    $data_konfirmasi = $db->getFieldValue("ppob_deposit_konfirmasi AS A ", array("A.id", "A.id_deposit", "A.status"), array("id" => $id));
    
    //get data deposit
    $data = $db->getFieldValue("ppob_deposit AS A LEFT JOIN member AS B ON A.id_member=B.id", array("A.id", "A.id_member", "B.phone", "A.total", "A.status"), array("A.id" => $data_konfirmasi[0]["id_deposit"]));
    
    if(count($data)==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Data deposit tidak ditemukan!")));        
    }
    
    //VALIDASI
    if($status==2) {
        if ($data[0]["status"]==$status) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Pembayaran deposit sudah diterima!"))); 
        }
        
        //SALDO MEMBER NAMBAH
        $sql = "UPDATE member SET saldo=saldo+".$data[0]["total"]." WHERE id=".$data[0]["id_member"];
        $db->mysql_execute($sql);

        //HISTORI TRANSAKSI
        $db->mysql_insert("h_trx", array(
            "id_member" => $data[0]["id_member"],
            "kode"   => "DPT",
            "jenis"  => "K",
            "id_ref" => $data[0]["id"],
            "jumlah" => $data[0]["total"],
            "tanggal_jam" => $tanggal_jam
        ));
    }
    
    if($status==1) {
        if($data_konfirmasi[0]["status"]==2) {
            //SALDO MEMBER BERKURANG
            $sql = "UPDATE member SET saldo=saldo-".$data[0]["total"]." WHERE id=".$data[0]["id_member"];
            $db->mysql_execute($sql);
            
            //HISTORI TRANSAKSI
            $db->mysql_insert("h_trx", array(
                "id_member" => $data[0]["id_member"],
                "kode"   => "DPT",
                "jenis"  => "D",
                "id_ref" => $data[0]["id"],
                "jumlah" => $data[0]["total"],
                "tanggal_jam" => $tanggal_jam
            ));
        }
    }
    
    $db->mysql_update(
        "ppob_deposit_konfirmasi", 
        array(
            "status" => $status,
            "tanggal_jam_update_status" => $tanggal_jam
        ),      
        array("id" => $id)
    );
    
    $db->mysql_update(
        "ppob_deposit", 
        array(
            "status" => $status,
            "date_update_status" => $tanggal_jam
        ),      
        array("id" => $data[0]["id"])
    );
    
    if($status==2) {
        //SEND SMS TO MEMBER
        $message = "Deposit sebesar IDR ". number_format($data[0]["total"], 0, '.', ',')." berhasil ditambahkan.";
        $db->sendSms(str_replace(" ", "", $data[0]["phone"]), $message);
    }
    
    $db->mysql_close();
    die(json_encode(array("success" => true)));
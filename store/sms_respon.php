<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    $db = new classUtama();
    $db->mysql_connect();
    
    if(!isset($_SESSION[SESSION_NAME])) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Kesalahan login! Silahkan logout.")));
    }
    
    $message   = $_POST["message"];
    $temps     = split(" ", $message);
    $katakunci = split(",", strtoupper($_POST["katakunci"]));
    
    $temp = array();
    foreach ($temps as $key => $value) {
        if(strlen(trim($value))>0) {
            array_push($temp, strtoupper(trim($value)));
        }
    }
    
    $status_confirm = 1;
    foreach ($katakunci as $key => $value) {
        if(array_search(strtoupper(trim($value)), $temp)!==false) {
            $status_confirm = 2;
            break;
        }
    }
    
    $sql = "SELECT * FROM mokes_transaksi_beli_pulsa WHERE server_id='".$_SESSION[SESSION_NAME]["id"]."' AND status_confirm=0 AND "
            . "TIME_TO_SEC(TIMEDIFF(NOW(), tanggal_jam_proses))<=300";
    $db->mysql_query($sql, $rec_count, $data_trax);
    foreach ($data_trax as $key => $value) {
        if(array_search($value["no_hp"], $temp)!==false) {
            $db->mysql_update("mokes_transaksi_beli_pulsa", array(
               "status_confirm" => $status_confirm,
               "tanggal_jam_balasan" => date("Y-m-d H:i:s"),
               "katakunci_sukses" => $_POST["katakunci"],
               "balasan" => $_POST["message"]
            ), array("id" => $value["id"]));
            
            
            $data_user = $db->getFieldValue("mokes_pengguna", array("*"), array("id" => $value["id_user"]));
            include $root."includes/php/GCM.php";    
            $gcm = new GCM();            
            
            //sukses
            if($status_confirm==2) {
                //PUSH NOTIFICATION USER
                if(strlen($data_user[0]["gcm_regid"])>0) {
                    $data_beli_pulsa = array(
                        "success" => true,
                        "tanggal_jam" => date("d-m-Y H:i:s"),
                        "title" => "MOKES: BELI PULSA",
                        "konten" => "Pembelian ".strtolower($value["jenis_pulsa"])." ".$value["provider"]." dengan nominal ".$value["nominal"]." BERHASIL."
                    );
                    $gcmRegIds = array();
                    array_push($gcmRegIds, $data_user[0]['gcm_regid']);        
                    if(count($gcmRegIds)>0) {
                        $message = json_encode($data_beli_pulsa);            
                        $result = $gcm->send_notification($gcmRegIds, array("tipe" => "beli_pulsa", "message" => $message));
                        $db->mysql_update(
                            "mokes_transaksi_beli_pulsa", 
                            array(
                                "push_result" => $result           
                            ),
                            array("id" => $value["id"])
                        );
                    }
                }    
            }
    
            //gagal
            if($status_confirm==1) {

                $harga = $db->getFieldValue("mokes_histori_transaksi", array("debet"), array("transaksi" => "BELI PULSA", "id_ref" => $value["id"]));

                //UPDATE SALDO USER
                $db->mysql_update(
                    "mokes_pengguna", 
                    array(
                        "saldo" => "saldo".(isset($harga[0]["debet"])?("+".$harga[0]["debet"]):"")      
                    ),      
                    array("id" => $data_user[0]["id"]),
                    array("saldo")
                );

                //DELETE HISTORI TRANSAKSI
                $db->mysql_delete("mokes_histori_transaksi", array("transaksi" => "BELI PULSA", "id_ref" => $value["id"]));

                //PUSH NOTIFICATION USER
                if(strlen($data_user[0]["gcm_regid"])>0) {
                    $data_beli_pulsa = array(
                        "success" => true,
                        "tanggal_jam" => $_POST["tanggal_jam"],
                        "title" => "MOKES: BELI PULSA",
                        "konten" => "Pembelian ".strtolower($value["jenis_pulsa"])." ".$value["provider"]." dengan nominal ".$value["nominal"]." GAGAL."
                    );
                    $gcmRegIds = array();
                    array_push($gcmRegIds, $data_user[0]['gcm_regid']);        
                    if(count($gcmRegIds)>0) {
                        $message = json_encode($data_beli_pulsa);            
                        $result = $gcm->send_notification($gcmRegIds, array("tipe" => "beli_pulsa", "message" => $message));
                        $db->mysql_update(
                            "mokes_transaksi_beli_pulsa", 
                            array(
                                "push_result" => $result           
                            ),
                            array("id" => $value["id"])
                        );
                    }
                }    
            }
            
            $db->mysql_close();
            die(json_encode(array("success" => true, "id" => $value["id"], "status" => ($status_confirm==1?"GAGAL":"SUKSES"))));
            
            break;
        }                
    }
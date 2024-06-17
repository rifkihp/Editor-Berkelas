<?php
    $root = "../";
    include $root."includes/php/initial.php";
    if(strlen($_SESSION['security_code'])==0 || !isset($_SESSION['security_code']) || $_POST["security_code"]!=$_SESSION['security_code']) {
    	die(json_encode(array("success" => false, "message" => "Maaf! Token tidak valid!")));
    }
    unset($_SESSION['security_code']);

    include $root."includes/php/classUtama.php";
    include $root."includes/php/terbilang.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $id_member = $_POST["user_id"];    
    $id_header = $db->getLastNumber("ppob_transaksi", "id");
    $kode_order = $db->getLastNumber("ppob_transaksi", "kode", 4, $_POST["kode_trx"]."-".date("Ymd")."-");
    
    if(strlen($_POST["metode_pembayaran"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Metode pembayaran harus diisi.")));
    }
    
    //VALIDASI SALDO
    $member = $db->getFieldValue("member AS A", array("A.saldo", "A.aktif", "A.admin"), array("A.id" => $id_member));
    if($member[0]["aktif"]==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Akun anda tidak aktif. Hubungi Admin.")));
    }
    if($member[0]["admin"]==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Akun anda disuspend. Hubungi Admin.")));
    }
    
    //GET TOTAL
    if($_POST["tipe_trx"]=="BELI") {
        $produk = $db->getFieldValue("ppob_produk", array("jual"), array("id" => $_POST["id_produk"]));
        if(isset($produk[0]["jual"])) {
            $_POST["total"] = $produk[0]["jual"];
        } else {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Produk tidak valid.")));
        }
        
        if($_POST["total"]==0) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Produk tidak valid.")));
        }
    }
    
    if($member[0]["saldo"]<$_POST["total"]) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Saldo tidak mencukupi.")));
    }
    $tanggal_jam = date("Y-m-d H:i:s");
    
    //SALDO MEMBER BERKURANG
    $sql = "UPDATE member SET saldo=saldo-".$_POST["total"]." WHERE id=".$id_member;
    $db->mysql_execute($sql);

    //HISTORI TRANSAKSI
    $db->mysql_insert("h_trx", array(
        "id_member" => $id_member,
        "kode"   => $_POST["kode_trx"],
        "jenis"  => "D",
        "id_ref" => $id_header,
        "jumlah" => $_POST["total"],
        "tanggal_jam" => $tanggal_jam
    ));
    
    $terbilang = new terbilang();
    
    //SAVE TRANSAKSI
    $data = array(
        "id" => $id_header,
        "id_member" => $id_member,
        "kode" => $kode_order,
        "jenis_trx" => $_POST["tipe_trx"],
        "tanggal_jam" => $tanggal_jam,
        "pembayaran" => $_POST["metode_pembayaran"],
        
        //produk_selected
        "id_produk" => $_POST["id_produk"],
        "provider" => $_POST["provider"],
        "provider_sub" => $_POST["provider_sub"],
        "code" => $_POST["code"],
        "description" => $_POST["description"],
        
        //tagihan & produk_selecterd
        "nomer_tujuan" => $_POST["nomer_tujuan"],
        "nama_tujuan"  => $_POST["nama_tujuan"],
        "lembar"       => $_POST["lembar"],
        "platform"     => $_POST["platform"],
        
        "pemakaian"    => $_POST["pemakaian"],
        "periode"      => $_POST["periode"],
        
        "tagihan" => $_POST["tagihan"],
        "denda" => $_POST["denda"],
        "biaya" => $_POST["biaya"],
        "admin" => $_POST["admin"],
        "transaksi" => $_POST["transaksi"],
        "fee" => $_POST["fee"],
        "total" => $_POST["total"],
        "beli" => $_POST["beli"],
        "terbilang" => $terbilang->toTerbilang($_POST["total"]),
        
        "date_update_status" => $tanggal_jam,
        "date_create" => $tanggal_jam,
        "date_update" => $tanggal_jam,
        "status" => "2" 
    );
    
    if($_POST["tipe_trx"]=="BAYAR") {
        
        //LISTRIK
        if(isset($_POST["pln_detail"])) {
            $id_taglis_head = $db->getLastNumber("pln_taglis_head", "id");
            $db->mysql_insert(
                "pln_taglis_head", 
                array(
                    "id" => $id_taglis_head,
                    "id_transaksi" => $id_header,
                    "subscriberID" => $_POST["pln_subscriberID"],
                    "nama" => $_POST["pln_nama"],
                    "tarif" => $_POST["pln_tarif"],
                    "daya" => $_POST["pln_daya"],
                    "lembarTagihanTotal" => $_POST["pln_lembarTagihanTotal"],
                    "lembarTagihan" => $_POST["pln_lembarTagihan"],
                    "lembarTagihanSisa" => $_POST["pln_lembarTagihanSisa"],
                    "totalTagihan" => $_POST["pln_totalTagihan"],
                    "productCode" => $_POST["pln_productCode"],
                    "refID" => $_POST["pln_refID"]
                )
            );
            
            $sql_insert = "INSERT INTO pln_taglis_detail(id_head, periode, nilaiTagihan, denda, admin, transaksi,total) VALUES";
            $row = explode("\n", $_POST["pln_detail"]);
            foreach($row as $i => $value) {
                $col = explode("\t", $value);    
                $periode      = $col[0];
                $nilaiTagihan = $col[1];
                $denda        = $col[2];
                $admin        = $col[3];
                $transaksi    = $col[4];
                $total        = $col[5];
                
                $sql_insert.="("
                    . "'".$id_taglis_head."', "
                    . "'".$periode."',"
                    . "'".$nilaiTagihan."',"
                    . "'".$denda."',"
                    . "'".$admin."',"
                    . "'".$transaksi."',"
                    . "'".$total."' "
                . "),";
            }
            $db->mysql_execute(rtrim($sql_insert, ","));
        }
        
        //PDAM
        if(isset($_POST["pdam_detail"])) {
            $sql_insert = "INSERT INTO pdam_tagihan_detail(id_head, periode, pemakaian, meterAwal, meterAkhir, nilaiTagihan, denda, tagihanLain, admin, transaksi,total, tarif, alamat, no_account, terbilang) VALUES";
            $row = explode("\n", $_POST["pdam_detail"]);
            foreach($row as $i => $value) {
                $col = explode("\t", $value);    
                $periode      = $col[0];
                $pemakaian    = $col[1];
                $meterAwal    = $col[2];
                $meterAkhir   = $col[3];
                $nilaiTagihan = $col[4];
                $denda        = $col[5];
                $tagihanLain  = $col[6];
                $admin        = $col[7];
                $transaksi    = $col[8];
                $total        = $col[9];
                $tarif        = $col[10];
                $alamat       = $col[11];
                $no_account   = $col[12];
                $terbil       = $terbilang->toTerbilang($total);
                
                $sql_insert.="("
                    . "'".$id_header."', "
                    . "'".$periode."',"
                    . "'".$pemakaian."',"
                    . "'".$meterAwal."',"
                    . "'".$meterAkhir."',"
                    . "'".$nilaiTagihan."',"
                    . "'".$denda."',"
                    . "'".$tagihanLain."',"
                    . "'".$admin."',"
                    . "'".$transaksi."',"
                    . "'".$total."',"
                    . "'".$tarif."',"
                    . "'".$alamat."',"
                    . "'".$no_account."',"
                    . "'".$terbil."' "                        
                . "),";
            }
            $db->mysql_execute(rtrim($sql_insert, ","));
        }
        
        //TELKOM
        if(isset($_POST["telkom_detail"])) {
            $sql_insert = "INSERT INTO telkom_tagihan_detail(id_head, periode, nilaiTagihan, denda, admin, transaksi, total, fee, terbilang) VALUES";
            $row = explode("\n", $_POST["telkom_detail"]);
            foreach($row as $i => $value) {
                $col = explode("\t", $value);    
                $periode      = $col[0];
                $nilaiTagihan = $col[1];
                $denda        = $col[2];
                $admin        = $col[3];
                $transaksi    = $col[4];
                $total        = $col[5];
                $fee          = $col[6];
                $terbil       = $terbilang->toTerbilang($total);
                
                $sql_insert.="("
                    . "'".$id_header."', "
                    . "'".$periode."',"
                    . "'".$nilaiTagihan."',"
                    . "'".$denda."',"
                    . "'".$admin."',"
                    . "'".$transaksi."',"
                    . "'".$total."',"
                    . "'".$fee."',"
                    . "'".$terbil."' "                        
                . "),";
            }
            $db->mysql_execute(rtrim($sql_insert, ","));
        }
        
        //TELEVISI
        if(isset($_POST["televisi_detail"])) {
            $sql_insert = "INSERT INTO televisi_tagihan_detail(id_head, periode, jatuhTempo,referensi,noref1,noref2,paket,nilaiTagihan, denda, admin, transaksi, total, fee, terbilang) VALUES";
            $row = explode("\n", $_POST["televisi_detail"]);
            foreach($row as $i => $value) {
                $col = explode("\t", $value);    
                $periode      = $col[0];
                $jatuhTempo   = $col[1];
                $referensi    = $col[2];
                $noref1       = $col[3];
                $noref2       = $col[4];
                $paket        = $col[5];
                $nilaiTagihan = $col[6];
                $denda        = $col[7];
                $admin        = $col[8];
                $transaksi    = $col[9];
                $total        = $col[10];
                $fee          = $col[11];
                $terbil       = $terbilang->toTerbilang($total);
                
                $sql_insert.="("
                    . "'".$id_header."', "
                    . "'".$periode."',"
                    . "'".$jatuhTempo."',"
                    . "'".$referensi."',"
                    . "'".$noref1."',"
                    . "'".$noref2."',"
                    . "'".$paket."',"
                    . "'".$nilaiTagihan."',"
                    . "'".$denda."',"
                    . "'".$admin."',"
                    . "'".$transaksi."',"
                    . "'".$total."',"
                    . "'".$fee."',"
                    . "'".$terbil."' "                        
                . "),";
            }
            $db->mysql_execute(rtrim($sql_insert, ","));
        }
    }
    
    if($_POST["metode_pembayaran"]==1) {
        $data["bank_id"] = $_POST["bank_id"];
        $data["no_rekening"] = $_POST["bank_no_rekening"];
        $data["nama_pemilik_rekening"] = $_POST["bank_nama_pemilik_rekening"];
        $data["nama_bank"] = $_POST["bank_nama"];
        $data["cabang"] = $_POST["bank_cabang"];    
    }
    
    $db->mysql_insert("ppob_transaksi", $data);
    
    $digits = 9;
    $trxid_api = rand(pow(10, $digits-1), pow(10, $digits)-1);

    $db->mysql_insert("channel_send", array(
        "code" => $_POST["code"],
        "phone" => $_POST["nomer_tujuan"],
        "trxid_api" => $_POST["tipe_trx"]=="BAYAR"?$_POST["inquiry"]:$trxid_api,
        "total" => $_POST["total"]-$_POST["transaksi"],
        "text" => '',
        "tanggal_jam_request" => date("Y-m-d H:i:s"),
        "tanggal_jam_process" => "0000-00-00 00:00:00",
        "tanggal_jam_response" => "0000-00-00 00:00:00",
        "server" => ($_POST["provider"]=="BOSBILLER"?"BOSBILLER":"JAVAH2H"),
        "status" => "WAITING",
        "id_header" => $id_header 
    ));
    
    $sql = "SELECT A.id, A.first_name, A.last_name, A.email, A.phone, A.photo, A.saldo FROM member AS A WHERE A.id='".$id_member."'";
    $db->mysql_query($sql, $rec_count, $user);
    
    $db->mysql_close();
    die(json_encode(array("success" => true, "id_header" => $id_header, "no_transaksi" => $kode_order, "user" => $user[0], "jumlah" => $_POST["total"])));
<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
            
    //validasi-validasi
    if(strlen($_POST["tanggal"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Tanggal harus diisi.")));
    } else {
        if(!$db->dateValidation($_POST["tanggal"], "d-m-Y")) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Format Tanggal tidak valid.")));
        }
    }
    
    if(strlen($_POST["nama_member"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Member harus diisi.")));
    } 
    
    if(strlen($_POST["nama"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Pengiriman kepada harus diisi.")));
    } 
    
    if(strlen($_POST["alamat"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Alamat harus diisi.")));
    }
    
    if(strlen($_POST["no_hp"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "No. HP harus diisi.")));
    }
    
    if(strlen($_POST["id_propinsi"])==0 || $_POST["id_propinsi"]=="0") {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Propinsi harus diisi.")));
    }
    
    if(strlen($_POST["id_kota"])==0 || $_POST["id_kota"]=="0") {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Kota harus diisi.")));
    }
    
    if(strlen($_POST["id_kecamatan"])==0 || $_POST["id_kecamatan"]=="0") {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Kecamatan harus diisi.")));
    }
    
    if(strlen($_POST["kode_pos"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Kode Pos harus diisi.")));
    }
    
    if(strlen($_POST["kurir"])==0 || $_POST["kurir"]=='0') {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Kurir harus diisi.")));
    }
    
    if(strlen($_POST["layanan"])==0 || $_POST["layanan"]=="0") {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Layanan harus diisi.")));
    }
    
    if($_POST["is_dropship"]=="Y" && strlen(trim($_POST["dropship_name"]))==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Nama dropshiper harus diisi.")));
    }
    
    if($_POST["id_member"]=="0" && strlen(trim($_POST["email_notifikasi"]))==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Email notifikasi harus diisi.")));
    }
    
    if(strlen($_POST["pembayaran"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Metode pembayaran harus diisi.")));
    }
    
    if($_POST["status"]==2 || $_POST["status"]==5 || $_POST["status"]==6)  {
        if(strlen($_POST["pembayaran"])=="1" && strlen(trim($_POST["bank_tujuan"]))==0) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Bank tujuan pembayaran harus diisi.")));
        }

        if(strlen($_POST["pembayaran"])=="1" && (strlen(trim($_POST["jumlah_transfer"]))==0 || $_POST["jumlah_transfer"]<$_POST["total"])) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Jumlah transfer tidak boleh kurang dari total pemesanan.")));
        }
    }
    
    $id_member = $_POST["id_member"];
    $id_header = $db->getLastNumber("customer_order_header", "id");
    $kode_order = $db->getLastNumber("customer_order_header", "kode", 6);
    
    //TIPE USER
    $data_user = $db->getFieldValue("member", array("*"), array("id" => $id_member));
    $tipe_user = count($data_user)>0?$data_user[0]["jenis_user"]:0;
    
    
    //SAVE ALAMAT JIKA MEMBER
    if($id_member!=0) {
        $alamat_customer = $db->getFieldValue("customer_address", array("*"), array("id_member" => $id_member, "UPPER(nama)" => strtoupper($_POST["nama"])));
        
        if(count($alamat_customer)==0) {
            $db->mysql_insert("customer_address", array(
                "id_member" => $id_member,
                "nama" => $_POST["nama"],
                "alamat" => $_POST["alamat"],
                "id_propinsi" => $_POST["id_propinsi"],
                "nama_propinsi" => $_POST["nama_propinsi"],
                "id_kota" => $_POST["id_kota"],
                "nama_kota" =>  $_POST["nama_kota"],        
                "id_kecamatan" => $_POST["id_kecamatan"],
                "nama_kecamatan" =>  $_POST["nama_kecamatan"],
                "kode_pos" => $_POST["kode_pos"],
                "no_hp" => $_POST["no_hp"]
            ));
        } else {
            $db->mysql_update("customer_address", array(
                "id_member" => $id_member,
                "nama" => $_POST["nama"],
                "alamat" => $_POST["alamat"],
                "id_propinsi" => $_POST["id_propinsi"],
                "nama_propinsi" => $_POST["nama_propinsi"],
                "id_kota" => $_POST["id_kota"],
                "nama_kota" =>  $_POST["nama_kota"],        
                "id_kecamatan" => $_POST["id_kecamatan"],
                "nama_kecamatan" =>  $_POST["nama_kecamatan"],
                "kode_pos" => $_POST["kode_pos"],
                "no_hp" => $_POST["no_hp"]
            ), array(
                "id" => $alamat_customer[0]["id"]
            ));
        }
    }
    
    //SAVE ONGKOS KIRIM
    $ekspedisi = $db->getFieldValue("ekspedisi", array("id"), array("kode" => $_POST["kurir"]));
    $db->mysql_insert("customer_order_ongkir", array(
        "id_header" => $id_header,
        "id_ekspedisi" => $ekspedisi[0]["id"],
        "layanan" => $_POST["layanan"],
        "tarif" => $_POST["ongkir"],
        "etd" => $_POST["etd"]
    ));
    
    //SAVE DETAIL PESANAN
    $row = explode("\n", $_POST["detail"]);
    $sql_insert = "INSERT INTO customer_order_detail(id_header, id_produk, kode, nama, gambar, ukuran, warna, jumlah, berat, harga_beli, harga_jual, harga_diskon, persen_diskon, sub_total, grand_total) VALUES";
    
    $total_qty = 0;
    $grandtotal = 0;
    foreach($row as $i => $value) {
        $col = explode("\t", $value);
        
        //GET FOTO
        $sql = "SELECT nama_file AS foto FROM gambar_produk WHERE id_produk='".$col[0]."' AND as_default='Y'";
        $db->mysql_query($sql, $rec_count_gambar, $data_gambar);
        
        $ukuran = $warna = "";
        if(strlen($col[4])>0) {
            $temp = explode("|", $col[4]);
            $ukuran = $temp[0];
            $warna = $temp[1];
        }
        
        $sql_insert.="("
            . "'$id_header', "                   // id_header
            . "'".$col[0]."',"                   // id_produk
            . "'".$col[1]."',"                   // kode
            . "'".$col[2]."',"                   // nama
            . "'".$data_gambar[0]["foto"]."',"   // gambar
            . "'".$ukuran."',"                   // ukuran
            . "'".$warna."',"                    // warna
            . "'".$col[5]."',"                   // jumlah
            . "'".$col[3]."',"                   // berat
            . "'".$col[10]."',"                  // harga beli
            . "'".$col[6]."',"                   // harga jual
            . "'".$col[6]."',"                   // harga diskon
            . "'".$col[7]."',"                   // persen diskon
            . "'".$col[8]."',"                   // sub total
            . "'".$col[9]."'),";                 // grand total
        
        //UPDATE STOK
        $db->mysql_update(
            "produk_varian", 
            array(
                "jumlah" => "(jumlah-".$col[5].")", 
                "keep" => "(keep+".$col[5].")"), 
            array(
                "id_produk" => $col[0], 
                "ukuran" => $ukuran,
                "warna" => $warna), 
            array(
                "jumlah", 
                "keep")
        );
        
        $grandtotal+=$col[9];
        $total_qty+=$col[5];
    }
    $db->mysql_execute(rtrim($sql_insert, ","));
        
    $temp = explode("-", $_POST["tanggal"]);
    $tanggal_jam = ($temp[2]."-".$temp[1]."-".$temp[0]) . " " . date("H:i:s");
    
    //SAVE HEADER
    $db->mysql_insert("customer_order_header", array(
        "id" => $id_header,
        "id_member" => $id_member,
        "kode" => $kode_order,
        "tanggal_jam" => $tanggal_jam, 

        "nama" => $_POST["nama"],
        "alamat" => $_POST["alamat"],
        "id_propinsi" => $_POST["id_propinsi"],
        "nama_propinsi" => $_POST["nama_propinsi"],
        "id_kota" => $_POST["id_kota"],
        "nama_kota" => $_POST["nama_kota"],        
        "id_kecamatan" => $_POST["id_kecamatan"],
        "nama_kecamatan" => $_POST["nama_kecamatan"],
        "kode_pos" => $_POST["kode_pos"],
        "no_hp" => $_POST["no_hp"],

        "is_dropship" => $_POST["is_dropship"],
        "dropship_name" => $_POST["dropship_name"],
        "dropship_phone" => $_POST["dropship_phone"],
        "email_notifikasi" => $_POST["email_notifikasi"],

        "pembayaran" => $_POST["pembayaran"],

        "total_qty" => $total_qty,
        "grandtotal" => $grandtotal,
        "voucher" => $_POST["voucher"],
        "ongkir" =>  $_POST["ongkir"],
        "total" => ($grandtotal-$_POST["voucher"])+$_POST["ongkir"],

        "is_open" => "N",
        "date_update_status" => date("Y-m-d H:i:s"), 
        "status" => $_POST["status"]
    ));
    
    //INSERT HISTORI PEMESANAN
    $db->mysql_insert("histori_status_pemesanan", array(
        "id" => $db->getLastNumber("histori_status_pemesanan", "id"),
        "id_pemesanan" => $id_header,
        "tanggal_jam" => $tanggal_jam,
        "penjelasan" => "Admin melakukan perubahan pesanan."
    ));
    
    //UPDATE KONFIRMASI PEMBAYARAN
    if($_POST["pembayaran"]==1 && ($_POST["status"]==2 || $_POST["status"]==5 || $_POST["status"]==6))  {
        $data_konfirmasi =  $db->getFieldValue(
            "konfirmasi_pembayaran AS A", 
            array("*"), 
            array(
                "A.id_header" => $id_header,
                "A.status" => 2
            )
        );
        
        if(count($data_konfirmasi)==0) {
            $data_konfirmasi =  $db->getFieldValue(
                "konfirmasi_pembayaran AS A", 
                array("*"), 
                array(
                    "A.kode_pemesanan" => $data_header[0]["kode"]
                ),
                array(),
                1, 0,
                " id DESC "
            );
        }
            
        if(count($data_konfirmasi)==0) {
            $db->mysql_insert("konfirmasi_pembayaran", 
                array(
                    "id" => $db->getLastNumber("konfirmasi_pembayaran", "id"),
                    "tanggal_jam" => $tanggal_jam,
                    "kode_pemesanan" => $data_header[0]["kode"],
                    "bank_tujuan" => $_POST["bank_tujuan"],
                    "jumlah_transfer" => $_POST["jumlah_transfer"],                
                    "id_member" => $_POST["id_member"],
                    "id_header" => $id_header,
                    "status" => 2,
                    "tanggal_jam_update_status" => $tanggal_jam                
                )
            );
            
            $db->mysql_insert("histori_status_pemesanan", array(
                "id" => $db->getLastNumber("histori_status_pemesanan", "id"),
                "id_pemesanan" => $id_header,
                "tanggal_jam" => $tanggal_jam,
                "penjelasan" => "Admin menerima pembayaran customer."
            ));
            
        } else {
            $sql = "DELETE FROM konfirmasi_pembayaran WHERE kode_pemesanan='".$data_header[0]["kode"]."' AND id<>'".$data_konfirmasi[0]["id"]."'";
            $db->mysql_execute($sql);
            
            $db->mysql_update("konfirmasi_pembayaran", 
                array(                    
                    "bank_tujuan" => $_POST["bank_tujuan"],
                    "jumlah_transfer" => $_POST["jumlah_transfer"],                
                    "id_header" => $id_header,
                    "status" => 2      
                ), array(
                    "id" => $data_konfirmasi[0]["id"]
                )
            );
        }
    }

    //SEND EMAIL TO USER
    $data_umum = $db->getFieldValue("umum", array("website", "mask_email"));
    $email_from = $data_umum[0]["mask_email"];
    $from_alias = $data_umum[0]["website"];
    
    $data_member = $db->getFieldValue("member", array("CONCAT(first_name, ' ', last_name) AS nama", "email"), array("id" => $_POST["id_member"]));
    $subject = "Pemesanan Baru";
    $detail_message = "Admin telah membuat pesanan baru untuk Anda dengan nomer pemesanan <b>#".$kode_order."/b>.";

    $email_to = $_POST["id_member"]=="0"?$_POST["email_notifikasi"]:$data_member[0]["email"];
    $to_alias = $_POST["id_member"]=="0"?'Guest':$data_member[0]["nama"];
    $db->sendEmail($email_to, $to_alias, $subject, $detail_message, $email_from, $from_alias);
    
    $_SESSION["alert_success"] = "Tambah data pesanan berhasil.";
    $db->mysql_close();
    die(json_encode(array("success" => true)));
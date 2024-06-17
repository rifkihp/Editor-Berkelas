<?php
    $root = "../";
    include $root."includes/php/initial.php";    
    include $root."includes/php/classUtama.php";
        
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $id = $db->checkIntegerRange($_POST["id"])?$_POST["id"]:0;
    
    $data_user = $db->getFieldValue("member", array("*"), array("id" => $_POST["id_user"]));
    $tipe_user = count($data_user)>0?$data_user[0]["jenis_user"]:0;
    $freeongkir = $db->getFieldValue("freeongkir_setting", array("is_aktif", "all_produk"));
        
    //IMAGES LIST
    $sql = "SELECT nama_file FROM gambar_produk WHERE id_produk='$id' ORDER BY urutan";
    $db->mysql_query($sql, $rec_count, $data_images);
    
    //related produk
    $sql = "SELECT B.*, IF(B.harga_diskon>0 AND IF(B.from_date_harga_diskon IS NOT NULL, B.from_date_harga_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(B.to_date_harga_diskon IS NOT NULL, B.to_date_harga_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1), 1, 0) AS harga_promo, IF(B.persen_diskon>0 AND IF(B.from_date_persen_diskon IS NOT NULL, B.from_date_persen_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(B.to_date_persen_diskon IS NOT NULL, B.to_date_persen_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1), 1, 0) AS diskon_promo" . (count($data_user)>0?", IF(C.harga_jual IS NOT NULL, C.harga_jual, B.harga_jual) AS harga_jual_khusus":"")." FROM produk_to_category AS A LEFT JOIN produk AS B ON A.id_produk=B.id".(count($data_user)>0?" LEFT JOIN (SELECT id_produk, harga_jual FROM harga_jual_user WHERE tipe_user='$tipe_user' AND harga_jual>0 GROUP BY id_produk) AS C ON C.id_produk=B.id":"")." WHERE A.id_produk<>'$id' AND A.id_kategori IN (SELECT id_kategori FROM produk_to_category WHERE id_produk='$id') ORDER BY RAND() LIMIT 10";
    $db->mysql_query($sql, $rec_count, $produk_lain);
    foreach ($produk_lain as $key => $value) {
        $produk_lain[$key]["produk_freeongkir"] = $freeongkir[0]["is_aktif"]==0?0:($freeongkir[0]["all_produk"]==1?1:$value["produk_freeongkir"]);
            
        $produk_lain[$key]["foto1_produk"] = $value["gambar_utama"];
        $produk_lain[$key]["nama"] = trim(ucwords(strtolower($value["nama"])));

        $produk_lain[$key]["harga_jual"] = $value[count($data_user)==0?"harga_jual":"harga_jual_khusus"];
        $produk_lain[$key]["persen_diskon"] = $value["diskon_promo"]==1?$value["persen_diskon"]:0;
        $produk_lain[$key]["harga_diskon"] = $value["harga_promo"]==1?$value["harga_diskon"]:0;
        if($value["persen_diskon"]!=0) {
            if($produk_lain[$key]["harga_diskon"]!=0) { $produk_lain[$key]["harga_jual"] = $produk_lain[$key]["harga_diskon"]; }                
            $produk_lain[$key]["harga_diskon"] = $produk_lain[$key]["harga_jual"]-($produk_lain[$key]["persen_diskon"]*($produk_lain[$key]["harga_jual"]*0.01));
        }
            
        $produk_lain[$key]["kategori"] = $db->getFieldValue("produk_to_category AS A LEFT JOIN category AS B ON A.id_kategori=B.id", array("B.id", "B.nama"), array("A.id_produk" => $value["id"]));
        $produk_lain[$key]["category_name"] = "";
        foreach ($produk_lain[$key]["kategori"] as $key_kategori => $value_kategori) {
            $produk_lain[$key]["category_name"] .= $value_kategori["nama"].", ";
        }
        $produk_lain[$key]["category_name"] = rtrim($produk_lain[$key]["category_name"], ", ");
    }
    
    //GET LIST UKURAN DAN WARNA
    $list_ukuran = $list_warna = array();
    $data_ukuran_warna = $db->getFieldValue("produk_varian", array("*"), array("id_produk" => $id), array(), 0, 0, "", "jumlah>0");
    $jumlah_stok = 0;
    if(count($data_ukuran_warna)==1 && $data_ukuran_warna[0]["ukuran"]=="" && $data_ukuran_warna[0]["warna"]=="") {
        $jumlah_stok = $data_ukuran_warna[0]["jumlah"];
    } else {
        //GET LIST UKURAN
        foreach($data_ukuran_warna as $i => $value) {        
            $jumlah_stok+=$value["jumlah"];
            if(strlen($value["ukuran"])>0) {
                $add_ukuran = true;
                foreach ($list_ukuran as $i_ukuran => $v_ukuran) {
                    if($v_ukuran["ukuran"]==$value["ukuran"]) {
                        $add_ukuran = false;
                        break;
                    }
                }            
                if($add_ukuran) { $list_ukuran[count($list_ukuran)]["ukuran"] = $value["ukuran"]; }
            }

            if(strlen($value["warna"])>0) {
                $add_warna = true;
                foreach ($list_warna as $i_warna => $v_warna) {
                    if($v_warna["warna"]==$value["warna"]) {
                        $add_warna = false;
                        break;
                    }
                }
                if($add_warna) { $list_warna[count($list_warna)]["warna"] = $value["warna"]; }
            }
        }
    }
    
    $data_pengaturan = $db->getFieldValue("pengaturan AS A", array("A.is_tampilkan_stok"), array("A.id" => 1));
    
    $data_grosir =  $db->getFieldValue("produk_grosir AS A", array("A.jumlah_min", "A.jumlah_max", "A.harga"), array("A.id_produk" => $id));
    
    //DATA ALAMAT DEFAULT
    //$data_alamat = $db->getFieldValue("customer_address", array("id_propinsi", "nama_propinsi", "id_kota", "nama_kota", "id_kecamatan", "nama_kecamatan"), array("id_member" => $_POST["id_user"], "as_default" => 1));
    //if(count($data_alamat)==0) {
        $data_alamat[0] = array(
            "id_propinsi" => 6, 
            "nama_propinsi" => "DKI Jakarta", 
            "id_kota" => 152, 
            "nama_kota" => "Jakarta Pusat", 
            "id_kecamatan" => 2102, 
            "nama_kecamatan" => "Tanah Abang"
        );
    //}
    
    //PENGATURAN STOK
    $data_set_stok = $db->getFieldValue("pengaturan", array("status_stok", "parameter_status")); 
    
    $db->mysql_close();
    die(json_encode(array("images" => $data_images, "alamat_kirim" => $data_alamat[0], "totalCount" => $rec_count, "topics" => $produk_lain, "tampilkan_stok" => $data_pengaturan[0]["is_tampilkan_stok"]=="Y", "jumlah_stok" => $jumlah_stok, "list_ukuran" => $list_ukuran, "list_warna" => $list_warna, "list_stok" => $data_ukuran_warna, "list_grosir" => $data_grosir, "set_stok" => $data_set_stok[0])));
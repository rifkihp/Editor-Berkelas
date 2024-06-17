<?php
    $root = "../";
    include $root."includes/php/initial.php";    
    include $root."includes/php/classUtama.php";
        
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    //TIPE USER
    $data_user = $db->getFieldValue("member", array("*"), array("id" => $_POST["id_user"]));
    $tipe_user = count($data_user)>0?$data_user[0]["jenis_user"]:0;
    
    $total_qty = 0;
    $total = 0;
    $cart = array();
    if(strlen(trim($_POST["cart"]))>0) {
        $row = explode("\n", trim($_POST["cart"]));
        foreach($row as $i => $value) {
            $col = explode("\t", $value);    
            $id_produk = $col[0];
            $ukuran    = $col[1];
            $warna     = $col[2];
            $qty       = $col[3];
            $qty_komulatif = $qty;
            foreach($row as $i_ => $value_) {
                $col_ = explode("\t", $value_);    
                if($i!=$i_ && $id_produk==$col_[0]) {
                    $qty_komulatif+=$col_[3];
                }
            }

            $cart[$i] = array("id" => $id_produk, "ukuran" => $ukuran, "warna" => $warna, "qty" => $qty, "message" => "Produk tersedia!", "status" => "OK");
            //CEK AVIABYLITY PRODUK
            $sql = "SELECT A.id, A.kode, A.nama, A.harga_modal AS harga_beli, ".(count($data_user)>0?"IF(C.harga_jual IS NOT NULL, C.harga_jual, A.harga_jual) AS harga_jual_khusus":"A.harga_jual").", A.harga_diskon, A.persen_diskon, A.berat, IF(A.harga_diskon>0 AND IF(A.from_date_harga_diskon IS NOT NULL, A.from_date_harga_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_harga_diskon IS NOT NULL, A.to_date_harga_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1), 1, 0) AS harga_promo, IF(A.persen_diskon>0 AND IF(A.from_date_persen_diskon IS NOT NULL, A.from_date_persen_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_persen_diskon IS NOT NULL, A.to_date_persen_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1), 1, 0) AS diskon_promo FROM produk AS A".(count($data_user)>0?" LEFT JOIN (SELECT id_produk, harga_jual FROM harga_jual_user WHERE tipe_user='$tipe_user' AND harga_jual>0 GROUP BY id_produk) AS C ON C.id_produk=A.id":"")." WHERE A.id='".$id_produk."'";
            $db->mysql_query($sql, $rec_count, $data);
            if($rec_count==0) {
                $cart[$i]["status"]  = "ERROR";
                $cart[$i]["message"] = "Maaf stok kosong.";
            } else {
                //CEK STOK
                $data_stok = $db->getFieldValue("produk_varian", array("*"), array("id_produk" => $id_produk, "ukuran" => $ukuran, "warna" => $warna), array(), 0, 0, "", " jumlah>0 ");
                if(count($data_stok)>0) {
                    if($qty>$data_stok[0]["jumlah"]) {                
                        $cart[$i]["status"]  = "ERROR";
                        $cart[$i]["message"] = "Stok tidak cukup!";
                    }
                } else {
                    $cart[$i]["status"]  = "ERROR";
                    $cart[$i]["message"] = "Maaf stok kosong.";
                }
            }

            if($cart[$i]["status"]=="OK") {
                $data_grosir = array();
                $sql = "SELECT * FROM produk_grosir WHERE id_produk='".$id_produk."' AND jumlah_min<='$qty_komulatif' ORDER BY jumlah_min DESC LIMIT 0, 1";
                $db->mysql_query($sql, $rec_count, $data_grosir);

                $data[0]["persen_diskon"] = $data[0]["diskon_promo"]==1?$data[0]["persen_diskon"]:0;
                $data[0]["harga_diskon"]  = $data[0]["harga_promo"]==1?$data[0]["harga_diskon"]:0;
                $data[0]["harga_jual"]    = count($data_grosir)>0?$data_grosir[0]["harga"]:($data[0]["harga_diskon"]>0?$data[0]["harga_diskon"]:$data[0][count($data_user)==0?"harga_jual":"harga_jual_khusus"]);
                $data[0]["subtotal"]      = $data[0]["harga_jual"]-($data[0]["harga_jual"]*$data[0]["persen_diskon"]*0.01);    
                $data[0]["grandtotal"]    = $qty*$data[0]["subtotal"];

                $cart[$i]["id"]            = $data[0]["id"];
                $cart[$i]["kode"]          = $data[0]["kode"];
                $cart[$i]["nama"]          = $data[0]["nama"];
                $cart[$i]["gambar"]        = $data[0]["foto"];
                $cart[$i]["ukuran"]        = $ukuran;
                $cart[$i]["warna"]         = $warna;
                $cart[$i]["jumlah"]        = $qty;
                $cart[$i]["berat"]         = $data[0]["berat"];
                $cart[$i]["harga_beli"]    = $data[0]["harga_beli"];
                $cart[$i]["harga_jual"]    = $data[0]["harga_jual"];
                $cart[$i]["harga_diskon"]  = $data[0]["harga_diskon"];
                $cart[$i]["persen_diskon"] = $data[0]["persen_diskon"];
                $cart[$i]["subtotal"]      = $data[0]["subtotal"];
                $cart[$i]["grandtotal"]    = $data[0]["grandtotal"];

                $total+=$cart[$i]["grandtotal"];
                $total_qty+=$cart[$i]["jumlah"];
            }
        }
    }
    $result = array("topics" => $cart, "qty" => $total_qty, "jumlah" => $total);
    
    
    //DATA ALAMAT
    $data_alamat = $db->getFieldValue("customer_address", array("*"), array("id_member" => $_POST["id_user"], "as_default" => 1));
    if(count($data_alamat)>0) {
        $result["data_alamat"] = $data_alamat[0]; 
    }
    $db->mysql_close();
    
    die(json_encode($result));
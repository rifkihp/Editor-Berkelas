<?php
    $root = "../";
    include $root."includes/php/initial.php";    
    include $root."includes/php/classUtama.php";
        
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $no_transaksi = $_POST["no_transaksi"];
    
    //ALAMAT
    $data_alamat = $db->getFieldValue("customer_order_header AS A", array("A.*"), array("A.kode" => $no_transaksi));
    $data_alamat[0]["is_dropship"] = $data_alamat[0]["is_dropship"]=="Y";
    
    //ONGKIR
    $data_ongkir = $db->getFieldValue("customer_order_ongkir AS A LEFT JOIN ekspedisi AS B ON A.id_ekspedisi=B.id LEFT JOIN customer_order_header AS C ON A.id_header=C.id", array(
        "B.id AS id_kurir", 
        "B.kode AS kode_kurir",
        "B.nama AS nama_kurir",
        "A.kode_layanan AS kode_service",
        "A.layanan AS nama_service",
        "A.nominal",
        "A.etd",
        "A.tarif",
        "B.gambar"
    ), array(
        "C.kode" => $no_transaksi
    ));
    $data_ongkir[0]["tarif"] = "Rp ".number_format($data_ongkir[0]["tarif"], 0, '.', ',');
    
    //DATA PEMBAYARAN
    $data_pembayaran = $db->getFieldValue("customer_order_transfer_bank AS A LEFT JOIN bank_transfer AS C ON A.bank_id=C.id LEFT JOIN customer_order_header AS B ON A.id_header=B.id", array(
        "A.bank_id AS id", 
        "A.no_rekening",
        "A.nama_pemilik_rekening",
        "A.nama_bank",
        "A.cabang",
        "C.gambar"
    ), array(
        "B.kode" => $no_transaksi
    ));
    
    //VOUCHER
    $data_voucher = $db->getFieldValue("customer_order_voucher AS A LEFT JOIN customer_order_header AS B ON A.id_header=B.id", array(
        "A.kode_voucher",
        "A. nominal AS nominal_voucher",
        "A.tipe_voucher",
        "A.jenis_voucher"
    ), array(
        "B.kode" => $no_transaksi)
    );
    
    $detail_order = $db->getFieldValue(
        "customer_order_detail AS A LEFT JOIN customer_order_header AS B ON A.id_header=B.id LEFT JOIN gambar_produk AS D ON A.id_produk=D.id_produk AND D.as_default='Y'", 
        array("A.id", "A.kode", "A.nama", "D.nama_file AS gambar", "A.ukuran", "A.warna", "B.total_qty", "B.total", "B.ongkir", "B.voucher", "A.jumlah", "A.berat", "A.harga_beli", "A.harga_jual", "A.harga_diskon", "A.persen_diskon", "A.sub_total AS subtotal", "A.grand_total AS grandtotal"), 
        array("B.kode" => $no_transaksi)
    );
    
    $gtotal_diskon = 0;
    $gtotal_pengiriman = $detail_order[0]["ongkir"];
    $gtotal_voucher = $detail_order[0]["voucher"];
    
    $gtotal_total = 0;
    foreach($detail_order as $i => $value) {
        $gtotal_total+=$value["grandtotal"];
        $detail_order[$i]["persen_diskon"] = str_replace("%", "", $value["persen_diskon"]);
    }
    
    $db->mysql_close();
    die(json_encode(array("alamat" => $data_alamat[0], "ongkir" => $data_ongkir[0], "metode_pembayaran" => $data_alamat[0]["pembayaran"], "pembayaran" => $data_pembayaran[0], "voucher" => $data_voucher[0], "topics" => $detail_order, "gtotal" => 
        array(
            "gtotal_total" => $gtotal_total,
            "gtotal_diskon" => $gtotal_diskon,
            "gtotal_pengiriman" => $gtotal_pengiriman,
            "gtotal_voucher" => $gtotal_voucher
        )    
    )));
            
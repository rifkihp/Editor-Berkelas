<?php
    $root = "../../";
    include $root."includes/php/initial.php";    
    if(!isset($_SESSION[ADMIN_SESSION_NAME])) {
        header("location: ".ADMINWEB_URL);
        die();
    }
    include $root."includes/php/classUtama.php";    
    include $root."includes/php/rajaOngkir.php";
    include SMARTY_DIR."Smarty.class.php";
    
    
    $smarty = new Smarty;        
    //$smarty->force_compile = true;
    //$smarty->debugging = true;
    $smarty->caching = true;
    $smarty->cache_lifetime = 0;
    
    $smarty->assign("homeurl", HOME_URL); 
    $smarty->assign("adminweburl", ADMINWEB_URL); 
    $smarty->assign("data_user", $_SESSION[ADMIN_SESSION_NAME]["user"]);
    $smarty->assign("tpl_dir", HOME_URL."/templates/".BACK_END_TEMPLATE);
    $smarty->assign("include_tpl", BACK_END_TEMPLATE_INCLUDE_PATH);
        
    //DATABASE CONNECTION
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    $id = $db->checkIntegerRange($_GET["id"])?$_GET["id"]:0;
    if($id==0) {
        header("location: ".ADMINWEB_URL."/pemesanan/");
        die();
    }
    
    //GET BANK
    $data_bank = $db->getFieldValue("bank_transfer", array("*"), array("is_aktif" => "Y"));
    $smarty->assign("list_bank", $data_bank);
    
    $data_header = $db->getFieldValue(
        "customer_order_header AS A LEFT JOIN member AS B ON A.id_member=B.id", 
        array(
            "A.id",
            "A.id_member",
            "DATE_FORMAT(A.tanggal_jam, '%d-%m-%Y') AS tanggal",
            "A.kode",
            "A.nama",
            "A.alamat",
            "A.no_hp",
            "A.id_propinsi",
            "A.nama_propinsi",
            "A.id_kota",
            "A.nama_kota",
            "A.id_kecamatan",
            "A.nama_kecamatan",
            "A.kode_pos",
            "A.grandtotal",
            "A.ongkir",
            "A.voucher",
            "A.total",
            "A.status",
            "A.is_dropship",
            "A.dropship_name",
            "A.dropship_phone",
            "A.email_notifikasi",
            "B.id AS id_member",
            "IF(A.id_member=0, 'Tamu', CONCAT(B.first_name, ' ', B.last_name)) AS nama_member",
            "B.email AS email_member",
            "A.pembayaran"
        ), 
        array("A.id" => $id)
    );
    foreach($data_header as $key => $value) {
        $data_header[$key]["grandtotal"] = number_format($value["grandtotal"], 0, '.', ',');
        $data_header[$key]["voucher"]    = number_format($value["voucher"], 0, '.', ',');
        $data_header[$key]["ongkir"]     = number_format($value["ongkir"], 0, '.', ',');
        $data_header[$key]["total"]      = number_format($value["total"], 0, '.', ',');
    }
    
    $data_alamat = $db->getFieldValue("customer_address", array("*"), array("id_member" => $data_header[0]["id_member"]));
    
    $data_user = $db->getFieldValue("member", array("jenis_user"), array("id" => $data_header[0]["id_member"]));
    $tipe_user = $data_user[0]["jenis_user"];
    
    $data_detail = $db->getFieldValue(
        "customer_order_detail AS B LEFT JOIN produk AS A ON A.id=B.id_produk".(count($data_user)>0?" LEFT JOIN (SELECT id_produk, harga_jual FROM harga_jual_user WHERE tipe_user='$tipe_user' AND harga_jual>0 GROUP BY id_produk) AS C ON C.id_produk=A.id":""), 
        array(
            "B.id",
            "B.id_produk",
            "B.kode",
            "B.nama",
            "B.gambar",
            "B.ukuran",
            "B.warna",
            "B.jumlah",
            "B.berat",
            "B.harga_beli",
            "B.harga_jual AS harga_jual_detail",
            "B.harga_diskon",
            "B.persen_diskon",
            "B.sub_total",
            "B.grand_total",
            //"IF(A.harga_diskon>0 AND IF(A.from_date_harga_diskon IS NOT NULL, A.from_date_harga_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_harga_diskon IS NOT NULL, A.to_date_harga_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1), 1, 0) AS harga_promo", 
            //"IF(A.persen_diskon>0 AND IF(A.from_date_persen_diskon IS NOT NULL, A.from_date_persen_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_persen_diskon IS NOT NULL, A.to_date_persen_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1), 1, 0) AS diskon_promo",
            (count($data_user)>0?"IF(C.harga_jual IS NOT NULL, C.harga_jual, A.harga_jual) AS harga_jual_khusus":"A.harga_jual")
        ), 
        array("B.id_header" => $id)
    );
    
    
    $berat = 0;
    foreach($data_detail as $key => $value) {
        $berat+=$data_detail[$key]["berat"];
        
        //LIST GROSIR
        $data_detail[$key]["list_grosir"] = '';
        $data_grosir = $db->getFieldValue("produk_grosir", array("CONCAT(jumlah_min, '|', jumlah_max, '|', harga) AS harga_grosir"), array("id_produk" => $value["id_produk"]), array(), 0, 0, "jumlah_min DESC");
        foreach ($data_grosir as $key_grosir => $value_grosir) {
            $data_detail[$key]["list_grosir"] .= (strlen($data_detail[$key]["list_grosir"])>0?'\n':'').$value_grosir["harga_grosir"];
        }
        
        $data_detail[$key]["ukuran_warna"]   = strtoupper($value["ukuran"]."|".$value["warna"]);
        $data_detail[$key]["harga_jual_ori"] = $value[count($data_user)==0?"harga_jual":"harga_jual_khusus"];
        $data_detail[$key]["harga_jual"]     = number_format($value["harga_jual_detail"], 0, '.', ',');
        $data_detail[$key]["harga_diskon"]   = number_format($value["harga_diskon"], 0, '.', ',');
        $data_detail[$key]["sub_total"]      = number_format($value["sub_total"], 0, '.', ',');
        $data_detail[$key]["grand_total"]    = number_format($value["grand_total"], 0, '.', ',');
        
        //GET LIST UKURAN
        $sql = "SELECT UPPER(CONCAT(ukuran, '|', warna)) AS kode, ukuran, warna, jumlah FROM produk_varian WHERE id_produk='".$value["id_produk"]."'";
        $db->mysql_query($sql, $rec_count_varian, $data_detail[$key]["list_ukuran_warna"]);
    }
        
    
    $data_ongkir = $db->getFieldValue(
        "customer_order_ongkir AS A LEFT JOIN ekspedisi AS B ON A.id_ekspedisi=B.id", 
        array(
            "A.id",
            "B.kode AS kurir",
            "B.id AS kurir_id",
            "B.nama AS kurir_nama",
            "A.layanan",
            "A.etd",
            "A.no_resi",
            "A.nama_penerima",
            "A.tarif"
        ), 
        array("A.id_header" => $id)
    );
    
    //GET PROPINSI
    $ro = new rajaOngkir(RAJA_ONGKIR_TYP, RAJA_ONGKIR_KEY);
    $smarty->assign("listpropinsi", $ro->getPropinsi());
    
    //GET KOTA
    $smarty->assign("listkota", $ro->getKota($data_header[0]["id_propinsi"]));
    
    //GET KECAMATAN
    $smarty->assign("listkecamatan", $ro->getKecamatan($data_header[0]["id_kota"]));
    
    //GET KURIR
    $ekspdisi = $db->getFieldValue("ekspedisi", array("kode", "nama"), array("is_aktif" => 'Y'));
    $smarty->assign("listkurir", $ekspdisi);
    
    //GET KECAMATAN
    $smarty->assign("listkecamatan", $ro->getKecamatan($data_header[0]["id_kota"]));
    
    //GET LAYANAN
    $data_umum = $db->getFieldValue("umum", array("*"));
    $layanan = $ro->getCost($data_umum[0]["kota"], 'city', $data_header[0]["id_kecamatan"], 'subdistrict', ($berat>0?$berat:1000), strtolower($data_ongkir[0]["kurir"]));
    foreach ($layanan as $key => $value) {
        foreach ($value['cost'] as $key_ => $value_) {
            $layanan[$key]['cost'][$key_]['tarif'] = "Rp ".number_format($value_["value"], 0, '.', ',');
        }
    }
    $smarty->assign("listlayanan", $layanan);
    
    $data_voucher = $db->getFieldValue(
        "customer_order_voucher AS A", 
        array(
            "A.id",
            "A.kode_voucher",
            "A.nominal"
        ), 
        array("A.id_header" => $id)
    );
    
    $data_konfirmasi =  $db->getFieldValue(
        "konfirmasi_pembayaran AS A", 
        array(
            "A.bank_tujuan",
            "A.jumlah_transfer"
        ), 
        array(
            "A.id_header" => $id,
            "A.status" => 2
        )
    );
    foreach($data_konfirmasi as $key => $value) {
        $data_konfirmasi[$key]["jumlah_transfer"] = number_format($value["jumlah_transfer"], 0, '.', ',');
    }
    
    //GET METODE PEMBAYARAN
    $cara_bayar = array(
        array('kode' => 1, 'nama' => 'Transfer Bank'),
        array('kode' => 2, 'nama' => 'Kartu Kredit / Debet'),
        array('kode' => 3, 'nama' => 'Cash on Delivery (COD)')
    );
    $smarty->assign("cara_bayar", $cara_bayar);
    
    $smarty->assign("header", $data_header[0]);
    $smarty->assign("data_alamat", $data_alamat);
    $smarty->assign("listdetail", $data_detail);
    $smarty->assign("ongkir", $data_ongkir[0]);
    $smarty->assign("voucher", $data_voucher[0]);
    $smarty->assign("pembayaran", $data_konfirmasi[0]);
    
    $smarty->assign("isEdit", true);
    $smarty->assign("page_selected", "pesanan");
    $smarty->assign("sub_page_selected", "pemesanan");
    $smarty->assign("title", "Pemesanan");
    $smarty->assign("sub_title", "Edit Pemesanan");
    $smarty->assign("from_page", $_GET["from_page"]);
    
    $id_menu = 4; $aksi = "E";
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/pemesanan/edit.html");    
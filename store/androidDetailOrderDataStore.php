<?php
    $root = "../";
    include $root."includes/php/initial.php";    
    include $root."includes/php/classUtama.php";
        
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $no_transaksi = $_POST["no_transaksi"];
    $detail_order = $db->getFieldValue(
        "customer_order_detail AS A LEFT JOIN customer_order_header AS B ON A.id_header=B.id LEFT JOIN gambar_produk AS D ON A.id_produk=D.id_produk AND D.as_default='Y'", 
        array("A.id", "A.kode", "A.nama", "D.nama_file AS gambar", "A.ukuran", "A.warna", "B.total_qty", "B.total", "A.jumlah", "A.berat", "A.harga_beli", "A.harga_jual", "A.harga_diskon", "A.persen_diskon", "A.sub_total AS subtotal", "A.grand_total AS grandtotal"), 
        array("B.kode" => $no_transaksi)
    );
    
    $total = $detail_order[0]["total"];
    $total_qty = $detail_order[0]["total_qty"];
        
    foreach($detail_order as $i => $value) {
        $detail_order[$i]["persen_diskon"] = str_replace("%", "", $value["persen_diskon"]);
    }
    
    $db->mysql_close();
    die(json_encode(array("topics" => $detail_order, "qty" => $total_qty, "jumlah" => $total)));
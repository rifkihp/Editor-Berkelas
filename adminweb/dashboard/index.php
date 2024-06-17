<?php
     $root = "../../";
    include $root."includes/php/initial.php";    
    if(!isset($_SESSION[ADMIN_SESSION_NAME])) {
        header("location: ".ADMINWEB_URL);
        die();
    }
    include $root."includes/php/classUtama.php";
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
    $smarty->assign("page_selected", "dashboard");
    $smarty->assign("sub_page_selected", "dashboard");    
    $smarty->assign("title", "Dashboard");
    $smarty->assign("sub_title", "Summary of your App");
    
    $data_pengaturan = $db->getFieldValue("pengaturan", array("*"));
    
    $pagelimit = 5;
    $limit = 20;
    
    //PERINGATAN STOK
    $currentpage = (!isset($_GET["page_stok"])?1:$_GET["page_stok"]);    
    $totalrecord = $db->getFieldValue("produk_varian AS A", array("COUNT(*) AS TOTAL"), array(),  array(), 0, 0, "", " A.jumlah<=".$data_pengaturan[0]["stok_minimum"]);
    $totalpage = ceil($totalrecord[0]["TOTAL"]/$limit);
    $frompage = $totalpage<=$pagelimit?1:($currentpage>($totalpage+1-$pagelimit)?($totalpage+1-$pagelimit):$currentpage);
    $untilpage = $totalpage<$pagelimit?$totalpage:$frompage+$pagelimit-1;
    $listdetail = $db->getFieldValue("produk_varian AS A LEFT JOIN produk AS B ON A.id_produk=B.id", array("B.id", "B.kode", "B.nama", "A.ukuran", "A.warna", "A.jumlah"), array(), array(), $limit, $limit*($currentpage-1), " B.id DESC ",  " A.jumlah<=".$data_pengaturan[0]["stok_minimum"]);
    
    $smarty->assign("limitpage", $limit);
    $smarty->assign("stok_currentpage", $currentpage);
    $smarty->assign("stok_totalrecord", $totalrecord[0]["TOTAL"]);
    $smarty->assign("stok_totalpage", $totalpage);
    $smarty->assign("stok_untilpage", $untilpage);
    $smarty->assign("stok_frompage", $frompage);
    $smarty->assign("stok_listdetail", $listdetail);
    
    //PEMESANAN BARU
    $currentpage = (!isset($_GET["page_pemesanan"])?1:$_GET["page_pemesanan"]);    
    $totalrecord = $db->getFieldValue("customer_order_header AS A", array("COUNT(*) AS TOTAL"), array("A.status" => 0));
    $totalpage = ceil($totalrecord[0]["TOTAL"]/$limit);
    $frompage = $totalpage<=$pagelimit?1:($currentpage>($totalpage+1-$pagelimit)?($totalpage+1-$pagelimit):$currentpage);
    $untilpage = $totalpage<$pagelimit?$totalpage:$frompage+$pagelimit-1;
    $listdetail = $db->getFieldValue("customer_order_header AS A LEFT JOIN member AS B ON A.id_member=B.id LEFT JOIN (SELECT COUNT(*) AS TOTAL, id_header FROM customer_order_detail GROUP BY id_header) AS C ON A.id=C.id_header", array("A.id", "A.id_member", "A.kode", "A.is_dropship", "DATE_FORMAT(A.tanggal_jam, '%d-%m-%Y') AS waktu", "A.total", "C.TOTAL AS jumlah", "CONCAT(B.first_name, ' ', B.last_name) AS nama", "A.status"), array("A.status" => 0), array(), $limit, $limit*($currentpage-1), " B.id DESC ");
    foreach ($listdetail as $key => $value) {
        $listdetail[$key]["total"]  = number_format($value["total"], 0, '.', ',');
        $listdetail[$key]["jumlah"] = number_format($value["jumlah"], 0, '.', ',');                
    }
    
    $smarty->assign("limitpage", $limit);
    $smarty->assign("pemesanan_currentpage", $currentpage);
    $smarty->assign("pemesanan_totalrecord", $totalrecord[0]["TOTAL"]);
    $smarty->assign("pemesanan_totalpage", $totalpage);
    $smarty->assign("pemesanan_untilpage", $untilpage);
    $smarty->assign("pemesanan_frompage", $frompage);
    $smarty->assign("pemesanan_listdetail", $listdetail);
    
    
    //KONFIRMASI PEMBAYARAN
    $currentpage = (!isset($_GET["page_konfirmasi"])?1:$_GET["page_konfirmasi"]);    
    $totalrecord = $db->getFieldValue("konfirmasi_pembayaran AS A", array("COUNT(*) AS TOTAL"), array("A.status" => 0));
    $totalpage = ceil($totalrecord[0]["TOTAL"]/$limit);
    $frompage = $totalpage<=$pagelimit?1:($currentpage>($totalpage+1-$pagelimit)?($totalpage+1-$pagelimit):$currentpage);
    $untilpage = $totalpage<$pagelimit?$totalpage:$frompage+$pagelimit-1;
    $listdetail = $db->getFieldValue("konfirmasi_pembayaran AS A LEFT JOIN member AS B ON A.id_member=B.id LEFT JOIN bank_transfer AS C ON A.bank_tujuan=C.id", array("A.id", "A.kode_pemesanan", "A.jumlah_transfer", "DATE_FORMAT(A.tanggal_jam, '%d-%m-%Y') AS waktu", "C.nama_bank", "CONCAT(B.first_name, ' ', B.last_name) AS nama", "A.status"), array("A.status" => 0), array(), $limit, $limit*($currentpage-1), " B.id DESC ");
    foreach ($listdetail as $key => $value) {
        $listdetail[$key]["jumlah_transfer"]  = number_format($value["jumlah_transfer"], 0, '.', ',');
    }
    
    $smarty->assign("limitpage", $limit);
    $smarty->assign("konfirmasi_currentpage", $currentpage);
    $smarty->assign("konfirmasi_totalrecord", $totalrecord[0]["TOTAL"]);
    $smarty->assign("konfirmasi_totalpage", $totalpage);
    $smarty->assign("konfirmasi_untilpage", $untilpage);
    $smarty->assign("konfirmasi_frompage", $frompage);
    $smarty->assign("konfirmasi_listdetail", $listdetail);
    
    
    $id_menu = 1;
    include $root."includes/php/notification.php";
    
    $data = $db->getFieldValue("user_menu_akses", array("*"), array("id_menu" => 5, "id_user" => $_SESSION[ADMIN_SESSION_NAME]["user"]["id"]), array(), 0, 0, "", isset($aksi)?"akses LIKE '%T%'":"");
    $smarty->assign("edit_stok", count($data)>0);
    
    $data = $db->getFieldValue("user_menu_akses", array("*"), array("id_menu" => 4, "id_user" => $_SESSION[ADMIN_SESSION_NAME]["user"]["id"]));
    $smarty->assign("lihat_pesanan", count($data)>0);
    
    $data = $db->getFieldValue("user_menu_akses", array("*"), array("id_menu" => 6, "id_user" => $_SESSION[ADMIN_SESSION_NAME]["user"]["id"]));
    $smarty->assign("lihat_konfirmasi", count($data)>0);
    
    $jumlah_pelanggan = $db->getFieldValue("member", array("COUNT(*) AS jumlah_pelanggan"));
    $sql = "SELECT SUM(IF(status IN ('2', '5', '6'), 1, 0)) AS jumlah_lunas, SUM(IF(status IN ('0', '1', '3'), 1, 0)) jumlah_belum_lunas FROM  customer_order_header";
    $db->mysql_query($sql, $rec_num, $jumlah_order_lunas);        
            
    $smarty->assign(
        "dashboard", 
        array(
            "jumlah_pengunjung" => 0,
            "jumlah_pelanggan" => $jumlah_pelanggan[0]["jumlah_pelanggan"],
            "jumlah_lunas" => $jumlah_order_lunas[0]["jumlah_lunas"],
            "jumlah_belum_lunas" => $jumlah_order_lunas[0]["jumlah_belum_lunas"]
        )
    );
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/index.html");    
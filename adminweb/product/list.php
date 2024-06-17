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
    
    $pagelimit = 5;
    $limit = 20;
    
    $currentpage  = (!isset($_GET["page"])?1:$_GET["page"]);
    $query        = (isset($_GET["query"])?$_GET["query"]:"");
    
    $produk_promo = $db->checkIntegerRange($_GET["produk_promo"])?$_GET["produk_promo"]:0;
    $produk_featured = $db->checkIntegerRange($_GET["produk_featured"])?$_GET["produk_featured"]:0;
    $produk_terbaru = $db->checkIntegerRange($_GET["produk_terbaru"])?$_GET["produk_terbaru"]:0;
    $produk_preorder = $db->checkIntegerRange($_GET["produk_preorder"])?$_GET["produk_preorder"]:0;
    $produk_soldout = $db->checkIntegerRange($_GET["produk_soldout"])?$_GET["produk_soldout"]:0;
    $produk_freeongkir = $db->checkIntegerRange($_GET["produk_freeongkir"])?$_GET["produk_freeongkir"]:0;
    
    $tag = "";
    if($produk_promo==1) {
        $tag .= " AND IF((A.harga_diskon>0 AND IF(A.from_date_harga_diskon IS NOT NULL, A.from_date_harga_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_harga_diskon IS NOT NULL, A.to_date_harga_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1)) OR (A.persen_diskon>0 AND IF(A.from_date_persen_diskon IS NOT NULL, A.from_date_persen_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_persen_diskon IS NOT NULL, A.to_date_persen_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1)), 1, 0)=1 ";
    }    
    if($produk_featured==2) {
        $tag .= " AND A.produk_featured=1 ";
    }
    if($produk_terbaru==3) {
        $tag .= " AND A.produk_terbaru=1 ";
    }
    if($produk_preorder==4) {
        $tag .= " AND A.produk_preorder=1 ";
    }
    if($produk_soldout==5) {
        $tag .= " AND A.produk_soldout=1 ";
    }
    if($produk_freeongkir==6) {
        $tag .= " AND A.produk_freeongkir=1 ";
    }
    
    $totalrecord = $db->getFieldValue("produk AS A", array("COUNT(*) AS TOTAL"), array(),  array(), 0, 0, "", " 1 " . $tag . (strlen($query)>0?" AND (A.kode LIKE '%$query%' OR A.nama LIKE '%$query%' OR A.keyword LIKE '%$query%')":""));
    $totalpage = ceil($totalrecord[0]["TOTAL"]/$limit);
    $frompage = $totalpage<=$pagelimit?1:($currentpage>($totalpage+1-$pagelimit)?($totalpage+1-$pagelimit):$currentpage);
    $untilpage = $totalpage<$pagelimit?$totalpage:$frompage+$pagelimit-1;
    $listdetail = $db->getFieldValue("produk AS A", array("A.id", "A.kode", "A.wa_penjual", "DATE_FORMAT(A.tanggal_update, '%d-%m-%Y %H:%i:%s') AS tanggal", "A.nama", "A.harga_jual", "IF((A.harga_diskon>0 AND IF(A.from_date_harga_diskon IS NOT NULL, A.from_date_harga_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_harga_diskon IS NOT NULL, A.to_date_harga_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1)) OR (A.persen_diskon>0 AND IF(A.from_date_persen_diskon IS NOT NULL, A.from_date_persen_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(A.to_date_persen_diskon IS NOT NULL, A.to_date_persen_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1)), 1, 0) AS produk_promo", "A.produk_terbaru", "A.produk_featured", "A.produk_preorder", "A.produk_soldout", "A.produk_freeongkir", "A.gambar_utama AS foto1_produk", "A.status"), array(), array(), $limit, $limit*($currentpage-1), " A.tanggal_update DESC ",  " 1 " . $tag . (strlen($query)>0?" AND (A.kode LIKE '%$query%' OR A.nama LIKE '%$query%' OR A.keyword LIKE '%$query%')":"")); 
    foreach($listdetail as $key => $value) {
        $listdetail[$key]["harga_jual"] = number_format($value["harga_jual"], 0, '.', ',');
        
        $sql = "select A.id_produk, GROUP_CONCAT(B.nama SEPARATOR ', ') AS nama from produk_to_category AS A, category AS B WHERE A.id_kategori=B.id AND  A.id_produk='".$value["id"]."'"; 
        $db->mysql_query($sql, $rec_count, $rs);
        $listdetail[$key]["kategori"] = $rs[0]["nama"];
    }
    
    $smarty->assign('query', $query);
    $smarty->assign('produk_promo', $produk_promo);
    $smarty->assign('produk_featured', $produk_featured);
    $smarty->assign('produk_terbaru', $produk_terbaru);
    $smarty->assign('produk_preorder', $produk_preorder);
    $smarty->assign('produk_soldout', $produk_soldout);
    $smarty->assign('produk_freeongkir', $produk_freeongkir);
    $smarty->assign("currentpage", $currentpage);
    $smarty->assign("limitpage", $limit);
    $smarty->assign("totalpage", $totalpage);
    $smarty->assign("untilpage", $untilpage);
    $smarty->assign("frompage", $frompage);
    $smarty->assign("untilpage", $untilpage);
    $smarty->assign("listdetail", $listdetail);
    $smarty->assign("page_selected", "katalog");
    $smarty->assign("sub_page_selected", "product");
    $smarty->assign("title", "Product");
    $smarty->assign("sub_title", "List of Product");
    
    if(isset($_SESSION["alert_success"])) {
        $smarty->assign("alert_success", $_SESSION["alert_success"]);
        unset($_SESSION["alert_success"]);
    }
    
    $id_menu = 14;
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/product/list.html");    
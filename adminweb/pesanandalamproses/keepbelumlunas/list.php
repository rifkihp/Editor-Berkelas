<?php
    $root = "../../../";
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
    
    $tipe        = (isset($_GET["tipe"])?$_GET["tipe"]:"");
    $query       = (isset($_GET["query"])?$_GET["query"]:"");
    $currentpage = (!isset($_GET["page"])?1:$_GET["page"]);
    
    $tanggal_dari   = !isset($_GET["tanggal_dari"])?'':$_GET["tanggal_dari"];
    $temp = explode("-", $tanggal_dari);
    if(count($temp)==3) { $tanggal_dari = ($temp[2]."-".$temp[1]."-".$temp[0]); }
    
    $tanggal_sampai   = !isset($_GET["tanggal_sampai"])?'':$_GET["tanggal_sampai"];
    $temp = explode("-", $tanggal_sampai);
    if(count($temp)==3) { $tanggal_sampai = ($temp[2]."-".$temp[1]."-".$temp[0]); }
    
    $totalrecord = $db->getFieldValue("customer_order_detail AS B LEFT JOIN customer_order_header AS A ON B.id_header=A.id  LEFT JOIN member AS C ON A.id_member=C.id", array("COUNT(*) AS TOTAL"), array(),  array(), 0, 0, "", " A.status IN ('0', '1', '3', '7', '8') " . 
        (strlen($tanggal_dari)>0?" AND DATE_FORMAT(A.tanggal_jam, '%Y-%m-%d')>='$tanggal_dari' ":"") .
        (strlen($tanggal_sampai)>0?" AND DATE_FORMAT(A.tanggal_jam, '%Y-%m-%d')<='$tanggal_sampai' ":"") .
        (strlen($query)>0?" AND (CONCAT(C.first_name, ' ', C.last_name) LIKE '%$query%' OR A.kode LIKE '%$query%' OR B.kode LIKE '%$query%' OR B.nama LIKE '%$query%' OR B.ukuran LIKE '%$query%' OR B.warna LIKE '%$query%')":""));
    $totalpage = ceil($totalrecord[0]["TOTAL"]/$limit);
    $frompage = $totalpage<=$pagelimit?1:($currentpage>($totalpage+1-$pagelimit)?($totalpage+1-$pagelimit):$currentpage);
    $untilpage = $totalpage<$pagelimit?$totalpage:$frompage+$pagelimit-1;
    $listdetail = $db->getFieldValue("customer_order_detail AS B LEFT JOIN customer_order_header AS A ON B.id_header=A.id  LEFT JOIN member AS C ON A.id_member=C.id ", array("B.id", "A.kode AS no_trx", "B.id_header", " A.id_member", " C.email AS email_member", " CONCAT(C.first_name", " ' '", " C.last_name) AS nama_member", " DATE_FORMAT(A.tanggal_jam", " '%d-%m-%Y') AS tanggal_pesan", " B.id_produk", " B.kode", " B.nama", " B.ukuran", " B.warna", " B.jumlah", " B.harga_jual", " B.sub_total", "B.grand_total"), array(), array(), $limit, $limit*($currentpage-1), " B.id_header DESC, B.id ",  " A.status IN ('0', '1', '3', '7', '8') " . 
        (strlen($tanggal_dari)>0?" AND DATE_FORMAT(A.tanggal_jam, '%Y-%m-%d')>='$tanggal_dari' ":"") .
        (strlen($tanggal_sampai)>0?" AND DATE_FORMAT(A.tanggal_jam, '%Y-%m-%d')<='$tanggal_sampai' ":"") .
        (strlen($query)>0?" AND (CONCAT(C.first_name, ' ', C.last_name) LIKE '%$query%' OR A.kode LIKE '%$query%' OR B.kode LIKE '%$query%' OR B.nama LIKE '%$query%' OR B.ukuran LIKE '%$query%' OR B.warna LIKE '%$query%')":""));
    foreach($listdetail as $key => $value) {
        $listdetail[$key]["grand_total"] = "Rp. ".number_format($value["grand_total"], 0, '.', ',');
    }
    
    $smarty->assign('tanggal_dari', $_GET["tanggal_dari"]); 
    $smarty->assign('tanggal_sampai', $_GET["tanggal_sampai"]);
    $smarty->assign('query', $query);
    $smarty->assign("currentpage", $currentpage);
    $smarty->assign("limitpage", $limit);
    $smarty->assign("totalpage", $totalpage);
    $smarty->assign("untilpage", $untilpage);
    $smarty->assign("frompage", $frompage);
    $smarty->assign("untilpage", $untilpage);
    $smarty->assign("listdetail", $listdetail);
    $smarty->assign("page_selected", "pesanan");
    $smarty->assign("sub_page_selected", "pesanandalamproses");    
    $smarty->assign("title", "Order in Progress");
    $smarty->assign("sub_title", "List of Order in Progress");
    
    if(isset($_SESSION["alert_success"])) {
        $smarty->assign("alert_success", $_SESSION["alert_success"]);
        unset($_SESSION["alert_success"]);
    }
    
    $id_menu = 3;
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/pesanandalamproses/list_keepbelumlunas.html");    
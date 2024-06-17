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
    
    $sql_induk = "(SELECT A1.id_produk, A1.ukuran, A1.warna, SUM(A1.jumlah) AS qty FROM customer_order_detail AS A1 LEFT JOIN customer_order_header AS A2 ON A1.id_header=A2.id WHERE A2.status IN (0, 1, 3, 7, 8) " . (strlen($tanggal_dari)>0?" AND DATE_FORMAT(A2.tanggal_jam, '%Y-%m-%d')>='$tanggal_dari' ":"") .
        (strlen($tanggal_sampai)>0?" AND DATE_FORMAT(A2.tanggal_jam, '%Y-%m-%d')<='$tanggal_sampai' ":"")  . "GROUP BY A1.id_produk, A1.ukuran, A1.warna)";
    
    $totalrecord = $db->getFieldValue("$sql_induk AS A LEFT JOIN produk AS B ON A.id_produk=B.id", array("COUNT(*) AS TOTAL"), array(),  array(), 0, 0, "", " 1 " . (strlen($query)>0?" AND (B.kode LIKE '%$query%' OR B.nama LIKE '%$query%')":""));
    $totalpage = ceil($totalrecord[0]["TOTAL"]/$limit);
    $frompage = $totalpage<=$pagelimit?1:($currentpage>($totalpage+1-$pagelimit)?($totalpage+1-$pagelimit):$currentpage);
    $untilpage = $totalpage<$pagelimit?$totalpage:$frompage+$pagelimit-1;
    $listdetail = $db->getFieldValue("$sql_induk AS A LEFT JOIN produk AS B ON A.id_produk=B.id", array("A.id_produk AS id", "B.kode", "B.nama", "A.ukuran", "A.warna", "A.qty"), array(), array(), $limit, $limit*($currentpage-1), "",  " 1 " . (strlen($query)>0?" AND (B.kode LIKE '%$query%' OR B.nama LIKE '%$query%')":""));
    
    foreach ($listdetail as $key => $value) {
        $sql = "SELECT A.id, A.kode, B.jumlah FROM customer_order_detail AS B LEFT JOIN customer_order_header AS A ON B.id_header=A.id WHERE B.id_produk='".$value["id"]."' AND A.status IN (0, 1, 3, 7, 8) "; 
        $db->mysql_query($sql, $rec_count, $listdetail[$key]["transaksi"]);
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
    $smarty->display(BACK_END_TEMPLATE_PATH."/pesanandalamproses/list_keepperproduk.html");    
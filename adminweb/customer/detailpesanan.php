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
    
    $currentpage   = (!isset($_GET["page"])?1:$_GET["page"]);
    
    $tanggal_dari   = !isset($_GET["tanggal_dari"])?'':$_GET["tanggal_dari"];
    $temp = explode("-", $tanggal_dari);
    if(count($temp)==3) { $tanggal_dari = ($temp[2]."-".$temp[1]."-".$temp[0]); }
    
    $tanggal_sampai   = !isset($_GET["tanggal_sampai"])?'':$_GET["tanggal_sampai"];
    $temp = explode("-", $tanggal_sampai);
    if(count($temp)==3) { $tanggal_sampai = ($temp[2]."-".$temp[1]."-".$temp[0]); }
    
    $id_member = $_GET["id"];
    
    $sql_induk = "SELECT 
        id_member, 
        DATE_FORMAT(tanggal_jam, '%Y-%m-%d') AS tanggal, 
        SUM(total) AS jumlah, 
        SUM(total_qty) AS total_qty 
    FROM
        (SELECT A.id, A.total, A.tanggal_jam, A.id_member, B.total_qty, B.id_header FROM customer_order_header AS A LEFT JOIN 
        (SELECT id_header, SUM(jumlah) AS total_qty FROM customer_order_detail GROUP BY id_header) AS B ON A.id=B.id_header 
        WHERE A.id_member='".$id_member."' AND (A.status=6 OR A.status=5 OR A.status=2) " .
            (strlen($tanggal_dari)>0?" AND DATE_FORMAT(A.tanggal_jam, '%Y-%m-%d')>='$tanggal_dari'":"") .
            (strlen($tanggal_sampai)>0?" AND DATE_FORMAT(A.tanggal_jam, '%Y-%m-%d')<='$tanggal_sampai'":"").") AS T 
    GROUP BY 
        DATE_FORMAT(tanggal_jam, '%Y-%m-%d')";
    
    $sql = "SELECT COUNT(*) AS TOTAL, SUM(jumlah) AS TOTAL_JUMLAH, SUM(total_qty) AS TOTAL_QTY FROM ($sql_induk) AS T";
    $db->mysql_query($sql, $rec_count, $totalrecord);
    $totalpage = ceil($totalrecord[0]["TOTAL"]/$limit);
    $smarty->assign("jumlah", number_format($totalrecord[0]["TOTAL_JUMLAH"], 0, '.', ','));
    $smarty->assign("total_qty", number_format($totalrecord[0]["TOTAL_QTY"], 0, '.', ','));
    
    $frompage = $totalpage<=$pagelimit?1:($currentpage>($totalpage+1-$pagelimit)?($totalpage+1-$pagelimit):$currentpage);
    $untilpage = $totalpage<$pagelimit?$totalpage:$frompage+$pagelimit-1;
    
    $sql = "SELECT * FROM ($sql_induk) AS T ORDER BY T.tanggal LIMIT ".$limit*($currentpage-1).", ".$limit;
    $db->mysql_query($sql, $rec_count, $listdetail);
    foreach ($listdetail as $key => $value) {
        $listdetail[$key]["jumlah"] = number_format($value["jumlah"], 0, '.', ',');
        $listdetail[$key]["total_qty"] = number_format($value["total_qty"], 0, '.', ',');
    }  
    
    $smarty->assign('id_member', $id_member); 
    $smarty->assign('tanggal_dari', $_GET["tanggal_dari"]); 
    $smarty->assign('tanggal_sampai', $_GET["tanggal_sampai"]);
    $smarty->assign("currentpage", $currentpage);
    $smarty->assign("limitpage", $limit);
    $smarty->assign("totalpage", $totalpage);
    $smarty->assign("untilpage", $untilpage);
    $smarty->assign("frompage", $frompage);
    $smarty->assign("untilpage", $untilpage);
    $smarty->assign("listdetail", $listdetail);
    $smarty->assign("page_selected", "customer");
    $smarty->assign("sub_page_selected", "customer");    
    $smarty->assign("title", "Customer");
    $smarty->assign("sub_title", "List of Customer");
    
    $id_menu = 7;
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/customer/detail_pesanan.html");    
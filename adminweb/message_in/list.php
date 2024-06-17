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
    
    $sql_induk = "
        SELECT 
            A.id,
            A.id_member,
            A.id_guest,
            A.id_produk,
            B.kode, 
            B.nama, 
            B.gambar_utama AS gambar, 
            C.pesan, 
            C.tanggal_jam, 
            DATE_FORMAT(C.tanggal_jam, '%d-%m-%Y %H:%i:%s') AS tanggal,
            C.`from` AS from_id, 
            IF(C.grup=1, D.nama, IF(C.grup=2, TRIM(CONCAT(E.first_name, ' ', E.last_name)), CONCAT('Guest ', F.id)))  AS from_nama, 
            IF(C.grup=1, 'admin.png', IF(C.grup=2, D.photo, 'default.png'))  AS from_photo,
            G.total_unread,
            IF(G.total_unread>0, 0, 1) AS status
        FROM 
            message_head AS A LEFT JOIN 
            produk AS B ON A.id_produk=B.id LEFT JOIN 
            (SELECT 
                n.* 
            FROM 
                message n INNER JOIN (
                SELECT 
                    id_head, 
                    MAX(tanggal_jam) AS tanggal_jam
                FROM 
                    message 
                GROUP BY 
                    id_head
                ) AS MAX USING (id_head, tanggal_jam)
            ) AS C ON C.id_head=A.id LEFT JOIN
            user AS D ON C.from=D.id LEFT JOIN     
            member AS E ON C.from=E.id LEFT JOIN     
            guest AS F ON C.from=F.id LEFT JOIN
            (SELECT 
                id_head, 
                COUNT(*) AS total_unread 
            FROM 
                message 
            WHERE
                user_read=0 AND
                grup<>1
            GROUP BY 
                id_head
            ) AS G ON G.id_head=A.id";
    
    $pagelimit = 5;
    $limit = 20;
    $query = isset($_GET["query"])?$_GET["query"]:"";
    $currentpage = !isset($_GET["page"])?1:$_GET["page"];
    $totalrecord = $db->getFieldValue("($sql_induk) AS A", array("COUNT(*) AS TOTAL"));
    
    $totalpage = ceil($totalrecord[0]["TOTAL"]/$limit);
    $frompage = $totalpage<=$pagelimit?1:($currentpage>($totalpage+1-$pagelimit)?($totalpage+1-$pagelimit):$currentpage);
    $untilpage = $totalpage<$pagelimit?$totalpage:$frompage+$pagelimit-1;
    $listdetail = $db->getFieldValue("($sql_induk) AS A", array("*"), array(), array(), $limit, $limit*($currentpage-1), " A.tanggal_jam DESC "); 
    foreach ($listdetail as $key => $value) {
        $data[$key]["tanggal"] = $db->dateDiff(date("Y-m-d H:i:s"), $value["tanggal"]);
        $listdetail[$key]["pesan"]   = preg_replace( "/\r|\n/", "", $db->limitTextKonten($value["pesan"], 150));
    }
    
    $smarty->assign('query', $query);
    $smarty->assign("currentpage", $currentpage);
    $smarty->assign("limitpage", $limit);
    $smarty->assign("totalpage", $totalpage);
    $smarty->assign("untilpage", $untilpage);
    $smarty->assign("frompage", $frompage);
    $smarty->assign("untilpage", $untilpage);
    $smarty->assign("listdetail", $listdetail);
    $smarty->assign("page_selected", "message");
    $smarty->assign("sub_page_selected", "message");    
    $smarty->assign("title", "Message");
    $smarty->assign("sub_title", "List of Message");
    
    if(isset($_SESSION["alert_success"])) {
        $smarty->assign("alert_success", $_SESSION["alert_success"]);
        unset($_SESSION["alert_success"]);
    }
    
    $id_menu = 17;
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/message/message_in.html");
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
    
    $id_head = $db->checkIntegerRange($_GET["id"])?$_GET["id"]:0;
    if($id_head==0) {
        $db->mysql_close();
        header("location: ".ADMINWEB_URL."/message_in/");
        die();
    }

    $data_message_head = $db->getFieldValue("message_head", array("*"), array("id" => $id_head));
    $_id_user  = $data_message_head[0]["id_member"];
    $_id_guest = $data_message_head[0]["id_guest"];
    
    $totalrecord = $db->getFieldValue("message AS A", array("COUNT(*) AS TOTAL", "MAX(A.id) AS last_id_komentar"), array("A.id_head" => $id_head));
    /*$totalpage = ceil($totalrecord[0]["TOTAL"]/$limit);
    $frompage = $totalpage<=$pagelimit?1:($currentpage>($totalpage+1-$pagelimit)?($totalpage+1-$pagelimit):$currentpage);
    $untilpage = $totalpage<$pagelimit?$totalpage:$frompage+$pagelimit-1;*/
    
    $listdetail = $db->getFieldValue(
        "message AS A LEFT JOIN 
         user AS B ON A.from=B.id LEFT JOIN     
         member AS C ON A.from=C.id LEFT JOIN     
         guest AS D ON A.from=D.id", 
        array(
            "A.id", 
            "A.pesan AS komentar", 
            "A.tanggal_jam", 
            "IF(A.grup=1, 1, 0) AS is_self", 
            "DATE_FORMAT(A.tanggal_jam, '%d-%m-%Y %H:%i:%s') AS tanggal_komentar", 
            "IF(A.grup=1, B.nama, IF(A.grup=2, TRIM(CONCAT(C.first_name, ' ', C.last_name)), CONCAT('Guest ', D.id)))  AS nama", 
            "IF(A.grup=1, 'admin.png', IF(A.grup=2, C.photo, 'default.png'))  AS photo",
            "IF(A.grup<>1 AND A.user_read=0, 'new', '') AS is_new_komentar"
        ), 
        array(
            "A.id_head" => $id_head
        ), array(), 0, 0, " A.id "
    );
        
    foreach ($listdetail as $key => $value) {
        if($value["is_new_komentar"]=='new') { $db->mysql_update("message", array("user_read" => 1), array("id" => $value["id"])); }
    }
    
    //DETAIL PRODUK
    $produk = $db->getFieldValue("message_head AS A LEFT JOIN produk AS B ON A.id_produk=B.id", array("B.kode", "B.nama", "B.gambar_utama"), array("A.id" => $id_head));
    
    $smarty->assign("id_head", $id_head);
        $smarty->assign("detail_produk", $produk[0]);
    $smarty->assign("listkomentar", $listdetail);
    $smarty->assign('last_id_komentar', $totalrecord[0]["last_id_komentar"]);
    
    $smarty->assign("is_chatting", true);
    $smarty->assign("page_selected", "message");
    $smarty->assign("sub_page_selected", "message");    
    $smarty->assign("title", "Message");
    $smarty->assign("sub_title", "Reply Message");
    
    $id_menu = 17; $aksi = "E";
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/message/edit.html");    
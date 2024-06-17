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
    
    $id = $db->checkIntegerRange($_GET["id"])?$_GET["id"]:0;
    if($id==0) {
        header("location: ".ADMINWEB_URL."/product/");
        die();
    }
    
    //GETCATEGORY
    $datacategory = array();    
    $category = $db->getFieldValue("category AS A LEFT JOIN produk_to_category AS B ON B.id_kategori=A.id AND B.id_produk='$id'", array("A.id", "A.nama", "A.id_parent", "IF(B.id_kategori IS NOT NULL, 'Y', 'N') AS is_select"), array("A.id_parent" => 0));
    foreach ($category as $key => $value) {
        $datacategory[count($datacategory)] = $value;
        $sub_category = $db->getFieldValue("category AS A LEFT JOIN produk_to_category AS B ON B.id_kategori=A.id AND B.id_produk='$id'", array("A.id", "CONCAT('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', A.nama) AS nama", "A. id_parent", "IF(B.id_kategori IS NOT NULL, 'Y', 'N') AS is_select"), array("A.id_parent" => $value['id']));
        foreach ($sub_category as $key_ => $value_) {
            $datacategory[count($datacategory)] = $value_;
        }
    }
    $smarty->assign("datacategory", $datacategory);
    
    //GET JENIS USER
    $listjenisuser = $db->getFieldValue(
        "jenis_user AS A LEFT JOIN harga_jual_user AS B ON B.tipe_user=A.id AND B.id_produk='$id'", 
        array("A.id AS id_jenis_user", "A.nama AS jenis_user", "COALESCE(B.harga_jual, 0) AS harga_jual"), array(), array(), 0, 0, "", "A.id>1");
    foreach ($listjenisuser as $key => $value) {
        $listjenisuser[$key]["harga_jual"] = number_format($value["harga_jual"], 0, '.', ',');
    }
    $smarty->assign("listjenisuser", $listjenisuser);
    
    //GET VARIAN STOK
    $listvarian = $db->getFieldValue("produk_varian AS A", 
        array("A.ukuran", "A.warna", "A.jumlah"),
        array("A.id_produk" => $id)
    );
    foreach ($listvarian as $key => $value) {
        $listvarian[$key]["jumlah"] = number_format($value["jumlah"], 0, '.', ',');
    }
    if(count($listvarian)==0) {
        $listvarian = array(
            array("ukuran" => "", "warna" => "", "jumlah" => "0")     
        );
    }
    $smarty->assign("listvarian", $listvarian);
    
    //GET GROSIR STOK
    $listgrosir = $db->getFieldValue("produk_grosir AS A", 
        array("A.jumlah_min", "A.jumlah_max", "A.harga"),
        array("A.id_produk" => $id)
    );
    foreach ($listgrosir as $key => $value) {
        $listgrosir[$key]["jumlah_min"] = number_format($value["jumlah_min"], 0, '.', ',');
        $listgrosir[$key]["jumlah_max"] = number_format($value["jumlah_max"], 0, '.', ',');
        $listgrosir[$key]["harga"] = number_format($value["harga"], 0, '.', ',');
    }
    if(count($listgrosir)==0) {
        $listgrosir = array(
            array("jumlah_min" => "0", "jumlah_max" => "0", "harga" => "0")     
        );
    }
    $smarty->assign("listgrosir", $listgrosir);
    
    //GET GAMBAR
    $listfoto = $db->getFieldValue("gambar_produk AS A", 
        array("A.nama_file", "as_default"),
        array("A.id_produk" => $id),
        array(),
        0, 
        0,
        " urutan "
    );
    $smarty->assign("listfoto", $listfoto);
    
    //DATA PRODUK
    $data = $db->getFieldValue("produk", array("*", 
        "DATE_FORMAT(from_date_harga_diskon, '%d-%m-%Y') AS from_date_harga_diskon", 
        "DATE_FORMAT(to_date_harga_diskon, '%d-%m-%Y') AS to_date_harga_diskon", 
        "DATE_FORMAT(from_date_persen_diskon, '%d-%m-%Y') AS from_date_persen_diskon", 
        "DATE_FORMAT(to_date_persen_diskon, '%d-%m-%Y') AS to_date_persen_diskon"), array("id" => $id));
    $data[0]["penjelasan"] = preg_replace("/\r\n|\r|\n/",'<br/>',$data[0]["penjelasan"]);
    $data[0]["berat"] = number_format($data[0]["berat"], 0, '.', ',');
    $data[0]["harga_modal"] = number_format($data[0]["harga_modal"], 0, '.', ',');
    $data[0]["harga_jual"] = number_format($data[0]["harga_jual"], 0, '.', ',');
    $data[0]["harga_diskon"] = number_format($data[0]["harga_diskon"], 0, '.', ',');
    
    $smarty->assign("data", $data);
    
    $listbrand = $db->getFieldValue("brand", array("id", "kode", "nama"));
    $smarty->assign("listbrand", $listbrand);
    
    $smarty->assign("isEdit", true);
    $smarty->assign("page_selected", "katalog");
    $smarty->assign("sub_page_selected", "produk");
    $smarty->assign("title", "Produk");
    $smarty->assign("sub_title", "Edit Produk");
    
    $id_menu = 14; $aksi = "E";
    include $root."includes/php/notification.php";
    
    $db->mysql_close();
    $smarty->display(BACK_END_TEMPLATE_PATH."/product/edit.html");    
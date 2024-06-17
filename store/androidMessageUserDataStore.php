<?php
    $root = "../";
    include $root."includes/php/initial.php";
//    if(strlen($_SESSION['security_code'])==0 || !isset($_SESSION['security_code']) || $_POST["security_code"]!=$_SESSION['security_code']) {
//    	die(json_encode(array("success" => false, "message" => "Maaf! Token tidak valid!")));
//    }
    unset($_SESSION['security_code']);

    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $_limit     = 100;
    $_id_user   = $_POST["id_user"];
    $_id_guest  = $_POST["id_guest"];
    $_id_produk = $_POST["id_produk"];
    
    $_no_trx = $_POST["no_trx"];
    if(strlen($_no_trx)>0) {
        $sql = "SELECT B.id_produk FROM customer_order_header AS A LEFT JOIN customer_order_detail AS B ON A.id=B.id_header WHERE A.kode='".$_no_trx."' LIMIT 0, 1";
        $db->mysql_query($sql, $rec_count, $dat_a);
        $_id_produk = $dat_a[0]["id_produk"];
    }
    
    //GET PRODUK
    $sql = "SELECT B.*, IF(B.harga_diskon>0 AND IF(B.from_date_harga_diskon IS NOT NULL, B.from_date_harga_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(B.to_date_harga_diskon IS NOT NULL, B.to_date_harga_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1), 1, 0) AS harga_promo, IF(B.persen_diskon>0 AND IF(B.from_date_persen_diskon IS NOT NULL, B.from_date_persen_diskon<=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1) AND IF(B.to_date_persen_diskon IS NOT NULL, B.to_date_persen_diskon>=DATE_FORMAT(NOW(), '%Y-%m-%d'), 1), 1, 0) AS diskon_promo" . (count($data_user)>0?", IF(C.harga_jual IS NOT NULL, C.harga_jual, B.harga_jual) AS harga_jual_khusus":"")." FROM produk AS B ".(count($data_user)>0?" LEFT JOIN (SELECT id_produk, harga_jual FROM harga_jual_user WHERE tipe_user='$tipe_user' AND harga_jual>0 GROUP BY id_produk) AS C ON C.id_produk=B.id":"")." WHERE B.id='$_id_produk'";
    $db->mysql_query($sql, $rec_count, $produk);
    foreach ($produk as $key => $value) {
        $produk[$key]["foto1_produk"] = $value["gambar_utama"];
        $produk[$key]["nama"] = trim(ucwords(strtolower($value["nama"])));

        $produk[$key]["harga_jual"] = $value[count($data_user)==0?"harga_jual":"harga_jual_khusus"];
        $produk[$key]["persen_diskon"] = $value["diskon_promo"]==1?$value["persen_diskon"]:0;
        $produk[$key]["harga_diskon"] = $value["harga_promo"]==1?$value["harga_diskon"]:0;
        if($value["persen_diskon"]!=0) {
            if($produk[$key]["harga_diskon"]!=0) { $produk[$key]["harga_jual"] = $produk[$key]["harga_diskon"]; }                
            $produk[$key]["harga_diskon"] = $produk[$key]["harga_jual"]-($produk[$key]["persen_diskon"]*($produk[$key]["harga_jual"]*0.01));
        }
            
        $produk[$key]["kategori"] = $db->getFieldValue("produk_to_category AS A LEFT JOIN category AS B ON A.id_kategori=B.id", array("B.id", "B.nama"), array("A.id_produk" => $value["id"]));
        $produk[$key]["category_name"] = "";
        foreach ($produk[$key]["kategori"] as $key_kategori => $value_kategori) {
            $produk[$key]["category_name"] .= $value_kategori["nama"].", ";
        }
        $produk[$key]["category_name"] = rtrim($produk[$key]["category_name"], ", ");
    }
    
    //GET LAPORAN
    $sql = "SELECT 
            A.id,
            A.id_produk,
            B.kode, 
            B.nama, 
            B.gambar_utama AS gambar, 
            C.pesan, 
            C.tanggal_jam, 
            C.`from` AS from_id, 
            IF(C.grup=1, D.nama, IF(C.grup=2, TRIM(CONCAT(E.first_name, ' ', E.last_name)), CONCAT('Guest ', F.id)))  AS from_nama, 
            IF(C.grup=1, 'admin.png', IF(C.grup=2, D.photo, 'default.png'))  AS from_photo,
            G.total_unread
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
            admin_users AS D ON C.from=D.id LEFT JOIN     
            member AS E ON C.from=E.id LEFT JOIN     
            guest AS F ON C.from=F.id LEFT JOIN
            (SELECT 
                id_head, 
                COUNT(*) AS total_unread 
            FROM 
                message 
            WHERE
                user_read=0 AND
                grup=1
            GROUP BY 
                id_head
            ) AS G ON G.id_head=A.id
        WHERE 
            A.id_member='$_id_user' AND 
            A.id_guest='$_id_guest' AND 
            A.id_produk='$_id_produk'";
    $db->mysql_query($sql, $rec_count, $laporan);
    
    $_id_head = $rec_count>0?$laporan[0]["id"]:0;
    
    $data = array();
    if($_id_head>0) {
        $sql = "SELECT COUNT(*) AS TOTAL FROM message WHERE id_head=$_id_head";
        $db->mysql_query($sql, $rec_count, $totalrecord);
        $nbrows = $totalrecord[0]["TOTAL"];
        $_page =  ceil($nbrows/$_limit);    

        if($nbrows>0) {
            $sql = "SELECT 
                A.id, 
                A.pesan AS message, 
                A.tanggal_jam AS datetime,
                DATE_FORMAT(A.tanggal_jam, '%d-%m-%Y %H:%i:%s') AS tanggal_komentar, 
                IF(A.grup=1, B.nama, IF(A.grup=2, TRIM(CONCAT(C.first_name, ' ', C.last_name)), CONCAT('Guest ', D.id)))  AS nama, 
                IF(A.grup=1, 'admin.png', IF(A.grup=2, C.photo, 'default.png')) AS photo,
                IF(A.grup=1 AND A.user_read=0, 'new', '') AS is_new_komentar,
                IF(A.grup='".($_id_user>0?2:3)."' AND A.from='".($_id_user>0?$_id_user:$_id_guest)."', 1, 0) AS is_self,
                1 AS is_sent
            FROM 
                message AS A LEFT JOIN 
                admin_users AS B ON A.from=B.id LEFT JOIN     
                member AS C ON A.from=C.id LEFT JOIN     
                guest AS D ON A.from=D.id
            WHERE 
                A.id_head=$_id_head 
            ORDER BY 
                A.id 
            LIMIT ".(($_page-1)*$_limit).",".$_limit;
            $db->mysql_query($sql, $rec_count, $data);
            foreach ($data as $key => $value) {
                if($value["is_new_komentar"]=='new') { $db->mysql_update("message", array("user_read" => 1), array("id" => $value["id"])); }                
                $data[$key]["is_self"] = $data[$key]["is_self"]==1;
                $data[$key]["is_sent"] = $data[$key]["is_sent"]==1;
            }
        }
    }
    
    //GET UMUM
    $data_umum = $db->getFieldValue("umum", array("avatar"));
    
    $db->mysql_close();
     
    $rasult = array(
        "totalCount"   => $nbrows,
        "topics"       => $data,
        "dat_a"        => $dat_a,
        "produk"       => $produk[0],
        "laporan"      => $laporan[0],
        "avatar_admin" => $data_umum[0]["avatar"]
    );
    
    die(json_encode($rasult));
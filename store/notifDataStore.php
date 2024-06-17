<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    if(!isset($_SESSION[ADMIN_SESSION_NAME])) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Kesalahan login! Silahkan logout.")));
    }
    
    //NOTIFIKASI KOMENTAR (halaman message!)
    $id_head_komentar = isset($_POST["id_head_komentar"])?$_POST["id_head_komentar"]:0;
    $last_id_komentar = isset($_POST["last_id_komentar"])?$_POST["last_id_komentar"]:0;
    
    if($id_head_komentar>0) {
        $list_komentar = $db->getFieldValue(
            "message AS A LEFT JOIN 
            admin_users AS B ON A.from=B.id LEFT JOIN     
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
                "A.id_head" => $id_head_komentar
            ), 
            array(), 0, 0, " A.id ", " A.id>$last_id_komentar AND A.grup<>1 "
        );

        foreach ($list_komentar as $key => $value) {
            if($value["is_new_komentar"]=='new') { $db->mysql_update("message", array("user_read" => 1), array("id" => $value["id"])); }
            $last_id_komentar = $value["id"];
        }
    }
    $data_komentar = array(
        "last_id_komentar" => $last_id_komentar,
        "list_new_komentar" => $list_komentar
    );
    
    //NOTIFIKASI MESSAGE
    $total_new_message = $db->getFieldValue(
        "message AS A", 
        array("COUNT(*) AS TOTAL"), 
        array("A.user_read" => 0), 
        array(), 0, 0, "", "A.grup<>1"
    );
    if($total_new_message[0]["TOTAL"]>0) {
        $sql = "SELECT 
            A.*, 
            B.kode, 
            B.nama, 
            B.gambar_utama AS gambar, 
            C.pesan, 
            C.tanggal_jam, 
            C.`from` AS from_id, 
            IF(C.grup=1, D.nama, IF(C.grup=2, TRIM(CONCAT(E.first_name, ' ', E.last_name)), CONCAT('Guest ', F.id)))  AS from_nama, 
            IF(C.grup=1, 'admin.png', IF(C.grup=2, D.photo, 'default.png'))  AS from_photo,
            G.total_unread,
            IF(G.total_unread>0, 0, 1) AS status
        FROM 
            (SELECT A.id_head, COUNT(*) AS TOTAL FROM message AS A WHERE A.user_read=0 AND A.grup<>1 ".($id_head_komentar>0?" AND A.id_head<>$id_head_komentar":"")." GROUP BY A.id_head) AS Z LEFT JOIN
            message_head AS A ON A.id=Z.id_head LEFT JOIN    
            produk AS B ON A.id_produk=B.id LEFT JOIN (
            SELECT 
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
                grup<>1
            GROUP BY 
                id_head
            ) AS G ON G.id_head=A.id
        ORDER BY C.tanggal_jam DESC ";
        $db->mysql_query($sql, $rec_count, $list_message);
        foreach ($list_message as $key => $value) {
            $list_message[$key]["waktu"]  = $db->dateDiff(date("Y-m-d H:i:s"), $value["tanggal_jam"]);
        }
    }
    $data_message = array(
        "total_new_message" => $total_new_message[0]["TOTAL"],
        "list_new_message" => $list_message
    );
    
    //GET NEW ORDER
    $last_id_order = strlen($_POST["last_id_order"])==0?'0':$_POST["last_id_order"];
    $total_new_order = $db->getFieldValue("customer_order_header AS A", array("COUNT(*) AS TOTAL", "MAX(A.id) AS LAST_ID"), array("A.status" => 0), array(), 0, 0, "", " A.id>'".$last_id_order."' ");
    
    $data_order = array();
    if($total_new_order[0]["TOTAL"]>0) {
        $notif_order = $db->getFieldValue("customer_order_header AS A LEFT JOIN member AS B ON A.id_member=B.id LEFT JOIN (SELECT COUNT(*) AS TOTAL, id_header FROM customer_order_detail GROUP BY id_header) AS C ON A.id=C.id_header", array("A.id", "A.id_member", "A.kode", "A.is_dropship", "A.tanggal_jam AS waktu", "A.total", "C.TOTAL AS jumlah", "CONCAT(B.first_name, ' ', B.last_name) AS nama", "A.status"), array(), array(), 3, 0, " A.id DESC ", "");
        foreach ($notif_order as $key => $value) {
            $notif_order[$key]["waktu"]  = $db->dateDiff(date("Y-m-d H:i:s"), $value["waktu"]);
            $notif_order[$key]["total"]  = number_format($value["total"], 0, '.', ',');
            $notif_order[$key]["jumlah"] = number_format($value["jumlah"], 0, '.', ',');                
        }
        $data_order = array(
            "total_new_order" => $total_new_order[0]["TOTAL"],
            "last_id_order" => $total_new_order[0]["LAST_ID"],
            "list_new_order" => $notif_order
        );
    }
    
    
    //GET NEW KONFIRMASI
    $last_id_konfirmasi = strlen($_POST["last_id_konfirmasi"])==0?'0':$_POST["last_id_konfirmasi"];
    $total_new_konfirmasi = $db->getFieldValue("konfirmasi_pembayaran AS A", array("COUNT(*) AS TOTAL", "MAX(A.id) AS LAST_ID"), array("A.status" => 0), array(), 0, 0, "", " A.id>'".$last_id_konfirmasi."' ");
    
    $data_konfirmasi = array();
    if($total_new_konfirmasi[0]["TOTAL"]>0) {
        $notif_konfirmasi = $db->getFieldValue("konfirmasi_pembayaran AS A LEFT JOIN member AS B ON A.id_member=B.id LEFT JOIN bank_transfer AS C ON A.bank_tujuan=C.id", array("A.id", "A.kode_pemesanan", "A.jumlah_transfer", "A.tanggal_jam AS waktu", "C.nama_bank", "CONCAT(B.first_name, ' ', B.last_name) AS nama", "A.status"), array(), array(), 3, 0, " A.id DESC ", "");
        foreach ($notif_konfirmasi as $key => $value) {
            $notif_konfirmasi[$key]["text"] = "No. <b>#".$value["kode_pemesanan"]."</b> sebesar <b><i>Rp. ".number_format($value["jumlah_transfer"], 0, '.', ','). ",-</b></i>&nbsp;&nbsp;ke <b>".$value["nama_bank"]."</b>.";
            $notif_konfirmasi[$key]["waktu"] = $db->dateDiff(date("Y-m-d H:i:s"), $value["waktu"]);
        }
        $data_konfirmasi = array(
            "total_new_konfirmasi" => $total_new_konfirmasi[0]["TOTAL"],
            "last_id_konfirmasi" => $total_new_konfirmasi[0]["LAST_ID"],
            "list_new_konfirmasi" => $notif_konfirmasi
        );
    }
    
    //GET NEW PELANGGAN
    $last_id_pelanggan = strlen($_POST["last_id_pelanggan"])==0?'0':$_POST["last_id_pelanggan"];
    $total_new_pelanggan = $db->getFieldValue("member AS A", array("COUNT(*) AS TOTAL", "MAX(A.id) AS LAST_ID"), array("A.is_open" => 0), array(), 0, 0, "", " A.id>'".$last_id_pelanggan."' ");
    
    $data_pelanggan = array();
    if($total_new_pelanggan[0]["TOTAL"]>0) {
        $notif_pelanggan = $db->getFieldValue("member AS A", array("A.id", "A.tanggal_jam_create AS waktu", "CONCAT(A.first_name, ' ', A.last_name) AS nama", "A.email", "A.is_open AS status"), array(), array(), 3, 0, " A.is_open, A.id DESC ", "");
        foreach ($notif_pelanggan as $key => $value) {
            $notif_pelanggan[$key]["text"] = $value["nama"] . "( ". $value["email"] . ")";
            $notif_pelanggan[$key]["waktu"] = $db->dateDiff(date("Y-m-d H:i:s"), $value["waktu"]);
        }
        $data_pelanggan = array(
            "total_new_pelanggan" => $total_new_pelanggan[0]["TOTAL"],
            "last_id_pelanggan" => $total_new_pelanggan[0]["LAST_ID"],
            "list_new_pelanggan" => $notif_pelanggan
        );
    }
    
    $db->mysql_close();
    $result = array(
        "success" => true,
        "data_komentar" => $data_komentar,
        "data_message" => $data_message,
        "data_order" => $data_order,
        "data_konfirmasi" => $data_konfirmasi,
        "data_pelanggan" => $data_pelanggan
    );
    
    
    die(json_encode($result));
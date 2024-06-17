<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    //TIPE USER
    $id_member = $_POST["user_id"];
    $id_guest  = $_POST["guest_id"];
    
    $_limit    = 10;
    $_page     = $_POST["page"];
    
    $sql_induk = "
        SELECT 
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
            A.id_member='$id_member' AND 
            A.id_guest='$id_guest'";
    
    //get total
    $sql = "SELECT COUNT(*) AS TOTAL FROM ($sql_induk) AS A";
    $db->mysql_query($sql, $rec_count, $rs);
    $nbrows = $rs[0]["TOTAL"];
    $data = array();
    if($nbrows>0) {
        $data = $db->getFieldValue("($sql_induk) AS A", array("*"), array(), array(), $_limit, $_limit*($_page-1), " A.tanggal_jam DESC "); 
        foreach($data as $key => $value) {
            //$data[$key]["tanggal"] = $db->dateDiff(date("Y-m-d H:i:s"), $value["tanggal"]);
            $data[$key]["pesan"]   = preg_replace( "/\r|\n/", "", $db->limitTextKonten($value["pesan"], 150));
        }
    }
    $db->mysql_close();
     
    $rasult = array(
        "totalCount" => $nbrows,
        "topics" => $data,
        "next_page" => $_page+(count($data)==0?0:1)
    );
    
    die(json_encode($rasult));
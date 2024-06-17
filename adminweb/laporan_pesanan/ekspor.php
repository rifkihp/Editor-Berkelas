<?php
       
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    $tanggal_dari   = !isset($_GET["tanggal_dari"])?'':$_GET["tanggal_dari"];
    $temp = explode("-", $tanggal_dari);
    if(count($temp)==3) { $tanggal_dari = ($temp[2]."-".$temp[1]."-".$temp[0]); }
    
    $tanggal_sampai   = !isset($_GET["tanggal_sampai"])?'':$_GET["tanggal_sampai"];
    $temp = explode("-", $tanggal_sampai);
    if(count($temp)==3) { $tanggal_sampai = ($temp[2]."-".$temp[1]."-".$temp[0]); }
    
    $sql = "
        SELECT 
            A.kode AS kode_pesan, 
            IF(A.id_member=0, 'Tamu', CONCAT(B.first_name, ' ', B.last_name)) AS member, 
            DATE_FORMAT(A.tanggal_jam, '%d-%m-%Y') AS tanggal, 
            COALESCE(C.modal, 0) AS modal, 
            A.grandtotal, 
            A.voucher, 
            A.ongkir, 
            A.total 
        FROM 
            customer_order_header AS A LEFT JOIN 
            member AS B ON A.id_member=B.id LEFT JOIN 
            (SELECT C1.id_header, SUM(C1.jumlah*harga_beli) AS modal, C2.status FROM customer_order_detail AS C1 LEFT JOIN customer_order_header AS C2 ON C1.id_header=C2.id WHERE (C2.status=6 OR C2.status=5 OR C2.status=2) ".
            (strlen($tanggal_dari)>0?" AND DATE_FORMAT(C2.tanggal_jam, '%Y-%m-%d')>='$tanggal_dari'":"") .
            (strlen($tanggal_sampai)>0?" AND DATE_FORMAT(C2.tanggal_jam, '%Y-%m-%d')<='$tanggal_sampai'":"") ." " .
            "GROUP BY C1.id_header) AS C ON A.id=C.id_header 
        WHERE (A.status=6 OR A.status=5 OR A.status=2) " .
            (strlen($tanggal_dari)>0?" AND DATE_FORMAT(A.tanggal_jam, '%Y-%m-%d')>='$tanggal_dari'":"") .
            (strlen($tanggal_sampai)>0?" AND DATE_FORMAT(A.tanggal_jam, '%Y-%m-%d')<='$tanggal_sampai'":"")." ORDER BY A.tanggal_jam DESC";
    
    $file_name = $db->exportToExcel($root, $sql);
    $db->mysql_close();

    if(isset($file_name))
        die(json_encode(array("success" => true, "filename" => $file_name.".xls")));
    else
        die(json_encode(array("success" => false, "message" => "Tidak ada file yang dihasilkan.")));
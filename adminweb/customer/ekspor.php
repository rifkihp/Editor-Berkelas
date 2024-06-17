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
    
    $id_member = $_GET["id"];
    
    $sql = "SELECT 
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
    
    $file_name = $db->exportToExcel($root, $sql);
    $db->mysql_close();

    if(isset($file_name))
        die(json_encode(array("success" => true, "filename" => $file_name.".xls")));
    else
        die(json_encode(array("success" => false, "message" => "Tidak ada file yang dihasilkan.")));
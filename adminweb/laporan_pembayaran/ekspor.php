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
    
    $sql = "SELECT A.id, A.kode_pemesanan AS kode_pesan, IF(A.id_member=0, 'Tamu', CONCAT(B.first_name, ' ', B.last_name)) AS member, 
            DATE_FORMAT(A.tanggal_jam_update_status, '%d-%m-%Y') AS tanggal_bayar, C.nama_bank, C.cabang, C.no_rekening, C.nama_pemilik_rekening, 
            A.jumlah_transfer FROM konfirmasi_pembayaran AS A LEFT JOIN member AS B ON A.id_member=B.id LEFT JOIN bank_transfer AS C ON A.bank_tujuan=C.id
            WHERE A.status=2 ". (strlen($tanggal_dari)>0?"AND DATE_FORMAT(A.tanggal_jam_update_status, '%Y-%m-%d')>='$tanggal_dari' ":"") .
            (strlen($tanggal_sampai)>0?"AND DATE_FORMAT(A.tanggal_jam_update_status, '%Y-%m-%d')<='$tanggal_sampai' ":"")."ORDER BY A.tanggal_jam_update_status DESC";
    
    $file_name = $db->exportToExcel($root, $sql);
    $db->mysql_close();

    if(isset($file_name))
        die(json_encode(array("success" => true, "filename" => $file_name.".xls")));
    else
        die(json_encode(array("success" => false, "message" => "Tidak ada file yang dihasilkan.")));
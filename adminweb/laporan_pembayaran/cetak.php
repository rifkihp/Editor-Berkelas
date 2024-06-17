<?php  
    $root = "../../";
    include $root."includes/php/initial.php";    
    if(!isset($_SESSION[ADMIN_SESSION_NAME])) {
        header("location: ".ADMINWEB_URL);
        die();
    }
    include $root."includes/php/classUtama.php";
    require($root."includes/fpdf16/fpdf.php");
    
    
    //DATABASE CONNECTION
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
    $db->mysql_query($sql, $rs_num, $rs);
    
    $pdf = new FPDF();
    $barisPerHalaman = 30;
    $baris = 0;
    $top = 32;
    $left = 19;
    $tinggi = 5;
    $TOTAL = 0;
    foreach ($rs as $key => $value) {
        $TOTAL += $value["jumlah_transfer"];
        if($baris==0) {
            $pdf->AddPage();
            
            $pdf->setY(14);
            $pdf->setFont('Arial','',12);
            $pdf->cell(190,6,'LAPORAN PEMBAYARAN', 0, 0, 'C');
            $pdf->setY(20);
            $pdf->setFont('Arial','',10);
            $pdf->cell(190,6, (strlen($_GET["tanggal_dari"])>0?("Dari tanggal ".$_GET["tanggal_dari"]." "):"").(strlen($_GET["tanggal_sampai"])>0?("sd. tanggal ".$_GET["tanggal_sampai"]." "):""), 0, 0, 'C');
            
            $pdf->setXY($left, $top+($baris*$tinggi));
            $pdf->setFont('Arial','B',7);
            $pdf->cell(10, $tinggi, 'No.', 1, 0, 'C');
            $pdf->cell(25, $tinggi, 'No. Pesan', 1, 0, 'C');
            $pdf->cell(25, $tinggi, 'Tanggal', 1, 0, 'C');            
            $pdf->cell(40, $tinggi, 'Dari Member', 1, 0, 'C');
            $pdf->cell(40, $tinggi, 'Tujuan', 1, 0, 'C');
            $pdf->cell(30, $tinggi, 'Jumlah', 1, 0, 'C');
            $pdf->setFont('Arial','',7);
            $baris++;
        }
        
        $pdf->setXY($left, $top+($baris*$tinggi));
        $pdf->cell(10, $tinggi, ($key+1), 1, 0, 'C');
        $pdf->cell(25, $tinggi, $value["kode_pesan"], 1, 0, 'C');
        $pdf->cell(25, $tinggi, $value["tanggal_bayar"], 1, 0, 'C');
        $pdf->cell(40, $tinggi, $value["member"], 1, 0, 'L');
        $pdf->cell(40, $tinggi, $value["nama_bank"], 1, 0, 'L');
        $pdf->cell(30, $tinggi, number_format($value["jumlah_transfer"], 0, '.', ','), 1, 0, 'R');
        $baris++;
        
        if($baris>$barisPerHalaman) {
            $baris=0;
        }
    }
    $pdf->setXY($left, $top+($baris*$tinggi));
    $pdf->setFont('Arial','B',7);
            $pdf->cell(140, $tinggi, 'TOTAL: ', 1, 0, 'R');
            
            $pdf->cell(30, $tinggi, number_format($TOTAL, 0, '.', ','), 1, 0, 'R');
            $pdf->setFont('Arial','',7);
            $baris++;
            
    $pdf->Output();
    

    

    $db->mysql_close();
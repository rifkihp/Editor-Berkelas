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
    $db->mysql_query($sql, $rs_num, $rs);
    
    $pdf = new FPDF();
    $barisPerHalaman = 30;
    $baris = 0;
    $top = 32;
    $left = 10;
    $tinggi = 5;
    $TOTAL_MODAL = $TOTAL_GRANDTOTAL = $TOTAL_VOUCHER = $TOTAL_ONGKIR = $TOTAL_TOTAL = 0;
    foreach ($rs as $key => $value) {
        $TOTAL_MODAL += $value["modal"];
        $TOTAL_GRANDTOTAL += $value["grandtotal"];
        $TOTAL_VOUCHER += $value["voucher"];
        $TOTAL_ONGKIR += $value["ongkir"];
        $TOTAL_TOTAL += $value["total"];
        
        if($baris==0) {
            $pdf->AddPage();
            
            $pdf->setY(14);
            $pdf->setFont('Arial','',12);
            $pdf->cell(190,6,'LAPORAN PESANAN', 0, 0, 'C');
            $pdf->setY(20);
            $pdf->setFont('Arial','',10);
            $pdf->cell(190,6, (strlen($_GET["tanggal_dari"])>0?("Dari tanggal ".$_GET["tanggal_dari"]." "):"").(strlen($_GET["tanggal_sampai"])>0?("sd. tanggal ".$_GET["tanggal_sampai"]." "):""), 0, 0, 'C');
            
            $pdf->setXY($left, $top+($baris*$tinggi));
            $pdf->setFont('Arial','B',7);
            $pdf->cell(10, $tinggi, 'No.', 1, 0, 'C');
            $pdf->cell(20, $tinggi, 'No. Pesan', 1, 0, 'C');
            $pdf->cell(20, $tinggi, 'Tanggal', 1, 0, 'C');            
            $pdf->cell(40, $tinggi, 'Member', 1, 0, 'C');
            $pdf->cell(20, $tinggi, 'Modal', 1, 0, 'C');
            $pdf->cell(20, $tinggi, 'Sub Total', 1, 0, 'C');
            $pdf->cell(20, $tinggi, 'Voucher', 1, 0, 'C');
            $pdf->cell(20, $tinggi, 'Ongkir', 1, 0, 'C');
            $pdf->cell(20, $tinggi, 'Total', 1, 0, 'C');
            $pdf->setFont('Arial','',7);
            $baris++;
        }
        
        $pdf->setXY($left, $top+($baris*$tinggi));
        $pdf->cell(10, $tinggi, ($key+1), 1, 0, 'C');
        $pdf->cell(20, $tinggi, $value["kode_pesan"], 1, 0, 'C');
        $pdf->cell(20, $tinggi, $value["tanggal"], 1, 0, 'C');
        $pdf->cell(40, $tinggi, $value["member"], 1, 0, 'L');
        
        $pdf->cell(20, $tinggi, number_format($value["modal"], 0, '.', ','), 1, 0, 'R');
        $pdf->cell(20, $tinggi, number_format($value["grandtotal"], 0, '.', ','), 1, 0, 'R');
        $pdf->cell(20, $tinggi, number_format($value["voucher"], 0, '.', ','), 1, 0, 'R');
        $pdf->cell(20, $tinggi, number_format($value["ongkir"], 0, '.', ','), 1, 0, 'R');
        $pdf->cell(20, $tinggi, number_format($value["total"], 0, '.', ','), 1, 0, 'R');
        
        $baris++;
        
        if($baris>$barisPerHalaman) {
            $baris=0;
        }
    }
    $pdf->setXY($left, $top+($baris*$tinggi));
    $pdf->setFont('Arial','B',7);
            $pdf->cell(90, $tinggi, 'TOTAL: ', 1, 0, 'R');            
            $pdf->cell(20, $tinggi, number_format($TOTAL_MODAL, 0, '.', ','), 1, 0, 'R');
            $pdf->cell(20, $tinggi, number_format($TOTAL_GRANDTOTAL, 0, '.', ','), 1, 0, 'R');
            $pdf->cell(20, $tinggi, number_format($TOTAL_VOUCHER, 0, '.', ','), 1, 0, 'R');
            $pdf->cell(20, $tinggi, number_format($TOTAL_ONGKIR, 0, '.', ','), 1, 0, 'R');
            $pdf->cell(20, $tinggi, number_format($TOTAL_TOTAL, 0, '.', ','), 1, 0, 'R');
            $pdf->setFont('Arial','',7);
            $baris++;
    ob_end_clean();        
    $pdf->Output();
    

    

    $db->mysql_close();
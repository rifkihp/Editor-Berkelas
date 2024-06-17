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
    $id_member = $_GET["id"];
    
    $customer = $db->getFieldValue("member", array("*"), array("id" => $id_member));
    
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
    $db->mysql_query($sql, $rs_num, $rs);
    
    $pdf = new FPDF();
    $barisPerHalaman = 30;
    $baris = 0;
    $top = 32;
    $left = 10;
    $tinggi = 5;
    $TOTAL_JUMLAH = $TOTAL_QTY = 0;
    foreach ($rs as $key => $value) {
        $TOTAL_JUMLAH += $value["jumlah"];
        $TOTAL_QTY += $value["total_qty"];
        
        if($baris==0) {
            $pdf->AddPage();
            
            $pdf->setY(14);
            $pdf->setFont('Arial','',12);
            $pdf->cell(190,6,'LAPORAN DETAIL PESANAN '.$customer[0]["first_name"]." ".$customer[0]["last_name"], 0, 0, 'C');
            $pdf->setY(20);
            $pdf->setFont('Arial','',10);
            $pdf->cell(190,6, (strlen($_GET["tanggal_dari"])>0?("Dari tanggal ".$_GET["tanggal_dari"]." "):"").(strlen($_GET["tanggal_sampai"])>0?("sd. tanggal ".$_GET["tanggal_sampai"]." "):""), 0, 0, 'C');
            
            $pdf->setXY($left, $top+($baris*$tinggi));
            $pdf->setFont('Arial','B',7);
            $pdf->cell(10, $tinggi, 'No.', 1, 0, 'C');
            $pdf->cell(60, $tinggi, 'Tanggal', 1, 0, 'C');
            $pdf->cell(60, $tinggi, 'Jumlah', 1, 0, 'C');
            $pdf->cell(60, $tinggi, 'Total Qty', 1, 0, 'C');
            $pdf->setFont('Arial','',7);
            $baris++;
        }
        
        $pdf->setXY($left, $top+($baris*$tinggi));
        $pdf->cell(10, $tinggi, ($key+1), 1, 0, 'C');
        $pdf->cell(60, $tinggi, $value["tanggal"], 1, 0, 'C');
        $pdf->cell(60, $tinggi, number_format($value["jumlah"], 0, '.', ','), 1, 0, 'R');
        $pdf->cell(60, $tinggi, number_format($value["total_qty"], 0, '.', ','), 1, 0, 'R');
        
        $baris++;
        
        if($baris>$barisPerHalaman) {
            $baris=0;
        }
    }
    $pdf->setXY($left, $top+($baris*$tinggi));
    $pdf->setFont('Arial','B',7);
            $pdf->cell(70, $tinggi, 'TOTAL: ', 1, 0, 'R');            
            $pdf->cell(60, $tinggi, number_format($TOTAL_JUMLAH, 0, '.', ','), 1, 0, 'R');
            $pdf->cell(60, $tinggi, number_format($TOTAL_QTY, 0, '.', ','), 1, 0, 'R');
            $pdf->setFont('Arial','',7);
            $baris++;
            
    $pdf->Output();
    

    

    $db->mysql_close();
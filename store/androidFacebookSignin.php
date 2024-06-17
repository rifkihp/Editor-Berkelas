<?php
    $root = "../";
    include $root."includes/php/initial.php";
    if(strlen($_SESSION['security_code'])==0 || !isset($_SESSION['security_code']) || $_POST["security_code"]!=$_SESSION['security_code']) {
    	die(json_encode(array("success" => false, "message" => "Maaf! Token tidak valid!")));
    }
    unset($_SESSION['security_code']);

    include $root."includes/php/classUtama.php";
    
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $data_login = $db->getFieldValue(
        "member AS A LEFT JOIN jenis_user AS B ON B.id=A.jenis_user", 
        array("A.id", "A.first_name", "A.last_name", "A.email", "A.phone", "A.dropship_name", "A.dropship_phone", "B.nama AS jenis_user", "A.photo", "A.aktif"),
        array("email" => $_POST["email"])
    );
    
    if(count($data_login)>0) {
        
        if($data_login[0]["aktif"]==0 && $_POST["do_registrasi"]=="NO") {
            $db->mysql_close();
            die(json_encode(array("success" => false, "tidak_aktif" => true, "message" => "Akun sudah terdaftar tetapi belum aktif!")));
        } else {
            //LOAD DATA ORDER LIST
            $data_login[0]["order_list"] = $db->getFieldValue("customer_order_header AS A LEFT JOIN customer_order_ongkir AS B ON A.id=B.id_header LEFT JOIN ekspedisi AS C ON B.id_ekspedisi=C.id", array(
                "A.kode AS no_transaksi", 
                "A.tanggal_jam AS tgl_transaksi",
                "A.pembayaran", 
                "A.nama",
                "A.total_qty AS qty",
                "A.grandtotal AS jumlah",
                "B.etd AS estimasi",
                "C.kode AS kurir",
                "B.no_resi",
                "C.gambar",
                "A.status",
                "A.id_member AS user_id" 
                ), array("A.id_member" => $data_login[0]["id"]));
        }
    }
    $db->mysql_close();
    
    $data_login[0]["success"] = count($data_login)>0;
    $data_login[0]["message"] = $data_login[0]["success"]?"Proses masuk dengan facebook berhasil!":"Akun Facebook belum terdaftar!";
    die(json_encode($data_login[0]));
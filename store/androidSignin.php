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
    
    $_email    = $_POST["email"];
    $_password = $_POST["password"];
    
    include $root."includes/php/MCrypt.php";
    $mcrypt = new MCrypt();
    
    if(strlen($_email)==0 || strlen($_password)==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Email dan password harus diisi!")));
    }
    
    $sql = "SELECT A.id, A.first_name, A.last_name, A.email, A.phone, B.nama AS jenis_user, A.password, A.photo, A.saldo, A.aktif, A.admin FROM member AS A
            LEFT JOIN jenis_user AS B ON B.id=A.jenis_user WHERE (A.email='".$_email."' OR A.phone='".$_email."') AND A.password='".$mcrypt->encrypt($_password)."'";
    //die(json_encode(array("success" => false, "message" => $mcrypt->encrypt($_password))));
    $db->mysql_query($sql, $rec_count, $data_login);
    
    if(($data_login[0]["email"]==$_email || $data_login[0]["phone"]==$_email) && $data_login[0]["password"]==$mcrypt->encrypt($_password)) {
        /*if($data_login[0]["aktif"]==0) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Akun wtvindonesia belum aktif!")));
        } else if($data_login[0]["admin"]==0) {
            $db->mysql_close();
            die(json_encode(array("success" => false, "message" => "Akun wtvindonesia belum aktif!")));
        } else {*/   
            unset($data_login[0]["password"]);
            $data_login[0]["success"] = true;
            
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
            
            $db->mysql_close();
            die(json_encode($data_login[0]));
        //}
    } else {
    	$db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Email dan password tidak sesuai!")));        
    }
    
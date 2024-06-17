<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $id_member = $_POST["id_user"];
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $pesan = $_POST["pesan"];
    
    if(strlen($nama)==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Nama harus diisi!")));
    }
    
    if(strlen($email)==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Email harus diisi!")));
    }
    
    if(strlen($pesan)<=20) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Isi pesan harus lebih dari 20 karakter!")));
    }
    
    $db->mysql_close(); 
    die(json_encode(array("success" => true, "message" => array("Proses kirim pesan berhasil!"))));
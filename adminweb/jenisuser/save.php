<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();
    
    //validasi-validasi
    if(strlen($_POST["nama"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Nama grup harus diisi.")));
    }
    
    if(strlen($_POST["keterangan"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Keterangan harus diisi.")));
    }
    
    if(count($_POST["menu"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Pilih minimal 1 menu untuk diberi akses.")));
    }
    
    //get last id banner
    $id = $db->getLastNumber("usergrup", "id");
    
    //insert data banner
    $db->mysql_insert(
        "usergrup", 
        array(
            "id" => $id,
            "nama" => $_POST["nama"],
            "keterangan" => $_POST["keterangan"]
        )      
    );
    
    //INSERT MENU AKSES
    $sql = "INSERT INTO usergrup_modul_akses VALUES";
    $row = explode("\n", $_POST["menu"]);
    foreach ($row as $key => $value) {
        $col = explode("\t", $value);
        $sql.="('".$id."','".$col[0]."','".$col[1]."'),";
    }
    $db->mysql_execute(rtrim($sql, ","));    
    $db->mysql_close();
    
    die(json_encode(array("success" => true)));
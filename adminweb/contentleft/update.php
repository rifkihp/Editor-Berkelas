<?php
    $root = "../../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    $db = new classUtama(ADMIN_SESSION_NAME);
    $db->mysql_connect();

    //validasi-validasi
    if($_POST["tipe"]=='Kategori' && strlen($_POST["id_kategori"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Kategori harus diisi.")));
    }
    
    if (strlen($_POST["judul"])==0) {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Judul harus diisi.")));
    }
    
    //id banner update
    $id = $_POST["id"];
    
    //update data banner
    $db->mysql_update(
        "widget", 
        array(
            "id" => $id,
            "judul" => $_POST["judul"],
            "tipe" => $_POST["tipe"],
            "id_kategori" => $_POST["id_kategori"],
            "letak" => "Kiri",
            "is_aktif" => $_POST["is_aktif"],
            "urutan" => 0
        ), 
        array("id" => $id) 
    );
    
    //update posisi    
    $urutan = 1;
    $posisi = $urutan+1;
    $update_pos = $_POST["id_widget_posisi"]==0;
    
    $sql = "SELECT * FROM widget WHERE urutan>0 AND letak='Kiri' ORDER BY urutan";
    $db->mysql_query($sql, $rec_count, $data);
    for($i=0; $i<$rec_count; $i++) {
        if($update_pos) {
            $sql = "UPDATE widget SET urutan='".$posisi."' WHERE id='".$data[$i]["id"]."'";
            $db->mysql_execute($sql);
            $posisi++;
        } else
        if($data[$i]["id"]==$_POST["id_widget_posisi"]) {
            $urutan = $data[$i]["urutan"]+1;
            $posisi = $urutan+1;
            $update_pos = true; 
        }
    }
    $sql = "UPDATE widget SET urutan='$urutan' WHERE id='$id'";
    $db->mysql_execute($sql);
    
    $_SESSION["alert_success"] = "Update widget kiri berhasil.";
    $db->mysql_close();
    die(json_encode(array("success" => true)));
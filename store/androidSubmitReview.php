<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    //DATABASE CONNECTION
    $db = new classUtama();
    $db->mysql_connect(true);
    
    //TIPE USER
    $data_user = $db->getFieldValue("member", array("*"), array("id" => $_POST["id_user"]));
    $data_produk = $db->getFieldValue("produk", array("*"), array("id" => $_POST["id_produk"]));
    
    $rating    = $_POST["rating"];
    $review    = $_POST["review"];
    
    if(count($data_user)>0 && count($data_produk)>0) {
        $id = $db->getLastNumber("produk_rating_review", "id");
        $db->mysql_insert("produk_rating_review", array("id" => $id, "id_member" => $_POST["id_user"], "id_produk" => $_POST["id_produk"], "rating" => $rating, "review" => $review, "tanggal_jam" => date("Y-m-d H:i:s")));
    
        $sql = "SELECT COUNT(T.id_member) AS total_responden, AVG(T.rating) AS total_rating FROM (SELECT id_member, AVG(rating) AS rating FROM produk_rating_review WHERE id_produk='".$_POST["id_produk"]."' GROUP BY id_member) AS T";
        $db->mysql_query($sql, $rec_count, $data);
        
        $data_review = $db->getFieldValue("produk_rating_review", array("COUNT(*) AS total_review"), array("id_produk" => $_POST["id_produk"]));
        $db->mysql_update("produk", array("rating" => $data[0]["total_rating"], "responden" => $data[0]["total_responden"], "review" => $data_review[0]["total_review"]), array("id" => $_POST["id_produk"]));
        
        $data_produk = $db->getFieldValue("produk", array("rating", "responden", "review"), array("id" => $_POST["id_produk"]));
        $db->mysql_close();
        die(json_encode(array("success" => true, "message" => "Tambah review berhasil.", "total_rating" => $data_produk[0]["rating"], "total_responden" => $data_produk[0]["responden"], "total_review"  => $data_produk[0]["review"])));
    } else {
        $db->mysql_close();
        die(json_encode(array("success" => false, "message" => "Proses gagal!")));
    }
    
    
    
    die(json_encode($rasult));
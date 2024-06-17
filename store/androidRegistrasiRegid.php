<?php
    $root = "../";
    include $root."includes/php/initial.php";
    include $root."includes/php/classUtama.php";
    
    $db = new classUtama();
    $db->mysql_connect(true);
    
    $_user_id  = $_POST["user_id"];
    $_guest_id = $_POST["guest_id"];
    $_reg_id   = $_POST["reg_id"];
    
    
    //AS GUEST
    if($_user_id==0) {
        //clear gcm_regid member
        $db->mysql_update("member", array("gcm_regid" => "NULL"), array("gcm_regid" => $_reg_id), array("gcm_regid"));
        
        //cek data guest based on gcm regid
        $guest = $db->getFieldValue("guest", array("id"), array("gcm_regid" => $_reg_id));
        if(count($guest)>0) {
            $_guest_id = $guest[0]["id"];
        } else if($_guest_id>0) {
            
            //cek data guest based on guest id
            $guest = $db->getFieldValue("guest", array("id"), array("id" => $_guest_id));
            if(count($guest)>0) {
                $db->mysql_update("guest", array( "gcm_regid" => $_reg_id), array("id" => $_guest_id));
            } else {
                $db->mysql_insert("guest", array("id" => $_guest_id, "gcm_regid" => $_reg_id));
            }
        } else {
            
            $_guest_id = $db->getLastNumber("guest", "id");
            $db->mysql_insert("guest", array("id" => $_guest_id, "gcm_regid" => $_reg_id));
        }
    } else {
        
        //clear gcm_regid guest by reg id
        $db->mysql_delete("guest", array("gcm_regid" => $_reg_id));
            
        //clear gcm_regid guest by guest id
        if($_guest_id>0) { 
            $db->mysql_delete("guest", array("id" => $_guest_id));
            $_guest_id = 0;
        }
        
        $db->mysql_update("member", array( "gcm_regid" => $_reg_id), array("id" => $_user_id));
    }
    
    
    $db->mysql_close();
    die(json_encode(array("success" => true, "guest_id" => $_guest_id)));
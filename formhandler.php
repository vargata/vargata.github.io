<?php
    foreach($_POST as $name => $param){
        $params[$name] = $param;
    }
    
    $trash = array_pop($params);
    
    if(isset($_POST["marketing"]))
        $marketing = array_pop($params);
    
    $db = new db();
    $db->connect_db();
    
    if(isset($marketing)){
        $db->add_query("saveMarketing", "CALL saveMarketing(?, ?)");
        $db->add_params("saveMarketing", "ss", array($params["name"], $params["email"]));
        if($db->save_Data("saveMarketing"))
            echo "msuccess";
    }
    
    $db->add_query("saveEnquiry", "CALL saveEnquiry(?, ?, ?, ?, ?, ?, @cId)");
    $db->add_params("saveEnquiry", "ssssss", $params);
    if($db->save_Data("saveEnquiry"))
        echo "esuccess";
    
    $db->disconnect_db();
?>
<?php require_once 'db.php';?>

<?php

    $return = array();
    
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    
    $domain=explode("@",$email.".");
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($return, 'Need a valid email address.');
    }else
        if(!checkdnsrr(end($domain), 'MX')){
            array_push($return, 'Not existing email provider.');
    }
    
    $regex_digitonly = "/[^0-9]/";
    $regex_phone = "/0[0-9]{10}/";
    $phone = preg_replace($regex_digitonly, "", $phone, );
    if (!preg_match($regex_phone, $phone))
        array_push($return, 'Need a 11 digit phone number.');

?>

<?php

    if (empty($return)){
    
        foreach($_POST as $name => $param){
            $params[$name] = $param;
        }
        
        if(isset($_POST["marketing"]))
            $marketing = array_pop($params);
        
        $db = new db();
        $db->connect_db();
        
        if(isset($marketing)){
            $db->add_query("saveMarketing", "CALL saveMarketing(?, ?)");
            $db->add_params("saveMarketing", "ss", array($params["name"], $params["email"]));
            if($db->save_Data("saveMarketing")){
                array_push($return, 'Marketing preferences saved.');
            } else{
                array_push($return, 'Database error.');
            }
        }
        
        $db->add_query("saveEnquiry", "CALL saveEnquiry(?, ?, ?, ?, ?, ?, @cId)");
        $db->add_params("saveEnquiry", "ssssss", $params);
        if($db->save_Data("saveEnquiry")){
            array_push($return, 'Message sent successfully.');
        } else{
            array_push($return, 'Database error.');
        }
        
        $db->disconnect_db();
    }
    
    echo "<pre>".PHP_EOL;
    foreach($return as $value){
        echo "<label class='msglabel'>".$value."</label>".PHP_EOL;
    }
    echo "</pre>".PHP_EOL;
    
?>
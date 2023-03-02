<?php require_once 'db.php';?>

<?php

    $return = array();
    
    $name=$_POST['name'];
    $company=$_POST['company'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $subject=$_POST['subject'];
    $message=$_POST['message'];
    
    if(!preg_match("/^(?![\\- ])(?!.*  )[ \\-'\\p{L}]+(?<![\\- ])$/u", $name)){
        array_push($return, 'Invalid name!');
        $return["success"] = false;
    }
    
    if($company != ""){
        if(!preg_match("/^(?! )(?!.*  )[ \\d\\p{P}\\p{S}\\p{L}]+(?<![\\- ])$/u", $company)){
            array_push($return, 'Invalid company!');
            $return["success"] = false;
        }
    }
    
    if(!preg_match("/^(?! )(?!.*  )[ \\d\\p{P}\\p{S}\\p{L}]+(?<![\\- ])$/u", $subject)){
        array_push($return, 'Invalid subject!');
        $return["success"] = false;
    }
    
    if(!preg_match("/^(?!\\s)(?!.*  )(?!.*\\s\\s\\s)[\\s\\d\\p{P}\\p{S}\\p{L}]+(?<![\\s\\-])$/u", $message)){
        array_push($return, 'Invalid message!');
        $return["success"] = false;
    }
    
    $domain=explode("@",$email.".");
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($return, 'Need a valid email address.');
        $return["success"] = false;
    }else if(!checkdnsrr(end($domain), 'MX')){
        array_push($return, 'Not existing email provider.');
        $return["success"] = false;
    }
    
    $regex_digitonly = "/[^0-9]/";
    $regex_phone = "/^0[0-9]{10}$/";
    $phone = preg_replace($regex_digitonly, "", $phone, );
    if (!preg_match($regex_phone, $phone)){
        array_push($return, 'Need an 11 digit phone number starting with a 0.');
        $return["success"] = false;
    }

?>

<?php

    if (!isset($return["success"])){
    
        foreach($_POST as $name => $param){
            $params[$name] = $param;
        }
        
        if(isset($_POST["marketing"]))
            $marketing = array_pop($params);
        
        $db = new db();
        if($db->connect_db()){
        
            if(isset($marketing)){
                $db->add_query("saveMarketing", "CALL saveMarketing(?, ?)");
                $db->add_params("saveMarketing", "ss", array($params["name"], $params["email"]));
                if($db->save_Data("saveMarketing")){
                    array_push($return, 'Marketing preferences saved.');
                    $return["success"] = true;
                } else{
                    array_push($return, 'Database error! Please try again later');
                    $return["success"] = false;
                }
            }
            
            $db->add_query("saveEnquiry", "CALL saveEnquiry(?, ?, ?, ?, ?, ?, @cId)");
            $db->add_params("saveEnquiry", "ssssss", $params);
            if($db->save_Data("saveEnquiry")){
                array_push($return, 'Message sent successfully.');
                $return["success"] = true;
            } else{
                array_push($return, 'Database error! Please try again later');
                $return["success"] = false;
            }
            
            $db->disconnect_db();
        } else {
            array_push($return, "Connection error! Please try again later");
            $return["success"] = false;
        }
    }
    
    if($return["success"]){
        echo "<div class='success'>".PHP_EOL;
    } else{
        echo "<div class='error'>".PHP_EOL;
    }
    
    foreach($return as $key =>$value){
        if($key != "success")
            echo "<label class='msglabel'>".$value."</label>".PHP_EOL;
    }
    echo"</div>".PHP_EOL;
    
?>
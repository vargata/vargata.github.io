<?php

$return = array();

$fname=$_POST['fname'];
$sname=$_POST['sname'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$subject=$_POST['subject'];
$message=$_POST['msg'];

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

if (empty($return)){
    include_once 'db.php';
    
    $dbase = new db();
    $dbase->connect_db();
    if($dbase->save_Data($fname, $sname, $email, $phone, $subject, $message)){
        $dbase->close_db();
        array_push($return, 'Message sent successfully.');
    } else {
        array_push($return, 'Database error.');
    }
}

echo "<pre>".PHP_EOL;
foreach($return as $value){
    echo "<label class='msglabel'>".$value."</label>".PHP_EOL;
}
echo "</pre>".PHP_EOL;

?>
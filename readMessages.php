<?php
    require_once './src/db.php';

    $db = new db();
    $db->connect_db();
    
    $db->add_query("getMarketing",
        "SELECT
            market_name as 'Name',
            market_email as 'EMail'
        FROM tbl_marketing");
    
    $db->add_query("getMessages",
        "SELECT
            contact_name as 'Name',
            contact_company as 'Company',
            contact_email as 'EMail',
            contact_phone as 'Phone',
            msg_subject as 'Subject',
            msg_content as 'Message'
        FROM tbl_contacts, tbl_messages
        WHERE tbl_contacts.contact_id = tbl_messages.contact_id");
    
    $messages = $db->get_Data("getMessages");
    echo "<table>".PHP_EOL;
    echo "<tr><td colspan=6>Messages</td></tr>".PHP_EOL;
    foreach($messages as $row => $content){
        echo "<tr>".PHP_EOL;
        if($row == "row0"){
            foreach($content as $name => $value){
                echo "<th>" . $name . "</th>".PHP_EOL;
            }
            echo "</tr>".PHP_EOL;
            echo "<tr>".PHP_EOL;
        }
        foreach($content as $name => $value){
            echo "<td>" . $value . "</td>".PHP_EOL;
        }
        echo "</tr>".PHP_EOL;
    }
    echo "</table>".PHP_EOL;
    
    $marketing = $db->get_Data("getMarketing");
    echo "<table>".PHP_EOL;
    echo "<tr><td colspan=2>Marketing subscribers</td></tr>".PHP_EOL;
    foreach($marketing as $row => $content){
        echo "<tr>".PHP_EOL;
        if($row == "row0"){
            foreach($content as $name => $value){
                echo "<th>" . $name . "</th>".PHP_EOL;
            }
            echo "</tr>".PHP_EOL;
            echo "<tr>".PHP_EOL;
        }
        foreach($content as $name => $value){
            echo "<td>" . $value . "</td>".PHP_EOL;
        }
        echo "</tr>".PHP_EOL;
    }
    echo "</table>".PHP_EOL;
    
?>
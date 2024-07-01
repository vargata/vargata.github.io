<?php
class db
{    
    private $conn;
    
    const db_host = "localhost";
    const db_name = "db_contact";
    const db_user = "contact_user";
    const db_pwd = "contactpwd";
    
    const sql_subject = "SELECT * FROM `tbl_subjects`;";
    
    function connect_db(){
        mysqli_report(MYSQLI_REPORT_OFF);
        $this->conn = @mysqli_connect(self::db_host, self::db_user, self::db_pwd, self::db_name);
        if(!$this->conn){
            echo "<label class='msglabel'>"."Connection error\nPlease try again later"."</label>".PHP_EOL;
        }
    }
    
    function get_Subjects(){
        if($this->conn){
            $returndata = array();
            $subjects = $this->conn->query(self::sql_subject);
            while($row = mysqli_fetch_array($subjects))
            {
                $returndata[$row['subject_Id']] = $row['subject_Text'];
            }
            return $returndata;
        }
    }
    
    Function save_Data($fname, $sname, $email, $phone, $subject, $message){
        $returndata = false;
        if($this->conn){
            $sql_savedata = "CALL add_Message(?, ?, ?, ?, ?, ?)";
            //$returndata = $this->conn->query($sql_savedata);
            $stmt = mysqli_prepare($this->conn, $sql_savedata);
            $stmt->bind_param('ssssis', $fname, $sname, $email, $phone, $subject, $message);
            $stmt->execute();
            $returndata = $stmt->affected_rows;
        }
        return $returndata;
    }
    
    function close_db(){
        if($this->conn)
            mysqli_close($this->conn);
    }
}
?>
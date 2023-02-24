<?php

class db
{    
    private $conn;
    
    const db_host = "localhost";
    const db_name = "db_netmatters";
    const db_user = "contact_user";
    const db_pwd = "contactpwd";
    
    private $sql_list = array();
    private $param_list = array();
    
    function add_query($sql_name, $sql){
        $this->sql_list[$sql_name] = $sql;
    }
    
    function add_params($sql_name, string $type_string, array $params){
        $this->param_list[$sql_name] = array("type_string" => $type_string, "params" => $params);
    }
    
    function connect_db(){
        //mysqli_report(MYSQLI_REPORT_OFF);
        $this->conn = @mysqli_connect(self::db_host, self::db_user, self::db_pwd, self::db_name);
        if(!$this->conn){
            echo "<label class='msglabel'>"."Connection error\nPlease try again later"."</label>".PHP_EOL;
        }
    }
    
    function disconnect_db(){
        if(!$this->conn){
            $this->conn->close();
        }
    }
    
    function get_Data($sql_name){
        if($this->conn){
            $returndata = array();
            
            $sql = $this->sql_list[$sql_name];
            $stmt = mysqli_prepare($this->conn, $sql);
            if(isset($this->param_list[$sql_name])){
                $stmt->bind_param($this->param_list[$sql_name]["type_string"], $this->param_list[$sql_name]["params"]);
            }
            $stmt->execute();
            $result = $stmt->get_result();
            
            $counter = 0;
            while($row = $result->fetch_assoc()){
                foreach($row as $key => $value)
                    $returndata["row" . $counter][$key] = $value;
                $counter++;
            }
            
            $stmt->close();
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
<?php

class db
{    
    private $conn;
    
    /*const db_host = "138.68.136.139";
    const db_name = "tamasvar_db_netmatters";
    const db_user = "tamasvar_contact_user";
    const db_pwd = "dU91Sc&Y0E5J";*/
    
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
        $ret = true;
        mysqli_report(MYSQLI_REPORT_OFF);
        $this->conn = @mysqli_connect(self::db_host, self::db_user, self::db_pwd, self::db_name);
        if(!$this->conn){
            $ret = false;
        }
        return $ret;
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
                $stmt->bind_param($this->param_list[$sql_name]["type_string"], ...$this->param_list[$sql_name]["params"]);
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
    
    Function save_Data($sql_name){
        $returndata = false;
        if($this->conn){
            $sql = $this->sql_list[$sql_name];
            $stmt = mysqli_prepare($this->conn, $sql);
            if(isset($this->param_list[$sql_name])){
                $stmt->bind_param($this->param_list[$sql_name]["type_string"], ...array_values($this->param_list[$sql_name]["params"]));
            }
            $stmt->execute();
            $returndata = $stmt->affected_rows;
            if($returndata < 1)
                $returndata = 0;
        }
        $stmt->close();
        return $returndata;
    }
    
    function close_db(){
        if($this->conn)
            mysqli_close($this->conn);
    }
}

?>
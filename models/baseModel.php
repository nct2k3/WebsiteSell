<?php

class BaseModel extends Database {

    protected $connect;

    public function __construct() {
        $this->connect = $this->connect(); 
    }

    private function _query($sql) {
    
        return mysqli_query($this->connect, $sql);
    }

    public function getAll($table) {
    
        $sql = "SELECT * FROM ${table}";
        $result = $this->_query($sql);
        
        $data = [];
        while ($row = mysqli_fetch_array($result)) {
            array_push($data, $row);
        }
        
        return $data; 
    }
}
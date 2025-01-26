<?php
require_once __DIR__ . '/../core/database.php'; // Thay đổi đường dẫn cho đúng
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
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data, $row);
        }
        
        return $data; 
    }

    public function getById($table, $id ,$typeID) {
        $sql = "SELECT * FROM ${table} WHERE ${typeID} = " . intval($id);
        $result = $this->_query($sql);
        return mysqli_fetch_assoc($result);
    }
    public function getByIdGroupByGroupBy($table, $id ,$typeID,$By,$limit) {
        $sql = "SELECT * FROM ${table} WHERE ${typeID} = " . intval($id)." GROUP BY ${By} LIMIT ${limit}";
        $result = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data, $row);
        }
        return $data; 
    }

    public function create($table, $data) {
        // Sử dụng mysqli_real_escape_string với đúng số lượng tham số
        $escapedData = array_map(function($value) {
            return mysqli_real_escape_string($this->connect, $value); // Thêm kết nối thứ hai
        }, $data);
    
        $columns = implode(", ", array_keys($escapedData));
        $values = implode("', '", array_values($escapedData));
        $sql = "INSERT INTO ${table} (${columns}) VALUES ('${values}')";
        
        return $this->connect->query($sql); // Sử dụng query thay vì exec để có thể trả về true/false
    }

    public function update($table, $data, $id) {
        $set = "";
        foreach ($data as $key => $value) {
            $set .= "${key} = '" . mysqli_real_escape_string($this->connect, $value) . "', ";
        }
        $set = rtrim($set, ", ");
        $sql = "UPDATE ${table} SET ${set} WHERE id = " . intval($id);
        return $this->_query($sql);
    }

    public function delete($table, $id) {
        $sql = "DELETE FROM ${table} WHERE id = " . intval($id);
        return $this->_query($sql);
    }
}
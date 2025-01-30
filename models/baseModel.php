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

    public function getOneCustome($sql) {
       
        $result = $this->_query($sql);
        return mysqli_fetch_assoc($result);
    }
    public function getListById($table, $id ,$typeID) {
        $sql = "SELECT * FROM ${table} WHERE ${typeID} = " . intval($id);
        $result = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data, $row);
        }
        return $data; 
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

    public function getCustome($sqls) {
        $sql = $sqls;
        $result = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data, $row);
        }
        return $data; 
    }

    public function create($table, $data) {
        $escapedData = array_map(function($value) {
            return mysqli_real_escape_string($this->connect, $value); 
        }, $data);
    
        $columns = implode(", ", array_keys($escapedData));
        $values = implode("', '", array_values($escapedData));
        $sql = "INSERT INTO ${table} (${columns}) VALUES ('${values}')";
        
        return $this->connect->query($sql) > 0 ? 1 : 0; 
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

    public function deleteTowID($table, $one, $two, $idOne, $idTwo) {
        $sql = "DELETE FROM ${table} WHERE ${one} = ${idOne} AND ${two} = ${idTwo} LIMIT 1";
        $_SESSION['message'] = "Đăng nhập thành công!";
        return $this->_query($sql) > 0 ? 1 : 0; 
    }
}
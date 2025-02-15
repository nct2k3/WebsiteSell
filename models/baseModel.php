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
            $data[] = $row;
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
    public function getListBystring($table, $name, $typeID) {
        $sql = "SELECT * FROM {$table} WHERE {$typeID} ='$name'";
        $result = $this->_query($sql);
        $data = [];
        
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        
        return $data; 
    }

    public function getListByTowstring($table, $name, $typeID,$nameTow,$typeIDTow) {
        $sql = "SELECT * FROM {$table} WHERE {$typeID} ='$name' and {$typeIDTow}='$nameTow' ";
        $result = $this->_query($sql);
        $data = [];
        
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data; 
    }
    public function getListByThreeString($table, $name, $typeID,$nameTow,$typeIDTow,$nameThree,$typeIDThree) {
        $sql = "SELECT * FROM {$table} WHERE {$typeID} ='$name' and {$typeIDTow}='$nameTow' and {$typeIDThree}='$nameThree' ";
        $result = $this->_query($sql);
        $data = [];
        
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
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

    //creat

    public function create($table, $data) {
        $escapedData = array_map(function($value) {
            return mysqli_real_escape_string($this->connect, $value); 
        }, $data);
    
        $columns = implode(", ", array_keys($escapedData));
        $values = implode("', '", array_values($escapedData));
        $sql = "INSERT INTO ${table} (${columns}) VALUES ('${values}')";
        return $this->connect->query($sql) > 0 ? 1 : 0; 
    }
    public function createReturnID($table, $data) {
        $escapedData = array_map(function($value) {
            return mysqli_real_escape_string($this->connect, $value); 
        }, $data);
        
        $columns = implode(", ", array_keys($escapedData));
        $values = implode("', '", array_values($escapedData));
        $sql = "INSERT INTO ${table} (${columns}) VALUES ('${values}')";
        
        if ($this->connect->query($sql) === TRUE) {
            return $this->connect->insert_id; 
        } else {
            return 0;
        }
    }


    //delete
    
    public function delete($table, $id) {
        $sql = "DELETE FROM ${table} WHERE id = " . intval($id);
        return $this->_query($sql);
    }
    public function deleteID($table, $id,$typeid) {
        $sql = "DELETE FROM ${table} WHERE ${typeid} = " . intval($id);
        return $this->_query($sql);
    }

    public function deleteTowID($table, $one, $two, $idOne, $idTwo) {
        $sql = "DELETE FROM ${table} WHERE ${one} = ${idOne} AND ${two} = ${idTwo} LIMIT 1";
        return $this->_query($sql) > 0 ? 1 : 0; 
    }

    //update

    public function updateTowId($table, $IdOne, $IdTwo, $TypeOne, $TypeTwo, $TypeData, $data) {
        
        $sql = "UPDATE ${table} SET ${TypeData} = '${data}' WHERE ${TypeOne} = ${IdOne} AND ${TypeTwo} = ${IdTwo}";
        return $this->_query($sql)> 0 ? 1 : 0; 
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
    public function updateString($table, $data,$dataUpdate, $id,$where) {
        $sql = "UPDATE ${table} SET $data='$dataUpdate' WHERE $where = $id ";
        return $this->_query($sql);
    }
 
    public function UpdateCustome($sql) {

        $result = $this->_query($sql);
        if (!$result) {
            die("Query failed: ");
        }
        return $result; 
    }
    

}
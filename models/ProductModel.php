<?php
require_once __DIR__ . '/../entities/Product.php';
require_once __DIR__ . '/../core/database.php';

class ProductModel extends BaseModel
{
    public function __construct() {
        $this->connect = $this->connect(); 
    }

    private function _query($sql) {
        return mysqli_query($this->connect, $sql);
    }

    public function getByProductLineID($table, $ProductLineID) {
        $sql = "SELECT * FROM ${table} WHERE ProductLineID = " . intval($ProductLineID) . " GROUP BY ProductType";
        $result = $this->_query($sql);
    
        if ($result === false) {
            die("SQL Error: " . mysqli_error($this->connect)); // Hiển thị lỗi SQL nếu có
        }
    
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row; 
        }
        return $data; 
    }

    public function getCapacity($Producttype) {
        $sql = "SELECT DISTINCT Capacity FROM products WHERE ProductType = '" . mysqli_real_escape_string($this->connect, $Producttype)."'";
        $result = $this->_query($sql);
    
        if ($result === false) {
            die("SQL Error: " . mysqli_error($this->connect)); // Hiển thị lỗi SQL nếu có
        }
    
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row; 
        }
        return $data; 
    }
    
    public function getColor($Producttype) {
        $sql = "SELECT DISTINCT Color FROM products WHERE ProductType = '" . mysqli_real_escape_string($this->connect, $Producttype)."'";
        $result = $this->_query($sql);
    
        if ($result === false) {
            die("SQL Error: " . mysqli_error($this->connect)); // Hiển thị lỗi SQL nếu có
        }
    
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row; 
        }
        return $data; 
    }
    
    
    public function getProduct($ProductLineID)
    {
        // Lấy dữ liệu từ bảng Product
        $data = $this->getByProductLineID('Products',$ProductLineID); 
        $Product = [];

        foreach ($data as $row) {
            // Tạo đối tượng Account từ dữ liệu
            $Product[] = new Product(
                $row['ProductID'], // Cột AccountID
                $row['ProductLineID'],     // Cột Email
                $row['ProductType'],
                $row['ProductModel'],  // Cột Password
                $row['ProductName'],      // Cột Role
                $row['Price']  ,
                $row['OriginalPrice'],
                $row['Stock'],
                $row['Img'],
                $row['Capacity'],
                $row['Color']   // Cột UserID
            );
        }

        return $Product; // Trả về mảng các đối tượng Account
    }

    public function getProductByID($ProductID)
{
    // Lấy dữ liệu từ bảng Products
    $data = $this->getById('Products', $ProductID, 'ProductID');
    if (empty($data)) {
        return null; 
    }
    $Product = new Product(
        $data['ProductID'],
        $data['ProductLineID'],
        $data['ProductType'],
        $data['ProductModel'],
        $data['ProductName'],
        $data['Price'],
        $data['OriginalPrice'],
        $data['Stock'],
        $data['Img'],
        $data['Capacity'],
        $data['Color']
    );

    return $Product; // Trả về đối tượng Product
}

public function getByIdGroup($ProductID)
{
    // Lấy dữ liệu từ bảng Products
    $data = $this->getByIdGroupByGroupBy('Products', $ProductID, 'ProductLineID',"	ProductType",3);
        $Product = [];

        foreach ($data as $row) {
            // Tạo đối tượng Account từ dữ liệu
            $Product[] = new Product(
                $row['ProductID'], // Cột AccountID
                $row['ProductLineID'],     // Cột Email
                $row['ProductType'], 
                $row['ProductModel'], // Cột Password
                $row['ProductName'],      // Cột Role
                $row['Price']  ,
                $row['OriginalPrice'],
                $row['Stock'],
                $row['Img'],
                $row['Capacity'],
                $row['Color']   // Cột UserID
            );
        }

        return $Product; 
}

public function getModel($ProductID)
{
    // Lấy dữ liệu từ bảng Products
    $data = $this->getByIdGroupByGroupBy('Products', $ProductID, 'ProductLineID',"	ProductModel",20);
        $Product = [];

        foreach ($data as $row) {
            // Tạo đối tượng Account từ dữ liệu
            $Product[] = new Product(
                $row['ProductID'], // Cột AccountID
                $row['ProductLineID'],     // Cột Email
                $row['ProductType'], 
                $row['ProductModel'], // Cột Password
                $row['ProductName'],      // Cột Role
                $row['Price']  ,
                $row['OriginalPrice'],
                $row['Stock'],
                $row['Img'],
                $row['Capacity'],
                $row['Color']   // Cột UserID
            );
        }

        return $Product; 
}
}
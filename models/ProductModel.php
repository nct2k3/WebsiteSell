<?php
require_once __DIR__ . '/../entities/Product.php';
require_once __DIR__ .'/../entities/DetailProduct.php';
require_once __DIR__ . '/../core/database.php';
require_once __DIR__ .'/../entities/ProductLine.php';
require_once __DIR__ .'/../entities/ProductModels.php';
require_once __DIR__ .'/../entities/ProductType.php';


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
            die("SQL Error: " . mysqli_error($this->connect)); 
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
            die("SQL Error: " . mysqli_error($this->connect)); 
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
            die("SQL Error: " . mysqli_error($this->connect)); 
        }
    
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row; 
        }
        return $data; 
    }
    
    public function getAllProduct()
    {
        $data = $this->getAll('Products'); 
        $Product = [];

        foreach ($data as $row) {
           
            $Product[] = new Product(
                $row['ProductID'], 
                $row['ProductLineID'],     
                $row['ProductType'],
                $row['ProductModel'],  
                $row['ProductName'],      
                $row['Price']  ,
                $row['OriginalPrice'],
                $row['Stock'],
                $row['Img'],
                $row['Capacity'],
                $row['Color']   
            );
        }

        return $Product; 
    }
    
    public function getProduct($ProductLineID)
    {
        $data = $this->getByProductLineID('Products',$ProductLineID); 
        $Product = [];

        foreach ($data as $row) {
           
            $Product[] = new Product(
                $row['ProductID'], 
                $row['ProductLineID'],     
                $row['ProductType'],
                $row['ProductModel'],  
                $row['ProductName'],      
                $row['Price']  ,
                $row['OriginalPrice'],
                $row['Stock'],
                $row['Img'],
                $row['Capacity'],
                $row['Color']   
            );
        }

        return $Product; 
    }

    public function getProductByID($ProductID)
{
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

    return $Product; 
}

public function getByIdGroup($ProductID)
{
   
    $data = $this->getByIdGroupByGroupBy('Products', $ProductID, 'ProductLineID',"	ProductType",6);
        $Product = [];

        foreach ($data as $row) {
            $Product[] = new Product(
                $row['ProductID'], 
                $row['ProductLineID'],    
                $row['ProductType'], 
                $row['ProductModel'],
                $row['ProductName'],     
                $row['Price']  ,
                $row['OriginalPrice'],
                $row['Stock'],
                $row['Img'],
                $row['Capacity'],
                $row['Color']  
            );
        }

        return $Product; 
}

public function getProductModel($ID)
{
   
    $data = $this->getListBystring('Products', $ID, 'ProductModel');
        $Product = [];

        foreach ($data as $row) {
            $Product[] = new Product(
                $row['ProductID'], 
                $row['ProductLineID'],   
                $row['ProductType'], 
                $row['ProductModel'],
                $row['ProductName'],    
                $row['Price']  ,
                $row['OriginalPrice'],
                $row['Stock'],
                $row['Img'],
                $row['Capacity'],
                $row['Color']   
            );
        }

        return $Product; 
}

public function getModel($ProductID)
{
    
    $data = $this->getByIdGroupByGroupBy('Products', $ProductID, 'ProductLineID',"	ProductModel",20);
        $Product = [];

        foreach ($data as $row) {
           
            $Product[] = new Product(
                $row['ProductID'], 
                $row['ProductLineID'],     
                $row['ProductType'], 
                $row['ProductModel'], 
                $row['ProductName'],      
                $row['Price']  ,
                $row['OriginalPrice'],
                $row['Stock'],
                $row['Img'],
                $row['Capacity'],
                $row['Color']   
            );
        }

        return $Product; 
}
public function getproductColor($Color, $ProductType) {

    $data = $this->getListByTowstring('Products', $Color, 'Color', $ProductType, 'ProductType');

    if ($data && is_array($data)) {
        
        $productData = $data[0]; 
        $Product = new Product(
            $productData['ProductID'], 
            $productData['ProductLineID'],     
            $productData['ProductType'], 
            $productData['ProductModel'], 
            $productData['ProductName'],      
            $productData['Price'],
            $productData['OriginalPrice'],
            $productData['Stock'],
            $productData['Img'],
            $productData['Capacity'],
            $productData['Color']
        );

        return $Product; 
    } else {
        
        return null; 
    }
}
public function getproductCapacity($Capacity, $ProductType) {

    $data = $this->getListByTowstring('Products', $Capacity, 'Capacity', $ProductType, 'ProductType');

    if ($data && is_array($data)) {
        
        $productData = $data[0]; 
        $Product = new Product(
            $productData['ProductID'], 
            $productData['ProductLineID'],     
            $productData['ProductType'], 
            $productData['ProductModel'], 
            $productData['ProductName'],      
            $productData['Price'],
            $productData['OriginalPrice'],
            $productData['Stock'],
            $productData['Img'],
            $productData['Capacity'],
            $productData['Color']
        );

        return $Product; 
    } else {
        
        return null; 
    }
}

public function getproductCapacityAndColor($Color,$Capacity, $ProductType) {

    $data = $this->getListByThreeString('Products', $Capacity, 'Capacity', $ProductType, 'ProductType',$Color,'Color');

    if ($data && is_array($data)) {
        
        $productData = $data[0]; 
        $Product = new Product(
            $productData['ProductID'], 
            $productData['ProductLineID'],     
            $productData['ProductType'], 
            $productData['ProductModel'], 
            $productData['ProductName'],      
            $productData['Price'],
            $productData['OriginalPrice'],
            $productData['Stock'],
            $productData['Img'],
            $productData['Capacity'],
            $productData['Color']
        );

        return $Product; 
    } else {
        
        return null; 
    }
}

public function getCapacityByTow($Producttype,$Color) {
    $sql = "SELECT DISTINCT Capacity FROM products WHERE Color='$Color' and ProductType = '" . mysqli_real_escape_string($this->connect, $Producttype)."'";
    $result = $this->_query($sql);

    if ($result === false) {
        die("SQL Error: " . mysqli_error($this->connect)); 
    }

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row; 
    }
    return $data; 
}

public function getColorByTow($Producttype,$Capacity) {

    $sql = "SELECT DISTINCT Color FROM products WHERE Capacity='$Capacity' and ProductType = '" . mysqli_real_escape_string($this->connect, $Producttype)."'";
    $result = $this->_query($sql);

    if ($result === false) {
        die("SQL Error: " . mysqli_error($this->connect)); 
    }

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row; 
    }
    return $data; 
}

public function getDeatilProduct($ID)
{
   
    $data = $this->getListBystring('productdetails', $ID, 'ProductType');
        $Product = [];

        foreach ($data as $row) {
            $Product[] = new DetailProduct(
                $row['ProductDetaiID'], 
                $row['ProductType'], 
                $row['Img'], 
                
            );
        }

        return $Product; 
}

public function getLineProduct()
{
   
    $data = $this->getAll('productlines');
        $Product = [];

        foreach ($data as $row) {
            $Product[] = new ProductLine(
                $row['ProductLineID'], 
                $row['ProductLineName'], 
            );
        }

        return $Product; 
}

public function getModelProduct($ID)
{
   
    $data = $this->getListById('productmodel', $ID, 'ProductLine');
        $Product = [];

        foreach ($data as $row) {
            $Product[] = new ProductModels(
                $row['ProductModelID'], 
                $row['ProductModelName'],   
                $row['ProductLine'],
            );
        }

        return $Product; 
}

public function getTypeProduct($ID)
{
   
    $data = $this->getListById('producttype', $ID, 'ProductModelID');
        $Product = [];

        foreach ($data as $row) {
            $Product[] = new ProductType(
                $row['ProductTypeID'], 
                $row['ProductTypeName'],
                $row['ProductModelID'],   
                
            );
        }

        return $Product; 
}
public function getnameLine($id){

    $sql="SELECT  ProductLineName FROM productlines WHERE ProductLineID=$id";
    $data=$this->getOneCustome($sql);
    return $data;

}
public function getnameModel($id){

    $sql="SELECT  ProductModelName FROM productmodel WHERE ProductModelID=$id";
    $data=$this->getOneCustome($sql);
    return $data;

}


}
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
    // create
    public function createProduct($productsData)
{
    $product = [
        'Img' => $productsData->img,
        'ProductLineID' => $productsData->productLineID,
        'ProductName' => $productsData->productName,
        'Status'=>$productsData->status,
        'OriginalPrice' => $productsData->originalPrice,
        'Price' => $productsData->price,
        'Stock' => $productsData->stock,
        'Capacity' => $productsData->capacity,
        'Color' => $productsData->color,
    ];

    $sql = "SELECT * FROM products 
            WHERE ProductLineID = '{$productsData->productLineID}' 
              AND ProductName = '{$productsData->productName}' 
              AND Capacity = '{$productsData->capacity}' 
              AND Color = '{$productsData->color}'";
    $data = $this->getCustome($sql);

    if ($data != null) {
        return false;
    }

    $this->createReturnID('products', $product);
    return true;
}

    private function _query($sql) {
        return mysqli_query($this->connect, $sql);
    }
    public function addProductModels($productModelName,$productLineID){

        $sql ="SELECT * FROM `productmodel` WHERE ProductModelName = '$productModelName' and ProductLine = $productLineID ";
        $checkData= $this->getCustome($sql);
        if($checkData!=null){
           return 1;
        }
        $Data = [
            'ProductModelID'=>'',
            'ProductModelName' =>  $productModelName,
            'ProductLine' => $productLineID, 
        ];
        return $this->createReturnID('productmodel', $Data);
    }
    public function addProductTypes($productTypeName,$productModel){
        $sql ="SELECT * FROM `producttype` WHERE ProductTypeName = '$productModel' and ProductModelID = $productTypeName ";
        $checkData= $this->getCustome($sql);
        if($checkData!=null){
           return 1;
        }
        $Data = [
            'ProductTypeName' => $productModel,
            'ProductModelID' => $productTypeName, 
        ];
        return $this->createReturnID('producttype', $Data);
    }
    public function addProductDetails($Url,$ProductType){
        $Data = [
            'ProductDetaiID'=>'',
            'ProductType' => $ProductType,
            'Img' => $Url, 
        ];
        return $this->createReturnID('productdetails', $Data);
    }
    public function addBanner($Url,$ProductLineID){
        $Data = [
            'BannerID'=>'',
            'Img' => $Url,
            'ProductLineID' => $ProductLineID, 
        ];
        return $this->createReturnID('productdetails', $Data);
    }


    // get
    public function getByProductLineID($table, $ProductLineID) {
        $sql = "SELECT * FROM ${table} WHERE ProductLineID = " . intval($ProductLineID). " AND Status = 0";
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

    public function getProductManager($ProductLineID)
    {
        $data = $this->getListById('Products',$ProductLineID,'ProductLineID'); 
        $Product = [];
        foreach ($data as $row) {
            $Product[] = new Product(
                $row['ProductID'], 
                $row['ProductLineID'],     
                $row['ProductName']
                ,$row['Status'],      
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

  

    
    public function getAllProduct()
    {
        $data = $this->getAll('Products'); 
        $Product = [];
        foreach ($data as $row) {
            $Product[] = new Product(
                $row['ProductID'], 
                $row['ProductLineID'],     
                $row['ProductName'] 
                ,$row['Status'],     
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
        $data = $this->getByProductLineID('Products', $ProductLineID); 
        $Product = [];

        foreach ($data as $row) {
            if ($row['Status'] == 0) { 
                $Product[] = new Product(
                    $row['ProductID'], 
                    $row['ProductLineID'], 
                    $row['ProductName'],
                    $row['Status'],          
                    $row['Price'],
                    $row['OriginalPrice'],
                    $row['Stock'],
                    $row['Img'],
                    $row['Capacity'],
                    $row['Color']
                );
            }
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
            $data['ProductName'],
            $data['Status'],
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
        $data = $this->getByIdGroupByGroupBy('Products', $ProductID, 'ProductLineID',"	ProductName",6);
            $Product = [];
            foreach ($data as $row) { 
                $Product[] = new Product(
                    $row['ProductID'], 
                    $row['ProductLineID'],    
                    $row['ProductName'],  
                    $row['Status'],   
                    $row['Price'],
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
                    $row['ProductName'],  
                    $row['Status'],  
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
                    $row['ProductName'],
                    $row['Status'],    
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
                $productData['ProductName'], 
                $productData['Status'],  
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
                $productData['ProductName'],$productData['Status'],      
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
                $productData['ProductName'],$productData['Status'],      
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

    public function getProductDelete()
    {
        $sql = "SELECT p.*
                FROM products p
                LEFT JOIN invoicedetails id ON p.ProductID = id.ProductID
                WHERE id.ProductID IS NULL ";
        $result = $this->_query($sql);
        if ($result === false) {
            die("SQL Error: " . mysqli_error($this->connect)); 
        }
        $Product = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $Product[] = new Product(
                $row['ProductID'], 
                $row['ProductLineID'],   
                $row['ProductName'],  
                $row['Status'],      
                $row['Price'],
                $row['OriginalPrice'],
                $row['Stock'],
                $row['Img'],
                $row['Capacity'],
                $row['Color']
            );
        }

        return $Product; 
    }
    public function getProductDeleteWithLine($id)
    {
        $sql = "SELECT p.*
                FROM products p
                LEFT JOIN invoicedetails id ON p.ProductID = id.ProductID
                WHERE id.ProductID IS NULL and ProductLineID=$id";
        $result = $this->_query($sql);
        if ($result === false) {
            die("SQL Error: " . mysqli_error($this->connect)); 
        }
        $Product = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $Product[] = new Product(
                $row['ProductID'], 
                $row['ProductLineID'],    
                $row['ProductName'],  
                $row['Status'],     
                $row['Price'],
                $row['OriginalPrice'],
                $row['Stock'],
                $row['Img'],
                $row['Capacity'],
                $row['Color']
            );
        }
        return $Product; 
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
    public function getAllModel()
    {
        $data = $this->getAll('productmodel');
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
    // update
    public function updateProduct(Product $product)
    {
        $fields = [];
        if (!empty($product->productLineID)) $fields[] = "ProductLineID = " . intval($product->productLineID);
        if (!empty($product->productName)) $fields[] = "ProductName = '" . mysqli_real_escape_string($this->connect, $product->productName) . "'";
        if (!empty($product->price)) $fields[] = "Price = " . floatval($product->price);
        if (!empty($product->originalPrice)) $fields[] = "OriginalPrice = " . floatval($product->originalPrice);
        if (!empty($product->capacity)) $fields[] = "Capacity = '" . mysqli_real_escape_string($this->connect, $product->capacity) . "'";
        if (!empty($product->color)) $fields[] = "Color = '" . mysqli_real_escape_string($this->connect, $product->color) . "'";
        if (!empty($product->img)) $fields[] = "Img = '" . mysqli_real_escape_string($this->connect, $product->img) . "'";
        if (!is_null($product->Status)) $fields[] = "Status = " . intval($product->Status);
    
        if (empty($fields)) {
            throw new Exception("No fields to update.");
        }
    
        $fieldsString = implode(", ", $fields);
    
        $sql = "UPDATE products SET {$fieldsString} WHERE ProductID = " . intval($product->productID);

        return $this->UpdateCustome($sql);
    }
    
    

public function updateProductss(Product $product)
{
    $sql = "UPDATE products 
            SET ProductLineID = '{$product->productLineID}',
                ProductName = '{$product->productName}', 
                Price = {$product->price},
                OriginalPrice = {$product->originalPrice},
                Stock = {$product->stock},
                Img = '{$product->img}',
                Capacity = '{$product->capacity}',
                Color = '{$product->color}',
                Status = {$product->Status}
            WHERE ProductID = {$product->productID}";
    
    return $this->UpdateCustome($sql);
}

    public function UpdateQuantity($productData){

        $sql="UPDATE products 
        SET Stock='$productData->stock'
        WHERE ProductID=$productData->productID";
        $this->UpdateCustome($sql);
        
    }


    // delete

public function deleteProduct($id) {
    $sql = "SELECT ProductID FROM invoicedetails WHERE ProductID = " . intval($id);
    $result = $this->getCustome($sql);
    
    if ($result == null) {
        $this->deleteID('products', $id, 'ProductID');
        return true;
    } else {
        $updateSql = "UPDATE products SET Status = 1 WHERE ProductID = " . intval($id);
        $this->UpdateCustome($updateSql);
        return true;
    }
}
    //check
    public function CheclIsEmpty($product){
        $sql="SELECT ProductID FROM products WHERE ProductName='$product->productName' and Color='$product->color' and Img='$product->img' and Capacity='$product->capacity' ";
        $data=$this->getOneCustome($sql);
        return $data;

    }


}
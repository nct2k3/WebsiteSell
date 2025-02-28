<?php
require_once __DIR__ ."/../entities/Product.php";

class AddProductController extends BaseController
{
    private $ProductModel;
    public function __construct()
    {
        $this->ProductModel = $this->loadModel("ProductModel");
    }
    public function index()
    {
        $Url='';
        if (isset($_SESSION['UrlProduct'])) {
            $Url = $_SESSION['UrlProduct'];
        }
        $dataLineProduct=$this->ProductModel->getLineProduct();
        $this->view('manager.AddProduct.index',['Url'=>$Url,'dataLineProduct'=>$dataLineProduct]);
    }
    // lẤy model tu dtb 
    public function productModel($id){
        $Url='';
        if (isset($_SESSION['UrlProduct'])) {
            $Url = $_SESSION['UrlProduct'];
        }
        $dataModelProduct=$this->ProductModel->getModelProduct($id);
        $dataLineProduct=$this->ProductModel->getLineProduct();
        $_SESSION['LineId'] = $id;
        $NameLine=$this->ProductModel-> getnameLine($id);
        $this->view('manager.AddProduct.index',['Url'=>$Url,'NameLine'=>$NameLine,'dataModelProduct'=>$dataModelProduct,'dataLineProduct'=>$dataLineProduct]);
    }
    // lẤy type tu dtb
    public function productType($id){
        $Url='';
        if (isset($_SESSION['UrlProduct'])) {
            $Url = $_SESSION['UrlProduct'];
        }
        $Idline = $_SESSION['LineId'];
        $dataModelProduct=$this->ProductModel->getModelProduct($Idline);
        $dataLineProduct=$this->ProductModel->getLineProduct();
        $dataTypeProduct=$this->ProductModel->getTypeProduct($id);
        $NameLine=$this->ProductModel-> getnameLine($Idline);
        $NameModel=$this->ProductModel->getnameModel($id);
        $_SESSION['TypeId'] = $id;
        $this->view('manager.AddProduct.index',['Url'=>$Url,'NameModel'=>$NameModel,'NameLine'=>$NameLine,'dataTypeProduct'=>$dataTypeProduct,'dataModelProduct'=>$dataModelProduct,'dataModelProduct'=>$dataModelProduct,'dataLineProduct'=>$dataLineProduct]);
    }
    // thêm sản phẩm
    public function AddProduct($productType,$productName,$originalPrice,$price,$stock,$capacity,$color){
        $Url = '';
        $Idline = '';
        $IdType = '';
        if (isset($_SESSION['UrlProduct']) && !empty($_SESSION['UrlProduct'])) {
            $Url = $_SESSION['UrlProduct'];
        }
        if (isset($_SESSION['LineId']) && !empty($_SESSION['LineId'])) {
            $Idline = $_SESSION['LineId'];
        }
        if (isset($_SESSION['TypeId']) && !empty($_SESSION['TypeId'])) {
            $IdType = $_SESSION['TypeId'];
        }
        if($Url==''||$Idline==''||$IdType==''||$productName==''||$capacity==''){
            $_SESSION['error'] = "Missing data!";
            $this->index();
            exit();
        }
        $modelData = $this->ProductModel->getnameModel($IdType);
        $NameModel = isset($modelData['ProductModelName']) ? $modelData['ProductModelName'] : '';
        $productData= new product(
            '',
            $Idline,
            $productType,
            $NameModel,
            $productName,
            $price,
            $originalPrice,
            $stock,
            $Url,
            $capacity,
            $color
        );
        $data=$this->ProductModel->createProduct($productData);
        $_SESSION['message'] = "Add successfully!";
        header("Location: /?controller=homeManager");
        exit();
        
    }
    
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;

    switch ($action) {
        case 'chosenLine':
            $productLine = $_POST['productLine'];
            $AddProductController= new AddProductController();
            $AddProductController->productModel($productLine);
            exit();
        case 'chosenModel':
                $productType = $_POST['productModel'];
                $AddProductController= new AddProductController();
                $AddProductController->productType($productType);
                exit();
        case 'add':
            $productType= $_POST['productType'];
            $productName = $_POST['productName'];
            $originalPrice = $_POST['originalPrice'];
            $Price = $_POST['Price'];
            $stock = $_POST['stock'];
            $capacity = $_POST['capacity'];
            $color = $_POST['color'];
            $AddProductController= new AddProductController();
            $AddProductController->AddProduct($productType, $productName,$originalPrice,$Price,$stock,$capacity,$color);
            exit();

        case 'upload':
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['file'];
                $fileName = time() . '_' . basename($file['name']);
                $filePath = 'public/img/' . $fileName;
                if (move_uploaded_file($file['tmp_name'], $filePath)) {
                    $fullPath = $filePath; 
                    $_SESSION['UrlProduct'] = $fullPath;
                    $AddProductController= new AddProductController();
                    $AddProductController->index();
                    } else {
                            echo "Lỗi khi tải tệp lên.";
                    }
                    } else {
                        echo "Không có tệp nào được tải lên hoặc có lỗi xảy ra.";
                    }
                    exit();
            
            default:
            echo "Hành động không hợp lệ!";
            break;
    }
}
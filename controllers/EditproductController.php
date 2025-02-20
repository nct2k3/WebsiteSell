<?php
require_once __DIR__ ."/../entities/Product.php";

class EditProductController extends BaseController
{
    private $ProductModel;
    public function __construct()
    {
        $this->ProductModel = $this->loadModel("ProductModel");
    }
    public function index()
    {
        $Url='';
        if (isset($_SESSION['UrlProductEdit'])) {
            $Url = $_SESSION['UrlProductEdit'];
        }
        $id=$_GET['id'];
        $ProductEdit = $this->ProductModel->getProductByID($id);
        $dataLineProduct=$this->ProductModel->getLineProduct();
        $this->view('manager.EditProduct.index',['ProductEdit'=>$ProductEdit,'Url'=>$Url,'dataLineProduct'=>$dataLineProduct]);
    }
    // hiên thi nhung voi dk idid
    public function indexHaveId($id)
    {
        $Url='';
        if (isset($_SESSION['UrlProductEdit'])) {
            $Url = $_SESSION['UrlProductEdit'];
        }
        $ProductEdit = $this->ProductModel->getProductByID($id);
        $dataLineProduct=$this->ProductModel->getLineProduct();
        $this->view('manager.EditProduct.index',['ProductEdit'=>$ProductEdit,'Url'=>$Url,'dataLineProduct'=>$dataLineProduct]);
    }
   // sửa sản phẩmphẩm
    public function EditProduct($id,$productName, $originalPrice, $price, $stock, $capacity, $color) {
        $ProductEdit = $this->ProductModel->getProductByID($id);
        
        if ($ProductEdit === null) {
            die("Error: Product not found.");
        }
        $Url = isset($_SESSION['UrlProductEdit']) && !empty($_SESSION['UrlProductEdit']) ? $_SESSION['UrlProductEdit'] : $ProductEdit->img;
    
        $productNameNew = !empty($productName) ? $productName : $ProductEdit->productName;
        $originalPriceNew = !empty($originalPrice) ? $originalPrice : $ProductEdit->originalPrice;
        $priceNew = !empty($price) ? $price : $ProductEdit->price;
        $stockNew = !empty($stock) ? $stock : $ProductEdit->stock;
        $capacityNew = !empty($capacity) ? $capacity : $ProductEdit->capacity;
        $colorNew = !empty($color) ? $color : $ProductEdit->color;
        $productData = new Product(
            $id,
            '',
            '',
            '',
            $productNameNew,
            $priceNew,
            $originalPriceNew,
            $stockNew,
            $Url,
            $capacityNew,
            $colorNew
        );
        $data=$this->ProductModel->CheclIsEmpty($productData);
       if ($data != null) {
        $_SESSION['error'] = "Duplicate data!";
        $this->indexHaveId($id);
        exit();
       }
       else{
        $data = $this->ProductModel->UpdateProduct($productData);
         $_SESSION['message'] = "Update successfully!";
         $_SESSION['UrlProductEdit'] ='';
         header("Location: /?controller=homeManager");
         exit();
       }
    }
    
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;
    switch ($action) {
        case 'add':
            $id=$_POST['IdProduct'];
            $productName = $_POST['productName'];
            $originalPrice = $_POST['originalPrice'];
            $Price = $_POST['Price'];
            $stock = $_POST['stock'];
            $capacity = $_POST['capacity'];
            $color ='';
            if( isset($_POST['color']) &&$_POST['color']!=''){
                $color =$_POST['color'];
            }
            $EditProductController= new EditProductController();
            $EditProductController->EditProduct($id, $productName,$originalPrice,$Price,$stock,$capacity,$color);
            exit();
        case 'uploadEdit':
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['file'];
                $fileName = time() . '_' . basename($file['name']);
                $filePath = 'public/img/' . $fileName;
                 if (move_uploaded_file($file['tmp_name'], $filePath)) {
                        $fullPath = $filePath; 
                        $_SESSION['UrlProductEdit'] = $fullPath;
                        $EditProductController= new EditProductController();
                        $EditProductController->index();
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
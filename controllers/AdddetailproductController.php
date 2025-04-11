<?php
require_once __DIR__ ."/../entities/Product.php";

class AdddetailproductController extends BaseController
{
    private $ProductModel;
    public function __construct()
    {
        $this->ProductModel = $this->loadModel("ProductModel");
    }
    public function index()
    {
        $dataLineProduct=$this->ProductModel->getLineProduct();
        $dataModelProduct=$this->ProductModel->getAllModel();
        $this->view('manager.AddDetailProduct.index',['dataModelProduct'=>$dataModelProduct, 'dataLineProduct'=>$dataLineProduct]);
    }
    function AddProductModel($productModel,$productName){ 
        $CheckData=  $this->ProductModel->addProductModels($productName,$productModel);
        if ($CheckData==1) {
            $_SESSION['error'] = "Thêm thất bại !";
            $this->index();
        }
        else{
        $_SESSION['message'] = "Thêm thành công!";
        $this->index();
        }
    }
    function addType($IdModel,$Name,$List ){
         $CheckData=  $this->ProductModel->addProductTypes($IdModel,$Name);
      if($CheckData==1){
        $_SESSION['error'] = "Thêm thất bại!";
        $this->index();
        exit();
        
      }
      
    if($CheckData!=1){

        foreach ($List as $item) {
            if($item){
                if (is_array($item)) {
                    $item = implode('_', $item);
                }
                $Urlend = '/public/ImgType/' . $item;
             $this->ProductModel->addProductDetails($Urlend, $Name);
                }
        }
        $_SESSION['message'] = "Thêm thành công!";
        $this->index();
        exit();
        
    }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;
    switch ($action) {
        case 'addModel':
            $productModel= $_POST['productModel'];
            $productName = $_POST['productNameModel'];
            $AdddetailproductController= new AdddetailproductController();
            $AdddetailproductController->AddProductModel($productModel,$productName);
            exit();
        case'uploadType':
                $NameType=$_POST['productName'];
                $productType = $_POST['productType'];
                if($_FILES['file']==null){
                $AdddetailproductController= new AdddetailproductController();
                $_SESSION['error'] = "No file!";
                $AdddetailproductController->index();
                exit();
                }
                $lisFile[]=[];
                $uploadDir = 'public/ImgType/';
                if (isset($_FILES['file'])) {
                    $fileCount = count($_FILES['file']['name']); 
                    for ($i = 0; $i < $fileCount; $i++) {
                        $fileTmpPath = $_FILES['file']['tmp_name'][$i]; 
                        $fileName = $_FILES['file']['name'][$i];        
                        $uniqueFileName = uniqid() . '_' . $fileName;   
                        $filePath = $uploadDir . $uniqueFileName;
                        if (move_uploaded_file($fileTmpPath, $filePath)) {
                            if (!isset($_SESSION['uploaded_files'])) {
                                $lisFile[] = [];
                            }
                            $lisFile[] = $uniqueFileName;
                        }
                    }
                }
                $AdddetailproductController= new AdddetailproductController();
                $AdddetailproductController->addType($productType,$NameType,$lisFile);
                exit();            
            default:
            echo "Hành động không hợp lệ!";
            break;
    }
}
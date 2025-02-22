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
            $_SESSION['error'] = "Add fail!";
            $this->index();
          
        }
        else{
        $_SESSION['message'] = "Add successfully!";
        $this->index();
        }

    }
    function addType($IdModel,$Name,$List ){

       $CheckData=  $this->ProductModel->addProductTypes($Name,$IdModel);
     
      if($CheckData==1){
        $_SESSION['error'] = "Add fail!";
        $this->index();
      }
      foreach($List as $item){
        $Urlend= 'C:/xampp/htdocs/WebsiteSells/public/ImgType'.$item;
        $this->ProductModel->addProductDetails($Urlend,$Name);
      }
      $_SESSION['message'] = "Add successfully!";
        $this->index();



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

                $Modelid=$_POST['productName'];
                $productType = $_POST['productType'];
                if($_FILES['file']==null){
                $AdddetailproductController= new AdddetailproductController();
                $_SESSION['error'] = "No file!";
                $AdddetailproductController->index();
                exit();
                }
                $lisFile[]=[];
                $uploadDir = 'C:/xampp/htdocs/WebsiteSells/public/ImgType/';
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
                $AdddetailproductController->addType($Modelid,$productType,$lisFile);
               
                exit();
           
            
            default:
            echo "Hành động không hợp lệ!";
            break;
    }
}
<?php
class HomemanagerController extends BaseController
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
        $this->view('manager.HomeManager.index',['Url'=>$Url,'dataLineProduct'=>$dataLineProduct]);
    }
    public function productModel($id){
        $Url='';
        if (isset($_SESSION['UrlProduct'])) {
            $Url = $_SESSION['UrlProduct'];
        }
        $dataModelProduct=$this->ProductModel->getModelProduct($id);
        $dataLineProduct=$this->ProductModel->getLineProduct();
        $_SESSION['LineId'] = $id;
        $NameLine=$this->ProductModel-> getnameLine($id);
       
        $this->view('manager.HomeManager.index',['Url'=>$Url,'NameLine'=>$NameLine,'dataModelProduct'=>$dataModelProduct,'dataLineProduct'=>$dataLineProduct]);
    }
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
        $this->view('manager.HomeManager.index',['Url'=>$Url,'NameModel'=>$NameModel,'NameLine'=>$NameLine,'dataTypeProduct'=>$dataTypeProduct,'dataModelProduct'=>$dataModelProduct,'dataModelProduct'=>$dataModelProduct,'dataLineProduct'=>$dataLineProduct]);
    }
    
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;

    switch ($action) {
        case 'chosenLine':
            $productLine = $_POST['productLine'];
            $homeManagerController= new HomemanagerController();
            $homeManagerController->productModel($productLine);
            exit();
        case 'chosenModel':
                $productType = $_POST['productModel'];
                $homeManagerController= new HomemanagerController();
                $homeManagerController->productType($productType);
                exit();

                case 'upload':
                    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                        $file = $_FILES['file'];
                        $fileName = time() . '_' . basename($file['name']);
                        $filePath = 'public/img/' . $fileName;
                        if (move_uploaded_file($file['tmp_name'], $filePath)) {
                            $fullPath = $filePath; 
                            $_SESSION['UrlProduct'] = $fullPath;
                            $homeManagerController= new HomemanagerController();
                            $homeManagerController->index();
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
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
        $dataLineProduct=$this->ProductModel->getLineProduct();
        $this->view('manager.HomeManager.index',['dataLineProduct'=>$dataLineProduct]);
    }
    public function productModel($id){
        $dataModelProduct=$this->ProductModel->getModelProduct($id);
        $dataLineProduct=$this->ProductModel->getLineProduct();
        $_SESSION['LineId'] = $id;
        $NameLine=$this->ProductModel-> getnameLine($id);
       
        $this->view('manager.HomeManager.index',['NameLine'=>$NameLine,'dataModelProduct'=>$dataModelProduct,'dataLineProduct'=>$dataLineProduct]);
    }
    public function productType($id){
        $Idline = $_SESSION['LineId'];
        $dataModelProduct=$this->ProductModel->getModelProduct($Idline);
        $dataLineProduct=$this->ProductModel->getLineProduct();
        $dataTypeProduct=$this->ProductModel->getTypeProduct($id);
        $NameLine=$this->ProductModel-> getnameLine($Idline);
        $NameModel=$this->ProductModel->getnameModel($id);
        $_SESSION['TypeId'] = $id;
        $this->view('manager.HomeManager.index',['NameModel'=>$NameModel,'NameLine'=>$NameLine,'dataTypeProduct'=>$dataTypeProduct,'dataModelProduct'=>$dataModelProduct,'dataModelProduct'=>$dataModelProduct,'dataLineProduct'=>$dataLineProduct]);
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
        

        default:
            echo "Hành động không hợp lệ!";
            break;
    }
}
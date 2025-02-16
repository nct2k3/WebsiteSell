<?php
class HomemanagerController extends BaseController
{
    private $CartModel;
    private $ProductModel;

    public function __construct()
    {
        $this->CartModel = $this->loadModel("CartModel");
        $this->ProductModel = $this->loadModel("ProductModel");
    }
 
    public function index(){

        $Role=$this->takeRole();
        if($Role==0){
            header("Location: /");
            $_SESSION['error'] = "You do not have a management role";
        }
        $data = $this->ProductModel->getAllProduct();
        $dataLineProduct=$this->ProductModel->getLineProduct();
        $this->view('manager.HomeManager.index',['dataLineProduct'=>$dataLineProduct,'data'=>$data]);
    }
 

    public function FilterProduct($id){
        
        $data = $this->ProductModel->getProductManager($id);
        $dataLineProduct=$this->ProductModel->getLineProduct();
        $this->view('manager.HomeManager.index',['dataLineProduct'=>$dataLineProduct,'data'=>$data]);
    }
    public function searchProduct($string) {
        $data = $this->getAllProduct();
        
        $productDataSearch = [];
        foreach ($data as $items) {
            if (stripos($items->productName, $string) !== false) {
                $productDataSearch[] = $items;
            }
        }
        if (count($productDataSearch) == 0) {
            $_SESSION['error'] = "There are no products found.";
        }
        $dataLineProduct=$this->ProductModel->getLineProduct();
        $this->view('manager.HomeManager.index',['dataLineProduct'=>$dataLineProduct,'data'=>$productDataSearch ]);
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;
    $HomemanagerController= new HomemanagerController();
    switch ($action) {
        case 'chosenLine':
            $productLine = $_POST['productLine'];
           
            $HomemanagerController->FilterProduct($productLine);
            exit();
            case 'search':
               
                $string = $_POST['string'] ?? null;
                if ($string) {
                   
                    $HomemanagerController->searchProduct($string);
                    exit;
                } else {
                    $_SESSION['error'] = "There are no products found.";
                    $HomemanagerController->index();
                    exit;
                }
      
        default:
            echo "Hành động không hợp lệ!";
            break;
    }
}
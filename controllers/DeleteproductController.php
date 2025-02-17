<?php
class DeleteproductController extends BaseController
{
    private $CartModel;
    private $ProductModel;

    public function __construct()
    {
        $this->CartModel = $this->loadModel("CartModel");
        $this->ProductModel = $this->loadModel("ProductModel");
    }
 
    public function index(){

        // $Role=$this->takeRole();
        // if($Role==0){
        //     header("Location: /");
        //     $_SESSION['error'] = "You do not have a management role";
        // }
        $data = $this->ProductModel->getProductDelete();
        $dataLineProduct=$this->ProductModel->getLineProduct();
        $this->view('manager.Deleteproduct.index',['dataLineProduct'=>$dataLineProduct,'data'=>$data]);
    }
 

    public function FilterProduct($id){
        
        $data = $this->ProductModel-> getProductDeleteWithLine($id);
        $dataLineProduct=$this->ProductModel->getLineProduct();
        $this->view('manager.Deleteproduct.index',['dataLineProduct'=>$dataLineProduct,'data'=>$data]);
    }
    public function searchProduct($string) {
        $data = $this->ProductModel->getProductDelete();
        
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
        $this->view('manager.Deleteproduct.index',['dataLineProduct'=>$dataLineProduct,'data'=>$productDataSearch ]);
    }

    public function deleteProduct()
    {
       
        $id = $_POST['id'] ?? ''; 
        if ($id == '') {
            $_SESSION['error'] = "Invalid product.";
            $this->index(); 
            exit;
        } else {
            $this->ProductModel->deleteProduct($id);
            $_SESSION['messages'] = "Delete success!";
            $this->index();
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;
    $DeleteproductController= new DeleteproductController();
    switch ($action) {
        case 'chosenLine':
            $productLine = $_POST['productLine'];
           
            $DeleteproductController->FilterProduct($productLine);
            exit();
            case 'search':
               
                $string = $_POST['string'] ?? null;
                if ($string) {
                   
                    $DeleteproductController->searchProduct($string);
                    exit;
                } else {
                    $_SESSION['error'] = "There are no products found.";
                    $DeleteproductController->index();
                    exit;
                }
                case 'deleteProduct':
                
                    $DeleteproductController->deleteProduct();
                    exit;
      
        default:
           // echo "Hành động không hợp lệ!";
            break;
    }
}
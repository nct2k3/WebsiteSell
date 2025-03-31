<?php
class HomemanagerController extends BaseController
{
    private $ProductModel;
    public function __construct()
    {
        $this->ProductModel = $this->loadModel("ProductModel");
    }
    public function index(){
        $Role=$this->takeRole();
        if($Role==0){
            header("Location: /");
            $_SESSION['error'] = "You do not have a management role";
        }
        $data = $this->ProductModel->getAllProduct();
        
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $numbegin=0;
        $numend=10;
        if($page && $page>1){
            $numbegin= ($page-1)*$numend;
            $numend= $numend*$page;
        }
        $number= count($data);
        $numpage= ceil($number/10);
        $products = array_slice($data,$numbegin,$numend);

        $products = array_slice($data, $numbegin, min(10, count($data) - $numbegin));

        $dataLineProduct=$this->ProductModel->getLineProduct();
        $this->view('manager.HomeManager.index',['dataLineProduct'=>$dataLineProduct,'data'=>$products,'numpage'=>$numpage]);
    }
    //  lọc sản phâm
    public function FilterProduct($id){
        $data = $this->ProductModel->getProductManager($id);
        $dataLineProduct=$this->ProductModel->getLineProduct();
        $this->view('manager.HomeManager.index',['dataLineProduct'=>$dataLineProduct,'data'=>$data]);
    }
    // tìm kiếm sản phẩm
    public function searchProduct($string) {
        $data = $this->ProductModel->getAllProduct();
        
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
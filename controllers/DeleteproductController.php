<?php
class DeleteproductController extends BaseController
{
    private $ProductModel;
    private $LoginManagerModel;
    public function __construct()
    {
        $this->ProductModel = $this->loadModel("ProductModel");
        $this->LoginManagerModel = $this->loadModel("LoginManagerModels");
    }
    public function index(){
        $Role=$this->takeRole();
        if($Role==0){
            header("Location: /");
            $_SESSION['error'] = "You do not have a management role";
        }
        $data = $this->ProductModel->getProductDelete();
        $dataLineProduct=$this->ProductModel->getLineProduct();
        $this->view('manager.Deleteproduct.index',['dataLineProduct'=>$dataLineProduct,'data'=>$data]);
    }
    //lọc sản phẩm theo dòng
    public function FilterProduct($id){
        $data = $this->ProductModel-> getProductDeleteWithLine($id);
        $dataLineProduct=$this->ProductModel->getLineProduct();
        $this->view('manager.Deleteproduct.index',['dataLineProduct'=>$dataLineProduct,'data'=>$data]);
    }
    // tìm sản phẩm theo têntên
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
    // Xóa sản phẩm nếu k bánbán
    public function deleteProduct()
    {
        $id = $_POST['id'] ?? ''; 
        if ($id == '') {
            $_SESSION['error'] = "Invalid product.";
            $this->index(); 
            exit;
        } else {
            $temp= $_SESSION['AccountID'] ;
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $currentTime = date('Y-m-d H:i:s');
            $loginmanager = new LoginManager(
                '',
                $temp,
                $currentTime,
                'Delete'
            );
            $this->LoginManagerModel->createLoginManager($loginmanager);

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
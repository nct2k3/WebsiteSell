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
        $Role = $this->takeRole();
        if ($Role == 0) {
            header("Location: /");
            $_SESSION['error'] = "Bạn không có vai trò quản lý";
        }
        $product = $this->ProductModel->getAllProduct();
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $numbegin = 0;
        $numend = 10;
        if ($page && $page > 1) {
            $numbegin = ($page - 1) * $numend;
            $numend = $numend * $page;
        }
        $number = count($product);
        $numpage = ceil($number / 10);
        $products = array_slice($product, $numbegin, $numend);
        $dataLineProduct = $this->ProductModel->getLineProduct();
        $this->view('manager.Deleteproduct.index', ['dataLineProduct' => $dataLineProduct, 'data' => $products, 'numpage' => $numpage]);
    }
    // Lọc sản phẩm theo dòng
    public function FilterProduct($id){
        $data = $this->ProductModel->getProductDeleteWithLine($id);
        $dataLineProduct = $this->ProductModel->getLineProduct();
        $this->view('manager.Deleteproduct.index', ['dataLineProduct' => $dataLineProduct, 'data' => $data]);
    }
    // Tìm sản phẩm theo tên
    public function searchProduct($string) {
        $data = $this->ProductModel->getAllProduct();
        
        $productDataSearch = [];
        foreach ($data as $items) {
            if (stripos($items->productName, $string) !== false) {
                $productDataSearch[] = $items;
            }
        }
        if (count($productDataSearch) == 0) {
            $_SESSION['error'] = "Không tìm thấy sản phẩm nào.";
        }
        $dataLineProduct = $this->ProductModel->getLineProduct();
        $this->view('manager.Deleteproduct.index', ['dataLineProduct' => $dataLineProduct, 'data' => $productDataSearch]);
    }
    // Xóa sản phẩm nếu không bán
    public function deleteProduct()
    {
        $id = $_POST['id'] ?? ''; 
        if ($id == '') {
            $_SESSION['error'] = "Sản phẩm không hợp lệ.";
            $this->index(); 
            exit;
        } else {
            $temp = $_SESSION['AccountID'];
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
            $_SESSION['messages'] = "Xóa sản phẩm thành công!";
            $this->index();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;
    $DeleteproductController = new DeleteproductController();
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
                $_SESSION['error'] = "Không tìm thấy sản phẩm nào.";
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
?>
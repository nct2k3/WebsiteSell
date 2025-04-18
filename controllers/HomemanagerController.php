<?php
class HomemanagerController extends BaseController
{
    private $LoginManagerModel;
    private $ProductModel;
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
    //  lọc sản phâm với phân trang
    public function FilterProduct($id){
        // Lấy dữ liệu của dòng sản phẩm đã chọn
        $data = $this->ProductModel->getProductManager($id);
        
        // Lấy thông tin dòng sản phẩm đã chọn
        $lineInfo = null;
        $dataLineProduct=$this->ProductModel->getLineProduct();
        foreach ($dataLineProduct as $line) {
            if ($line->ProductLineID == $id) {
                $lineInfo = [
                    'ProductLineID' => $line->ProductLineID,
                    'ProductLineName' => $line->ProductLineName
                ];
                break;
            }
        }
        
        // Xử lý phân trang
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $numbegin = 0;
        $numend = 10;
        if($page && $page > 1){
            $numbegin = ($page-1) * $numend;
        }
        
        $number = count($data);
        $numpage = ceil($number / 10);
        
        // Cắt mảng kết quả lọc để phân trang
        $paginatedResults = array_slice($data, $numbegin, min(10, count($data) - $numbegin));
        
        $this->view('manager.HomeManager.index',[
            'dataLineProduct' => $dataLineProduct,
            'data' => $paginatedResults,
            'numpage' => $numpage,
            'productLineID' => $id,
            'NameLine' => $lineInfo
        ]);
    }

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
            
            // Kiểm tra nếu có các tham số tìm kiếm hoặc lọc để quay lại đúng trang
            if (isset($_GET['lineID'])) {
                header("Location: ?controller=homeManager&action=filter&lineID=" . $_GET['lineID'] . "&page=1");
            } else if (isset($_GET['string'])) {
                header("Location: ?controller=homeManager&action=search&string=" . $_GET['string'] . "&page=1");
            } else {
                $this->index();
                exit;
            }
            exit;
        }
    }
    
    // tìm kiếm sản phẩm với phân trang
    public function searchProduct($string) {
        $data = $this->ProductModel->getAllProduct();
        
        $productDataSearch = [];
        foreach ($data as $items) {
            if (stripos($items->productName, $string) !== false) {
                $productDataSearch[] = $items;
            }
        }
        
        // Thêm logic phân trang cho kết quả tìm kiếm
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $numbegin = 0;
        $numend = 10;
        if($page && $page > 1){
            $numbegin = ($page-1) * $numend;
        }
        
        $number = count($productDataSearch);
        $numpage = ceil($number / 10);
        
        // Cắt mảng kết quả tìm kiếm để phân trang
        $paginatedResults = array_slice($productDataSearch, $numbegin, min(10, count($productDataSearch) - $numbegin));
        
        if (count($productDataSearch) == 0) {
            $_SESSION['error'] = "There are no products found.";
        }
        
        $dataLineProduct = $this->ProductModel->getLineProduct();
        $this->view('manager.HomeManager.index', [
            'dataLineProduct' => $dataLineProduct,
            'data' => $paginatedResults,
            'numpage' => $numpage,
            'searchTerm' => $string // Truyền từ khóa tìm kiếm để giữ trong liên kết phân trang
        ]);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;
    $HomemanagerController = new HomemanagerController();
    switch ($action) {
        case 'chosenLine':
            $productLine = $_POST['productLine'] ?? '';
            if (empty($productLine)) {
                $_SESSION['error'] = "Vui lòng chọn dòng sản phẩm";
                header("Location: ?controller=homeManager");
                exit;
            }
            // Chuyển hướng đến URL GET để có thể phân trang
            header("Location: ?controller=homeManager&action=filter&lineID=" . urlencode($productLine) . "&page=1");
            exit();
        case 'search':
            $string = $_POST['string'] ?? null;
            if ($string) {
                // Chuyển hướng đến URL GET với tham số tìm kiếm để có thể phân trang
                header("Location: ?controller=homeManager&action=search&string=" . urlencode($string) . "&page=1");
                exit;
            } else {
                $_SESSION['error'] = "There are no products found.";
                $HomemanagerController->index();
                exit;
            }
        case 'deleteProduct':
            $HomemanagerController->deleteProduct();
            exit;
        default:
            //echo "Hành động không hợp lệ!";
            break;
    }
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $action = $_GET['action'] ?? null;
    $HomemanagerController = new HomemanagerController();
    
    switch ($action) {
        case 'search':
            // Xử lý yêu cầu GET cho tìm kiếm (được sử dụng cho phân trang)
            $string = $_GET['string'] ?? '';
            $HomemanagerController->searchProduct($string);
            exit;
        case 'filter':
            // Xử lý yêu cầu GET cho lọc sản phẩm (được sử dụng cho phân trang)
            $lineID = $_GET['lineID'] ?? '';
            if (empty($lineID)) {
                $_SESSION['error'] = "Thiếu thông tin dòng sản phẩm";
                $HomemanagerController->index();
                exit;
            }
            $HomemanagerController->FilterProduct($lineID);
            exit;
        case 'deleteProduct':
            // Xử lý xóa sản phẩm theo GET (nếu có)
            $HomemanagerController->deleteProduct();
            exit;
    }
}
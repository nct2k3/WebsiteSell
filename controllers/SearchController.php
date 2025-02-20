<?php
class SearchController extends BaseController
{
    private $ProductModel;
    public function __construct()
    {
        $this->ProductModel = $this->loadModel("ProductModel");
    }
    public function index() {

        $dataLineProduct=$this->ProductModel->getLineProduct();
        $this->view('frontEnd.search.index',['dataLineProduct'=>$dataLineProduct]);
    }
    // dẹp chọn lọc tim kiem
    public function CleanAll() {   
        $_SESSION['ProductLineSearch'] = '';
        $_SESSION['From']='';
        $_SESSION['To']='';
        $dataLineProduct=$this->ProductModel->getLineProduct();
        $this->view('frontEnd.search.index',['dataLineProduct'=>$dataLineProduct]);
    }
    // tìm theo têntên
    public function searchProduct($string) {
        $data = $this->getAllProduct();
        $dataLineProduct=$this->ProductModel->getLineProduct();
        $productDataSearch = [];
        $productLineName='';
        $ProductLineAdd = isset($_SESSION['ProductLineSearch']) ? $_SESSION['ProductLineSearch'] : ' ';
        if($ProductLineAdd!==''){
            $productLineName=$this->ProductModel-> getnameLine( $ProductLineAdd);
        }
        $FromAdd = isset($_SESSION['From']) ? $_SESSION['From'] : ' ';
        $ToAdd = isset($_SESSION['To']) ? $_SESSION['To'] : ' ';
        if( $ProductLineAdd!=''&& $FromAdd!=''&& $ToAdd!=''){
            foreach ($data as $items) {
                if (stripos($items->productName, $string) !== false&&$items->productLineID ==  $ProductLineAdd && $items->price >= $FromAdd && $items->price <= $ToAdd) {
                    $productDataSearch[] = $items;
                }
            }
        }
        else
        if( $ProductLineAdd==''&& $FromAdd!=''&& $ToAdd!=''){
            foreach ($data as $items) {
                if (stripos($items->productName, $string) !== false&& $items->price >= $FromAdd && $items->price <= $ToAdd) {
                    $productDataSearch[] = $items;
                }
            }
        }
        else
        foreach ($data as $items) {
            if (stripos($items->productName, $string) !== false) {
                $productDataSearch[] = $items;
            }
        }
        if (count($productDataSearch) == 0) {
            $_SESSION['error'] = "There are no products found.";
        }
        $this->view('frontEnd.search.index',
        ['dataPrd'=>$productDataSearch,
        'dataLineProduct'=>$dataLineProduct,
        'productLineName'=> $productLineName,
        'FromAdd'=>$FromAdd,
        'ToAdd'=>$ToAdd]);
    }
    // tìm theo giá + line
    public function searchWithConditions($ProductLines, $From, $To) {
        $data = $this->getAllProduct();
        $dataLineProduct = $this->ProductModel->getLineProduct();
        $productDataSearch = [];
        $productLineName='';
        $ProductLineAdd = isset($_SESSION['ProductLineSearch']) ? $_SESSION['ProductLineSearch'] : ' ';
        if($ProductLineAdd!==''){
            $productLineName=$this->ProductModel-> getnameLine( $ProductLineAdd);
        }
        $FromAdd = isset($_SESSION['From']) ? $_SESSION['From'] : ' ';
        $ToAdd = isset($_SESSION['To']) ? $_SESSION['To'] : ' ';
        foreach ($data as $items) {
            if ($ProductLines == '') {
                if ($items->price >= $From && $items->price <= $To) {
                    $productDataSearch[] = $items;
                }           
            } else
            if ($items->productLineID == $ProductLines && $items->price >= $From && $items->price <= $To) {
                $productDataSearch[] = $items;
            }
        }
        if (count($productDataSearch) == 0) {
            $_SESSION['error'] = "There are no products found.";
        }
        $this->view('frontEnd.search.index', [
            'dataPrd' => $productDataSearch,
            'dataLineProduct' => $dataLineProduct,
            'productLineName'=> $productLineName,
            'FromAdd'=>$FromAdd,
            'ToAdd'=>$ToAdd
        ]);
    }
    
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;
    $searchController = new SearchController();
    switch ($action) {
        case 'search':
            $string = $_POST['string'] ?? null;
            if ($string) {        
                $searchController->searchProduct($string);
                exit;
            } else {
                $_SESSION['error'] = "There are no products found.";
                $searchController->index();
                exit;
            }
        case 'searchWithConditions':
            if (!isset($ProductLine)) {
                $ProductLine = isset($_POST['ProductLine']) ? $_POST['ProductLine'] : '';
            }           
            $_SESSION['ProductLineSearch'] = $ProductLine;
            $From=$_POST['From'];
            $_SESSION['From']=$From;
            $To=$_POST['To'];
            $_SESSION['To']=$To;
            $searchController->searchWithConditions($ProductLine,$From,$To);
            exit();
        default:
            echo "Hành động không hợp lệ!";
            break;
    }
}

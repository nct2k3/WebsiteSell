<?php
class SearchController extends BaseController
{

    private $ProductModel;

    public function __construct()
    {
       
        $this->ProductModel = $this->loadModel("ProductModel");
    }

    public function index() {
    
        $this->view('frontEnd.search.index');
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
        $this->view('frontEnd.search.index',['data'=>$productDataSearch]);
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;

    switch ($action) {
        case 'search':
            $searchController = new SearchController();
            $string = $_POST['string'] ?? null;
            if ($string) {
               
                $searchController->searchProduct($string);
                exit;
            } else {
                $_SESSION['error'] = "There are no products found.";
                $searchController->index();
                exit;
            }
           
        default:
            echo "Hành động không hợp lệ!";
            break;
    }
}

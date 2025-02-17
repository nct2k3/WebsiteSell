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
    public function searchProduct($string) {
        $data = $this->getAllProduct();
        $dataLineProduct=$this->ProductModel->getLineProduct();
        $productDataSearch = [];
        foreach ($data as $items) {
            if (stripos($items->productName, $string) !== false) {
                $productDataSearch[] = $items;
            }
        }
        if (count($productDataSearch) == 0) {
            $_SESSION['error'] = "There are no products found.";
        }
        $this->view('frontEnd.search.index',['dataPrd'=>$productDataSearch,'dataLineProduct'=>$dataLineProduct]);
    }

    public function searchWithConditions($ProductLines,$From,$To) {

        $data = $this->getAllProduct();
        $dataLineProduct=$this->ProductModel->getLineProduct();
        $productDataSearch = [];
        foreach ($data as $items) {
            if ($items->productLineID == $ProductLines&& $items->price<=$To && $items->price>=$To ) {
                $productDataSearch[] = $items;
            }
        }
        if (count($productDataSearch) == 0) {
            $_SESSION['error'] = "There are no products found.";
        }
        $this->view('frontEnd.search.index',['dataPrd'=>$productDataSearch,'dataLineProduct'=>$dataLineProduct]);
 





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
            $ProductLine=$_POST['ProductLine'];
            $From=$_POST['From'];
            $To=$_POST['To'];
            $searchController->searchWithConditions($ProductLine,$From,$To);


            exit();


           
        default:
            echo "Hành động không hợp lệ!";
            break;
    }
}

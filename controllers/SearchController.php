<?php
class SearchController extends BaseController
{
    private $ProductModel;

    public function __construct()
    {
        $this->ProductModel = $this->loadModel("ProductModel");
    }

    public function index()
    {
        $dataLineProduct = $this->ProductModel->getLineProduct();
        $this->view('frontEnd.search.index', ['dataLineProduct' => $dataLineProduct]);
    }

    public function CleanAll()
    {
        $_SESSION['ProductLineSearch'] = '';
        $_SESSION['From'] = '';
        $_SESSION['To'] = '';
        $dataLineProduct = $this->ProductModel->getLineProduct();
        $this->view('frontEnd.search.index', ['dataLineProduct' => $dataLineProduct]);
    }

    public function searchProduct($string)
    {
        $searchQuery = isset($_GET['string']) ? trim($_GET['string']) : '';
        $data = $this->getAllProduct();
        $dataLineProduct = $this->ProductModel->getLineProduct();
        $productDataSearch = [];
        $productLineName = '';

        $ProductLineAdd = $_SESSION['ProductLineSearch'] ?? '';
        $FromAdd = $_SESSION['From'] ?? 0;
        $ToAdd = $_SESSION['To'] ?? 0;

        if ($ProductLineAdd != '') {
            $productLineName = $this->ProductModel->getnameLine($ProductLineAdd);
        }

        foreach ($data as $items) {
            $nameMatch = mb_stripos(mb_strtolower($items->productName), mb_strtolower($string)) !== false;
            $lineMatch = ($ProductLineAdd == '' || $items->productLineID == $ProductLineAdd);
            $priceMatch = ($FromAdd == 0 && empty($ToAdd)) || ($items->price >= $FromAdd && (empty($ToAdd) || $items->price <= $ToAdd));

            if ($nameMatch && $lineMatch && $priceMatch) {
                $productDataSearch[] = $items;
            }
        }

        if (count($productDataSearch) == 0) {
            $_SESSION['error'] = "There are no products found.";
        }

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $pagination = $this->paginate($productDataSearch, $page, 6);
        $numpage = $pagination['totalPages'] ?? 1;

        $this->view('frontEnd.search.index', [
            'dataPrd' => $pagination['items'],
            'dataLineProduct' => $dataLineProduct,
            'numpage' => $numpage,
            'currentPage' => $pagination['currentPage'],
            'searchQuery' => http_build_query($_GET)
        ]);
        exit;
    }

    // Sửa phương thức searchWithConditions để linh hoạt hơn
    public function searchWithConditions($ProductLines, $From, $To)
    {
        $data = $this->getAllProduct();
        $dataLineProduct = $this->ProductModel->getLineProduct();
        $productDataSearch = [];
        $productLineName = '';

        $ProductLineAdd = isset($_SESSION['ProductLineSearch']) ? $_SESSION['ProductLineSearch'] : '';
        if ($ProductLineAdd !== '') {
            $productLineName = $this->ProductModel->getnameLine($ProductLineAdd);
        }

        $FromAdd = isset($_SESSION['From']) ? $_SESSION['From'] : 0;
        $ToAdd = isset($_SESSION['To']) ? $_SESSION['To'] : 0;

        foreach ($data as $items) {
            $lineMatch = ($ProductLines == '' || $ProductLines == 0 || $items->productLineID == $ProductLines);
            $priceMatch = ($From == '' && $To == '') || 
                          ($From == '' && $items->price <= $To) || 
                          ($To == '' && $items->price >= $From) || 
                          ($items->price >= $From && $items->price <= $To);

            // Chỉ cần một trong hai điều kiện đúng (hoặc cả hai)
            if ($lineMatch && $priceMatch) {
                $productDataSearch[] = $items;
            }
        }

        if (count($productDataSearch) == 0) {
            $_SESSION['error'] = "There are no products found.";
            $productDataSearch = [];
        } else {
            $_SESSION['productDataSearch'] = $productDataSearch;
        }

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $searchQuery = isset($_POST['string']) ? trim($_POST['string']) : "";
        $pagination = $this->paginate($productDataSearch, $page, 6);

        $this->view('frontEnd.search.index', [
            'dataPrd' => $pagination['items'],
            'dataLineProduct' => $dataLineProduct,
            'productLineName' => $productLineName,
            'FromAdd' => $FromAdd,
            'ToAdd' => $ToAdd,
            'numpage' => $pagination['totalPages'],
            'currentPage' => $pagination['currentPage'],
            'searchQuery' => $searchQuery
        ]);
        exit;
    }

    private function paginate($items, $page, $itemsPerPage = 6)
    {
        $totalItems = count($items);
        $totalPages = ceil($totalItems / $itemsPerPage);
        $offset = ($page - 1) * $itemsPerPage;
        $pagedItems = array_slice($items, $offset, $itemsPerPage);

        return [
            'items' => $pagedItems,
            'totalPages' => $totalPages,
            'currentPage' => $page
        ];
    }

   
}

// Xử lý request
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $action = $_GET['action'] ?? null;
    $searchController = new SearchController();

    switch ($action) {
        case 'search':
            $string = $_GET['string'] ?? null;
            if ($string) {
                $searchController->searchProduct($string);
                exit;
            } else {
                $_SESSION['error'] = "There are no products found.";
                $searchController->index();
                exit;
            }
        case 'searchWithConditions':
            $ProductLine = isset($_GET['ProductLine']) ? $_GET['ProductLine'] : '';
            $_SESSION['ProductLineSearch'] = $ProductLine;
            $From = isset($_GET['From']) && $_GET['From'] !== '' ? (int)$_GET['From'] : '';
            $_SESSION['From'] = $From;
            $To = isset($_GET['To']) && $_GET['To'] !== '' ? (int)$_GET['To'] : '';
            $_SESSION['To'] = $To;

            $searchController->searchWithConditions($ProductLine, $From, $To);
            exit;
        case 'CleanAll':
            $searchController->CleanAll();
            exit;
        default:
          
            break;
    }
}
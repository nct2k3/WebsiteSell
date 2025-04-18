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
        exit;
    }

    public function search()
    {
        // Lấy các tham số từ $_GET
        $string = isset($_GET['string']) ? trim($_GET['string']) : '';
        $ProductLine = isset($_GET['ProductLine']) ? $_GET['ProductLine'] : ''; // Khởi tạo giá trị mặc định
        $From = isset($_GET['From']) && $_GET['From'] !== '' ? (int)$_GET['From'] : '';
        $To = isset($_GET['To']) && $_GET['To'] !== '' ? (int)$_GET['To'] : '';

        $data = $this->ProductModel->getProductUnDelete();
        $dataLineProduct = $this->ProductModel->getLineProduct();
        $productDataSearch = [];
        $productLineName = '';

        if ($ProductLine !== '') {
            $productLineName = $this->ProductModel->getnameLine($ProductLine);
        }

        // Lọc sản phẩm dựa trên các tham số
        foreach ($data as $items) {
            $nameMatch = $string === '' || mb_stripos(mb_strtolower($items->productName), mb_strtolower($string)) !== false;
            $lineMatch = $ProductLine === '' || $items->productLineID == $ProductLine;
            $priceMatch = ($From === '' && $To === '') ||
                          ($From === '' && $items->price <= $To) ||
                          ($To === '' && $items->price >= $From) ||
                          ($items->price >= $From && $items->price <= $To);

            if ($nameMatch && $lineMatch && $priceMatch) {
                $productDataSearch[] = $items;
            }
        }

        if (count($productDataSearch) == 0) {
            $_SESSION['error'] = "Không tìm thấy sản phẩm nào.";
        }

        // Phân trang
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $pagination = $this->paginate($productDataSearch, $page, 6);
        $numpage = $pagination['totalPages'] ?? 1;

        $this->view('frontEnd.search.index', [
            'dataPrd' => $pagination['items'], // Dữ liệu sản phẩm
            'dataLineProduct' => $dataLineProduct, // Danh sách dòng sản phẩm
            'productLineName' => $productLineName, // Tên dòng sản phẩm (nếu có)
            'From' => $From,
            'To' => $To,
            'string' => $string,
            'numpage' => $numpage,
            'currentPage' => $pagination['currentPage'],
            'searchQuery' => http_build_query($_GET),
            'ProductLine' => $ProductLine // Truyền biến $ProductLine
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
            $searchController->search();
            break;
        default:
            $searchController->index();
            break;
    }
}
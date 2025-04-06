<?php
class HomeController extends BaseController
{
    private $ProductModel;

    public function __construct()
    {
        $this->ProductModel = $this->loadModel("ProductModel");
    }
    
    public function index()
    {
        $category = isset($_GET['category']) ? $_GET['category'] : null;

        $pageIphone = ($category === 'iphone' && isset($_GET['page'])) ? (int)$_GET['page'] : 1;
        $pageMacbook = ($category === 'macbook' && isset($_GET['page'])) ? (int)$_GET['page'] : 1;
        $pageIPad = ($category === 'ipad' && isset($_GET['page'])) ? (int)$_GET['page'] : 1;
        $pageWatch = ($category === 'watch' && isset($_GET['page'])) ? (int)$_GET['page'] : 1;



        $ProductIphone = $this->ProductModel->getByProductLineID('products',1);
        $ProductMacbock = $this->ProductModel->getByProductLineID('products',2);
        $ProductIPad = $this->ProductModel->getByProductLineID('products',5);
        $ProductWatch = $this->ProductModel->getByProductLineID('products',4);

        // Phân trang cho từng loại sản phẩm (6 sản phẩm mỗi trang)
        $paginationIphone = $this->paginate($ProductIphone, $pageIphone, 6);
        $paginationMacbook = $this->paginate($ProductMacbock, $pageMacbook, 6); 
        $paginationIPad = $this->paginate($ProductIPad, $pageIPad, 6);
        $paginationWatch = $this->paginate($ProductWatch, $pageWatch, 6);

        $this->view('frontEnd.home.index', [
            'ProductIphone' => $paginationIphone['items'],
            'ProductMacbock' => $paginationMacbook['items'],
            'ProductIPad' => $paginationIPad['items'],
            'ProductWatch' => $paginationWatch['items'],
            'currentPageIphone' => $paginationIphone['currentPage'],
            'currentPageMacbook' => $paginationMacbook['currentPage'],
            'currentPageIPad' => $paginationIPad['currentPage'],
            'currentPageWatch' => $paginationWatch['currentPage'],
            'totalPagesIphone' => $paginationIphone['totalPages'],
            'totalPagesMacbook' => $paginationMacbook['totalPages'],
            'totalPagesIPad' => $paginationIPad['totalPages'],
            'totalPagesWatch' => $paginationWatch['totalPages'],
        ]);
    }

    function paginate($products, $currentPage, $perPage) {
        $totalItems = count($products);
        $totalPages = ceil($totalItems / $perPage);
        
        // Đảm bảo trang hiện tại nằm trong phạm vi hợp lệ
        if ($currentPage < 1) {
            $currentPage = 1;
        } elseif ($currentPage > $totalPages) {
            $currentPage = $totalPages;
        }
    
        $startIndex = ($currentPage - 1) * $perPage;
        $paginatedItems = array_slice($products, $startIndex, $perPage);
    
        return [
            'items' => $paginatedItems,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages
        ];
    }
    

    
    
}
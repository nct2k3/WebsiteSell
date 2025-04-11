<?php
class ProductController extends BaseController
{
    private $ProductModel;
    private $BannerModel;

    public function __construct()
    {
        $this->ProductModel = $this->loadModel("ProductModel");
        $this->BannerModel = $this->loadModel("BannerModel");
    }

    public function index()
    {
        $id = $_GET['items'];
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $itemsPerPage = 6;

        $product = $this->ProductModel->getProduct($id);
        $Banner = $this->BannerModel->getBanners($id);

        $number = count($product);
        $numpage = ceil($number / $itemsPerPage);

        $page = max(1, min($page, $numpage));

        $numbegin = ($page - 1) * $itemsPerPage;
        $products = array_slice($product, $numbegin, $itemsPerPage);

        $this->view('frontEnd.product.index', [
            'products' => $products,
            'Banner' => $Banner,
            'items' => $id,
            'numpage' => $numpage
        ]);
    }

    public function indexSortHightToLow()
    {
        $id = $_GET['items'];
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $itemsPerPage = 6;

        $product = $this->ProductModel->getProduct($id);
        if (!empty($product)) {
            usort($product, function($a, $b) {
                return $b->price - $a->price;
            });
        }

        $Banner = $this->BannerModel->getBanners($id);

        $number = count($product);
        $numpage = ceil($number / $itemsPerPage);

        $page = max(1, min($page, $numpage));

        $numbegin = ($page - 1) * $itemsPerPage;
        $products = array_slice($product, $numbegin, $itemsPerPage);

        $this->view('frontEnd.product.index', [
            'products' => $products,
            'Banner' => $Banner,
            'items' => $id,
            'numpage' => $numpage
        ]);
    }

    public function indexSortLowToHight()
    {
        $id = $_GET['items'];
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $itemsPerPage = 6;

        $product = $this->ProductModel->getProduct($id);
        if (!empty($product)) {
            usort($product, function($a, $b) {
                return $a->price - $b->price;
            });
        }

        $Banner = $this->BannerModel->getBanners($id);

        $number = count($product);
        $numpage = ceil($number / $itemsPerPage);

        $page = max(1, min($page, $numpage));

        $numbegin = ($page - 1) * $itemsPerPage;
        $products = array_slice($product, $numbegin, $itemsPerPage);

        $this->view('frontEnd.product.index', [
            'products' => $products,
            'Banner' => $Banner,
            'items' => $id,
            'numpage' => $numpage
        ]);
    }
}
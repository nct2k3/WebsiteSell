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
        $product = $this->ProductModel->getProduct($id);
        $Model= $this->ProductModel->getModel($id);
        $Banner= $this->BannerModel->getBanners($id);
        $products = [];
        foreach ($product as $items) {
            $capacity = $this->getCapacity($items->productType);
        
            $products[] = [
                'item' => $items,
                'capacity' => $capacity
            ];
        }
        $this->view('frontEnd.product.index', 
        ['products' => $products,'Model'=>$Model,'Banner'=> $Banner,'items'=>$id]);
    }
    public function productModel()
    {
        $id = $_GET['items'];
        $Model=$_GET['model'];
        $product = $this->ProductModel->getProductModel($Model);
        $Model= $this->ProductModel->getModel($id);
        $Banner= $this->BannerModel->getBanners($id);
        $products = [];
        foreach ($product as $items) {
            $capacity = $this->getCapacity($items->productType);
        
            $products[] = [
                'item' => $items,
                'capacity' => $capacity
            ];
        }
        $this->view('frontEnd.product.index', 
        ['products' => $products,'Model'=>$Model,'Banner'=> $Banner,'items'=>$id]);
    }

    public function getCapacity($productType) {
        // Gọi hàm trong ProductModel để lấy capacity dựa trên productType
        $capacity = $this->ProductModel->getCapacity($productType);
        return $capacity;
    }
}

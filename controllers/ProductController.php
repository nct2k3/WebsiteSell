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
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $product = $this->ProductModel->getProduct($id);
        $Banner= $this->BannerModel->getBanners($id);
        $numbegin=0;
        $numend=6;
        if($page && $page>1){
            $numbegin= ($page-1)*$numend;
            $numend= $numend*$page;
        }
        $number= count($product);
        $numpage= ceil($number/6);
        $products = array_slice($product,$numbegin,$numend);
        $products = array_slice($products, 0, 6);
        $this->view('frontEnd.product.index', ['products' => $products,'Banner'=> $Banner,'items'=>$id,'numpage'=>$numpage ]);
    }

    
    public function indexSortHightToLow()
    {
        $id = $_GET['items'];
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $product = $this->ProductModel->getProduct($id);
        if (!empty($product)) {
            usort($product, function($a, $b) {
                return  $b->price - $a->price;
            });
        }
        $Banner= $this->BannerModel->getBanners($id);
        $numbegin=0;
        $numend=6;
        if($page && $page>1){
            $numbegin= ($page-1)*$numend;
            $numend= $numend*$page;
        }
        $number= count($product);
        $numpage= ceil($number/6);
        $products = array_slice($product,$numbegin,$numend);
        
        $this->view('frontEnd.product.index', 
        ['products' => $products,'Banner'=> $Banner,'items'=>$id,'numpage'=>$numpage]);
    }
    
    public function indexSortLowToHight()
    {
        $id = $_GET['items'];
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $product = $this->ProductModel->getProduct($id);
        if (!empty($product)) {
            usort($product, function($a, $b) {
                return  $a->price - $b->price;
            });
        }
        $Banner= $this->BannerModel->getBanners($id);
        $numbegin=0;
        $numend=6;
        if($page && $page>1){
            $numbegin= ($page-1)*$numend;
            $numend= $numend*$page;
        }
        $number= count($product);
        $numpage= ceil($number/6);
        $products = array_slice($product,$numbegin,$numend);
       
        $this->view('frontEnd.product.index', 
        ['products' => $products,'Banner'=> $Banner,'items'=>$id,'numpage'=>$numpage]);
    }

    public function getProductsByCategory($ProductLineID){
       
        $products = $this->ProductModel->getByProductLineID('products',$ProductLineID);
        return $products;
    }
}
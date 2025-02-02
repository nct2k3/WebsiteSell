<?php
class DetailProductController extends BaseController
{
    private $ProductModel;
    private $CartModel;
    public function __construct()
    {
        $this->ProductModel = $this->loadModel("ProductModel");
        $this->CartModel = $this->loadModel("CartModel");
    }

    public function index()
    {
        $id = $_GET['items'];
        // Lấy danh sách sản phẩm theo ProductLineID
        $product = $this->ProductModel->getProductByID($id);
        $products = [];
            $capacity = $this->getCapacity($product->productType);
            $color = $this->getColor($product->productType);
           
            // Thêm item và capacity vào mảng products
            $products[] = [
                'item' => $product,
                'capacity' => $capacity,
                'color'=> $color
            ];
        $this->view('frontEnd.detailProduct.index', ['products' => $products,'productType'=>$product->productType]);
    }
    public function searchColor()
    {
        $Color = $_GET['color'];
        $productType=$_GET['productType'];
        $product = $this->ProductModel->getproductColor($Color,$productType);
        $products = [];
            $capacity = $this->ProductModel->getCapacityByTow($product->productType,$Color);
            $color = $this->getColor($product->productType);
            $products[] = [
                'item' => $product,
                'capacity' => $capacity,
                'color'=> $color
            ];
        $this->view('frontEnd.detailProduct.index', ['products' => $products,'productType'=>$product->productType]);
    }
    public function searchCapacity()
    {
        $Capacity = $_GET['capacity'];
        $productType=$_GET['productType'];
        $product = $this->ProductModel->getproductCapacity($Capacity,$productType);
        $products = [];
            $capacity = $this->getCapacity($product->productType);
            $color = $this->ProductModel->getColorByTow($product->productType,$Capacity);
           
            // Thêm item và capacity vào mảng products
            $products[] = [
                'item' => $product,
                'capacity' => $capacity,
                'color'=> $color
            ];
        $this->view('frontEnd.detailProduct.index', ['products' => $products,'productType'=>$product->productType]);
    }

    public function addCart(){
        $userId= $this->takeIDAccount();
        if($userId==""){
            $_SESSION['error'] = "You are not logged in yet!";
            $this->index(); 
            return;

        }
        $id = $_GET['items'];
        $cart= new Cart(
            '',
            $userId,
            $id,
            1
        );
        $data=$this->CartModel->createCart($cart);
        if ($data==1) {
            $_SESSION['message'] = "Added successfully!";

        }
        $this->index(); 
    }
    public function getCapacity($productType) {
        // Gọi hàm trong ProductModel để lấy capacity dựa trên productType
        $capacity = $this->ProductModel->getCapacity($productType);
        return $capacity;
    }
    public function getColor($productType) {
        // Gọi hàm trong ProductModel để lấy capacity dựa trên productType
        $Color = $this->ProductModel->getColor($productType);
        return $Color;
    }
}

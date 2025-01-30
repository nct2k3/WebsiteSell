<?php
class DetalProductController extends BaseController
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
        $this->view('frontEnd.detalProduct.index', ['products' => $products]);
    }

    public function addCart(){
        $userId= $this->takeIDAccount();
        $id = $_GET['items'];
        $cart= new Cart(
            '',
            $userId,
            $id

        );
        $data=$this->CartModel->createCart($cart);
        if ($data==1) {
            $_SESSION['message'] = "Thêm thành công!";

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

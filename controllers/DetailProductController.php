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
        $product = $this->ProductModel->getProductByID($id);
        $ProductIphone = $this->ProductModel->getByIdGroup(rand(1, 6));
        $this->view('frontEnd.detailProduct.index', ['ProductIphone' => $ProductIphone,'products' => $product]);
    }
   
    // thêm giỏ hànghàng
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


}

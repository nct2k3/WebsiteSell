<?php
class DetailProductController extends BaseController
{
    private $ProductModel;
    private $CartModel;
    private $UserModel;
    public function __construct()
    {
        $this->ProductModel = $this->loadModel("ProductModel");
        $this->CartModel = $this->loadModel("CartModel");
        $this->UserModel = $this->loadModel("UserModel");
    }

    public function index()
    {
        $id = $_GET['items'];
        $product = $this->ProductModel->getProductByID($id);
        $ProductIphone = $this->ProductModel->getByIdGroup(rand(1, 6));
        $nameLine = $this->ProductModel->getnameLine($product->productLineID);
        
        $this->view('frontEnd.detailProduct.index', ['ProductIphone' => $ProductIphone,'nameLine'=>$nameLine,'products' => $product]);
    }
   
    // thêm giỏ hànghàng
    public function addCart(){
        $userId= $this->takeIDAccount();
        if($userId==""){
            $_SESSION['error'] = "You are not logged in yet!";
            $this->index(); 
            return;
        }
        $dataUser = $this->UserModel->getUserByID($userId);
        if($dataUser->FullName=="Admin"){
            $_SESSION['error'] = "Admin không có quyền mua hàng!";
            header("Location: /");
            return;

        }
        $id = $_GET['items'];
        $cart= new Cart(
            '',
            $userId,
            $id,
            1
        );
        $data=$this->CartModel-> adddCart($cart);
        if ($data==1) {
            $_SESSION['message'] = "Added successfully!";
        }
        $this->index(); 
    }


}

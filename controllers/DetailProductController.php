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
        $this->view('frontEnd.detailProduct.index', ['ProductIphone' => $ProductIphone, 'products' => $product]);
    }
   
    // Thêm vào giỏ hàng
    public function addCart(){
        $userId = $this->takeIDAccount();
        if ($userId == "") {
            $_SESSION['error'] = "Bạn chưa đăng nhập!";
            $this->index(); 
            return;
        }
        if ($userId == 15) {
            $_SESSION['error'] = "Admin không thể mua hàng!";
            $this->index(); 
            return;
        }
        $id = $_GET['items'];
        $cart = new Cart(
            '',
            $userId,
            $id,
            1
        );
        $data = $this->CartModel->adddCart($cart);
        if ($data == 1) {
            $_SESSION['message'] = "Thêm vào giỏ hàng thành công!";
        }
        $this->index(); 
    }
}
?>
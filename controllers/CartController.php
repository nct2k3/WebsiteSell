<?php
class CartController extends BaseController
{
    private $CartModel;
    private $ProductModel;
    public function __construct()
    {
        $this->CartModel = $this->loadModel("CartModel");
        $this->ProductModel = $this->loadModel("ProductModel");
    }
    public function index()
    {
        $userID = $this->takeIDAccount();
        $dataCart = $this->CartModel->getCart($userID);
        $products = []; 
        if (is_array($dataCart)) {
            foreach ($dataCart as $item) {
                if (isset($item->ProductID)) {
                    $product = $this->ProductModel->getProductByID($item->ProductID);
                    if ($product) {
                        $products[] = [
                            'item' => $product,
                            'quantity' => $item->Quantity,
                            'price' => $product->price * $item->Quantity,
                        ];
                    }
                }
            }
        }
        $total = 0;
        foreach ($products as $product) {
            $total += $product['item']->price * $product['quantity'];
        }
        $this->view('frontEnd.cart.index', ['products' => $products, 'total' => $total, 'userID' => $userID]);
    }

    // Xóa giỏ hàng
    public function delete()
    {
        if (isset($_GET['user']) && isset($_GET['product'])) {
            $userID = (int)$_GET['user']; 
            $productID = (int)$_GET['product']; 
            $data = $this->CartModel->delete($userID, $productID); 
            if ($data == 1) {
                $_SESSION['message'] = "Xóa sản phẩm thành công!";
            }
            $this->index(); 
        } else {
            echo "ID người dùng hoặc sản phẩm không hợp lệ.";
        }
    }
    // Thay đổi số lượng giỏ hàng
    public function ChangeQuantity(){
        $userId = $this->takeIDAccount();
        if ($userId == "") {
            $_SESSION['error'] = "Bạn chưa đăng nhập!";
            $this->index(); 
            return;
        }
        $id = $_GET['product'];
        $quantity = $_GET['quantity'];
        if (number_format($quantity) <= 0) {
            $_SESSION['error'] = "Số lượng phải lớn hơn 0!";
            $this->index(); 
            return;
        }
        $product = $this->ProductModel->getProductByID($id);
        
        $cart = new Cart(
            '',
            $userId,
            $id,
            $quantity
        );
        $data = $this->CartModel->createCart($cart);
        if ($data == 1) {
            $_SESSION['message'] = "Thay đổi số lượng thành công!";
        }
        $this->index(); 
    }
}
?>
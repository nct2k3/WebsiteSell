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
        $userID =$this->takeIDAccount();
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
                            'price'=>$product->price*$item->Quantity,
                        ];
                    }
                }
            }
        }
        $total = 0;
        foreach ($products as $product) {
            $total += $product['item']->price*$product['quantity'];
        }
        $this->view('frontEnd.cart.index', ['products' => $products, 'total' => $total, 'userID' => $userID]);
    }

    // xóa giỏ hàng
    public function delete()
    {
        if (isset($_GET['user']) && isset($_GET['product'])) {
            $userID = (int)$_GET['user']; 
            $productID = (int)$_GET['product']; 
            $data=$this->CartModel->delete($userID, $productID); 
            if ($data==1) {
                $_SESSION['message'] = "Xóa thành công!";
            }
            $this->index(); 
        } else {
            echo "Invalid user or product ID.";
        }
    }
    // thay đổi số lượng giỏ hàng
    public function ChangeQuantity(){
        $userId= $this->takeIDAccount();
        if($userId==""){
            $_SESSION['error'] = "You are not logged in yet!";
            $this->index(); 
            return;
        }
        $id = $_GET['product'];
        $quantity = $_GET['quantity'];
        if(number_format($quantity)<=0){
            $_SESSION['error'] = "Number must be greater than zero!";
            $this->index(); 
            return;
        }
        $product = $this->ProductModel->getProductByID($id);
        if($product->stock< $quantity){
            $_SESSION['error'] = "Excess inventory cannot be added!";
            $this->index(); 
            return;
        }
        $cart= new Cart(
            '',
            $userId,
            $id,
            $quantity
        );
        $data=$this->CartModel->createCart($cart);
        if ($data==1) {
            $_SESSION['message'] = "Change successfully!";
        }
        $this->index(); 
    }
}
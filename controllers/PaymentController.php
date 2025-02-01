<?php
class PaymentController extends BaseController
{
    private $ProductModel;

    private $CartModel;

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
                            'quantity' => $item->Quantity
                        ];
                    }
                }
            }
        }
        $total = 0;
        foreach ($products as $product) {
            $total += $product['item']->price*$product['quantity'];
        }
        $this->view('frontEnd.payment.index', ['products' => $products, 'total' => $total, 'userID' => $userID]);
    }
    public function Delete()
    {
        if (isset($_GET['user']) && isset($_GET['product'])) {
            $userID = (int)$_GET['user']; 
            $productID = (int)$_GET['product']; 
            $data=$this->CartModel->delete($userID, $productID); 
            if ($data==1) {
                $_SESSION['message'] = "Delete successfully!";

            }
            $this->index(); 
        } else {
            echo "Invalid user or product ID.";
        }
    }
    public function ChangeQuantity(){
        $userId= $this->takeIDAccount();
        if($userId==""){
            $_SESSION['error'] = "You are not logged in yet!";
            $this->index(); 
            return;
        }
        $id = $_GET['product'];
        $quantity = $_GET['quantity'];
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
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
        if (isset($_GET['user']) && is_numeric($_GET['user'])) {
            $userID = (int)$_GET['user']; 
        } else {
            return; 
        }
        $dataCart = $this->CartModel->getCart($userID);
        $products = []; 
        if (is_array($dataCart)) {
            foreach ($dataCart as $item) {
                if (isset($item->ProductID)) {
                    $product = $this->ProductModel->getProductByID($item->ProductID);
                    if ($product) {
                        $products[] = $product; 
                    }
                }
            }
        }

        $total = 0;
        foreach ($products as $product) {
            $total += $product->price;
        }

        $this->view('frontEnd.cart.index', ['products' => $products, 'total' => $total, 'userID' => $userID]);
    }

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
}
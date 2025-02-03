<?php
class PaymentController extends BaseController
{
    private $ProductModel;

    private $CartModel;
    private $UserModel;
    private $InvoiceModel;
    private $InvoiceDetailModel;
    public function __construct()
    {
        $this->CartModel = $this->loadModel("CartModel");
        $this->ProductModel = $this->loadModel("ProductModel");
        $this->UserModel = $this->loadModel("UserModel");
        $this->InvoiceModel = $this->loadModel("InvoiceModel");
        $this->InvoiceDetailModel = $this->loadModel("InvoiceDetailModel");
    }
    
    public function index()
    {
        $userID =$this->takeIDAccount();
        $dataUser = $this->UserModel->getUserByID($userID);
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
        $dataAction='payment';
        $this->view('frontEnd.payment.index', ['dataAction'=>$dataAction,'products' => $products, 'total' => $total, 'userID' => $userID,'dataUser'=>$dataUser,]);
    }
    public function buyOne()
    {
        $userID =$this->takeIDAccount();
        $dataUser = $this->UserModel->getUserByID($userID);
        $dataCart = $this->CartModel->getCart($userID);
        $products = []; 
        $idProduct=$_GET['items'];
        $_SESSION['IdProduct'] =$idProduct;
       
        $product = $this->ProductModel->getProductByID($idProduct);
        if ($product) {
            $products[] = [
                            'item' => $product,
                            'quantity' =>1,
                            'price'=>$product->price,
                        ];
         }
        $total =$product->price; 
        $dataAction='payOne';
        $this->view('frontEnd.payment.index', ['dataAction'=>$dataAction,'products' => $products, 'total' => $total, 'userID' => $userID,'dataUser'=>$dataUser]);
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
    public function PaymentNormal($loyaltyPoints) {
        $userID = $this->takeIDAccount();
        $dataUser = $this->UserModel->getUserByID($userID);
        $dataCart = $this->CartModel->getCart($userID);
        $products = [];
    
        if (is_array($dataCart) && count($dataCart) > 0) {
            foreach ($dataCart as $item) {
                if (isset($item->ProductID)) {
                    $product = $this->ProductModel->getProductByID($item->ProductID);
                    if ($product) {
                        $products[] = [
                            'item' => $product,
                            'quantity' => $item->Quantity,
                        ];
                    }
                }
            }
        }
    
        $total = 0;
        foreach ($products as $product) {
            $total += $product['item']->price * $product['quantity'];
        }
    
        $loyaltyPoints = floatval($loyaltyPoints);
        $endTotal = ($loyaltyPoints > 0) ? $total - $loyaltyPoints : $total;
    
        // Kiểm tra nếu dữ liệu người dùng tồn tại
        if (!$dataUser) {
            $_SESSION['error'] = "User data not found.";
            header("Location: /?controller=information&user=$userID");
            return;
        }
    
        $invoice = new Invoice(
            '',
            $userID,
            date('Y-m-d H:i:s'),
            $endTotal,
            0,
            'normal',
            $dataUser->PhoneNumber,
            $dataUser->Address 
        );
    
        $invoiceId = $this->InvoiceModel->createInvoice($invoice);
        if ($invoiceId) {
            foreach ($products as $product) {
                $invoiceDetail = new InvoiceDetail(
                    '',
                    $invoiceId,
                    $product['item']->productID,
                    $product['quantity']
                );
                $this->InvoiceDetailModel->createInvoice($invoiceDetail);
            }
            
            // Xóa giỏ hàng
            $this->CartModel->deleteById($userID);
            $_SESSION['message'] = "Payment successfully!";
            header("Location: /?controller=information&user=$userID");
        } else {
            $_SESSION['error'] = "Failed to create invoice.";
            header("Location: /?controller=information&user=$userID");
        }
    }

    public function PaymentOne($loyaltyPoints) {
        $userID = $this->takeIDAccount();
        $dataUser = $this->UserModel->getUserByID($userID);
        $idProduct=$this->takeIDProduct();
        $products = [];
        if (isset($idProduct)) {
                    $product = $this->ProductModel->getProductByID($idProduct);

                    if ($product) {
                        $products[] = [
                            'item' => $product,
                            'quantity' =>1,
                        ];
                    }
        }
        $total = 0;
        foreach ($products as $product) {
            $total += $product['item']->price * $product['quantity'];
        }
        $loyaltyPoints = floatval($loyaltyPoints);
        $endTotal = ($loyaltyPoints > 0) ? $total - $loyaltyPoints : $total;
    
        // Kiểm tra nếu dữ liệu người dùng tồn tại
        if (!$dataUser) {
            $_SESSION['error'] = "User data not found.";
            header("Location: /?controller=information&user=$userID");
            return;
        }
    
        $invoice = new Invoice(
            '',
            $userID,
            date('Y-m-d H:i:s'),
            $endTotal,
            0,
            'normal',
            $dataUser->PhoneNumber,
            $dataUser->Address 
        );
    
        $invoiceId = $this->InvoiceModel->createInvoice($invoice);
        if ($invoiceId) {
      
                $invoiceDetail = new InvoiceDetail(
                    '',
                    $invoiceId,
                    $idProduct,
                    1
                );
            
                $this->InvoiceDetailModel->createInvoice($invoiceDetail);
            
            
            // Xóa giỏ hàng
            $this->CartModel->deleteById($userID);
            $_SESSION['message'] = "Payment successfully!";
            header("Location: /?controller=information&user=$userID");
        } else {
            $_SESSION['error'] = "Failed to create invoice.";
            header("Location: /?controller=information&user=$userID");
        }
    }

}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;
    switch ($action) {
        case 'payment':
            $loyaltyPoints = $_POST['LoyaltyPoints'] ?? null;
            $paymentType = $_POST['paymentType'] ?? null;

            if ($paymentType) {
                $paymentcontroller= new PaymentController;
                $paymentcontroller->PaymentNormal($loyaltyPoints );
                if ($paymentType === 'credit_card') {
                    $cardName = $_POST['cardName'] ?? null;
                    $cardNumber = $_POST['cardNumber'] ?? null;
                    $expiry = $_POST['expiry'] ?? null;
                    $cvv = $_POST['cvv'] ?? null;

                    echo '<pre>';
                    if ($cardName && $cardNumber && $expiry && $cvv) {
                        echo "Thẻ tín dụng hợp lệ.<br>";
                    } else {
                        $_SESSION['error'] = "Invalid credit card!";
                        $paymentcontroller->index(); 
                    }
                }
            } else {
                $_SESSION['error'] = "Error!";
                $paymentcontroller->index(); 
            }
            break;
            case 'payOne':
                $loyaltyPoints = $_POST['LoyaltyPoints'] ?? null;
                $paymentType = $_POST['paymentType'] ?? null;
    
                if ($paymentType) {
                    $paymentcontroller= new PaymentController;
                    $paymentcontroller->PaymentOne($loyaltyPoints );
                    if ($paymentType === 'credit_card') {
                        $cardName = $_POST['cardName'] ?? null;
                        $cardNumber = $_POST['cardNumber'] ?? null;
                        $expiry = $_POST['expiry'] ?? null;
                        $cvv = $_POST['cvv'] ?? null;
    
                        echo '<pre>';
                        if ($cardName && $cardNumber && $expiry && $cvv) {
                            echo "Thẻ tín dụng hợp lệ.<br>";
                        } else {
                            $_SESSION['error'] = "Invalid credit card!";
                            $paymentcontroller->index(); 
                        }
                    }
                } else {
                    $_SESSION['error'] = "Error!";
                    $paymentcontroller->index(); 
                }
                break;

        default:
            echo "Hành động không hợp lệ hoặc không xác định!<br>";
            break;
    }
}

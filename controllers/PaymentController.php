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

        $provinceList = $this->InvoiceModel->getProvinces();
        $dataAction='payment';
        $this->view('frontEnd.payment.index', ['dataAction'=>$dataAction,'products' => $products, 'total' => $total, 'userID' => $userID,'dataUser'=>$dataUser,'provinceList'=>$provinceList]);
    }
    public function getDistricts() {
        if (isset($_GET['province'])) {
            $province = $_GET['province'];
            // Chuẩn hóa giá trị province thành dạng 2 chữ số
            $province = str_pad($province, 2, '0', STR_PAD_LEFT);
            
            $districts = $this->InvoiceModel->getDistricts($province);
            header('Content-Type: application/json');
            echo json_encode($districts);
            exit;
        }
    }
    // mua 1 sản phẩm 
    public function buyOne()
    {
        $userID =$this->takeIDAccount();
      
        
        if($userID==""){
            $_SESSION['error'] = "You are not logged in yet!";
            header("Location: /");
            return;

        }
        $dataUser = $this->UserModel->getUserByID($userID);
        if($dataUser->FullName="Admin"){
            $_SESSION['error'] = "Admin không có quyền mua hàng!";
            header("Location: /");
            return;

        }
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
        $provinceList = $this->InvoiceModel->getProvinces();
        $this->view('frontEnd.payment.index', ['dataAction'=>$dataAction,'products' => $products, 'total' => $total, 'userID' => $userID,'dataUser'=>$dataUser,'provinceList'=>$provinceList]);
    }
    // xóa  spsp

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
    // thay đổi sl sản phẩmphẩm
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
    // thanh toán bình thương với giỏ hàng
    public function PaymentNormal($loyaltyPoints,$PhoneNumber,$address,$dateDelivery,$Note,$StattusTypePay,$province,$district) {
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
        if (!$dataUser) {
            $_SESSION['error'] = "User data not found.";
            header("Location: /?controller=information&user=$userID");
            return;
        }
        $PhoneNumberend=$dataUser->PhoneNumber;
        if($PhoneNumber!=''){
            $PhoneNumberend=$PhoneNumber;
        }
        $addressend=$dataUser->Address;
        if($address!=''||$province!=''||$district!=''){

            if($address == '' || $province == '' || $district == '') {
                $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin địa chỉ (Địa chỉ, Tỉnh/Thành phố, Quận/Huyện) khi thay đổi";
                header("Location: /?controller=payment");
                exit;
            }
            $province = strlen($province) == 1 ? str_pad($province, 2, '0', STR_PAD_LEFT) : $province;
            $district = strlen($district) == 1 ? str_pad($district, 2, '0', STR_PAD_LEFT) : $district;     
            $provinceEnd = $this->InvoiceModel->getProvinceName($province);
            $districtEnd = $this->InvoiceModel->getDistrictName($district);
            $addressend = $address . ", " . $districtEnd . ", " . $provinceEnd;
            
        }
        $NodeEnd='';
        if($Note!=''){
            $NodeEnd=$Note;
        }
        $invoice = new Invoice(
            '',
            $userID,
            date('Y-m-d H:i:s'),
            $endTotal,
            $StattusTypePay,
            'normal',
            $PhoneNumberend,
            $addressend,
            $dateDelivery,
            $NodeEnd,
            $loyaltyPoints
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
            $this->CartModel->deleteById($userID);
            $_SESSION['message'] = "Payment successfully!";
            header("Location: /?controller=information&user=$userID");
        } else {
            $_SESSION['error'] = "Failed to create invoice.";
            header("Location: /?controller=information&user=$userID");
        }
    }
    // THANH TOÁN VỚI 1 sản phẩm
    public function PaymentOne($loyaltyPoints,$PhoneNumber,$address,$dateDelivery,$Note,$StattusTypePay,$province,$district) {
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
        if (!$dataUser) {
            $_SESSION['error'] = "User data not found.";
            header("Location: /?controller=information&user=$userID");
            return;
        }
        $PhoneNumberend=$dataUser->PhoneNumber;
        if($PhoneNumber!=''){
            $PhoneNumberend=$PhoneNumber;
        }
        $addressend=$dataUser->Address;
        if($address!=''||$province!=''||$district!=''){

            if($address == '' || $province == '' || $district == '') {
                $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin địa chỉ (Địa chỉ, Tỉnh/Thành phố, Quận/Huyện) khi thay đổi";
                header("Location: /?controller=payment");
                exit;
            }
            $province = strlen($province) == 1 ? str_pad($province, 2, '0', STR_PAD_LEFT) : $province;
            $district = strlen($district) == 1 ? str_pad($district, 2, '0', STR_PAD_LEFT) : $district;     
            $provinceEnd = $this->InvoiceModel->getProvinceName($province);
            $districtEnd = $this->InvoiceModel->getDistrictName($district);
            $addressend = $address . ", " . $districtEnd . ", " . $provinceEnd;
            
        }
        $NodeEnd='';
        if($Note!=''){
            $NodeEnd=$Note;
        }
        $invoice = new Invoice(
            '',
            $userID,
            date('Y-m-d H:i:s'),
            $endTotal,
            $StattusTypePay,
            'normal',
            $PhoneNumberend,
            $addressend,
            $dateDelivery,
            $NodeEnd,
            $loyaltyPoints
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
            $dateDelivery = $_POST['DateDelivery'] ?? null;
            $PhoneNumber = $_POST['PhoneNumber'] ?? null;
            $address = ($_POST['address'] ?? '');
            $province = $_POST['province']?? null;
            $district = $_POST['district']?? null;
            $Note = $_POST['Note'] ?? null;
            $paymentcontroller= new PaymentController;
            $paymentcontroller->PaymentNormal($loyaltyPoints,$PhoneNumber,$address,$dateDelivery,$Note,0,$province,$district);       
            break;
            case 'payOne':
                $loyaltyPoints = $_POST['LoyaltyPoints'] ?? null;
                $dateDelivery = $_POST['DateDelivery'] ?? null;
                $PhoneNumber = $_POST['PhoneNumber'] ?? null;
                $address = ($_POST['address'] ?? '');
                $province = $_POST['province']?? null;
                $district = $_POST['district']?? null;
                $Note = $_POST['Note'] ?? null;
                $paymentcontroller= new PaymentController;           
                $paymentcontroller->PaymentOne($loyaltyPoints,$PhoneNumber,$address,$dateDelivery,$Note,0,$province,$district);               
                break;

        default:
            echo "Hành động không hợp lệ hoặc không xác định!<br>";
            break;
    }
}

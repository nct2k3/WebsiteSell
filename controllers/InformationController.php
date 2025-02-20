<?php
class InformationController extends BaseController
{
  
    private $AccountsModel;
    private $ProductModel;
    private $CartModel;
    private $UserModel;
    private $InvoiceModel;
    private $InvoiceDetailModel;
    public function __construct()
    {
        $this->AccountsModel = $this->loadModel("AccountsModel");
        $this->CartModel = $this->loadModel("CartModel");
        $this->ProductModel = $this->loadModel("ProductModel");
        $this->UserModel = $this->loadModel("UserModel");
        $this->InvoiceModel = $this->loadModel("InvoiceModel");
        $this->InvoiceDetailModel = $this->loadModel("InvoiceDetailModel");
    }
    
    
    public function index()
    {
        $id = $this->takeIDAccount();
        $dataUser = $this->UserModel->getUserByID($id);
        $dataAccount = $this->AccountsModel->getAccountByIDUser($id);
        $dataInvoice = $this->InvoiceModel->getInvoiceByIDUser($id);
        usort($dataInvoice, function($a, $b) {
                return  $b->invoiceID - $a->invoiceID;
        });
        $dataPament = [];
        $dataWasPayment = [];
    
        if ($dataInvoice != null) {
            foreach ($dataInvoice as $items) {
                $products = [];
                $dataInvoiceDetail = $this->InvoiceDetailModel->getInvoiceDetailByIDUser($items->invoiceID);
                
                foreach ($dataInvoiceDetail as $item) {
                    $products[] = [
                        'product' => $this->ProductModel->getProductByID($item->productID),
                        'quantity' => $item->quantity,
                    ];
                }
    
                if ($items->status == 1) {
                    $status = "confirmed";
                } else if ($items->status == 2) {
                    $status = "being transported";
                } else if ($items->status == 3) {
                    $status = "delivered";
                } else if ($items->status == 4) {
                    $status = "complete";
                } else if ($items->status == 5) {
                    $status = "complete the order";
                } else {
                    $status = "wait for confirmation";
                }
    
                $paymentData = [
                    'products' => $products,
                    'invoice' => $items,
                    'status' => $status,
                ];
    
                if ($items->status != 4) {
                    $dataPament[] = $paymentData;
                } else {
                    $dataWasPayment[] = $paymentData;
                }
            }
        }
        
  
    $this->view('frontEnd.information.index', [
        'dataUser' => $dataUser,
        'Email' => $dataAccount->email,
        'dataPament'=>$dataPament,
        'dataWasPayment'=>$dataWasPayment,
    ]);
}
    public function logout(){
        $_SESSION['AccountID'] = "";
        $_SESSION['Role'] ="";
        $_SESSION['message'] = "Log out successfully!";
        header("Location: /");
        exit();
    }
    public function CancalOder(){
        $InvoiceId = $_GET['ID'];
        $this->InvoiceModel->deleteInvoice($InvoiceId);
        $_SESSION['message'] = "Cancel successfully!";
        $this->index();

    }
    public function change($FullName,$NumberPhone,$Address){

        $id = $this->takeIDAccount();
        $dataUser = $this->UserModel->getUserByID($id);
        $dataFullName=$FullName;
        if($FullName==''){
            $dataFullName=$dataUser->FullName;
        }
        $dataNumberPhone = $NumberPhone;
        if($NumberPhone==''){
            $dataNumberPhone=$dataUser->NumberPhone;
        }
        $dataAddress= $Address;
        if($Address== ''){
            $dataAddress=$dataUser->Address;
        }

        $this->UserModel->updateInformation($dataFullName,$dataNumberPhone,$dataAddress,$id);
        $_SESSION['message'] = "Change successfully!";

        $this->index();
        exit();

    }
    public function UpdateStatus($IdInvoices,$value,$TotalAmount){
        $this->InvoiceModel->UpdateStatus($IdInvoices,$value);
        $id = $this->takeIDAccount();
        $dataUser = $this->UserModel->getUserByID($id);
        $EndTotal=$dataUser->LoyaltyPoints+$TotalAmount/100;
        $this->UserModel->UpdateLoyaltyPoints($id,$EndTotal);
        $_SESSION['message'] = "Change successfully!";
        $this->index();


    }

    public function BuyAgain($InvoiceID){
        print_r($InvoiceID);
        $idUser=$this->takeIDAccount();
        $this->CartModel->deleteById($idUser);
        $dataInvoiceDetail = $this->InvoiceDetailModel->getInvoiceDetailByIDUser($InvoiceID);
        foreach ($dataInvoiceDetail as $item) {
            $Cart = new Cart(
                '',
                 $this->takeIDAccount(),
                $item->productID,
                $item->quantity,
                
            );
            $this->CartModel->createCart($Cart);
        }
        header('Location: /?controller=payment');


    }
    
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;

    switch ($action) {
        case 'change':
            $FullName = $_POST['fullName'] ?? ''; // Đảm bảo có giá trị mặc định
            $NumberPhone = $_POST['phone'] ?? '';
            $Address = $_POST['address'] ?? '';
            

            $InformationController = new InformationController();
            $InformationController->change($FullName, $NumberPhone, $Address);
            break;
            case 'ChangeStatus':
                $Status = 4;
                $IdPayment = $_POST['IdOder'];
                $TotalAmount=$_POST['TotalAmount'];
                $InformationController=new  InformationController();
                $InformationController->UpdateStatus($IdPayment,$Status, $TotalAmount);
            exit();

            case 'Reorder':
                $IdPayment = $_POST['InvoiceID'];
                $InformationController=new  InformationController();
                $InformationController->BuyAgain($IdPayment);


        default:
            echo "Hành động không hợp lệ!";
            break;
    }
}
<?php
class OdermanagerController extends BaseController
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
    $Role=$this->takeRole();
        if($Role==0){
            header("Location: /");
            $_SESSION['error'] = "You do not have a management role";
        }

    $StatusPayment = 5; 
            if (isset($_GET['id']) && $_GET['id'] !== '') {
                $StatusPayment = $_GET['id'];
            }


    $dataInvoice = $this->InvoiceModel->getInvoiceAll($StatusPayment);

    $dataPament = [];
    if ($dataInvoice!=null) {
        foreach ($dataInvoice as $items) {
            $products = [];
            $dataInvoiceDetail = $this->InvoiceDetailModel->getInvoiceDetailByIDUser($items->invoiceID);
            
            foreach ($dataInvoiceDetail as $item) {
                $products[] = [
                    'product' => $this->ProductModel->getProductByID($item->productID),
                    'quantity' => $item->quantity,
                ];
            }
            $status="wait for confirmation";
            if($items->status == 1) {
                $status="confirmed";
            }
            else if($items->status == 2) {
                $status="being transported";
            }
            else if($items->status == 3) {
                $status="delivered";
            }
            else if($items->status == 4) {
                $status="complete";
            }
            
            $dataPament[] = [
                'products' => $products,
                'invoice' => $items,
                'status'=>$status,
    
            ];
        }        
        
    }
    
    $this->view('manager.OderManager.index', [
        'dataPament'=>$dataPament,'donestatus'=>$StatusPayment
    ]);
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
    public function UpdateStatus($Id,$value){

        $this->InvoiceModel->UpdateStatus($Id,$value);
        $_SESSION['message'] = "Change successfully!";
        $this->index();


    }
    
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;

    switch ($action) {
        case 'ChangeStatus':
            $Status = $_POST['Status'];
            $IdPayment = $_POST['IdPayment'];
            $OdermanagerController=new  OdermanagerController();
            $OdermanagerController->UpdateStatus($IdPayment,$Status);
        exit();
        

        default:
            echo "Hành động không hợp lệ!";
            break;
    }
}
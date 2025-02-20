<?php
require_once __DIR__ . '/../vendor/autoload.php';



use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class OdermanagerController extends BaseController
{
  
    private $AccountsModel;
    private $ProductModel;
    private $CartModel;
    private $UserModel;
    private $InvoiceModel;
    private $InvoiceDetailModel;
    private $NotificationManagerModel;
    private $LinkInvoicesModel;
    public function __construct()
    {
        $this->AccountsModel = $this->loadModel("AccountsModel");
        $this->CartModel = $this->loadModel("CartModel");
        $this->ProductModel = $this->loadModel("ProductModel");
        $this->UserModel = $this->loadModel("UserModel");
        $this->InvoiceModel = $this->loadModel("InvoiceModel");
        $this->InvoiceDetailModel = $this->loadModel("InvoiceDetailModel");
        $this->NotificationManagerModel = $this->loadModel("NotificationManagerModel");
        $this->LinkInvoicesModel= $this->loadModel('LinkInvoicesModel');


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
    public function UpdateStatus($Id,$value,$UserID){

        if($value==3){
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $currentTime = date('Y-m-d H:i:s');
            $Notification =new Notification(
                '',
                $UserID,
                $Id,
                'Giao hang thanh cong',
                1,
                $currentTime,
    
            );    
            $this->NotificationManagerModel->createNotification($Notification);
        }
        $this->InvoiceModel->UpdateStatus($Id,$value);
        $_SESSION['message'] = "Change successfully!";
        $this->index();


    }

    public function Fillter($status,$DateFrom,$DateTo)
    {
        $Role=$this->takeRole();
            if($Role==0){
                header("Location: /");
                $_SESSION['error'] = "You do not have a management role";
            }
    
        $dataInvoice = $this->InvoiceModel->getInvoicewithDate($status,$DateFrom,$DateTo);
    
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
            'dataPament'=>$dataPament,'donestatus'=>$status
        ]);
    }

  
        function createInvoiceFile($InvoiceId,$UserID) {

            $dataUser = $this->UserModel->getUserByID($UserID);
            $dataInvoice = $this->InvoiceModel->getInvoiceByID($InvoiceId);
            $dataInvoiceDetail = $this->InvoiceDetailModel->getInvoiceDetailByIDUser($InvoiceId);
            $products = [];
            $stt=1;
            foreach ($dataInvoiceDetail as $item) {
                $products[] = [
                    'STT' => $stt,
                    'ProductName' => $this->ProductModel->getProductByID($item->productID)->productName,
                    'Quantity' => $item->quantity,
                    'UnitPrice' => $this->ProductModel->getProductByID($item->productID)->price,
                    'Total' => $item->quantity * $this->ProductModel->getProductByID($item->productID)->price,
                ];
                $stt++;
            }
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $currentTime = date('Y-m-d H:i:s');

         
            $phpWord = new PhpWord();
            $section = $phpWord->addSection();
        
            $section->addTitle('HÓA ĐƠN', 1);
            $section->addText('Ngày hóa đơn: '.$currentTime);
        
            $section->addText('Người bán: Công ty Iphone Store');
            $section->addText('Tên người bán: Trần Công');
            $section->addText('Địa chỉ: 192,Tân Thới nhất, Quận 12, TP.Hồ Chí Minh');
            $section->addText('Điện thoại:0368731585');
            $section->addText('Email:nguyennrdz@gmail.com');
            $section->addTextBreak();
        
            $section->addText('Người mua: ' . $dataUser->FullName);
            $section->addText('Địa chỉ: ' . $dataUser->Address);
            $section->addText('Điện thoại: ' . $dataUser->PhoneNumber);
            $section->addTextBreak(); 
        
            $table = $section->addTable();
            $table->addRow();
            $table->addCell(2000)->addText('STT');
            $table->addCell(4000)->addText('Tên sản phẩm');
            $table->addCell(2000)->addText('Số lượng');
            $table->addCell(2000)->addText('Đơn giá');
            $table->addCell(2000)->addText('Thành tiền');
        
            foreach ($products as $item) {
                $table->addRow();
                $table->addCell(2000)->addText($item['STT']);
                $table->addCell(4000)->addText($item['ProductName']);
                $table->addCell(2000)->addText($item['Quantity']);
                $table->addCell(2000)->addText(number_format($item['UnitPrice'], 0, ',', '.') . ' Đ');
                $table->addCell(2000)->addText(number_format($item['Total'], 0, ',', '.') . 'Đ');
            }
        
            $section->addTextBreak(); 
            $section->addText('Sản phẩm được đổi trả trong vòng 7 ngày, không hỗ trợ đổi trả khi sản phẩm bị hỏng do người dùng');
            $section->addText('Sản phẩm được bảo hành 12 tháng kể từ ngày sản xuất');

            $section->addText('Tổng tiền: ' .number_format($dataInvoice->totalAmount, 0, ',', '.') . ' Đ');
            $fileName = 'ID_'.$InvoiceId.'_Name_'.$dataUser->FullName.'_hoadon.docx';
            $filePath ='C:/xampp/htdocs/WebsiteSells/public/bill/' . $fileName; 
            $writer = IOFactory::createWriter($phpWord, 'Word2007');
            $writer->save($filePath);
            $check=  $this->LinkInvoicesModel->createLinkInvoice($InvoiceId,$filePath);
            if($check==0){
                $_SESSION['error'] = "Invoice already exists!";
                $this->index();
            }
            else{
            $_SESSION['message'] = " successfully!";
            $this->index();
            }

        }
    
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;

    switch ($action) {
        case 'ChangeStatus':
            $Status = $_POST['Status'];
            $IdPayment = $_POST['IdPayment'];
            $IdUser = $_POST['IdUser'];
            $OdermanagerController=new  OdermanagerController();
            $OdermanagerController->UpdateStatus($IdPayment,$Status,$IdUser);
        exit();

        case 'Fillter':
            $DateFrom = $_POST['DateFrom'];
            $DateTo = $_POST['DateTo'];
            $Status = $_POST['Status'];
            $OdermanagerController=new  OdermanagerController();
           $OdermanagerController->Fillter($Status,$DateFrom,$DateTo);
           exit();
        case 'CreateInvoice':
            
            $IdPayment = $_POST['IdPayment'];
            $IdUser = $_POST['IdUser'];
            $OdermanagerController=new  OdermanagerController();
            $OdermanagerController->createInvoiceFile($IdPayment,$IdUser);
           exit();
        

        default:
            echo "Hành động không hợp lệ!";
            break;
    }
}
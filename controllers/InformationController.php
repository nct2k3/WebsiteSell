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
        $provinces = $this->InvoiceModel->getProvinces(); // Lấy danh sách tỉnh

        if (!empty($dataInvoice)) {
            usort($dataInvoice, function($a, $b) {
                return $b->invoiceID - $a->invoiceID;
            });
        }

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
                    $status = "Đã xác nhận";
                } else if ($items->status == 2) {
                    $status = "Đang vận chuyển";
                } else if ($items->status == 3) {
                    $status = "Đã giao hàng";
                } else if ($items->status == 4) {
                    $status = "Hoàn thành";
                } else if ($items->status == 5) {
                    $status = "Đã hoàn tất đơn hàng";
                } else {
                    $status = "Chờ xác nhận";
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
        $addressParts = explode(', ', $dataUser->Address);
        $specificAddress = $addressParts[0] ?? '';
        $districtName = $addressParts[1] ?? '';
        $provinceName = $addressParts[2] ?? '';

        $this->view('frontEnd.information.index', [
            'dataUser' => $dataUser,
            'Email' => $dataAccount->email,
            'dataPament' => $dataPament,
            'dataWasPayment' => $dataWasPayment,
            'provinces' => $provinces,
            'specificAddress' => $specificAddress,
            'districtName' => $districtName,
            'provinceName' => $provinceName
        ]);
    }
    // đăng xuấtxuất
    public function logout(){
        $_SESSION['AccountID'] = "";
        $_SESSION['Role'] ="";
        $_SESSION['message'] = "Đăng xuất thành công!";
        header("Location: /");
        exit();
    }
    // xóa mua hànghàng
    public function CancalOder(){
        $InvoiceId = $_GET['ID'];
        $this->InvoiceModel->deleteInvoice($InvoiceId);
        $_SESSION['message'] = "Hủy đơn hàng thành công!";
        $this->index();
    }
    public function change($FullName, $NumberPhone, $ProvinceCode, $DistrictCode, $SpecificAddress) {
        $id = $this->takeIDAccount();
        $dataUser = $this->UserModel->getUserByID($id);
    
        $dataFullName = $FullName ?: $dataUser->FullName;
        $dataNumberPhone = $NumberPhone ?: $dataUser->PhoneNumber;
        $dataAddress = $dataUser->Address; 
    
        $isAddressChanged = false;
    
        if (!empty($ProvinceCode) && !empty($DistrictCode) && !empty($SpecificAddress)) {
            $provinceName = $this->InvoiceModel->getProvinceName($ProvinceCode);
            $districtName = $this->InvoiceModel->getDistrictName($DistrictCode);
    
            if ($provinceName && $districtName) {
                $dataAddress = "$SpecificAddress, $districtName, $provinceName";
                $isAddressChanged = true;
            } else {
                $dataAddress = $dataUser->Address;
            }
        }
        $this->UserModel->updateInformation($dataFullName, $dataNumberPhone, $dataAddress, $id);
        if ($dataFullName !== $dataUser->FullName || $dataNumberPhone !== $dataUser->PhoneNumber || $isAddressChanged) {
            $_SESSION['message'] = "Thay đổi thông tin thành công!";
        } else {
            $_SESSION['error'] = "Điền đủ thông tin (Địa chỉ, Quận/Huyện, Tỉnh/Thành phố).";
        }
    
        $this->index();
        exit();
    }
    public function getDistricts() {
        if (isset($_GET['province'])) {
            $province = $_GET['province'];
            $province = str_pad($province, 2, '0', STR_PAD_LEFT); 
            
            $districts = $this->InvoiceModel->getDistricts($province);
            $result = array_map(function($district) {
                return [
                    'code' => $district->code,
                    'name' => $district->name
                ];
            }, $districts);
            header('Content-Type: application/json');
            echo json_encode($result);
            exit;
        }
    }
    // thay đổi trạng thái mua hàng
    public function UpdateStatus($IdInvoices,$value,$TotalAmount){
        $this->InvoiceModel->UpdateStatus($IdInvoices,$value);
        $InvoiceData= $this->InvoiceModel->getInvoiceByID($IdInvoices);
        $id = $this->takeIDAccount();
        $dataUser = $this->UserModel->getUserByID($id);
        $EndTotal=($dataUser->LoyaltyPoints-$InvoiceData->UsePoints)+$TotalAmount/100;
        $this->UserModel->UpdateLoyaltyPoints($id,$EndTotal);
        $_SESSION['message'] = "Thay đổi trạng thái thành công!";
        $this->index();
    }
    // mua lại hàng
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
            $FullName = $_POST['fullName'] ?? '';
            $NumberPhone = $_POST['phone'] ?? '';
            $ProvinceCode = $_POST['ProvinceCode'] ?? '';
            $DistrictCode = $_POST['DistrictCode'] ?? '';
            $SpecificAddress = $_POST['SpecificAddress'] ?? '';
            $InformationController = new InformationController();
            $InformationController->change($FullName, $NumberPhone, $ProvinceCode, $DistrictCode, $SpecificAddress);
            break;
        case 'ChangeStatus':
            if (!isset($_SESSION['form_submitted'])) {
                $Status = 4;
                $IdPayment = $_POST['IdOder'];
                $TotalAmount = $_POST['TotalAmount'];
                $InformationController = new InformationController();
                $InformationController->UpdateStatus($IdPayment, $Status, $TotalAmount);
                $_SESSION['form_submitted'] = true;
            } else {
                $InformationController = new InformationController();
                $InformationController->index();
            }
            exit();
        case 'Reorder':
            $IdPayment = $_POST['InvoiceID'];
            $InformationController = new InformationController();
            $InformationController->BuyAgain($IdPayment);
            break;
        default:
            echo "Hành động không hợp lệ!";
            break;
    }
} elseif (isset($_GET['controller']) && $_GET['controller'] === 'information' && isset($_GET['action']) && $_GET['action'] === 'getDistricts') {
    $InformationController = new InformationController();
    $InformationController->getDistricts();
}
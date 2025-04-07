<?php
require_once __DIR__ . '/../entities/Account.php';
require_once __DIR__ . '/../entities/User.php';
require_once __DIR__ . '/../controllers/BaseController.php';

class RegisterController extends BaseController {
    private $UserModel;
    private $AccountModel;
    private $InvoiceModel;

    public function __construct()
    {
        $this->UserModel = $this->loadModel("UserModel");
        $this->AccountModel = $this->loadModel("AccountsModel");
        $this->InvoiceModel = $this->loadModel("InvoiceModel");
    }

    public function index() {
        $provinces = $this->InvoiceModel->getProvinces();
        $this->view('frontEnd.register.index', [
            'provinces' => $provinces
        ]);
    }

    public function create($Email, $Password, $FullName, $NumberPhone, $ProvinceCode, $DistrictCode, $SpecificAddress) {
        $emailCheck = $this->AccountModel->CheckEmail($Email);
        if ($emailCheck == 1) {
            $_SESSION['error'] = "Email already exists!";
            $this->index();
            exit;
        }

        $provinceName = $this->InvoiceModel->getProvinceName($ProvinceCode);
        $districtName = $this->InvoiceModel->getDistrictName($DistrictCode);
        $Address = "$SpecificAddress, $districtName, $provinceName";

        $User = new User(
            0,
            $FullName,
            $NumberPhone,
            $Address,
            0
        );
        $IdUser = $this->UserModel->createUser($User);
        $account = new Account(
            '',
            $Email,
            $Password,
            0,
            $IdUser
        );
        $Idac = $this->AccountModel->createAccounts($account);
        $_SESSION['AccountID'] = $IdUser;
        $_SESSION['message'] = "Register successfully!";
        header("Location: /"); 
        exit();
    }

    public function getDistricts() {
        if (isset($_GET['province'])) {
            $province = $_GET['province'];
            // Chuẩn hóa giá trị province thành dạng 2 chữ số nếu cần
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
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;
    switch ($action) {
        case 'register':
            $email = $_POST['Email'];
            $password = $_POST['Password'];
            $FullName = $_POST['FullName'];
            $NumberPhone = $_POST['NumberPhone'];
            $ProvinceCode = $_POST['ProvinceCode'];
            $DistrictCode = $_POST['DistrictCode'];
            $SpecificAddress = $_POST['SpecificAddress'];
            $registerController = new RegisterController();
            $registerController->create($email, $password, $FullName, $NumberPhone, $ProvinceCode, $DistrictCode, $SpecificAddress);
            break;
    }
} elseif (isset($_GET['controller']) && $_GET['controller'] === 'register' && isset($_GET['action']) && $_GET['action'] === 'getDistricts') {
    $registerController = new RegisterController();
    $registerController->getDistricts();
}
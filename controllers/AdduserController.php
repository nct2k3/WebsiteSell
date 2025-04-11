<?php
require_once __DIR__ . '/../entities/Account.php';
require_once __DIR__ . '/../entities/User.php';
require_once __DIR__ . '/../controllers/BaseController.php';

class AdduserController extends BaseController {
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
        $this->view('manager.Adduser.index', [
            'provinces' => $provinces
        ]);
    }

    public function create($Email, $Password, $FullName, $NumberPhone, $ProvinceCode, $DistrictCode, $SpecificAddress) {
        $emailCheck = $this->AccountModel->CheckEmail($Email);
        if ($emailCheck == 1) {
            $_SESSION['error'] = "Email đã tồn tại!";
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
        $_SESSION['message'] = "Thêm người dùng thành công!";
        $this->index();
        exit();
    }

    public function getDistricts() {
        if (isset($_GET['province'])) {
            $province = str_pad($_GET['province'], 2, '0', STR_PAD_LEFT);
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
        echo json_encode([]);
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;
    switch ($action) {
        case 'Adduser':
            $email = $_POST['Email'];
            $password = $_POST['Password'];
            $fullName = $_POST['FullName'];
            $numberPhone = $_POST['NumberPhone'];
            $provinceCode = $_POST['ProvinceCode'];
            $districtCode = $_POST['DistrictCode'];
            $specificAddress = $_POST['SpecificAddress'];
            $adduserController = new AdduserController();
            $adduserController->create($email, $password, $fullName, $numberPhone, $provinceCode, $districtCode, $specificAddress);
            break;
        default:
            echo "Hành động không hợp lệ!";
            break;
    }
} elseif (isset($_GET['controller']) && $_GET['controller'] === 'Adduser' && isset($_GET['action']) && $_GET['action'] === 'getDistricts') {
    $adduserController = new AdduserController();
    $adduserController->getDistricts();
}
?>
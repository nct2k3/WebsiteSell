<?php
require_once __DIR__ . '/../entities/Account.php';
require_once __DIR__ . '/../entities/User.php';
require_once __DIR__ . '/../controllers/BaseController.php';

class UsermanagerController extends BaseController
{
    private $UserModel;
    private $AccountModel;
    private $InvoiceModel;

    public function __construct()
    {
        $this->UserModel = $this->loadModel("UserModel");
        $this->AccountModel = $this->loadModel("AccountsModel");
        $this->InvoiceModel = $this->loadModel("InvoiceModel");
    }

    public function index()
    {
        $users = $this->UserModel->getAllUser();
        $dataUser = [];
        $provinces = $this->InvoiceModel->getProvinces();

        foreach ($users as $items) {
            $dataAcc = $this->AccountModel->getAccountByIDUser($items->userID);
            if ($dataAcc->role != 1) {
                $addressParts = explode(', ', $items->Address);
                $specificAddress = $addressParts[0] ?? '';
                $districtName = isset($addressParts[1]) && !empty($addressParts[1]) ? trim($addressParts[1]) : '';
                $provinceName = isset($addressParts[2]) && !empty($addressParts[2]) ? trim($addressParts[2]) : '';
                $provinceCode = '';
                $districtCode = '';

                foreach ($provinces as $p) {
                    if (trim($p->name) === $provinceName) {
                        $provinceCode = $p->code;
                        break;
                    }
                }

                if ($provinceCode && $districtName) {
                    $districts = $this->InvoiceModel->getDistricts($provinceCode);
                    foreach ($districts as $d) {
                        if (trim($d->name) === $districtName) {
                            $districtCode = $d->code;
                            break;
                        }
                    }
                }

                $dataUser[] = [
                    'DataUser' => $items,
                    'DataAcc' => $dataAcc,
                    'ProvinceCode' => $provinceCode,
                    'DistrictCode' => $districtCode,
                    'SpecificAddress' => $specificAddress,
                    'Districts' => $provinceCode ? $this->InvoiceModel->getDistricts($provinceCode) : [],
                    'DistrictName' => $districtName
                ];
            }
        }

        $this->view('manager.UserManager.index', [
            'dataUser' => $dataUser,
            'provinces' => $provinces
        ]);
        exit;
    }

    public function search($string)
    {
        $users = $this->UserModel->getAllUser();
        $dataUser = [];
        $provinces = $this->InvoiceModel->getProvinces();

        foreach ($users as $user) {
            $dataAcc = $this->AccountModel->getAccountByIDUser($user->userID);
            if ($dataAcc->role != 1 && stripos($user->FullName, $string) !== false) {
                $addressParts = explode(', ', $user->Address);
                $specificAddress = $addressParts[0] ?? '';
                $districtName = isset($addressParts[1]) && !empty($addressParts[1]) ? trim($addressParts[1]) : '';
                $provinceName = isset($addressParts[2]) && !empty($addressParts[2]) ? trim($addressParts[2]) : '';
                $provinceCode = '';
                $districtCode = '';

                foreach ($provinces as $p) {
                    if (trim($p->name) === $provinceName) {
                        $provinceCode = $p->code;
                        break;
                    }
                }

                if ($provinceCode && $districtName) {
                    $districts = $this->InvoiceModel->getDistricts($provinceCode);
                    foreach ($districts as $d) {
                        if (trim($d->name) === $districtName) {
                            $districtCode = $d->code;
                            break;
                        }
                    }
                }

                $dataUser[] = [
                    'DataUser' => $user,
                    'DataAcc' => $dataAcc,
                    'ProvinceCode' => $provinceCode,
                    'DistrictCode' => $districtCode,
                    'SpecificAddress' => $specificAddress,
                    'Districts' => $provinceCode ? $this->InvoiceModel->getDistricts($provinceCode) : [],
                    'DistrictName' => $districtName
                ];
            }
        }

        if (count($dataUser) == 0) {
            $_SESSION['error'] = "No users found matching your search.";
        }

        $this->view('manager.UserManager.index', [
            'dataUser' => $dataUser,
            'provinces' => $provinces
        ]);
    }

    public function updateUser($userID, $fullName, $email, $phone, $password, $provinceCode, $districtCode, $specificAddress)
    {
        try {
            $emailCheck = $this->AccountModel->CheckEmail($email);
            if ($emailCheck == 1) {
                $_SESSION['error'] = "Email đã tồn tại!";
                $this->index();
                exit;
            }    
            $currentUser = $this->UserModel->getUserById($userID);
            $currentAddress = $currentUser->Address;

            $originalProvinceCode = $_POST['OriginalProvinceCode'] ?? '';
            $originalDistrictCode = $_POST['OriginalDistrictCode'] ?? '';
            $originalSpecificAddress = $_POST['OriginalSpecificAddress'] ?? '';

            $isAddressChanged = (
                $provinceCode !== $originalProvinceCode ||
                $districtCode !== $originalDistrictCode ||
                $specificAddress !== $originalSpecificAddress
            );

            $newAddress = $currentAddress;
            if ($isAddressChanged) {
                if (empty($provinceCode) || empty($districtCode) || empty($specificAddress)) {
                    throw new Exception("Vui lòng điền đầy đủ Tỉnh/Thành phố, Quận/Huyện và Địa chỉ cụ thể khi thay đổi địa chỉ.");
                }

                $provinceName = $this->InvoiceModel->getProvinceName($provinceCode);
                $districtName = $this->InvoiceModel->getDistrictName($districtCode);
                if ($provinceName && $districtName) {
                    $newAddress = "$specificAddress, $districtName, $provinceName";
                } else {
                    throw new Exception("Không thể lấy thông tin Tỉnh/Quận. Vui lòng thử lại.");
                }
            }

            $userResult = $this->UserModel->updateInformation($fullName, $phone, $newAddress, $userID);
            $accountResult = $this->AccountModel->updateAccount($userID, $email, $password, 0);

            if ($userResult && $accountResult) {
                $_SESSION['message'] = "Update successfully!";
            } else {
                throw new Exception("Update operation failed");
            }
        } catch (Exception $e) {
            $_SESSION['error'] = "Update failed: " . $e->getMessage();
        } finally {
            $this->index();
        }
    }

    public function changeStatus($userID, $currentRole)
    {
        try {
            $newRole = ($currentRole == 0) ? 2 : 0;
            $data = $this->AccountModel->getAccountByIDUser($userID);
            $result = $this->AccountModel->updateAccount($userID, $data->email, $data->password, $newRole);

            if ($result) {
                $_SESSION['message'] = "Status changed successfully!";
            } else {
                throw new Exception("Status change operation failed");
            }
        } catch (Exception $e) {
            $_SESSION['error'] = "Status change failed: " . $e->getMessage();
        } finally {
            $this->index();
        }
    }

    public function getDistricts()
    {
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
    $UsermanagerController = new UsermanagerController();
    switch ($action) {
        case 'edit':
            $userID = $_POST['userID'] ?? '';
            $fullName = $_POST['UserName'] ?? '';
            $email = $_POST['Email'] ?? '';
            $phone = $_POST['Phone'] ?? '';
            $password = $_POST['password'] ?? '';
            $provinceCode = $_POST['ProvinceCode'] ?? '';
            $districtCode = $_POST['DistrictCode'] ?? '';
            $specificAddress = $_POST['SpecificAddress'] ?? '';
            $UsermanagerController->updateUser($userID, $fullName, $email, $phone, $password, $provinceCode, $districtCode, $specificAddress);
            exit();
        case 'changeStatus':
            $userID = $_POST['userID'] ?? '';
            $currentRole = $_POST['currentRole'] ?? '';
            $UsermanagerController->changeStatus($userID, $currentRole);
            exit();
        case 'search':
            $string = $_POST['string'] ?? null;
            if ($string) {
                $UsermanagerController->search($string);
                exit;
            } else {
                $_SESSION['error'] = "There are no users found.";
                $UsermanagerController->index();
                exit;
            }
        default:
            echo "Hành động không hợp lệ!";
            $UsermanagerController->index();
            exit;
    }
} elseif (isset($_GET['controller']) && $_GET['controller'] === 'Usermanager' && isset($_GET['action']) && $_GET['action'] === 'getDistricts') {
    $UsermanagerController = new UsermanagerController();
    $UsermanagerController->getDistricts();
} else {
    $UsermanagerController = new UsermanagerController();
    $UsermanagerController->index();
}
?>
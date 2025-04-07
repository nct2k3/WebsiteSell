<?php
require_once __DIR__ . '/../vendor/autoload.php';
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class OdermanagerController extends BaseController
{
    private $ProductModel;
    private $UserModel;
    private $InvoiceModel;
    private $InvoiceDetailModel;
    private $NotificationManagerModel;
    private $LinkInvoicesModel;

    public function __construct()
    {
        $this->ProductModel = $this->loadModel("ProductModel");
        $this->UserModel = $this->loadModel("UserModel");
        $this->InvoiceModel = $this->loadModel("InvoiceModel");
        $this->InvoiceDetailModel = $this->loadModel("InvoiceDetailModel");
        $this->NotificationManagerModel = $this->loadModel("NotificationManagerModel");
        $this->LinkInvoicesModel = $this->loadModel('LinkInvoicesModel');
    }
    
    public function index()
    {
        $Role = $this->takeRole();
        if ($Role == 0) {
            header("Location: /");
            $_SESSION['error'] = "You do not have a management role";
        }
        $StatusPayment = 5; 
        if (isset($_GET['id']) && $_GET['id'] !== '') {
            $StatusPayment = $_GET['id'];
        }
        $dataInvoice = $this->InvoiceModel->getInvoiceAll($StatusPayment);
        $dataPament = [];
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
                $status = "Chờ xác nhận ";
                if ($items->status == 1) {
                    $status = "Đã xác nhận ";
                } else if ($items->status == 2) {
                    $status = "Đang vận chuyển ";
                } else if ($items->status == 3) {
                    $status = "Giao hàng thành công";
                } else if ($items->status == 4) {
                    $status = "Hoàn tất";
                }
                $dataPament[] = [
                    'products' => $products,
                    'invoice' => $items,
                    'status' => $status,
                ];
            }        
        }
        $provinces = $this->InvoiceModel->getProvinces();
        $this->view('manager.OderManager.index', [
            'dataPament' => $dataPament,
            'donestatus' => $StatusPayment,
            'provinces' => $provinces,
            'selectedProvince' => '', // Mặc định không chọn tỉnh
            'selectedDistrict' => ''  // Mặc định không chọn huyện
        ]);
    }

    public function CancalOder()
    {
        $InvoiceId = $_GET['ID'];
        $this->InvoiceModel->deleteInvoice($InvoiceId);
        $_SESSION['message'] = "Cancel successfully!";
        $this->index();
    }

    public function change($FullName, $NumberPhone, $Address)
    {
        $id = $this->takeIDAccount();
        $dataUser = $this->UserModel->getUserByID($id);
        $dataFullName = $FullName ?: $dataUser->FullName;
        $dataNumberPhone = $NumberPhone ?: $dataUser->NumberPhone;
        $dataAddress = $Address ?: $dataUser->Address;

        $this->UserModel->updateInformation($dataFullName, $dataNumberPhone, $dataAddress, $id);
        $_SESSION['message'] = "Change successfully!";
        $this->index();
        exit();
    }

    public function UpdateStatus($Id, $value, $UserID)
    {
        if ($value == 3) {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $currentTime = date('Y-m-d H:i:s');
            $Notification = new Notification(
                '',
                $UserID,
                $Id,
                'Giao hang thanh cong',
                1,
                $currentTime
            );    
            $this->NotificationManagerModel->createNotification($Notification);
        }
        $check = $this->InvoiceModel->getInvoiceByID($Id);
        if ($check->status > $value) {
            $_SESSION['error'] = "Không thể cập nhập ngược!";
            $this->index();
            exit();
        }
        $this->InvoiceModel->UpdateStatus($Id, $value);
        $_SESSION['message'] = "Change successfully!";
        $this->index();
    }

    public function Fillter($status, $DateFrom, $DateTo)
    {
        $Role = $this->takeRole();
        if ($Role == 0) {
            header("Location: /");
            $_SESSION['error'] = "You do not have a management role";
        }
        $dataInvoice = $this->InvoiceModel->getInvoicewithDate($status, $DateFrom, $DateTo);
        $dataPament = [];
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
                $status = "Chờ xác nhận";
                if ($items->status == 1) {
                    $status = "Đã xác nhận";
                } else if ($items->status == 2) {
                    $status = "Đang vận chuyển";
                } else if ($items->status == 3) {
                    $status = "Giao hàng thành công";
                } else if ($items->status == 4) {
                    $status = "Hoàn tất";
                }
                $dataPament[] = [
                    'products' => $products,
                    'invoice' => $items,
                    'status' => $status,
                ];
            }        
        }
        if (count($dataPament) == 0) {
            $_SESSION['error'] = "Can't find";
            $this->index();
            exit();
        }
        $provinces = $this->InvoiceModel->getProvinces();
        $statusId = $_GET["id"];
        $this->view('manager.OderManager.index', [
            'dataPament' => $dataPament,
            'donestatus' => $statusId,
            'provinces' => $provinces,
            'selectedProvince' => '', // Giữ nguyên lựa chọn tỉnh trống sau khi lọc thời gian
            'selectedDistrict' => ''  // Giữ nguyên lựa chọn huyện trống sau khi lọc thời gian
        ]);
    }

    public function FilterByAddress($status, $ProvinceCode, $DistrictCode)
    {
        $Role = $this->takeRole();
        if ($Role == 0) {
            header("Location: /");
            $_SESSION['error'] = "You do not have a management role";
            exit();
        }

        $dataInvoice = $this->InvoiceModel->getInvoiceAll($status);
        $dataPament = [];

        if ($dataInvoice != null) {
            foreach ($dataInvoice as $items) {
                $addressParts = explode(', ', $items->Address);
                $districtName = $addressParts[1] ?? '';
                $provinceName = $addressParts[2] ?? '';

                $filterProvinceName = $ProvinceCode ? $this->InvoiceModel->getProvinceName($ProvinceCode) : '';
                $filterDistrictName = $DistrictCode ? $this->InvoiceModel->getDistrictName($DistrictCode) : '';

                $match = true;
                if ($ProvinceCode && $provinceName !== $filterProvinceName) {
                    $match = false;
                }
                if ($DistrictCode && $districtName !== $filterDistrictName) {
                    $match = false;
                }

                if ($match) {
                    $products = [];
                    $dataInvoiceDetail = $this->InvoiceDetailModel->getInvoiceDetailByIDUser($items->invoiceID);
                    
                    foreach ($dataInvoiceDetail as $item) {
                        $products[] = [
                            'product' => $this->ProductModel->getProductByID($item->productID),
                            'quantity' => $item->quantity,
                        ];
                    }
                    $statusText = "Chờ xác nhận";
                    if ($items->status == 1) {
                        $statusText = "Đã xác nhận";
                    } else if ($items->status == 2) {
                        $statusText = "Đang vận chuyển";
                    } else if ($items->status == 3) {
                        $statusText = "Giao hàng thành công";
                    } else if ($items->status == 4) {
                        $statusText = "Hoàn tất";
                    }
                    $dataPament[] = [
                        'products' => $products,
                        'invoice' => $items,
                        'status' => $statusText,
                    ];
                }
            }
        }

        if (count($dataPament) == 0) {
            $_SESSION['error'] = "Không tìm thấy đơn hàng nào khớp với địa chỉ!";
            $this->index();
            exit();
        }

        $statusId = $_GET["id"] ?? 5;
        $provinces = $this->InvoiceModel->getProvinces();
        $districts = $ProvinceCode ? $this->InvoiceModel->getDistricts($ProvinceCode) : []; // Lấy danh sách huyện nếu có tỉnh được chọn
        $this->view('manager.OderManager.index', [
            'dataPament' => $dataPament,
            'donestatus' => $statusId,
            'provinces' => $provinces,
            'districts' => $districts,        // Thêm danh sách huyện
            'selectedProvince' => $ProvinceCode,
            'selectedDistrict' => $DistrictCode
        ]);
    }

    public function getDistricts()
    {
        if (isset($_GET['province'])) {
            $province = $_GET['province'];
            $province = str_pad($province, 2, '0', STR_PAD_LEFT); // Chuẩn hóa mã tỉnh nếu cần
            
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
        case 'ChangeStatus':
            $Status = $_POST['Status'];
            $IdPayment = $_POST['IdPayment'];
            $IdUser = $_POST['IdUser'];
            $OdermanagerController = new OdermanagerController();
            $OdermanagerController->UpdateStatus($IdPayment, $Status, $IdUser);
            exit();

        case 'Fillter':
            $DateFrom = $_POST['DateFrom'];
            $DateTo = $_POST['DateTo'];
            $Status = $_POST['Status'];
            $OdermanagerController = new OdermanagerController();
            $OdermanagerController->Fillter($Status, $DateFrom, $DateTo);
            exit();

        case 'FilterByAddress':
            $Status = $_POST['Status'];
            $ProvinceCode = $_POST['ProvinceCode'];
            $DistrictCode = $_POST['DistrictCode'];
            $OdermanagerController = new OdermanagerController();
            $OdermanagerController->FilterByAddress($Status, $ProvinceCode, $DistrictCode);
            exit();

        default:
            echo "Hành động không hợp lệ!";
            break;
    }
} elseif (isset($_GET['controller']) && $_GET['controller'] === 'OderManager' && isset($_GET['action']) && $_GET['action'] === 'getDistricts') {
    $OdermanagerController = new OdermanagerController();
    $OdermanagerController->getDistricts();
}
<?php
require_once __DIR__ . '/../entities/Account.php';
require_once __DIR__ . '/../controllers/BaseController.php';
// require_once __DIR__ . '/../models/RegisterModel.php';

class RegisterController extends BaseController {
    private $RegisterModel;

    public function __construct() {
        $this->RegisterModel = $this->loadModel("RegisterModel");
    }

    public function index() {
        $this->view('frontEnd.register.index');
    }

    public function create($account) {
        $data = [
            'email' => $account->email,
            'password' => password_hash($account->password, PASSWORD_DEFAULT),
            'role' => $account->role,
            'userID' => $account->userID,
        ];

        if ($this->RegisterModel->create('accounts', $data)) {
            echo "Tài khoản được tạo thành công!";
        } else {
            echo "Lỗi khi tạo tài khoản: " . mysqli_error($this->RegisterModel->connect);
        }
    }
}

// Phần xử lý POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;

    switch ($action) {
        case 'create':
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            $userID = $_POST['userID'];

            $account = new Account(null, $email, $password, $role, $userID);
            $registerController = new RegisterController();
            $registerController->create($account);
            break;

        default:
            echo "Hành động không hợp lệ!";
            break;
    }
}
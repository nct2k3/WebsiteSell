<?php
ob_start(); // Bắt đầu output buffering
require_once __DIR__ . '/../entities/Account.php';
require_once __DIR__ . '/../controllers/BaseController.php';

class LoginController extends BaseController {
    private $AccountsModel;

    public function __construct() {
        $this->AccountsModel = $this->loadModel("AccountsModel");
    }

    public function index() {
        $this->view('frontEnd.login.index');
    }

    public function login($email, $password) {
        $temp = $this->AccountsModel->login($email, $password);
        if ($temp === null) {
            $_SESSION['messages'] = "Login false!";
            $this->index(); 
            exit();
        } elseif ($temp->role == 0) {
            $_SESSION['AccountID'] = $temp->userID;
            $_SESSION['message'] = "Login successfully!";
            header("Location: /"); // Chuyển hướng đến trang chủ
            exit();
        }
    }
}

// Xử lý yêu cầu POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;

    switch ($action) {
        case 'login':
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;
            if ($email && $password) {
                $loginController = new LoginController();
                $loginController->login($email, $password);
            } else {
                echo "Email hoặc mật khẩu không hợp lệ!";
            }
            break;

        default:
            echo "Hành động không hợp lệ!";
            break;
    }
}

ob_end_flush(); // Kết thúc output buffering
?>
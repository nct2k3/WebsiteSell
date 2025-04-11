<?php
ob_start(); 
require_once __DIR__ . '/../entities/Account.php';
require_once __DIR__ . '/../controllers/BaseController.php';
require_once __DIR__ . '/../entities/LoginManager.php';

class LoginController extends BaseController {
    private $AccountsModel;
    private $LoginManagerModel;

    public function __construct() {
        $this->AccountsModel = $this->loadModel("AccountsModel");
        $this->LoginManagerModel = $this->loadModel("LoginManagerModels");
    }
    public function index() {
        $this->view('frontEnd.login.index');
    }
    // đăng nhập
    public function login($email, $password) {
        $temp = $this->AccountsModel->login($email, $password);
        if ($temp === null) {
            $_SESSION['messages'] = "Login false!";
            $this->index(); 
            exit();
        } elseif ($temp->role == 0) {
            $_SESSION['AccountID'] = $temp->userID;
            $_SESSION['Role'] = $temp->role;
            $_SESSION['message'] = "Đăng nhập thành công!";
            header("Location: /");
            exit();
        }
        elseif ($temp->role == 1) {
            $_SESSION['AccountID'] = $temp->userID;
            $_SESSION['Role'] = $temp->role;
            $_SESSION['message'] = "Đăng nhập thành công!";
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $currentTime = date('Y-m-d H:i:s');
            $loginmanager = new LoginManager(
                '',
                $temp->userID,
                $currentTime,
                'Login'
            );
            $this->LoginManagerModel->createLoginManager($loginmanager);
            header("Location: /?controller=homeManager"); 
            exit();
        }
        elseif ($temp->role == 2) {
            $_SESSION['error'] = "Tài khoản đã bị khóa vui lòng liện hệ hổ trợ!";
            $this->index(); 
        }

    }
}

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

ob_end_flush(); 
?>
<?php
require_once __DIR__ . '/../entities/Account.php';
require_once __DIR__ . '/../controllers/BaseController.php';
require_once __DIR__ . '/../entities/LoginManager.php';
require_once 'vendor/autoload.php';

class ForgotpasswordController extends BaseController {
    private $AccountsModel;
    private $LoginManagerModel;

    public function __construct() {
        $this->AccountsModel = $this->loadModel("AccountsModel");
        $this->LoginManagerModel = $this->loadModel("LoginManagerModels");
    }

    public function sendEmail($email){
        $account = $this->AccountsModel->getAccountByEmail($email);
        if ($account) {
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
                ->setUsername('nguyennrdz123@gmail.com')
                ->setPassword('heyl njmw paiz tsbt');

            $mailer = new Swift_Mailer($transport);

            $message = (new Swift_Message('Email Khôi Phục Mật Khẩu'))
                ->setFrom(['nguyennrdz123@gmail.com' => 'Tên của bạn'])
                ->setTo([$email => 'Tên người nhận'])
                ->setBody('<h1>Mật Khẩu Của Bạn</h1><p>' . $account->password . '</p>', 'text/html');

            $result = $mailer->send($message);

            if ($result) {
                $_SESSION['message'] = "Kiểm tra mật khẩu trong email của bạn!";
                header("Location:/?controller=login");
                echo "Gửi email thành công!";
            } else {
                $_SESSION['error'] = "Lỗi khi gửi email!";
                echo "Không thể gửi email.";
            }
        } else {
            $_SESSION['error'] = "Email không tồn tại!";
            header("Location:/?controller=forgotpassword");
        }
    }

    public function index() {
        $this->view('frontEnd.ForgotPassWord.index');
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;

    switch ($action) {
        case 'ForgotPassword':
            $email = $_POST['email'] ?? null;
            $ForgotpasswordController = new ForgotpasswordController();
            $ForgotpasswordController->sendEmail($email);
            exit();

        default:
            echo "Hành động không hợp lệ!";
            break;
    }
}
?>
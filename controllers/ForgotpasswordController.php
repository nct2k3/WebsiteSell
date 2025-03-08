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

        $account= $this->AccountsModel->getAccountByEmail($email);
            if($account)
        {        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
                ->setUsername('nguyennrdz123@gmail.com')
                ->setPassword('heyl njmw paiz tsbt');

            $mailer = new Swift_Mailer($transport);

            $message = (new Swift_Message('Test Email'))
                ->setFrom(['nguyennrdz123@gmail.com' => 'Your Name'])
                ->setTo([$email => 'Recipient Name'])
                ->setBody('<h1>Your Password</h1><p>' . $account->password . '</p>', 'text/html');

            $result = $mailer->send($message);

            if ($result) {
                $_SESSION['message'] = "Check the password on your Email!";
                header("Location:/?controller=login");
                echo "Email sent successfully!";
            } else {
                $_SESSION['error'] = "Error send mail!";
                echo "Failed to send email.";
            }
        }
        else{
            $_SESSION['error'] = "Email does not exist!";
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
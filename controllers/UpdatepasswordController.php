<?php
require_once __DIR__ . '/../entities/Account.php';
require_once __DIR__ . '/../controllers/BaseController.php';


class UpdatepasswordController extends BaseController {
    private $AccountsModel;

    public function __construct() {
        $this->AccountsModel = $this->loadModel("AccountsModel");
      
    }
    public function index() {
        $this->view('frontEnd.Updatepassword.index');
    }
    // đăng nhập
    public function Updatepassword($email, $password, $NewPassword, $ConfirmPassword) {
        if ($ConfirmPassword != $NewPassword) {
            $_SESSION['error'] = "NewPassword not match !";
            $this->index();
        }
        $temp = $this->AccountsModel->login($email, $password);
        if ($temp == null) {
            $_SESSION['error'] = "Email or password not match!";
            $this->index();
        } else {
            $this->AccountsModel->updateString('accounts','Password',$NewPassword,$temp->accountID ,'AccountID');
            $_SESSION['message'] = "Update password successfully!";
            $this->view('frontEnd.login.index');
        }

    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;

    switch ($action) {
        case 'Updatepassword':
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;
            $NewPassword= $_POST['NewPassword']?? null;
            $ConfirmPassword= $_POST['ConfirmPassword']?? null;
            if ($email && $password && $NewPassword && $ConfirmPassword) {
                $UpdatepasswordController = new UpdatepasswordController();
                $UpdatepasswordController->Updatepassword($email, $password, $NewPassword, $ConfirmPassword);
            } else {
                echo "Email hoặc mật khẩu không hợp lệ!";
            }
            
            break;

        default:
            echo "Hành động không hợp lệ!";
            break;
    }
}
?>
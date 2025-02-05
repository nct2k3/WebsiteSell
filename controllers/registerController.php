<?php
require_once __DIR__ . '/../entities/Account.php';
require_once __DIR__ .'/../entities/User.php';
require_once __DIR__ . '/../controllers/BaseController.php';


class RegisterController extends BaseController {
 

    private $UserModel;
    private $AccountModel;

    public function __construct()
    {
        
        $this->UserModel = $this->loadModel("UserModel");
        $this->AccountModel = $this->loadModel("AccountsModel");
    }

    public function index() {
        $this->view('frontEnd.register.index');
    }

    public function create($Email,$Password,$FullName,$NumberPhone,$Address) {

        $emailCheck= $this->AccountModel->CheckEmail($Email);
        if($emailCheck==1) {
            $_SESSION['error'] = "Email already exists!";
            $this->index();
            exit;
        }
        $User = new User(
            0,
            $FullName,
            $NumberPhone,
            $Address,
            0,        
        );
        $IdUser= $this->UserModel->createUser($User);
        $account= new Account(

            '',
            $Email,
            $Password,
            0,
            $IdUser
        );

        $Idac= $this->AccountModel->createAccounts($account);
        $_SESSION['AccountID'] = $IdUser;
            $_SESSION['message'] = "Register successfully!";
            header("Location: /"); 
            exit();
       
    }
}

// Phần xử lý POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;

    switch ($action) {
        case 'register':
            $email = $_POST['Email'];
            $password = $_POST['Password'];
            $FullName = $_POST['FullName'];
            $NumberPhone= $_POST['NumberPhone'];
            $Address= $_POST['Address'];
            
            $registerController = new RegisterController();
            $registerController->create($email,$password,$FullName,$NumberPhone,$Address);
            break;

        default:
            echo "Hành động không hợp lệ!";
            break;
    }
}

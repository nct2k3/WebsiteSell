<?php
require_once __DIR__ . '/../entities/Notification.php';

class NotificationManagerController extends BaseController {
 
   
    private $NotificationManagerModel;

    private $InvoiceModel;

    private $LoginManagerModel;

    public function __construct()
    {
        
        $this->NotificationManagerModel = $this->loadModel("NotificationManagerModel");
        $this->InvoiceModel = $this->loadModel("InvoiceModel");
        $this->LoginManagerModel = $this->loadModel("LoginManagerModels");
        
    }
    public function index() {

        $IdOder=$_GET['idOder'];
        $IdUser=$_GET['idUser'];
   
        $this->view('manager.NotificationManager.index',['IdOder'=>$IdOder,'IdUser'=>$IdUser  ] );
    }

    public function DeleteOder($OderID,$UserID,$Content) {

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $currentTime = date('Y-m-d H:i:s');
        $Notification =new Notification(
            '',
            $UserID,
            $Content,
            0,
            $currentTime,

        );   
        $this->InvoiceModel->deleteInvoice($OderID);   
        $this->NotificationManagerModel->createNotification($Notification);
        $temp= $_SESSION['AccountID'] ;
        $loginmanager = new LoginManager(
            '',
            $temp,
            $currentTime,
            'Delete Oder'
        );
        $this->LoginManagerModel->createLoginManager($loginmanager);
        $_SESSION['message'] = "Delete successfully!";
        header("Location: /?controller=OderManager&id=5");
    }

}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;

    switch ($action) {
        case 'DeleteOder':
            $OderID = $_POST['oderID'];
            $UserID= $_POST['userID'];
            $Content = $_POST['content'];
            $NotificationManagerController = new NotificationManagerController();
             $NotificationManagerController->DeleteOder($OderID,$UserID,$Content);
            exit();

        default:
            echo "Hành động không hợp lệ!";
            break;
    }
}


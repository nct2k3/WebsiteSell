<?php


class NotificationController extends BaseController {
 
   
    
    private $NotificationManagerModel;

    private $InvoiceModel;

    public function __construct()
    {
        
        $this->NotificationManagerModel = $this->loadModel("NotificationManagerModel");
        $this->InvoiceModel = $this->loadModel("InvoiceModel");
       
        
    }
    public function index() {
   
        $idUser = $this->takeIDAccount();
        $data = $this->NotificationManagerModel->getNotificationWithId($idUser);
        $this->view('frontEnd.Notification.index', [
            'data' => $data,
        ]);
       
    }

   
}


// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $action = $_POST['action'] ?? null;

//     switch ($action) {
//         case 'DeleteOder':
//             $OderID = $_POST['oderID'];
//             $UserID= $_POST['userID'];
//             $Content = $_POST['content'];
//             $NotificationController = new NotificationController();
//              $NotificationController->DeleteOder($OderID,$UserID,$Content);
//             exit();

//         default:
//             echo "Hành động không hợp lệ!";
//             break;
//     }
// }


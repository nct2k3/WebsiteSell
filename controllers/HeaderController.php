<?php
class HeaderController extends BaseController
{
    private $UserModel;
    private $ProductModel;
    private $NotificationManagerModel;
    public function __construct()
    {
        $this->UserModel = $this->loadModel("UserModel");
        $this->ProductModel = $this->loadModel("ProductModel");
        $this->NotificationManagerModel = $this->loadModel("NotificationManagerModel");
    }
    public function index() {
        $accountID = $this->takeIDAccount();
        $numNotification = count($this->NotificationManagerModel->getNotificationWithId($accountID));
        $dataUser = $this->UserModel->getUserByID($accountID);
        $_SESSION['Product'] = json_encode($this->ProductModel->getAllProduct());
        if ($dataUser) {
            $data = [
                'username' => $dataUser->FullName,
                'userID' => $dataUser->userID,
                'NumNotification' => $numNotification,
            ];
        } else {
            $data = [];
        }
        
        $this->view('frontEnd.header.index', $data);
    }
}
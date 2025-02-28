<?php
class HeaderController extends BaseController
{
    private $UserModel;
    private $ProductModel;
    private $NotificationManagerModel;
    private $AccountsModel;
    public function __construct()
    {
        $this->UserModel = $this->loadModel("UserModel");
        $this->ProductModel = $this->loadModel("ProductModel");
        $this->NotificationManagerModel = $this->loadModel("NotificationManagerModel");
        $this->AccountsModel = $this->loadModel("AccountsModel");

    }
    public function index() {
        $accountID = $this->takeIDAccount();

        $numNotification = count($this->NotificationManagerModel->getNotificationWithId($accountID));
        $dataUser = $this->UserModel->getUserByID($accountID);
        if($dataUser){
        $dataAc= $this->AccountsModel->getAccountByIDUser($dataUser->userID);
        }
        $_SESSION['Product'] = json_encode($this->ProductModel->getAllProduct());
        if ($dataUser) {
            $data = [
                'username' => $dataUser->FullName,
                'userID' => $dataUser->userID,
                'NumNotification' => $numNotification,
                'Role'=>$dataAc->role
                
            ];
        } else {
            $data = [];
        }
        
        $this->view('frontEnd.header.index', $data);
    }
}
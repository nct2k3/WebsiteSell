<?php
class HeaderController extends BaseController
{
    private $UserModel;
    private $ProductModel;
    private $NotificationManagerModel;
    private $AccountsModel;
    private $CartModel;
    public function __construct()
    {
        $this->UserModel = $this->loadModel("UserModel");
        $this->ProductModel = $this->loadModel("ProductModel");
        $this->NotificationManagerModel = $this->loadModel("NotificationManagerModel");
        $this->AccountsModel = $this->loadModel("AccountsModel");
        $this->CartModel = $this->loadModel("CartModel");


    }
    public function index() {
        $accountID = $this->takeIDAccount();

        $notifications = $this->NotificationManagerModel->getNotificationWithId($accountID);
        $numNotification = $notifications ? count($notifications) : 0;
        $cartItems = $this->CartModel->getCart($accountID);
        $cart = $cartItems ? count($cartItems) : 0;
        
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
                'Cart' => $cart,
                'Role'=>$dataAc->role
                
            ];
        } else {
            $data = [];
        }
        
        $this->view('frontEnd.header.index', $data);
    }
}
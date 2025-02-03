<?php
class HeaderController extends BaseController
{

    private $UserModel;
    private $ProductModel;
    public function __construct()
    {
        $this->UserModel = $this->loadModel("UserModel");
        $this->ProductModel = $this->loadModel("ProductModel");
    }

    public function index() {
        $accountID = $this->takeIDAccount();
        $dataUser = $this->UserModel->getUserByID($accountID);
        $_SESSION['Product'] = json_encode($this->ProductModel->getAllProduct());
        if ($dataUser) {
            $data = [
                'username' => $dataUser->FullName,
                'userID' => $dataUser->userID
            ];
        } else {
            $data = [];
        }
        
        $this->view('frontEnd.header.index', $data);
    }


    
}
<?php
class HeaderController extends BaseController
{

    private $UserModel;
    public function __construct()
    {
        $this->UserModel = $this->loadModel("UserModel");
    }

    public function index() {
        $accountID = $this->takeIDAccount();
        $dataUser = $this->UserModel->getUserByID($accountID);
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
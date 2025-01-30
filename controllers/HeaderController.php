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
        $dataUser= $this->UserModel->getUserByID($accountID);
        $data = ['username'=>$dataUser->FullName,'userID'=>$dataUser->userID];
        $this->view('frontEnd.header.index', $data);
        
    }


    
}
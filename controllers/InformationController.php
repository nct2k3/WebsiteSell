<?php
class InformationController extends BaseController
{
    private $ProductModel;
    private $UserModel;
    private $AccountsModel;

    public function __construct()
    {
       
        $this->ProductModel = $this->loadModel("ProductModel");
        $this->AccountsModel = $this->loadModel("AccountsModel");
        $this->UserModel = $this->loadModel("UserModel");
        
    }
    
    public function index()
    {
        $id = $_GET['user'];
        $dataUser= $this->UserModel->getUserByID($id);
        $dataAccount= $this->AccountsModel->getAccountByIDUser($id);
        $this->view('frontEnd.information.index',[ 'dataUser'=>$dataUser,'Email'=>$dataAccount->email]);
    }
    public function logout(){
        $_SESSION['AccountID'] = "";
        $_SESSION['message'] = "Đăng xuất thành công!";
        header("Location: /");
        exit();
    }
    
}
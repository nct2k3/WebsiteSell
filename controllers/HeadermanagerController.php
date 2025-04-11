<?php
class HeadermanagerController extends BaseController
{
    private $LoginManagerModel;
    public function __construct()
    {
        $this->LoginManagerModel = $this->loadModel("LoginManagerModels");
    }
    public function index()
    {
        $this->view('manager.HeaderManager.index');
    }
    public function logout(){
        $temp= $_SESSION['AccountID'] ;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $currentTime = date('Y-m-d H:i:s');
        $loginmanager = new LoginManager(
            '',
            $temp,
            $currentTime,
            'Logout'
        );
        $this->LoginManagerModel->createLoginManager($loginmanager);
        $_SESSION['AccountID'] = "";
        $_SESSION['Role'] ="";
        $_SESSION['message'] = "Đăng xuất thành công!";
        header("Location: /");
        exit();
    }
}
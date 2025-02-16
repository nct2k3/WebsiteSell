<?php
class HeadermanagerController extends BaseController
{


    public function __construct()
    {
    
    }
    public function index()
    {
        $this->view('manager.HeaderManager.index');
    }
    public function logout(){
        $_SESSION['AccountID'] = "";
        $_SESSION['Role'] ="";
        $_SESSION['message'] = "Log out successfully!";
        header("Location: /");
        exit();
    }

    
}
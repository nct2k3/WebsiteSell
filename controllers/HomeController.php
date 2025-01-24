<?php
class HomeController extends BaseController
{
    private $AccountsModel;

    public function __construct()
    {
        $this->AccountsModel = $this->loadModel("AccountsModel");
    }

    public function index()
    {
        $accounts = $this->AccountsModel->getAllAccounts();
        
        // Render view với dữ liệu bien
        $this->view('frontEnd.home.index', ['accounts' => $accounts]);
    }
}
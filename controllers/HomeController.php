<?php
class HomeController extends BaseController
{
    private $ProductModel;

    public function __construct()
    {
        $this->ProductModel = $this->loadModel("ProductModel");
    }
    
    public function index()
    {
        $ProductIphone = $this->ProductModel->getByIdGroup(1);
        $ProductMacbock = $this->ProductModel->getByIdGroup(2);
        $ProductIPad = $this->ProductModel->getByIdGroup(5);
        $ProductWatch = $this->ProductModel->getByIdGroup(4);
        // Render view với dữ liệu bien
        $this->view('frontEnd.home.index', ['ProductIphone' => $ProductIphone,
        'ProductMacbock'=>$ProductMacbock,'ProductIPad'=>$ProductIPad,'ProductWatch'=>$ProductWatch
    
    ]);
    }
    
}
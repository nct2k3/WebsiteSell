<?php
class InformationproductController extends BaseController
{
    public function __construct()
    {
    }
    public function index()
    {
        $this->view('manager.InformationProduct.index');
    }
    
}
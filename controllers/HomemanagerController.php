<?php
class HomemanagerController extends BaseController
{


    public function __construct()
    {
    
    }
    public function index()
    {
        $this->view('manager.HomeManager.index');
    }
    
}
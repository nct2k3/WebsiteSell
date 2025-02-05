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
    
}
<?php



class ActionManagerController extends BaseController {
 

    
    private $LoginManagerModel;

    public function __construct()
    {
        
        $this->LoginManagerModel = $this->loadModel("LoginManagerModels");
       
    }

    public function index() {
        $data = $this->LoginManagerModel-> getLoginManagerAll();
        $this->view('manager.ActionManager.index', [
            'data' => $data,
        ]);
    }

}


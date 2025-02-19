<?php

class LoginManager
{
    public $ID;
    public $UserID ;
    public $TimeLogin	;
    public $Action;


    public function __construct($ID, $UserID, $TimeLogin, $Action)
    {
        $this->ID = $ID;
        $this->UserID = $UserID;
        $this->TimeLogin = $TimeLogin;
        $this->Action = $Action;
    }
   
}
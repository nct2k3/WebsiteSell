<?php

class Account
{
    public $accountID;
    public $email;
    public $password;
    public $role;
    public $userID;

    public function __construct($accountID, $email, $password, $role, $userID)
    {
        $this->accountID = $accountID;
        $this->email = $email;
        $this->password = $password; 
        $this->role = $role;
        $this->userID = $userID;
    }
}
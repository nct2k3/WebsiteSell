<?php

class User
{
    public $userID;
    public  $FullName;
    public $Email;
    public  $PhoneNumber;
    public $Address;
    public $JoinDate;
    public $LoyaltyPoints;

    public function __construct($userId, $fullName, $email, $phoneNumber = null, $address = null, $joinDate = null, $loyaltyPoints = 0)
    {
        $this->userID = $userId;
        $this->FullName = $fullName;
        $this->Email = $email;
        $this->PhoneNumber = $phoneNumber;
        $this->Address = $address;
        $this->JoinDate = $joinDate ?: date('Y-m-d');
        $this->LoyaltyPoints = $loyaltyPoints;
    }
}

?>
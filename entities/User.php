<?php

class User
{
    public $userID;
    public  $FullName;
    public  $PhoneNumber;
    public $Address;
    public $LoyaltyPoints;
    
    public function __construct($userId, $fullName, $phoneNumber = null, $address = null,$loyaltyPoints = 0)
    {
        $this->userID = $userId;
        $this->FullName = $fullName;
        $this->PhoneNumber = $phoneNumber;
        $this->Address = $address;
        $this->LoyaltyPoints = $loyaltyPoints;
    }
}

?>
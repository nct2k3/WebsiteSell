<?php

class Cart
{
    public $CartID;
    public $UserID;
    public $ProductID;
    public $Quantity;
    public function __construct($CartID, $UserID, $ProductID ,$Quantity)
    {
        $this->CartID = $CartID;
        $this->UserID = $UserID;
        $this->ProductID = $ProductID;
        $this->Quantity = $Quantity;
    }
}
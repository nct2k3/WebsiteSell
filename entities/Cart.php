<?php

class Cart
{
    public $CartID;
    public $UserID;
    public $ProductID;

    public function __construct($CartID, $UserID, $ProductID)
    {
        $this->CartID = $CartID;
        $this->UserID = $UserID;
        $this->ProductID = $ProductID;
    }
}
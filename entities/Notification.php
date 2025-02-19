<?php

class Notification
{
    public $ID;
    public $UserID ;
    public $InvoiceID	;
    public $Content	;
    public $Status;
    public $Time;


    public function __construct($ID, $UserID,$InvoiceID , $Content, $Status, $Time)
    {
        $this->ID = $ID;
        $this->UserID = $UserID;
        $this->InvoiceID = $InvoiceID;
        $this->Content = $Content;
        $this->Status = $Status;
        $this->Time = $Time;
    }
   
}
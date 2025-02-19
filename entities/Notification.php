<?php

class Notification
{
    public $ID;
    public $UserID ;
    public $Content	;
    public $Status;
    public $Time;


    public function __construct($ID, $UserID, $Content, $Status, $Time)
    {
        $this->ID = $ID;
        $this->UserID = $UserID;
        $this->Content = $Content;
        $this->Status = $Status;
        $this->Time = $Time;
    }
   
}
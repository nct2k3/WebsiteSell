<?php

class Invoice {
    public $invoiceID;
    public $userID;
    public $invoiceDate;
    public $totalAmount;
    public $status;
    public $paymentType;
    public $NumberPhone;

    public $Address;

    // Constructor
    public function __construct($invoiceID, $userID, $invoiceDate,
     $totalAmount, $status, $paymentType,$NumberPhone,$Address) {
        $this->invoiceID = $invoiceID;
        $this->userID = $userID;
        $this->invoiceDate = $invoiceDate;
        $this->totalAmount = $totalAmount;
        $this->status = $status;
        $this->paymentType = $paymentType;
        $this->NumberPhone = $NumberPhone;
        $this->Address = $Address;
    }

}
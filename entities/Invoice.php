<?php

class Invoice {
    public $invoiceID;
    public $userID;
    public $invoiceDate;
    public $totalAmount;
    public $status;
    public $paymentType;

    // Constructor
    public function __construct($invoiceID, $userID, $invoiceDate, $totalAmount, $status, $paymentType) {
        $this->invoiceID = $invoiceID;
        $this->userID = $userID;
        $this->invoiceDate = $invoiceDate;
        $this->totalAmount = $totalAmount;
        $this->status = $status;
        $this->paymentType = $paymentType;
    }

}
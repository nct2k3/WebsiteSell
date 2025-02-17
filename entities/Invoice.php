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

    public $DateDelivery;

    public $Note;

    public function __construct($invoiceID, $userID, $invoiceDate,
     $totalAmount, $status, $paymentType,$NumberPhone,$Address,$DateDelivery ,$Note) {
        $this->invoiceID = $invoiceID;
        $this->userID = $userID;
        $this->invoiceDate = $invoiceDate;
        $this->totalAmount = $totalAmount;
        $this->status = $status;
        $this->paymentType = $paymentType;
        $this->NumberPhone = $NumberPhone;
        $this->Address = $Address;
        $this->DateDelivery = $DateDelivery;
        $this->Note = $Note;
    }

}
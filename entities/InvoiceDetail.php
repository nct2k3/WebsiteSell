<?php

class InvoiceDetail {
    public $detailID;
    public $invoiceID;
    public $productID;
    public $quantity;
 

    // Constructor
    public function __construct($detailID, $invoiceID, $productID, $quantity) {
        $this->detailID = $detailID;
        $this->invoiceID = $invoiceID;
        $this->productID = $productID;
        $this->quantity = $quantity;
    }
}
<?php
require_once __DIR__ . '/../entities/InvoiceDetail.php';

class InvoiceDetailModel extends BaseModel
{
    public function createInvoice($Invoice) {
        $invoiceData = [
           
            'InvoiceID' => $Invoice->invoiceID,
            'ProductID' => $Invoice->productID,
            'Quantity' => $Invoice->quantity,
        ];
    
        $this->create('invoicedetails', $invoiceData); 
       
    }
}
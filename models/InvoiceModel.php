<?php
require_once __DIR__ . '/../entities/Invoice.php';

class InvoiceModel extends BaseModel
{
    public function createInvoice($Invoice) {
        $invoiceData = [
            'UserID' => $Invoice->userID,
            'InvoiceDate' => $Invoice->invoiceDate,
            'TotalAmount' => $Invoice->totalAmount,
            'Status' => $Invoice->status,
            'PaymentType' => $Invoice->paymentType,
        ];
        return $this->createReturnID('invoices', $invoiceData);
    }
}
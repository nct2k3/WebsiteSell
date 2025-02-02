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
    public function getInvoiceByIDUser($UserID) {
        $datas = $this->getListById('invoices', $UserID, 'UserID');
        if (empty($datas)) {
            return null; 
        }
        $Invoice = [];

        foreach ($datas as $data) {
        $Invoice[] = new Invoice(
            $data['InvoiceID'],
            $data['UserID'],
            $data['InvoiceDate'],
            $data['TotalAmount'],
            $data['status']    ,
            $data['PaymentType'] 
        );
    }
        return $Invoice;
        
    }

    public function deleteInvoice($InvoiceId) {
         $this->deleteID('invoices', $InvoiceId,'InvoiceID');

    }
}
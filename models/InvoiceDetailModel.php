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
    public function getInvoiceDetailByIDUser($InvoiceID)
{
    
    $data = $this->getListById('invoicedetails', $InvoiceID, 'InvoiceID');
        $InvoiceDetail = [];

        foreach ($data as $row) {
            $InvoiceDetail[] = new InvoiceDetail(
                $row['DetailID'], 
                $row['InvoiceID'],     
                $row['ProductID'], 
                $row['Quantity']
            );
        }
        return $InvoiceDetail; 
}
}
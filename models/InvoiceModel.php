<?php
require_once __DIR__ . '/../entities/Invoice.php';
require_once __DIR__ .'./InvoiceDetailModel.php';
require_once __DIR__ .'./ProductModel.php';

class InvoiceModel extends BaseModel
{
    public function createInvoice($Invoice) {
        $invoiceData = [
            'UserID' => $Invoice->userID,
            'InvoiceDate' => $Invoice->invoiceDate,
            'TotalAmount' => $Invoice->totalAmount,
            'Status' => $Invoice->status,
            'PaymentType' => $Invoice->paymentType,
            'NumberPhone'=>$Invoice->NumberPhone,
            'Address'=> $Invoice->Address,
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
            $data['PaymentType'] ,
            $data['NumberPhone'],
            $data['Address']
        );
    }
        return $Invoice;
        
    }

    public function deleteInvoice($InvoiceId) {
        $InvoiceDetailmodel=new InvoiceDetailModel();
        $InvoiceDetail= $InvoiceDetailmodel->getInvoiceDetailByIDUser($InvoiceId);
        foreach ($InvoiceDetail as $data) {
            $productModel= new ProductModel();
            $product = $productModel->getProductByID($data->productID);
            $endQuantity= $product->stock + $data->quantity;
            $sql="UPDATE products SET Stock = $endQuantity WHERE ProductID = $data->productID";
            print_r($sql);
            $this->UpdateCustome($sql);
        }

         $this->deleteID('invoices', $InvoiceId,'InvoiceID');

    }
}
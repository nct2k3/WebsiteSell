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
            'DateDelivery'=>$Invoice->DateDelivery
            ,'Note'=>$Invoice->Note
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
            $data['Address'],
            $data['DateDelivery'],
            $data['Note']
        );
    }
        return $Invoice;
    }
    public function getInvoiceBystatus($status) {
        $datas = $this->getListById('invoices', $status, 'status');
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
            $data['Address'],
            $data['DateDelivery'],
            $data['Note']
        );
    }
        return $Invoice;
    }
    public function getInvoiceByID($id) {
        $datas = $this->getListById('invoices', $id, 'InvoiceID');
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
            $data['Address'],
            $data['DateDelivery'],
            $data['Note']
        );
    }
        return $Invoice[0];
    }


    public function getInvoiceAll($status) {
        $sql="";
        if ($status == 5) {
        $sql="SELECT * FROM invoices WHERE  status!=4";
        }
        else if ($status == 4) {
            $sql="SELECT * FROM invoices WHERE status=$status";
        }
        $datas = $this->getCustome($sql);
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
            $data['Address'],
            $data['DateDelivery'],
            $data['Note']
        );
    }
        return $Invoice;
    }
    public function getInvoicewithDate($status,$DateFrom,$DateTo) {

        $sql="";
        if ($status == 5) {
        $sql="SELECT * FROM invoices WHERE  status!=4 and InvoiceDate BETWEEN '$DateFrom' And '$DateTo'";
        }
        else if ($status == 4) {
            $sql="SELECT * FROM invoices WHERE status=$status and InvoiceDate BETWEEN '$DateFrom' And '$DateTo'";
        }
        $datas = $this->getCustome($sql);
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
            $data['Address'],
            $data['DateDelivery'],
            $data['Note']
        );
    }
        return $Invoice;
    }

    public function getInvoiceByyearAndMoth($Year,$Moth) {
        $Sql="SELECT * FROM invoices WHERE YEAR(InvoiceDate)=$Year AND MONTH(InvoiceDate)=$Moth";
        $datas = $this->getCustome($Sql);
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
            $data['Address'],
            $data['DateDelivery'],
            $data['Note']
        );
    }
        return $Invoice;
    }

    public function getInvoiceByYear($Year) {
        $Sql="SELECT * FROM invoices WHERE YEAR(InvoiceDate)=$Year";
        $datas = $this->getCustome($Sql);
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
            $data['Address'],
            $data['DateDelivery'],
            $data['Note']
        );
    }
        return $Invoice;
    }


    public function UpdateStatus($invoiceId,$Vaule) {
        $sql="UPDATE invoices SET status=$Vaule WHERE InvoiceID=$invoiceId";
       $this->UpdateCustome($sql);
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
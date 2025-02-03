<?php
require_once __DIR__ . '/../entities/InvoiceDetail.php';
require_once __DIR__ .'./ProductModel.php';
require_once __DIR__ . '/../entities/Product.php';


class InvoiceDetailModel extends BaseModel
{
    public function createInvoice($Invoice) {
        $invoiceData = [
           
            'InvoiceID' => $Invoice->invoiceID,
            'ProductID' => $Invoice->productID,
            'Quantity' => $Invoice->quantity,
        ];
        $productModel= new ProductModel();
        $product = $productModel->getProductByID($Invoice->productID);

        $endQuantity= $product->stock - $Invoice->quantity;

        $sql="UPDATE products SET Stock = $endQuantity WHERE ProductID = $Invoice->productID";
        print_r($sql);
        $this->UpdateCustome($sql);
    
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
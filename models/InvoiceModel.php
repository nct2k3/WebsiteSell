<?php
require_once __DIR__ . '/../entities/Invoice.php';
require_once __DIR__ .'/../entities/provinces.php';
require_once __DIR__.'/../entities/districts.php';
require_once __DIR__ .'./InvoiceDetailModel.php';
require_once __DIR__ .'./ProductModel.php';
class InvoiceModel extends BaseModel
{
    // creat
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
            ,'UsePoints'=>$Invoice->UsePoints
        ];
        return $this->createReturnID('invoices', $invoiceData);
    }
    //get
    public function getProvinces() {
        try {
            $sql = "SELECT * FROM `provinces`";
            $datas = $this->getCustome($sql);
            
            $provinces = []; 
            if (!empty($datas) && is_array($datas)) {
                foreach ($datas as $data) {
                    $provinces[] = new Provinces(
                        (int)$data['code'], 
                        (string)$data['name'] 
                    );
                }
            }
            return $provinces;
        } catch (Exception $e) {
            // Xử lý lỗi nếu cần
            error_log("Error in getProvinces: " . $e->getMessage());
            return [];
        }
    }

    public function getDistricts($code_province) {
        try {
            $sql = "SELECT * FROM `districts` WHERE province_code = $code_province";
            $datas = $this->getCustome($sql);
            
            $districts = []; 
            if (!empty($datas) && is_array($datas)) {
                foreach ($datas as $data) {
                    $districts[] = new Districts(
                        (int)$data['code'], 
                        (string)$data['name'], 
                        (int)$code_province 
                    );
                }
            }
            return $districts;
        } catch (Exception $e) {
            // Xử lý lỗi nếu cần
            error_log("Error in getDistricts: " . $e->getMessage());
            return [];
        }
    }
    public function getProvinceName($provinceCode) {
        try {
            $sql = "SELECT name FROM `provinces` WHERE code = $provinceCode";
            $datas = $this->getCustome($sql); 
    
            if (!empty($datas) && isset($datas[0]['name'])) {
                return $datas[0]['name'];
            }
            return null; // Không tìm thấy
        } catch (Exception $e) {
            error_log("Error in getProvinceName: " . $e->getMessage());
            return null;
        }
    }
    public function getDistrictName($districtCode) {
        try {
            $sql = "SELECT name FROM `districts` WHERE code = $districtCode";
            $datas = $this->getCustome($sql);
    
            if (!empty($datas) && isset($datas[0]['name'])) {
                return $datas[0]['name'];
            }
            return null;
        } catch (Exception $e) {
            error_log("Error in getDistrictName: " . $e->getMessage());
            return null;
        }
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
            $data['Note'],
            $data['UsePoints']
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
            $data['Note'],
            $data['UsePoints']
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
            $data['Note'],
            $data['UsePoints']
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
            $data['Note'],
            $data['UsePoints']

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
            $data['Note'],
            $data['UsePoints']
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
            $data['Note'],
            $data['UsePoints']
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
            $data['Note'],
            $data['UsePoints']
        );
    }
        return $Invoice;
    }

    // update 
    public function UpdateStatus($invoiceId,$Vaule) {
        $sql="UPDATE invoices SET status=$Vaule WHERE InvoiceID=$invoiceId";
       $this->UpdateCustome($sql);
    }

    // delete
    public function deleteInvoice($InvoiceId) {
        $InvoiceDetailmodel=new InvoiceDetailModel();
        $InvoiceDetail= $InvoiceDetailmodel->getInvoiceDetailByIDUser($InvoiceId);
        foreach ($InvoiceDetail as $data) {
            $productModel= new ProductModel();
            $product = $productModel->getProductByID($data->productID);
            $endQuantity= $product->stock + $data->quantity;
            $sql="UPDATE products SET Stock = $endQuantity WHERE ProductID = $data->productID";
            $this->UpdateCustome($sql);
        }
         $this->deleteID('invoices', $InvoiceId,'InvoiceID');

    }
}
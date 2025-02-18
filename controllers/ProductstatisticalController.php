<?php
require_once __DIR__ . '/../entities/Account.php';
require_once __DIR__ .'/../entities/User.php';
require_once __DIR__ . '/../controllers/BaseController.php';


class ProductstatisticalController extends BaseController {
 


    private $ProductModel;
    private $InvoiceModel;
    private $InvoiceDetailModel;
    public function __construct()
    {
        
        
        $this->InvoiceModel = $this->loadModel("InvoiceModel");
        $this->InvoiceDetailModel = $this->loadModel("InvoiceDetailModel");
        $this->ProductModel = $this->loadModel("ProductModel");
    }

    public function index() {

        $dataInvoice = $this->InvoiceDetailModel->getInvoiceDetailAll();
        $EndData=[];
        $total=0;
        foreach($dataInvoice as $item){
            $total+=$item->quantity;
        }

        $EndData = [];
        $productQuantities = [];

        foreach ($dataInvoice as $item) {
        
            $product = $this->ProductModel->getProductByID($item->productID);
            
            
            if (isset($productQuantities[$item->productID])) {
      
                $productQuantities[$item->productID]['Quantity'] += $item->quantity;
            } else {
         
                $productQuantities[$item->productID] = [
                    'ProductID' => $item->productID,
                    'ProductName' => $product->productName,
                    'img' => $product->img,
                    'Quantity' => $item->quantity,
                ];
            }
        }
        foreach ($productQuantities as $productID => $productData) {
            $productData['Percent'] = ($productData['Quantity'] / $total) * 100; 
            $EndData[] = $productData;
        }
        $this->view('manager.ProductStatistical.index',
        [
        'data'=>$EndData
        ]);
    
    
    }

}


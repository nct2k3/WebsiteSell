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
        $EndData = [];
        $total = 0;
        foreach ($dataInvoice as $item) {
            $total += $item->quantity;
        }
    
        $productQuantities = [];
    
        foreach ($dataInvoice as $item) {
            $product = $this->ProductModel->getProductByID($item->productID);
    
            if (isset($productQuantities[$item->productID])) {
   
                $productQuantities[$item->productID]['Quantity'] += $item->quantity;
                $productQuantities[$item->productID]['Price'] += $product->price * $item->quantity;
            } else {
                $productQuantities[$item->productID] = [
                    'ProductID' => $item->productID,
                    'ProductName' => $product->productName,
                    'Price' => $product->price * $item->quantity,
                    'img' => $product->img,
                    'Quantity' => $item->quantity,
                ];
            }
        }

        foreach ($productQuantities as $productID => $productData) {
            $productData['Percent'] = ($productData['Quantity'] / $total) * 100; 
            $EndData[] = $productData; 
        }
    
        $totalAmount = 0;
        foreach ($EndData as $data) {
            $totalAmount += $data['Price'];
        }

        usort($EndData, function($a, $b) {
            return $b['Percent'] <=> $a['Percent']; 
        });
        $this->view('manager.ProductStatistical.index', [
            'data' => $EndData,
            'totalAmount' => $totalAmount
        ]);
    }

}


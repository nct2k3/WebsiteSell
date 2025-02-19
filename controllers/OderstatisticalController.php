<?php
require_once __DIR__ . '/../entities/Account.php';
require_once __DIR__ .'/../entities/User.php';
require_once __DIR__ . '/../controllers/BaseController.php';


class OderstatisticalController extends BaseController {
 


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

    
    $waitingConfirm = $this->InvoiceModel->getInvoiceBystatus(0);
    $confirmed = $this->InvoiceModel->getInvoiceBystatus(1);
    $inDelivery = $this->InvoiceModel->getInvoiceBystatus(3);
    $completed = $this->InvoiceModel->getInvoiceBystatus(4);

    $ProductNotsoldProductNotsold = $this->ProductModel->getProductDelete();
    $AllProduct = $this->ProductModel->getAllProduct();

    $numWaitingConfirm = is_array($waitingConfirm) ? count($waitingConfirm) : 0;
    $numConfirmed = is_array($confirmed) ? count($confirmed) : 0;
    $numInDelivery = is_array($inDelivery) ? count($inDelivery) : 0;
    $numCompleted = is_array($completed) ? count($completed) : 0;
    $numProductNotSold=is_array($ProductNotsoldProductNotsold) ? count($ProductNotsoldProductNotsold) : 0;
    $numAllProductAllProduct=is_array($AllProduct) ? count($AllProduct) : 0;
    $numProductSold=$numAllProductAllProduct-$numProductNotSold;
    
    $total=$numWaitingConfirm+$numConfirmed+$numInDelivery+$numCompleted;

    $PercentWaitingConfirm=($numWaitingConfirm/$total)*100;
    $PercentConfirmed=($numConfirmed/$total)*100;
    $PercentInDelivery=($numInDelivery/$total)*100;
    $PercentCompleted=($numCompleted/$total)*100;

    $PercentProductSold=($numProductSold/$numAllProductAllProduct)*100;
    $PercentProductNotSold=($numProductNotSold/$numAllProductAllProduct)*100;



        $this->view('manager.OderStatistical.index',
        ['PercentWaitingConfirm'=>$PercentWaitingConfirm,
        'PercentConfirmed'=>$PercentConfirmed,
        'PercentInDelivery'=>$PercentInDelivery,
        'PercentCompleted'=>$PercentCompleted,
        'numWaitingConfirm'=>$numWaitingConfirm,
        'numConfirmed'=>$numConfirmed,
        'numInDelivery'=>$numInDelivery,
        'numCompleted'=>$numCompleted,
        'total'=>$total,
        'PercentProductSold'=>$PercentProductSold,
        'PercentProductNotSold'=>$PercentProductNotSold,
        'numProductSold'=>$numProductSold,
        'numProductNotSold'=>$numProductNotSold,
        'numAllProductAllProduct'=>$numAllProductAllProduct
        ]);
    
    
    }

}


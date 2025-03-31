<?php
require_once __DIR__ . '/../entities/Account.php';
require_once __DIR__ .'/../entities/User.php';
require_once __DIR__ . '/../controllers/BaseController.php';

class PurchasePaymentController extends BaseController {
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
        foreach ($dataInvoice as $item) {
            $product = $this->ProductModel->getProductByID($item->productID);
            $invoice = $this->InvoiceModel->getInvoiceByID($item->invoiceID);
            if ($product && $invoice) {
                $EndData[] = [ 
                    'InvoiceDetailID' => $item->detailID,
                    'ProductID' => $item->productID,
                    'ProductName' => $product->productName,
                    'img' => $product->img,
                    'time' => $invoice->invoiceDate,
                    'Quantity' => $item->quantity,
                ];
            }
        }
        usort($EndData, function($a, $b) {
            return $b['time'] <=> $a['time']; 
        });
        $this->view('manager.PurchasePayment.index', [
            'data' => $EndData,
        ]);
    }
    // lấy doanh thu theo ngayngay
    public function Date($date) {
        $dataInvoice = $this->InvoiceDetailModel->getInvoiceDetailAll();
        $EndData = [];
        foreach ($dataInvoice as $item) {
            $product = $this->ProductModel->getProductByID($item->productID);
            $invoice = $this->InvoiceModel->getInvoiceByID($item->invoiceID);
            if ($product && $invoice && $date == $invoice->invoiceDate) {
                $EndData[] = [ 
                    'InvoiceDetailID' => $item->detailID,
                    'ProductID' => $item->productID,
                    'ProductName' => $product->productName,
                    'img' => $product->img,
                    'time' => $invoice->invoiceDate,
                    'Quantity' => $item->quantity,
                ];
            }
        }
        if (count($EndData) == 0) {
            $_SESSION['error'] = "There are no products found.";
            $this->index();
            exit();
        }
    
        $this->view('manager.PurchasePayment.index', [
            'data' => $EndData,
        ]);
    }
    // lấy doanh thu theo thang nămnăm
    public function YearAndMoth($year, $month) {
        $dataInvoice = $this->InvoiceDetailModel->getInvoiceDetailAll();
        $EndData = [];
        foreach ($dataInvoice as $item) {
            $product = $this->ProductModel->getProductByID($item->productID);
            $invoice = $this->InvoiceModel->getInvoiceByID($item->invoiceID);
            if ($product && $invoice) {
                $invoiceDate = DateTime::createFromFormat('Y-m-d', $invoice->invoiceDate);
                $invoiceMonth = $invoiceDate->format('m');
                $invoiceYear = $invoiceDate->format('Y');
                if ($month == $invoiceMonth && $year == $invoiceYear) {
                    $EndData[] = [ 
                        'InvoiceDetailID' => $item->detailID,
                        'ProductID' => $item->productID,
                        'ProductName' => $product->productName,
                        'img' => $product->img,
                        'time' => $invoice->invoiceDate,
                        'Quantity' => $item->quantity,
                    ];
                }
            }
        }
        usort($EndData, function($a, $b) {
            return $b['time'] <=> $a['time']; 
        });
        if (count($EndData) == 0) {
            $_SESSION['error'] = "There are no products found.";
            $this->index();
            exit();
        }
    
        $this->view('manager.PurchasePayment.index', [
            'data' => $EndData,
        ]);
    }

}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;
    switch ($action) {
        case 'DateFillter':
           $date = $_POST['date'] ?? '';
            $PurchasePaymentController = new PurchasePaymentController();
            $PurchasePaymentController->Date($date);
            exit();
        case 'YearFillter':
            $year = $_POST['year'] ?? '';
            $month = $_POST['month'] ?? '';
            $PurchasePaymentController = new PurchasePaymentController();
            $PurchasePaymentController-> YearAndMoth($year, $month);
            exit();   
        default:
            echo "Hành động không hợp lệ!";
            break;
    }
}
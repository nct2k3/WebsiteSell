<?php
require_once __DIR__ . '/../entities/Account.php';
require_once __DIR__ .'/../entities/User.php';
require_once __DIR__ . '/../controllers/BaseController.php';


class RevenuestatisticalController extends BaseController {
 


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
        
        $year=2025;
        
        $dataInvoice = $this->InvoiceModel->getInvoiceByYear($year);
        $totalAmount=0;
        $totalOrder=count($dataInvoice);
        foreach($dataInvoice as $item){
            $totalAmount+=$item->totalAmount;
        }
        $dataStatistical = [];
        $monthNames = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        ];
        for ($i = 1; $i <= 12; $i++) {
            $dataInvoice = $this->InvoiceModel->getInvoiceByyearAndMoth($year, $i);
            $total = 0;

            if (is_array($dataInvoice) && !empty($dataInvoice)) {
                foreach ($dataInvoice as $item) {
                    $total += $item->totalAmount; 
                }
            }
            $dataStatistical[$i] = [
                'total' => $total,
                'percent' => $total > 0 ? ($total / $totalAmount) * 100 : 0,
                'month' => $monthNames[$i],
                'numOrder' => is_array($dataInvoice) ? count($dataInvoice) : 0,
                'percentOrder' => is_array($dataInvoice) ? (count($dataInvoice) / $totalOrder) * 100 : 0,
            ];
        }
        $this->view('manager.RevenueStatistical.index', ['dataStatistical' => $dataStatistical,'totalAmount'=> $totalAmount,'year'=>$year]);
                        
    
    }

    public function RevenueYear($year) {
        
        $dataInvoice = $this->InvoiceModel->getInvoiceByYear($year);
        if (empty($dataInvoice)) {
            $_SESSION['error'] = "There are no invoices in this year.";
            $this->index();
            exit;
        }
        $totalAmount=0;
        $totalOrder=count($dataInvoice);
        foreach($dataInvoice as $item){
            $totalAmount+=$item->totalAmount;
        }
        $dataStatistical = [];
        $monthNames = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        ];
        for ($i = 1; $i <= 12; $i++) {
            $dataInvoice = $this->InvoiceModel->getInvoiceByyearAndMoth($year, $i);
            $total = 0;

            if (is_array($dataInvoice) && !empty($dataInvoice)) {
                foreach ($dataInvoice as $item) {
                    $total += $item->totalAmount; 
                }
            }
            $dataStatistical[$i] = [
                'total' => $total,
                'percent' => $total > 0 ? ($total / $totalAmount) * 100 : 0,
                'month' => $monthNames[$i],
                'numOrder' => is_array($dataInvoice) ? count($dataInvoice) : 0,
                'percentOrder' => is_array($dataInvoice) ? (count($dataInvoice) / $totalOrder) * 100 : 0,
            ];
        }
        $this->view('manager.RevenueStatistical.index', ['dataStatistical' => $dataStatistical,'totalAmount'=> $totalAmount,'year'=>$year]);
                        
    
    }

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;

    switch ($action) {
        case 'RevenueYear':
           $Year = $_POST['year'] ?? '';
            
            $RevenuestatisticalController = new RevenuestatisticalController();
            $RevenuestatisticalController->RevenueYear($Year);
            exit();

        default:
            echo "Hành động không hợp lệ!";
            break;
    }
}

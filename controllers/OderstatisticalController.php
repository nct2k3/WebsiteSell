<?php 
require_once __DIR__ . '/../entities/Account.php';
require_once __DIR__ . '/../entities/User.php';
require_once __DIR__ . '/../controllers/BaseController.php';

class OderstatisticalController extends BaseController {
    private $ProductModel;
    private $InvoiceModel;
    private $UserModel;
    private $InvoiceDetailModel;

    public function __construct()
    {
        $this->InvoiceModel = $this->loadModel("InvoiceModel");
        $this->ProductModel = $this->loadModel("ProductModel");
        $this->UserModel = $this->loadModel("UserModel");
        $this->InvoiceDetailModel = $this->loadModel("InvoiceDetailModel");
    }

    public function index() {
         $datefrom = '2025-02-01';
        $dateto = '2025-12-30';
        if (isset($_GET['datefrom'])) {
            $datefrom = $_GET['datefrom'];
        }
        if (isset($_GET['dateto'])) {
            $dateto = $_GET['dateto'];
        }
    
        $DataInvoice = $this->InvoiceModel->getInvoicewithDate(4, $datefrom, $dateto);
        $dataUser = [];
        foreach ($DataInvoice as $items) {
            $found = false;
            foreach ($dataUser as $key => $user) { // Không sử dụng tham chiếu
                if ($user['id'] == $items->userID) {
                    $dataUser[$key]['totalAmount'] += $items->totalAmount;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $dataUser[] = [
                    'id' => $items->userID,
                    'name' => $this->UserModel->getUserByID($items->userID)->FullName,
                    'totalAmount' => $items->totalAmount
                ];
            }
        }

        usort($dataUser, function($a, $b) {
            return $b['totalAmount'] - $a['totalAmount'];
        });

        $dataUsers = array_slice($dataUser, 0, 5);
        $dataPament = [];
        
        // Initialize array structure for each top user
        foreach ($dataUsers as $user) {
            $dataPament[$user['id']] = [
                'userName' => $user['name'],
                'totalAmount' => $user['totalAmount'],
                'invoices' => []
            ];
        }

        if ($DataInvoice != null) {
            foreach ($DataInvoice as $items) {
                foreach ($dataUsers as $user) {
                    if ($user['id'] == $items->userID) {
                        $products = [];
                        $dataInvoiceDetail = $this->InvoiceDetailModel->getInvoiceDetailByIDUser($items->invoiceID);
                        
                        foreach ($dataInvoiceDetail as $item) {
                            $products[] = [
                                'product' => $this->ProductModel->getProductByID($item->productID),
                                'quantity' => $item->quantity,
                            ];
                        }

                        $dataPament[$user['id']]['invoices'][] = [
                            'products' => $products,
                            'invoice' => $items
                        ];
                        break;
                    }
                }
            }
        }
        
        $this->view('manager.OderStatistical.index', [
            'dataUser' => $dataUsers,
            'dataPament' => $dataPament
        ]);
    }
}

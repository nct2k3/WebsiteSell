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
        $datefrom = '2025-04-06';
        $dateto = '2025-04-08';
        if (isset($_GET['datefrom'])) {
            $datefrom = $_GET['datefrom'];
        }
        if (isset($_GET['dateto'])) {
            $dateto = $_GET['dateto'];
        }
    
        $DataInvoice = $this->InvoiceModel->getInvoicewithDate(3, $datefrom, $dateto);
        $dataUser = [];
        
        // Check if $DataInvoice is not null before iterating
        if ($DataInvoice && is_array($DataInvoice)) {
            foreach ($DataInvoice as $items) {
                $found = false;
                foreach ($dataUser as $key => $user) { 
                    if ($user['id'] == $items->userID) {
                        $dataUser[$key]['totalAmount'] += $items->totalAmount;
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    $user = $this->UserModel->getUserByID($items->userID);
                    if ($user) {
                        $dataUser[] = [
                            'id' => $items->userID,
                            'name' => $user->FullName,
                            'totalAmount' => $items->totalAmount
                        ];
                    }
                }
            }
        }

        usort($dataUser, function($a, $b) {
            return $b['totalAmount'] - $a['totalAmount'];
        });

        $dataUsers = array_slice($dataUser, 0, 5);
        $dataPament = [];
        
        // Initialize array structure for each top user
        if (!empty($dataUsers)) {
            foreach ($dataUsers as $user) {
                $dataPament[$user['id']] = [
                    'userName' => $user['name'],
                    'totalAmount' => $user['totalAmount'],
                    'invoices' => []
                ];
            }
        }

        if ($DataInvoice && is_array($DataInvoice)) {
            foreach ($DataInvoice as $items) {
                foreach ($dataUsers as $user) {
                    if ($user['id'] == $items->userID) {
                        $products = [];
                        $dataInvoiceDetail = $this->InvoiceDetailModel->getInvoiceDetailByIDUser($items->invoiceID);
                        
                        if ($dataInvoiceDetail && is_array($dataInvoiceDetail)) {
                            foreach ($dataInvoiceDetail as $item) {
                                $product = $this->ProductModel->getProductByID($item->productID);
                                if ($product) {
                                    $products[] = [
                                        'product' => $product,
                                        'quantity' => $item->quantity,
                                    ];
                                }
                            }
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

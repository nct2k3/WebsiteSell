<?php


class NotificationController extends BaseController {
 
   
    
    private $NotificationManagerModel;

    private $LinkInvoicesModel;

    private $InvoiceModel;

    public function __construct()
    {
        
        $this->NotificationManagerModel = $this->loadModel("NotificationManagerModel");
        $this->InvoiceModel = $this->loadModel("InvoiceModel");
        $this->LinkInvoicesModel = $this->loadModel("LinkInvoicesModel");
       
        
    }
    public function index() {
        $idUser = $this->takeIDAccount();
        $data = $this->NotificationManagerModel->getNotificationWithId($idUser);
        usort($data, function($a, $b) {
            return strtotime($b->Time) - strtotime($a->Time); 
        });
        $DataInvoice = [];
        $DataBasic=[];
        foreach ($data as $item) {
            if($item->Status != 2) {
                $DataBasic[] = $item;
            }
        }
        foreach ($data as $item) {
            if($item->Status == 2) {
                $linkInvoices = $this->LinkInvoicesModel->getLinkInvoicesWithId($item->InvoiceID);
                
                if (is_array($linkInvoices) && !empty($linkInvoices)) {
                    $url = $linkInvoices[0]->URL ?? '';
                } else {
                    
                    $url = $linkInvoices->URL ?? '';
                }

                $DataInvoice[] = [
                    'Data' => $item,
                    'Link' => $url
                ];
            }
        }
    
        $this->view('frontEnd.Notification.index', [
            'data' => $DataBasic,
            'DataInvoice' => $DataInvoice
           
        ]);
    }

function downloadFile($file) {
    $filePath = "public/bill/" . basename($file);

    if (file_exists($filePath)) {
        $fileInfo = pathinfo($file);
        $timestamp = date('Y-m-d_H-i-s');
        $newFilename = $fileInfo['filename'] . '_' . $timestamp . '.' . $fileInfo['extension'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $filePath);
        finfo_close($finfo);
        header('Content-Description: File Transfer');
        header('Content-Type: ' . $mimeType);
        header('Content-Disposition: attachment; filename="' . $newFilename . '"'); // Changed to use newFilename with timestamp
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        
        readfile($filePath);
        $_SESSION['message'] = "Take file successfully!";
        $this->index();
        exit;
    } else {
        echo "File không tồn tại.";
    }
}
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;

    switch ($action) {
        case 'TakeFile':
            $URl = $_POST['URL'];
            $NotificationController = new NotificationController();
            $NotificationController->downloadFile($URl);
            exit();
        default:
            echo "Hành động không hợp lệ!";
            break;
    }
}

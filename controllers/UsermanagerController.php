<?php
class UsermanagerController extends BaseController
{
    private $UserModel;
    private $AccountModel;
    public function __construct()
    {
        $this->UserModel = $this->loadModel("UserModel");
        $this->AccountModel = $this->loadModel("AccountsModel");
    }
    public function index(){
 
        $User=$this->UserModel->getAllUser();
        $dataUser=[];
        foreach ($User as $items) {
           $dataAcc = $this->AccountModel-> getAccountByIDUser($items->userID);
           if($dataAcc->role!=1){
                $dataUser[] =[
                    'DataUser'=>$items,
                    'DataAcc'=>$dataAcc
            ];
           }
           
        }
        $this->view('manager.UserManager.index',['dataUser'=>$dataUser]);
    }
    
public function search($string) {
    $users = $this->UserModel->getAllUser();
    $dataUser = [];
    
    foreach ($users as $user) {
        $dataAcc = $this->AccountModel->getAccountByIDUser($user->userID);
        if ($dataAcc->role != 1) {
            if (stripos($user->FullName, $string) !== false) {
                $dataUser[] = [
                    'DataUser' => $user,
                    'DataAcc' => $dataAcc
                ];
            }
        }
    }
    if (count($dataUser) == 0) {
        $_SESSION['error'] = "No users found matching your search.";
    }
    $this->view('manager.UserManager.index', ['dataUser' => $dataUser]);
}
    public function updateUser($userID, $fullName, $email, $phone, $password, $address) {
        
        try {
            $userResult = $this->UserModel->updateInformation($fullName, $phone, $address, $userID);
            $accountResult = $this->AccountModel->updateAccount($userID, $email, $password, 0);

            if ($userResult && $accountResult) {
                $_SESSION['message'] = "Update successfully!";
            } else {
                throw new Exception("Update operation failed");
            }
        } catch (Exception $e) {
            $_SESSION['error'] = "Update failed: " . $e->getMessage();
        } finally {
            $this->index();
        }
            }

            public function changeStatus($userID, $currentRole) {
                try {
                    $newRole = ($currentRole == 0) ? 2 : 0; 
                    $data = $this->AccountModel->getAccountByIDUser($userID);
                    $result = $this->AccountModel->updateAccount($userID, $data->email, $data->password, $newRole);
                    
                    if ($result) {
                        $_SESSION['message'] = "Status changed successfully!";
                    } else {
                        throw new Exception("Status change operation failed");
                    }
                } catch (Exception $e) {
                    $_SESSION['error'] = "Status change failed: " . $e->getMessage();
                } finally {
                    $this->index();
                }
            }
    }
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;
    $UsermanagerController= new UsermanagerController();
    switch ($action) {
        case 'edit':
            $userID = $_POST['userID'] ?? '';
            $fullName = $_POST['UserName'] ?? '';
            $email = $_POST['Email'] ?? '';
            $phone = $_POST['Phone'] ?? '';
            $password = $_POST['password'] ?? '';
            $address = $_POST['address'] ?? '';
            
            $UsermanagerController->updateUser($userID, $fullName, $email, $phone, $password, $address);
            exit();
         case 'changeStatus':
                $userID = $_POST['userID'] ?? '';
                $currentRole = $_POST['currentRole'] ?? '';
                $UsermanagerController->changeStatus($userID, $currentRole);
                exit();
            case 'search':
               
                    $string = $_POST['string'] ?? null;
                    if ($string) {
                       
                        $UsermanagerController->search($string);
                        exit;
                    } else {
                        $_SESSION['error'] = "There are no products found.";
                        $UsermanagerController->index();
                        exit;
                    }
          
        default:
            echo "Hành động không hợp lệ!";
            break;
    }
}
<?php
require_once __DIR__ . '/../entities/Account.php';
require_once __DIR__ .'/BaseModel.php';
class AccountsModel extends BaseModel
{
    public function login($email, $password) {
        $sql = "SELECT * FROM accounts WHERE Email = '${email}' AND Password = '${password}'";
        $data = $this->getOneCustome($sql);
    
        if (empty($data)) {
            return null; 
        }
    
        $accounts = new Account(
            $data['AccountID'],
            $data['Email'],
            $data['Password'],
            $data['Role'],
            $data['UserID']
        );
        return $accounts; 
    }
    public function createAccounts($accounts) {
        print_r($accounts);
        $accountData = [
            'Email' => $accounts->email,
            'Password' => $accounts->password,
            'Role' => $accounts->role,
            'UserID'=> $accounts->userID,
           
        ];
        return $this->createReturnID('accounts', $accountData);
    }
    public function CheckEmail($Email) {
        if (empty($Email)) {
            return 0;
        }
        $sql = "SELECT Email FROM accounts WHERE Email='$Email'";
        $result = $this->getOneCustome($sql);
        if ($result) {
            return 1; 
        } else {
            return 0; 
        }
    }

    public function getAccountByIDUser($UserID) {
        $data = $this->getById('Accounts', $UserID, 'UserID');
        if (empty($data)) {
            return null; 
        }
        $Account = new Account(
            $data['AccountID'],
            $data['Email'],
            $data['Password'],
            $data['Role'],
            $data['UserID']     
        );
        return $Account;
    }
    public function getAccountByEmail($Email) {
        $data = $this->getByString('Accounts', $Email, 'Email');
        if (empty($data)) {
            return null; 
        }
        $Account = new Account(
            $data['AccountID'],
            $data['Email'],
            $data['Password'],
            $data['Role'],
            $data['UserID']     
        );
        return $Account;
    }

    public function updateAccount($userID, $email, $password,$role) {
        $sql = "UPDATE accounts SET `Email`='$email', `Password`='$password', `Role`='$role'  WHERE UserID=$userID";
        $result = $this->UpdateCustome($sql);
        if ($result) {
            return 1;
        } else {
            return 0;
        }
    }
}
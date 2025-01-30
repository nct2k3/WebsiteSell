<?php
require_once __DIR__ . '/../entities/Account.php';
require_once __DIR__ .'/BaseModel.php';
class AccountsModel extends BaseModel
{
    public function login($email, $password) {
        $sql = "SELECT * FROM accounts WHERE Email = '${email}' AND Password = '${password}'";
        $data = $this->getOneCustome($sql);
    
        if (empty($data)) {
            return null; // Trả về null nếu không tìm thấy tài khoản
        }
    
        $accounts = new Account(
            $data['AccountID'],
            $data['Email'],
            $data['Password'],
            $data['Role'],
            $data['UserID']
        );
        return $accounts; // Trả về đối tượng Account
    }
}
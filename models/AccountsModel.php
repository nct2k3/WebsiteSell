<?php
require_once __DIR__ . '/../entities/Account.php';
// Đảm bảo đường dẫn đúng tới tệp Account.php

class AccountsModel extends BaseModel
{
    public function getAllAccounts()
    {
        // Lấy dữ liệu từ bảng accounts
        $data = $this->getAll('accounts'); 
        $accounts = [];

        foreach ($data as $row) {
            // Tạo đối tượng Account từ dữ liệu
            $accounts[] = new Account(
                $row['AccountID'], // Cột AccountID
                $row['Email'],     // Cột Email
                $row['Password'],  // Cột Password
                $row['Role'],      // Cột Role
                $row['UserID']     // Cột UserID
            );
        }

        return $accounts; // Trả về mảng các đối tượng Account
    }
}
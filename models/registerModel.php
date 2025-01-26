<?php
require_once __DIR__ . '/../models/BaseModel.php';
require_once __DIR__ . '/../entities/Account.php';
require_once __DIR__ . '/../entities/User.php';

class RegisterModel extends BaseModel {
    public function create($table, $data) {
        return parent::create($table, $data);
    }

    public function getAllAccounts() {
        $data = $this->getAll('accounts'); 
        $accounts = [];

        foreach ($data as $row) {
            $accounts[] = new Account(
                $row['AccountID'],
                $row['Email'],
                $row['Password'],
                $row['Role'],
                $row['UserID']
            );
        }

        return $accounts; 
    }
}
<?php
require_once __DIR__ . '/../entities/User.php';

class UserModel extends BaseModel {
    public function create($table, $data) {
        return parent::create($table, $data);
    }
    public function getUserByID($UserID) {

        
            $data = $this->getById('users', $UserID, '	UserID');
            if (empty($data)) {
                return null; 
            }
            $User = new User(
                $data['UserID'],
                $data['FullName'],
                $data['PhoneNumber'],
                $data['Address'],
                $data['LoyaltyPoints'],        
            );
            return $User;
            
    }
}
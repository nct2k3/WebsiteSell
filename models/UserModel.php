<?php
require_once __DIR__ . '/../entities/User.php';

class UserModel extends BaseModel {
    //creat
    public function create($table, $data) {
        return parent::create($table, $data);
    }
    public function createUser($user) {
        $userData = [
            'FullName' => $user->FullName,
            'PhoneNumber' => $user->PhoneNumber,
            'Address' => $user->Address,
            'LoyaltyPoints'=> $user->LoyaltyPoints,
           
        ];
        return $this->createReturnID('users', $userData);
    }
    //update
    public function updateInformation($fullName, $phoneNumber, $address,$idUser) {
        $sql = "UPDATE users SET `FullName`='$fullName',`PhoneNumber`='$phoneNumber',`Address`='$address' WHERE UserID=$idUser";
        $result = $this->UpdateCustome($sql);
        if ($result) {
            return 1; 
        } else {
            return 0; 
        }
    }
    public function UpdateLoyaltyPoints($idUser,$data) {
        $this->updateString('users','LoyaltyPoints',$data,$idUser,'UserID');
    }
    //get
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
    public function getAllUser() {
        $data = $this->getAll('users');
        if (empty($data)) {
            return null;
        }
        
        $users = [];
        foreach ($data as $row) {
            $users[] = new User(
                $row['UserID'],
                $row['FullName'], 
                $row['PhoneNumber'],
                $row['Address'],
                $row['LoyaltyPoints']
            );
        }
        return $users;
    }
}
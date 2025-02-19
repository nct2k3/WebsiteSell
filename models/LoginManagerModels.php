<?php
require_once __DIR__ . '/../entities/LoginManager.php';

class LoginManagerModels extends BaseModel
{
    public function getLoginManagerAll()
    {
        $data = $this->getAll('loginmanager'); 
        $LoginManager = [];
        foreach ($data as $row) {
            $LoginManager[] = new LoginManager(
                $row['ID'], 
                $row['UserID'], 
                $row['TimeLogin'] ,
                $row['Action']
            );
        }
        return $LoginManager;
    }

    public function getLoginManagerWithId($id)
    {
        $data = $this->getListById('loginmanager',$id, 'UserID' ); 
        $LoginManager = [];
        foreach ($data as $row) {
            $LoginManager[] = new LoginManager(
                $row['ID'], 
                $row['UserID'], 
                $row['TimeLogin'] ,
                $row['Action']
            );
        }
        return $LoginManager;
    }
    public function createLoginManager($LoginManager) {
        $LoginManager = [
            'ID' => $LoginManager->ID,
            'UserID'=> $LoginManager->UserID,
            'TimeLogin' => $LoginManager->TimeLogin, 
            'Action' => $LoginManager->Action
        ];
        return $this->createReturnID('LoginManager', $LoginManager);
    }
}
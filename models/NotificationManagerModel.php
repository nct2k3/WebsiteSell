<?php
require_once __DIR__ . '/../entities/Notification.php';

class NotificationManagerModel extends BaseModel
{
    public function getNotificationAll()
    {
        $data = $this->getAll('notifications'); 
        $Notification = [];
        foreach ($data as $row) {
            $Notification[] = new Notification(
                $row['ID'], 
                $row['UserID'], 
                $row['Content'],
                $row['Status'] ,
                $row['Time'],
               
            );
        }
        return $Notification;
    }

    public function getNotificationWithId($id)
    {
        $data = $this->getListById('notifications',$id, 'UserID' ); 
        $Notification = [];
        foreach ($data as $row) {
            $Notification[] = new Notification(
                $row['ID'], 
                $row['UserID'], 
                $row['Content'],
                $row['Status'] ,
                $row['Time'],
            );
        }
        return $Notification;
    }
    public function createNotification($Notification) {

        print_r($Notification);
        $Notification = [
            'ID' => $Notification->ID,
            'UserID'=> $Notification->UserID,
            'Content' => $Notification->Content, 
            'Status' => $Notification->Status,
            'Time' => $Notification->Time,
        ];
        return $this->createReturnID('notifications', $Notification);
    }
}
<?php
require_once __DIR__ . '/../entities/Banner.php';
// Đảm bảo đường dẫn đúng tới tệp Banner.php

class BannerModel extends BaseModel
{
    public function getBanners($id)
    {
        $data = $this->getListById('Banner',$id, 'ProductLineID' ); 
        $Banners = [];
        foreach ($data as $row) {
            $Banners[] = new Banner(
                $row['BannerID'], 
                $row['Img'], 
                $row['ProductLineID'] 
            );
        }

        return $Banners;
    }
}
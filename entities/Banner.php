<?php

class Banner
{
    public $BannerID;
    public $img;
    public $ProductLineID;


    public function __construct($BannerID, $img, $ProductLineID)
    {
        $this->BannerID = $BannerID;
        $this->img = $img;
        $this->ProductLineID = $ProductLineID;
       
    }
}
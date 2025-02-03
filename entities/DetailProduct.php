<?php

class DetailProduct{
    public $ProductDetailID;
    public $ProductType;
    public $Img;


    public function __construct($ProductDetailID, $ProductType,$img)
    {
        $this->ProductDetailID = $ProductDetailID;
        $this->ProductType = $ProductType;
        $this->Img = $img;
       
       
    }
}
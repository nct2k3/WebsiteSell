<?php
class Product {
    public $productID;
    public $productLineID;
    public $productName;
    public $Status;
    public $price;
    public $originalPrice;
    public $stock;
    public $img;
    public $capacity;
    public $color;
    
    public function __construct($productID = null, $productLineID = null, $productName = null,$Status=null ,$price = null, $originalPrice = null, $stock = null, $img = null, $capacity = null, $color = null) 
    {
        $this->productID = $productID;
        $this->productLineID = $productLineID;
        $this->productName = $productName;
        $this->Status = $Status;
        $this->price = $price;
        $this->originalPrice = $originalPrice;
        $this->stock = $stock;
        $this->img = $img;
        $this->capacity = $capacity;
        $this->color = $color;
    }
}

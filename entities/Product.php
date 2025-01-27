<?php
class Product {
    public $productID;
    public $productLineID;
    public $productType;

    public $productModel;
    public $productName;
    public $price;
    public $originalPrice;
    public $stock;
    public $img;
    public $capacity;
    public $color;

    // Constructor
    public function __construct($productID, $productLineID, $productType,$productModel, $productName, $price, $originalPrice, $stock, $img, $capacity, $color) {
        $this->productID = $productID;
        $this->productLineID = $productLineID;
        $this->productType = $productType;
        $this->productModel = $productModel;
        $this->productName = $productName;
        $this->productLineID = $productLineID;
        $this->price = $price;
        $this->originalPrice = $originalPrice;
        $this->stock = $stock;
        $this->img = $img;
        $this->capacity = $capacity;
        $this->color = $color;
    }
}

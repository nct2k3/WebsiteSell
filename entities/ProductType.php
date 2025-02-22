<?php

class ProductType {
    public $ProductTypeID;
    public $ProductTypeName;
    public $ProductModelID;

    public function __construct($ProductTypeID, $ProductTypeName, $ProductModelID) {
        $this->ProductTypeID = $ProductTypeID;
        $this->ProductTypeName = $ProductTypeName;
        $this->ProductModelID = $ProductModelID;
       
    }
}
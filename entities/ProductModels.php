<?php

class ProductModels {
    public $ProductModelID;
    public $ProductModelName;

    public $ProductLine;
 

    public function __construct($ProductModelID, $ProductModelName, $ProductLine) {
        $this->ProductModelID = $ProductModelID;
        $this->ProductModelName = $ProductModelName;
        $this->ProductLine = $ProductLine;
    
    }
}
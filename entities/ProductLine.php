<?php

class ProductLine {
    public $ProductLineID;
    public $ProductLineName;
 
    public function __construct($ProductLineID, $ProductLineName) {
     $this->ProductLineID = $ProductLineID;
     $this->ProductLineName = $ProductLineName;
    }
}
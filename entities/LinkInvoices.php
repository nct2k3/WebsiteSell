<?php

class LinkInvoices {
    public $LinkID;
    public $InvoiceID;
    public $URL;


    public function __construct($LinkID,$InvoiceID,$URL ) {

        $this->LinkID= $LinkID;
        $this->InvoiceID = $InvoiceID;
        $this->URL=$URL;
    }
}

<?php
require_once __DIR__ . '/../entities/LinkInvoices.php';

class LinkInvoicesModel extends BaseModel
{
    public function getLinkInvoicesAll()
    {
        $data = $this->getAll('linkinvoices'); 
        $LinkInvoices = [];
        foreach ($data as $row) {
            $LinkInvoices[] = new LinkInvoices(
                $row['LinkID'], 
                $row['InvoiceID'], 
                $row['URL'] ,
                
            );
        }
        return $LinkInvoices;
    }

    public function getLinkInvoicesWithId($id)
    {
        $data = $this->getListById('linkinvoices',$id, 'InvoiceID' ); 
        $LinkInvoices = [];
        foreach ($data as $row) {
            $LinkInvoices[] = new LinkInvoices(
                $row['LinkID'], 
                $row['InvoiceID'], 
                $row['URL'] ,
             
            );
        }
        return $LinkInvoices;
    }
    public function createLinkInvoice($ID,$LinkInvoices) {

        $check =$this->getLinkInvoicesWithId($ID);
        if(count($check)!=0){
            return 0;
        }
        $LinkInvoices = [
            'LinkID' => '',
            'InvoiceID'=> $ID,
            'URL' => $LinkInvoices, 
         
        ];
        return $this->createReturnID('linkinvoices', $LinkInvoices);
    }
}
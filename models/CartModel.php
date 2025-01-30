<?php
require_once __DIR__ . '/../entities/Cart.php';
class CartModel extends BaseModel
{
    public function getcart($userID) {
        $data = $this->getListById('cart', $userID, 'UserID');
        
        if (empty($data)) {
            return null; 
        }
        $carts = [];
        foreach ($data as $item) {
            $Cart = new Cart(
                $item['CartID'],    
                $item['UserID'],
                $item['ProductID']
            );
            $carts[] = $Cart; 
        }
        return $carts; 
    }
    public function delete($userID, $productID) {
        
       return $this->deleteTowID('cart','UserID','ProductID', $userID, $productID);

    }
    public function createCart($Cart) {
        $data = [
            'UserID' =>$Cart->UserID,
            'ProductID' => $Cart->ProductID,
        ];
     return  $this->create('cart', $data);
    }

}
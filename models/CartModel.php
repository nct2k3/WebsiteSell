<?php
require_once __DIR__ . '/../entities/Cart.php';
class CartModel extends BaseModel
{
    //getget
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
                $item['ProductID'],
                $item['Quantity']
            );
            $carts[] = $Cart; 
        }
        return $carts; 
    }
    // deletedelete
    public function delete($userID, $productID) {      
       return $this->deleteTowID('cart','UserID','ProductID', $userID, $productID);
    }
    public function deleteById($userID) {
        return $this->deleteID('cart', $userID,'UserID');
    }
    // creatcreat
    public function createCart($Cart) {
        if (empty($Cart->UserID) || empty($Cart->ProductID) || $Cart->Quantity <= 0) {
            throw new InvalidArgumentException('Invalid cart data.');
        }
        $userID = intval($Cart->UserID);
        $productID = intval($Cart->ProductID);
        $quantity = intval($Cart->Quantity);
        $sql = "SELECT * FROM cart WHERE UserID = $userID AND ProductID = $productID";
        $existingCartItem = $this->getOneCustome($sql);

        if ($existingCartItem) {
            $Endquantity = $quantity;
            return $this->updateTowId('cart',$userID,$productID,'UserID','ProductID','Quantity',$Endquantity);
        } else {
            $data = [
                'UserID' => $userID,
                'ProductID' => $productID,
                'Quantity' => $quantity,
            ];
            return $this->create('cart', $data);
        }
    }


    public function adddCart($Cart) {
        if (empty($Cart->UserID) || empty($Cart->ProductID) || $Cart->Quantity <= 0) {
            throw new InvalidArgumentException('Invalid cart data.');
        }
        $userID = intval($Cart->UserID);
        $productID = intval($Cart->ProductID);
        $quantity = intval($Cart->Quantity);
        $sql = "SELECT * FROM cart WHERE UserID = $userID AND ProductID = $productID";
        $existingCartItem = $this->getOneCustome($sql);

        if ($existingCartItem) {
            $Endquantity = $existingCartItem['Quantity']+$quantity;
            return $this->updateTowId('cart',$userID,$productID,'UserID','ProductID','Quantity',$Endquantity);
        } else {
            $data = [
                'UserID' => $userID,
                'ProductID' => $productID,
                'Quantity' => $quantity,
            ];
            return $this->create('cart', $data);
        }
    }
}
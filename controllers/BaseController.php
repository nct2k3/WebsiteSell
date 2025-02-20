<?php
    // nền cho các controller khác dựa vào
    class BaseController
    {
        const VIEW_FOLDER_NAME = 'Views';
        const MODEL_FOLDER_NAME = 'models';
        protected function view($viewPath, array $data = [])
        {
            extract($data); 
            require (self::VIEW_FOLDER_NAME . '/' . str_replace('.', '/', $viewPath) . '.php');
        }
        protected function loadModel($model)
        {
            $modelPath = __DIR__ . '/../' . self::MODEL_FOLDER_NAME . '/' . str_replace('.', '/', $model) . '.php';
            require_once $modelPath;
            return new $model();
        }
        protected function takeIDAccount(){
            if (isset($_SESSION['AccountID'])) {
                $accountID = $_SESSION['AccountID'];
                return $accountID;
            } else {
            return;
            }
        }
        protected function takeRole(){
            if (isset($_SESSION['Role'])) {
                $accountID = $_SESSION['Role'];
                return $accountID;
            } else {
            return;
            }
        }

        protected function takeIDProduct(){
            if (isset($_SESSION['IdProduct'])) {
                $IdProduct = $_SESSION['IdProduct'];
                return $IdProduct;
            } else {
            return;
            }
        }
        protected function getAllProduct() {
        
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if (isset($_SESSION['Product']) && is_string($_SESSION['Product'])) {
                $productsData = json_decode($_SESSION['Product'], true); 
                $products = [];
                foreach ($productsData as $item) {
                    $products[] = new Product(
                        $item['productID'],
                        $item['productLineID'],
                        $item['productType'],
                        $item['productModel'],
                        $item['productName'],
                        $item['price'],
                        $item['originalPrice'],
                        $item['stock'],
                        $item['img'],
                        $item['capacity'],
                        $item['color']
                    );
                }
                return $products; 
            } else {
                return [];
            }
     }

}
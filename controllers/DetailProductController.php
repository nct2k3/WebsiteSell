<?php
class DetailProductController extends BaseController
{
    private $ProductModel;
    private $CartModel;
    public function __construct()
    {
        $this->ProductModel = $this->loadModel("ProductModel");
        $this->CartModel = $this->loadModel("CartModel");
    }

    public function index()
    {
        $id = $_GET['items'];
        $product = $this->ProductModel->getProductByID($id);
        $ProductDeatil= $this->ProductModel->getDeatilProduct($product->productType);
        $products = [];
            $capacity = $this->getCapacity($product->productType);
            $color = $this->getColor($product->productType);
            $products[] = [
                'item' => $product,
                'capacity' => $capacity,
                'color'=> $color
            ];

        $ProductIphone = $this->ProductModel->getByIdGroup(rand(1, 6));
        $this->view('frontEnd.detailProduct.index', ['ProductIphone' => $ProductIphone,'productDetail'=>$ProductDeatil,'products' => $products,'productType'=>$product->productType]);
    }
   

    // tìm kiếm theo màu và dung lượnglượng
    public function searchColorAndCapacity()
    {
        $Color = isset($_GET['color']) ? $_GET['color'] : null;
        $Capacity = isset($_GET['capacity']) ? $_GET['capacity'] : null;
        $productType = $_GET['productType'];
    
        try {
            $product = null;
            $capacity = [];
            $color = [];
            if ($Color && $Capacity) {
                $product = $this->ProductModel->getproductCapacityAndColor($Color, $Capacity, $productType);
                if (!$product) {
                    throw new Exception('Không tìm thấy sản phẩm với Color và Capacity được cung cấp.');
                }
                $capacity = $this->getCapacity($product->productType);
                $color = $this->getColor($product->productType);
            } 
            elseif ($Color) {
                $product = $this->ProductModel->getproductColor($Color, $productType);
                if (!$product) {
                    throw new Exception('Không tìm thấy sản phẩm với Color được cung cấp.');
                }
                $capacity = $this->ProductModel->getCapacityByTow($product->productType, $Color);
                $color = $this->getColor($product->productType);
            } 
            elseif ($Capacity) {
                $product = $this->ProductModel->getproductCapacity($Capacity, $productType);
                if (!$product) {
                    throw new Exception('Không tìm thấy sản phẩm với Capacity được cung cấp.');
                }
                $capacity = $this->getCapacity($product->productType);
                $color = $this->ProductModel->getColorByTow($product->productType, $Capacity);
            } 
            else {
                throw new Exception('Không có thông tin tìm kiếm nào được cung cấp.');
            }
            $products = [];
            $products[] = [
                'item' => $product,
                'capacity' => $capacity,
                'color' => $color
            ];
            $ProductDeatil= $this->ProductModel->getDeatilProduct($product->productType);

            $ProductIphone = $this->ProductModel->getByIdGroup(rand(1, 6));
    
            $this->view('frontEnd.detailProduct.index', ['ProductIphone' => $ProductIphone,'productDetail'=>$ProductDeatil,'products' => $products, 'productType' => $product->productType]);
    
        } catch (Exception $e) {
            $this->view('frontEnd.detailProduct.index', [
                'products' => [],
                'productType' => $productType,
                'errorMessage' => $e->getMessage() 
            ]);
        }
    }
    // thêm giỏ hànghàng
    public function addCart(){
        $userId= $this->takeIDAccount();
        if($userId==""){
            $_SESSION['error'] = "You are not logged in yet!";
            $this->index(); 
            return;
        }
        $id = $_GET['items'];
        $cart= new Cart(
            '',
            $userId,
            $id,
            1
        );
        $data=$this->CartModel->createCart($cart);
        if ($data==1) {
            $_SESSION['message'] = "Added successfully!";
        }
        $this->index(); 
    }

    // lấy dung lượnglượng
    public function getCapacity($productType) {
        $capacity = $this->ProductModel->getCapacity($productType);
        return $capacity;
    }
    // lấy màu 
    public function getColor($productType) {
        $Color = $this->ProductModel->getColor($productType);
        return $Color;
    }
}

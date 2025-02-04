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
        // Lấy danh sách sản phẩm theo ProductLineID
        $product = $this->ProductModel->getProductByID($id);
        $ProductDeatil= $this->ProductModel->getDeatilProduct($product->productType);
        $products = [];
            $capacity = $this->getCapacity($product->productType);
            $color = $this->getColor($product->productType);
           
            // Thêm item và capacity vào mảng products
            $products[] = [
                'item' => $product,
                'capacity' => $capacity,
                'color'=> $color
            ];

        $ProductIphone = $this->ProductModel->getByIdGroup(rand(1, 6));
        $this->view('frontEnd.detailProduct.index', ['ProductIphone' => $ProductIphone,'productDetail'=>$ProductDeatil,'products' => $products,'productType'=>$product->productType]);
    }
   


    public function searchColorAndCapacity()
    {
        $Color = isset($_GET['color']) ? $_GET['color'] : null;
        $Capacity = isset($_GET['capacity']) ? $_GET['capacity'] : null;
        $productType = $_GET['productType'];
    
        try {
            // Khai báo các biến trước
            $product = null;
            $capacity = [];
            $color = [];
    
            // Nếu có cả Color và Capacity
            if ($Color && $Capacity) {
                $product = $this->ProductModel->getproductCapacityAndColor($Color, $Capacity, $productType);
                if (!$product) {
                    throw new Exception('Không tìm thấy sản phẩm với Color và Capacity được cung cấp.');
                }
                $capacity = $this->getCapacity($product->productType);
                $color = $this->getColor($product->productType);
            } 
            // Nếu chỉ có Color
            elseif ($Color) {
                $product = $this->ProductModel->getproductColor($Color, $productType);
                if (!$product) {
                    throw new Exception('Không tìm thấy sản phẩm với Color được cung cấp.');
                }
                $capacity = $this->ProductModel->getCapacityByTow($product->productType, $Color);
                $color = $this->getColor($product->productType);
            } 
            // Nếu chỉ có Capacity
            elseif ($Capacity) {
                $product = $this->ProductModel->getproductCapacity($Capacity, $productType);
                if (!$product) {
                    throw new Exception('Không tìm thấy sản phẩm với Capacity được cung cấp.');
                }
                $capacity = $this->getCapacity($product->productType);
                $color = $this->ProductModel->getColorByTow($product->productType, $Capacity);
            } 
            // Nếu không có cả Color và Capacity
            else {
                throw new Exception('Không có thông tin tìm kiếm nào được cung cấp.');
            }
    
            // Chuẩn bị dữ liệu hiển thị
            $products = [];
            $products[] = [
                'item' => $product,
                'capacity' => $capacity,
                'color' => $color
            ];
            $ProductDeatil= $this->ProductModel->getDeatilProduct($product->productType);
    
            $this->view('frontEnd.detailProduct.index', ['productDetail'=>$ProductDeatil,'products' => $products, 'productType' => $product->productType]);
    
        } catch (Exception $e) {
            // Xử lý khi có lỗi xảy ra
            $this->view('frontEnd.detailProduct.index', [
                'products' => [],
                'productType' => $productType,
                'errorMessage' => $e->getMessage() 
            ]);
        }
    }
    


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
    public function getCapacity($productType) {
        // Gọi hàm trong ProductModel để lấy capacity dựa trên productType
        $capacity = $this->ProductModel->getCapacity($productType);
        return $capacity;
    }
    public function getColor($productType) {
        // Gọi hàm trong ProductModel để lấy capacity dựa trên productType
        $Color = $this->ProductModel->getColor($productType);
        return $Color;
    }
}

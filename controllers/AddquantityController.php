<?php
require_once __DIR__ ."/../entities/Product.php";

class AddquantityController extends BaseController
{
    private $ProductModel;
    public function __construct()
    {
        $this->ProductModel = $this->loadModel("ProductModel");
    }
    public function index()
    {
        $id=$_GET['id'];
        $ProductEdit = $this->ProductModel->getProductByID($id);
        $this->view('manager.AddQuantity.index',['ProductEdit'=>$ProductEdit]);
    }
    // thêm số lượng cho sản phẩm
    public function AddQuantity($id,$stock) {
        $ProductEdit = $this->ProductModel->getProductByID($id);
        if ($ProductEdit === null) {
            die("Error: Product not found.");
        }
        $stockNew =$ProductEdit->stock+$stock;
        $productData = new Product(
            $id,
            '',
            '',
            '',
            '',
            '',
            '',
            $stockNew,
            '',
            '',
            ''
        );
        $this->ProductModel->UpdateQuantity($productData);
        $_SESSION['message'] = "Update successfully!";
        header("Location: /?controller=homeManager");
        exit();
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? null;
    switch ($action) {
        case 'add':
            $id=$_POST['IdProduct'];
            $stock = $_POST['stock'];
            $AddQuantityController= new AddQuantityController();
            $AddQuantityController->AddQuantity($id,$stock);
            exit();
        default:
            echo "Hành động không hợp lệ!";
            break;
    }
}
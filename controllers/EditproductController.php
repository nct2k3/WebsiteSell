<?php
require_once __DIR__ . "/../entities/Product.php";
class FileHandler
{
    public static function uploadFile($file)
    {
        $uploadDir = __DIR__ . "/../uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = basename($file['name']);
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            return [
                'success' => true,
                'filePath' => "/uploads/" . $fileName
            ];
        } else {
            return [
                'success' => false,
                'error' => "Failed to upload file"
            ];
        }
    }
}

class EditProductController extends BaseController
{
    private $ProductModel;

    public function __construct()
    {
        $this->ProductModel = $this->loadModel("ProductModel");
    }

    public function index()
    {
        $productId = $_GET['id'] ?? null;
        if (!$productId) {
            $_SESSION['error'] = "Invalid product ID";
            header("Location: /?controller=homeManager");
            exit();
        }
        
        try {
            $dataLineProduct = $this->ProductModel->getLineProduct();
            $ProductEdit = $this->ProductModel->getProductById($productId);
            
            if (!$ProductEdit) {
                $_SESSION['error'] = "Product not found";
                header("Location: /?controller=homeManager");
                exit();
            }
            
            $this->view('manager.EditProduct.index', [
                'dataLineProduct' => $dataLineProduct,
                'ProductEdit' => $ProductEdit
            ]);
        } catch (Exception $e) {
            $_SESSION['error'] = "Error loading product data";
            header("Location: /?controller=homeManager");
            exit();
        }
    }

    public function updateProduct($productId, $data)
    {
        if (empty($productId)) {
            $_SESSION['error'] = "Invalid product ID";
            header("Location: /?controller=homeManager");
            exit();
        }

        try {
            // Get current product information
            $existingProduct = $this->ProductModel->getProductByID($productId);
            if (!$existingProduct) {
                $_SESSION['error'] = "Product not found";
                header("Location: /?controller=homeManager");
                exit();
            }

            // Convert Product object to array for merging
            $existingProductArray = [
                'productLineID' => $existingProduct->productLineID,
                'productName' => $existingProduct->productName,
                'price' => $existingProduct->price,
                'originalPrice' => $existingProduct->originalPrice,
                'imageUrl' => $existingProduct->img,
                'capacity' => $existingProduct->capacity,
                'color' => $existingProduct->color,
                'Status' => $existingProduct->Status
            ];

            // Update only submitted fields
            $updatedData = array_merge($existingProductArray, $data);

            // Check for file upload
            if (isset($_FILES['file']) && $_FILES['file']['size'] > 0) {
                if (!class_exists('FileHandler')) {
                    throw new Exception("FileHandler class not found");
                }
                
                $uploadResult = FileHandler::uploadFile($_FILES['file']);
                if ($uploadResult['success']) {
                    $updatedData['imageUrl'] = $uploadResult['filePath'];
                } else {
                    throw new Exception($uploadResult['error']);
                }
            }

            // Update product data
            $productData = new Product(
                $productId,
                $updatedData['productLineID'],
                $updatedData['productName'],
                $updatedData['Status'],
                $updatedData['price'],
                $updatedData['originalPrice'],
                0,
                $updatedData['imageUrl'],
                $updatedData['capacity'],
                $updatedData['color'],
                
            );
            print_r($productData);
            $this->ProductModel->updateProduct($productData);
            $_SESSION['success'] = "Product updated successfully!";
           header("Location: /?controller=homeManager");
            exit();
            
        } catch (Exception $e) {
            $_SESSION['error'] = "Error updating product: " . $e->getMessage();
            header("Location: /?controller=homeManager");
            exit();
        }
    }
}

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST['action'] ?? null;

    if ($action === 'edit') {
        $productId = $_POST['productId'] ?? null;
        $data = [
            'productLineID' => $_POST['productLine'] ?? '',
            'productName' => $_POST['productName'] ?? '',
            'originalPrice' => $_POST['originalPrice'] ?? '',
            'price' => $_POST['Price'] ?? '',
            'capacity' => $_POST['capacity'] ?? '',
            'color' => $_POST['color'] ?? '',
            'Status' => $_POST['Status'] ?? '',
        ];
            $controller = new EditProductController();
            $controller->updateProduct($productId, $data);
    }
}

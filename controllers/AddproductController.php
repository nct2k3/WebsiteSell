<?php
require_once __DIR__ . "/../entities/Product.php";

class FileHandler
{
    public static function uploadFile($file, $destinationFolder = 'public/img/')
    {
        // Kiểm tra nếu file hợp lệ
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'error' => 'Lỗi tải tệp hoặc chưa tải tệp nào'];
        }

        // Kiểm tra định dạng file (chỉ chấp nhận ảnh)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = mime_content_type($file['tmp_name']);

        if (!in_array($fileType, $allowedTypes)) {
            return ['success' => false, 'error' => 'Định dạng tệp không hợp lệ. Chỉ chấp nhận JPEG, PNG và GIF.'];
        }

        // Tạo tên file duy nhất
        $fileName = time() . '_' . basename($file['name']);
        $filePath = $destinationFolder . $fileName;

        // Kiểm tra và tạo thư mục nếu chưa tồn tại
        if (!is_dir($destinationFolder)) {
            if (!mkdir($destinationFolder, 0777, true) && !is_dir($destinationFolder)) {
                return ['success' => false, 'error' => 'Không thể tạo thư mục đích.'];
            }
        }

        // Lưu file
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            return ['success' => true, 'filePath' => $filePath];
        } else {
            return ['success' => false, 'error' => 'Không thể lưu tệp đã tải lên.'];
        }
    }
}

class AddProductController extends BaseController
{
    private $ProductModel;

    public function __construct()
    {
        $this->ProductModel = $this->loadModel("ProductModel");
    }

    public function index()
    {
        $Url = $_SESSION['UrlProduct'] ?? '';
        $dataLineProduct = $this->ProductModel->getLineProduct();
        $this->view('manager.AddProduct.index', ['Url' => $Url, 'dataLineProduct' => $dataLineProduct]);
    }

    public function AddProduct($productLine, $productName, $Status, $originalPrice, $price, $stock, $capacity, $color)
    {
        if (empty($productLine) || empty($productName) || empty($originalPrice) || empty($price)) {
            $_SESSION['error'] = "Vui lòng điền đầy đủ các trường bắt buộc.";
            header("Location: /?controller=addProduct");
            exit();
        }

        $Url = $_SESSION['UrlProduct'] ?? '';

        if (empty($Url)) {
            $_SESSION['error'] = "Yêu cầu tải lên tệp.";
            header("Location: /?controller=addProduct");
            exit();
        }

        $productData = new Product(
            null,
            $productLine,
            $productName,
            $Status,
            $price,
            $originalPrice,
            $stock,
            $Url,
            $capacity,
            $color
        );
        print_r($productData);
        
        $result = $this->ProductModel->createProduct($productData);

        if ($result) {
            $_SESSION['message'] = "Thêm sản phẩm thành công!";
            header("Location: /?controller=homeManager");
        } else {
            $_SESSION['error'] = "Thêm sản phẩm thất bại, có thể sản phẩm đã tồn tại.";
            header("Location: /?controller=addProduct");
        }
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST['action'] ?? null;

    switch ($action) {
        case 'add':
            $productLine = $_POST['productLine'] ?? '';
            $productName = $_POST['productName'] ?? '';
            $originalPrice = $_POST['originalPrice'] ?? 0;
            $price = $_POST['Price'] ?? 0;
            $stock = 1;
            $capacity = $_POST['capacity'] ?? '';
            $color = $_POST['color'] ?? '';
            $Status = 0;

            // Xử lý file upload
            if (isset($_FILES['file'])) {
                $uploadResult = FileHandler::uploadFile($_FILES['file']);
                if ($uploadResult['success']) {
                    $_SESSION['UrlProduct'] = $uploadResult['filePath'];
                } else {
                    $_SESSION['error'] = $uploadResult['error'];
                    header("Location: /?controller=addProduct");
                    exit();
                }
            } else {
                $_SESSION['error'] = "Chưa tải lên tệp nào.";
                header("Location: /?controller=addProduct");
                exit();
            }

            // Tạo sản phẩm
            $AddProductController = new AddProductController();
            $AddProductController->AddProduct(
                $productLine,
                $productName,
                $Status,
                $originalPrice,
                $price,
                $stock,
                $capacity,
                $color
            );
            break;
    }
}
?>
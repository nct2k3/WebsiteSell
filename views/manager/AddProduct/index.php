<?php
require_once './controllers/HeadermanagerController.php';
$controller = new HeadermanagerController();
$controller->index();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Nhập Liệu Sản Phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <h1 class="text-2xl font-bold mt-2 text-center">Thêm sản phẩm mới</h1>

    <div class="max-w-6xl mx-auto px-6 py-4 bg-white rounded-lg shadow-md mt-10">
        <!-- Hiển thị thông báo -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-500 text-white text-center p-2 mb-4">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="bg-green-500 text-white text-center p-2 mb-4">
                <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <!-- Form thêm sản phẩm -->
        <form action="?controller=Addproduct" method="POST" enctype="multipart/form-data" class="grid grid-cols-3 gap-4">
            <input type="hidden" name="action" value="add">

            <div>
                <label for="productLine" class="block text-sm font-medium text-gray-700">Dòng sản phẩm</label>
                <select id="productLine" name="productLine" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    <option value="" disabled selected>Chọn dòng sản phẩm</option>
                    <?php foreach ($dataLineProduct as $items): ?>
                        <option value="<?php echo $items->ProductLineID; ?>"><?php echo $items->ProductLineName; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="file" class="block text-sm font-medium text-gray-700">Hình ảnh</label>
                <input type="file" name="file" id="file" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" accept="image/*" onchange="previewImage(this)" required>
                <img id="preview" src="#" alt="Preview" class="hidden max-w-xs mt-2">
                <script>
                    function previewImage(input) {
                        const preview = document.getElementById('preview');
                        if (input.files && input.files[0]) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                preview.src = e.target.result;
                                preview.classList.remove('hidden');
                            }
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                </script>
            </div>

            <!-- Các trường khác -->
            <div>
                <label for="productName" class="block text-sm font-medium text-gray-700">Tên sản phẩm</label>
                <input type="text" id="productName" name="productName" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <div>
                <label for="originalPrice" class="block text-sm font-medium text-gray-700">Giá gốc</label>
                <input type="number" min="0" id="originalPrice" name="originalPrice" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <div>
                <label for="Price" class="block text-sm font-medium text-gray-700">Giá bán</label>
                <input type="number" min="0" id="Price" name="Price" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <div>
                <label for="capacity" class="block text-sm font-medium text-gray-700">Dung lượng</label>
                <input type="text" id="capacity" name="capacity" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <div>
                <label for="color" class="block text-sm font-medium text-gray-700">Màu sắc</label>
                <select id="color" name="color" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    <option value="" disabled selected>Chọn màu</option>
                    <option value="black">Đen</option>
                    <option value="white">Trắng</option>
                    <option value="red">Đỏ</option>
                    <option value="blue">Xanh dương</option>
                    <option value="green">Xanh lá</option>
                    <option value="yellow">Vàng gold</option>
                    <option value="pink">Hồng</option>
                </select>
            </div>

            <div class="col-span-3 flex justify-end">
                <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">Thêm</button>
            </div>
        </form>
    </div>
</body>
</html>

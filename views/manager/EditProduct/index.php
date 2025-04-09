<?php
require_once './controllers/HeadermanagerController.php';
$controller = new HeadermanagerController();
$controller->index();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Sản Phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <h1 class="text-2xl font-bold mt-2 text-center">Chỉnh Sửa Sản Phẩm: ID <?php echo $ProductEdit->productID; ?></h1>
    <div class="max-w-6xl mx-auto px-6 py-4 bg-white rounded-lg shadow-md">
        <form action="?controller=EditProduct" method="POST" enctype="multipart/form-data" class="grid grid-cols-3 gap-4">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="productId" value="<?php echo $ProductEdit->productID; ?>">
            <div>
                <label for="file" class="block text-sm font-medium text-gray-700">Hình ảnh</label>
                <input type="file" name="file" id="file" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" accept="image/*" onchange="previewImage(this)">
                <img id="preview" src="<?php echo $ProductEdit->img; ?>" alt="Preview" class="h-24 w-24 mt-2">
                <script>
                    function previewImage(input) {
                        const preview = document.getElementById('preview');
                        if (input.files && input.files[0]) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                preview.src = e.target.result;
                            }
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                </script>
            </div>
            <div>
                <label for="productLine" class="block text-sm font-medium text-gray-700">Dòng sản phẩm: <?php echo $ProductEdit->productLineID; ?></label>
                <select id="productLine" name="productLine" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    <option value="" disabled>Chọn dòng sản phẩm</option>
                    <?php foreach ($dataLineProduct as $items): ?>
                        <option value="<?php echo $items->ProductLineID; ?>"><?php echo $items->ProductLineName; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>


            <div>
                <label for="productName" class="block text-sm font-medium text-gray-700">Tên sản phẩm : <?php echo $ProductEdit->productName; ?></label>
                <input type="text" id="productName" name="productName" value="<?php echo $ProductEdit->productName; ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <div>
                <label for="originalPrice" class="block text-sm font-medium text-gray-700">Giá gốc: <?php echo number_format($ProductEdit->originalPrice); ?> đ</label>
                <input type="number" id="originalPrice" name="originalPrice" value="<?php echo $ProductEdit->originalPrice; ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <div>
                <label for="Price" class="block text-sm font-medium text-gray-700">Giá bán: <?php echo number_format($ProductEdit->price);?> đđ</label>
                <input type="number" id="Price" name="Price" value="<?php echo $ProductEdit->price; ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <div>
                <label for="capacity" class="block text-sm font-medium text-gray-700">Dung lượng: <?php echo $ProductEdit->capacity; ?></label>
                <input type="text" id="capacity" name="capacity" value="<?php echo $ProductEdit->capacity; ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <div>
                <label for="color" class="block text-sm font-medium text-gray-700">Màu sắc: <?php echo $ProductEdit->color; ?></label>
                <select id="color" name="color" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    <option value="<?php echo $ProductEdit->color; ?>" selected hidden><?php 
                        $colorMap = [
                            'black' => 'Đen',
                            'white' => 'Trắng', 
                            'red' => 'Đỏ',
                            'blue' => 'Xanh dương',
                            'green' => 'Xanh lá',
                            'yellow' => 'Vàng gold',
                            'pink' => 'Hồng'
                        ];
                        echo isset($colorMap[$ProductEdit->color]) ? $colorMap[$ProductEdit->color] : $ProductEdit->color;
                    ?></option>
                    <option value="black">Đen</option>
                    <option value="white">Trắng</option>
                    <option value="red">Đỏ</option>
                    <option value="blue">Xanh dương</option>
                    <option value="green">Xanh lá</option>
                    <option value="yellow">Vàng gold</option>
                    <option value="pink">Hồng</option>
                </select>
            </div>

            <div>
                <label for="Status" class="block text-sm font-medium text-gray-700">Trạng thái: 
                    <span class="<?php echo $ProductEdit->Status == 0 ? 'text-green-600' : 'text-red-600'; ?>">
                        <?php echo $ProductEdit->Status == 0 ? 'Đang bán' : 'Đã ẩn'; ?>
                    </span>
                </label>
                <select id="Status" name="Status" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    <option value="<?php echo $ProductEdit->Status; ?>" selected hidden>
                        <?php echo $ProductEdit->Status == 0 ? 'Đang bán' : 'Ẩn'; ?>
                    </option>
                    <option value="0">Đang bán</option>
                    <option value="1">Ẩn</option>
                </select>
            </div>

            <div class="col-span-3 flex justify-end">
                <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">Cập nhật</button>
            </div>
        </form>
    </div>
</body>
</html>

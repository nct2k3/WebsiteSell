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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #111827;
            background-image: 
                radial-gradient(circle at 25% 25%, rgba(74, 85, 104, 0.05) 0%, transparent 40%),
                radial-gradient(circle at 75% 75%, rgba(79, 70, 229, 0.05) 0%, transparent 40%);
        }
        
        /* Loại bỏ outline khi focus */
        input:focus, select:focus, button:focus {
            outline: none;
        }
        
        /* Tùy chỉnh select */
        select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23A78BFA' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1em;
            padding-right: 2.5rem;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }
        
        /* Tùy chỉnh input file */
        input[type="file"] {
            color: #D1D5DB;
        }
        
        input[type="file"]::file-selector-button {
            background-color: #4F46E5;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.25rem;
            margin-right: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        input[type="file"]::file-selector-button:hover {
            background-color: #4338CA;
        }
        
        /* Input number - hide arrows */
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
        
        input[type=number] {
            -moz-appearance: textfield;
        }
        
        /* Thanh cuộn tối */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #1F2937;
        }
        ::-webkit-scrollbar-thumb {
            background: #4B5563;
            border-radius: 4px;
        }
        
        /* Input styling */
        .input-field {
            transition: all 0.3s;
            background-color: rgba(55, 65, 81, 0.8);
        }
        
        .input-field:focus-within {
            background-color: rgba(55, 65, 81, 1);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.3);
        }
        
        /* Button glow effect */
        .btn-glow {
            position: relative;
            z-index: 1;
            overflow: hidden;
            transition: all 0.3s;
        }
        
        .btn-glow:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 0;
            background: linear-gradient(to top, rgba(129, 140, 248, 0.2), transparent);
            z-index: -1;
            transition: height 0.3s ease-out;
        }
        
        .btn-glow:hover:after {
            height: 100%;
        }
        
        /* Image preview styling */
        .image-preview {
            position: relative;
            overflow: hidden;
            background: rgba(17, 24, 39, 0.5);
            transition: all 0.3s;
        }
        
        .image-preview:hover {
            transform: scale(1.03);
        }
        
        .image-preview img {
            transition: all 0.3s;
        }
        
        .image-preview:hover img {
            transform: scale(1.05);
        }
        
        /* Label values */
        .label-value {
            display: inline-block;
            padding: 0.1rem 0.5rem;
            border-radius: 0.25rem;
            background-color: rgba(79, 70, 229, 0.1);
            color: #A78BFA;
        }
    </style>
</head>

<body class="text-gray-200 min-h-screen py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="bg-gray-800 backdrop-filter backdrop-blur-sm bg-opacity-90 rounded-xl overflow-hidden shadow-2xl p-8 animate__animated animate__fadeIn">
            <h1 class="text-3xl font-bold text-center mb-2 bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400">
                Chỉnh Sửa Sản Phẩm
            </h1>
            <p class="text-center text-gray-400 mb-8">
                ID: <span class="text-indigo-300 font-medium"><?php echo $ProductEdit->productID; ?></span>
            </p>
            
            <form action="?controller=EditProduct" method="POST" enctype="multipart/form-data" class="space-y-8">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="productId" value="<?php echo $ProductEdit->productID; ?>">
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="space-y-3">
                        <label for="file" class="block text-sm font-medium text-indigo-300 mb-2">Hình ảnh sản phẩm</label>
                        <div class="image-preview rounded-lg flex items-center justify-center p-4 h-48">
                            <img id="preview" src="<?php echo $ProductEdit->img; ?>" alt="Preview" class="max-h-full max-w-full object-contain">
                        </div>
                        <div class="input-field rounded-lg p-3 mt-2">
                            <input type="file" name="file" id="file" accept="image/*" onchange="previewImage(this)">
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <label for="productLine" class="block text-sm font-medium text-indigo-300 mb-2">
                            Dòng sản phẩm <span class="label-value ml-2"><?php echo $ProductEdit->productLineID; ?></span>
                        </label>
                        <div class="input-field rounded-lg p-3">
                            <select id="productLine" name="productLine" required class="w-full bg-transparent text-indigo-200">
                                <option value="" disabled>Chọn dòng sản phẩm</option>
                                <?php foreach ($dataLineProduct as $items): ?>
                                    <option value="<?php echo $items->ProductLineID; ?>" class="bg-gray-800 text-gray-200" <?php echo ($items->ProductLineID == $ProductEdit->productLineID) ? 'selected' : ''; ?>>
                                        <?php echo $items->ProductLineName; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <label for="productName" class="block text-sm font-medium text-indigo-300 mb-2">
                            Tên sản phẩm
                        </label>
                        <div class="input-field rounded-lg p-3 flex items-center">
                            <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <input type="text" id="productName" name="productName" value="<?php echo $ProductEdit->productName; ?>" class="w-full bg-transparent text-indigo-200" required>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <label for="originalPrice" class="block text-sm font-medium text-indigo-300 mb-2">
                            Giá gốc <span class="label-value ml-2"><?php echo number_format($ProductEdit->originalPrice); ?> đ</span>
                        </label>
                        <div class="input-field rounded-lg p-3 flex items-center">
                            <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <input type="number" id="originalPrice" name="originalPrice" value="<?php echo $ProductEdit->originalPrice; ?>" class="w-full bg-transparent text-indigo-200" required>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <label for="Price" class="block text-sm font-medium text-indigo-300 mb-2">
                            Giá bán <span class="label-value ml-2"><?php echo number_format($ProductEdit->price);?> đ</span>
                        </label>
                        <div class="input-field rounded-lg p-3 flex items-center">
                            <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <input type="number" id="Price" name="Price" value="<?php echo $ProductEdit->price; ?>" class="w-full bg-transparent text-indigo-200" required>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <label for="capacity" class="block text-sm font-medium text-indigo-300 mb-2">
                            Dung lượng <span class="label-value ml-2"><?php echo $ProductEdit->capacity; ?></span>
                        </label>
                        <div class="input-field rounded-lg p-3 flex items-center">
                            <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                            </svg>
                            <input type="text" id="capacity" name="capacity" value="<?php echo $ProductEdit->capacity; ?>" class="w-full bg-transparent text-indigo-200" required>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <label for="color" class="block text-sm font-medium text-indigo-300 mb-2">
                            Màu sắc <span class="label-value ml-2"><?php echo $ProductEdit->color; ?></span>
                        </label>
                        <div class="input-field rounded-lg p-3 flex items-center">
                            <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                            </svg>
                            <select id="color" name="color" class="w-full bg-transparent text-indigo-200">
                                <option value="<?php echo $ProductEdit->color; ?>" selected hidden class="bg-gray-800 text-gray-200"><?php 
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
                                <option value="black" class="bg-gray-800 text-gray-200">Đen</option>
                                <option value="white" class="bg-gray-800 text-gray-200">Trắng</option>
                                <option value="red" class="bg-gray-800 text-gray-200">Đỏ</option>
                                <option value="blue" class="bg-gray-800 text-gray-200">Xanh dương</option>
                                <option value="green" class="bg-gray-800 text-gray-200">Xanh lá</option>
                                <option value="yellow" class="bg-gray-800 text-gray-200">Vàng gold</option>
                                <option value="pink" class="bg-gray-800 text-gray-200">Hồng</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <label for="Status" class="block text-sm font-medium text-indigo-300 mb-2">
                            Trạng thái 
                            <span class="<?php echo $ProductEdit->Status == 0 ? 'bg-green-900 bg-opacity-30 text-green-400' : 'bg-red-900 bg-opacity-30 text-red-400'; ?> rounded-md px-2 py-1 ml-2 text-xs font-medium">
                                <?php echo $ProductEdit->Status == 0 ? 'Đang bán' : 'Đã ẩn'; ?>
                            </span>
                        </label>
                        <div class="input-field rounded-lg p-3 flex items-center">
                            <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <select id="Status" name="Status" class="w-full bg-transparent text-indigo-200">
                                <option value="<?php echo $ProductEdit->Status; ?>" selected hidden class="bg-gray-800 text-gray-200">
                                    <?php echo $ProductEdit->Status == 0 ? 'Đang bán' : 'Ẩn'; ?>
                                </option>
                                <option value="0" class="bg-gray-800 text-gray-200">Đang bán</option>
                                <option value="1" class="bg-gray-800 text-gray-200">Ẩn</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end mt-10">
                    <button type="submit" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-medium py-3 px-8 rounded-lg shadow-lg transition duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-800 btn-glow">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                        </svg>
                        Cập nhật sản phẩm
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.add('animate__animated', 'animate__fadeIn');
                    setTimeout(() => {
                        preview.classList.remove('animate__animated', 'animate__fadeIn');
                    }, 1000);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        // Chọn dòng sản phẩm mặc định
        document.addEventListener('DOMContentLoaded', function() {
            const productLineSelect = document.getElementById('productLine');
            const currentLine = '<?php echo $ProductEdit->productLineID; ?>';
            
            for (let i = 0; i < productLineSelect.options.length; i++) {
                if (productLineSelect.options[i].value === currentLine) {
                    productLineSelect.selectedIndex = i;
                    break;
                }
            }
        });
        function confirmDelete(productName) {
            return confirm(`Bạn có chắc chắn muốn xóa sản phẩm "${productName}" không?`);
        }
    </script>
</body>
</html>
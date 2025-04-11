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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
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
        
        /* Input và select styling */
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
        
        /* Card hover effect */
        .card-hover {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2), 0 10px 10px -5px rgba(0, 0, 0, 0.1);
        }
        
        /* Preview image container */
        .preview-container {
            background: rgba(17, 24, 39, 0.8);
            backdrop-filter: blur(2px);
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="text-gray-200 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-12 animate__animated animate__fadeIn">
            <h1 class="text-4xl font-bold mb-2 bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400 py-3">Thêm sản phẩm mới</h1>
            <p class="text-gray-400">Nhập thông tin sản phẩm bạn muốn thêm vào hệ thống</p>
        </div>

        <div class="bg-gray-800 backdrop-filter backdrop-blur-sm bg-opacity-90 p-8 rounded-xl shadow-2xl card-hover animate__animated animate__fadeInUp">
            <!-- Hiển thị thông báo -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="bg-red-500 bg-opacity-90 text-white text-center p-4 mb-8 rounded-lg shadow-lg animate__animated animate__headShake">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['message'])): ?>
                <div class="bg-green-500 bg-opacity-90 text-white text-center p-4 mb-8 rounded-lg shadow-lg animate__animated animate__fadeIn">
                    <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
                </div>
            <?php endif; ?>

            <!-- Form thêm sản phẩm -->
            <form action="?controller=Addproduct" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add">

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="space-y-2">
                        <label for="productLine" class="block text-sm font-medium text-indigo-300">Dòng sản phẩm</label>
                        <div class="input-field rounded-lg p-3">
                            <select id="productLine" name="productLine" required class="w-full bg-transparent text-indigo-200">
                                <option value="" disabled selected>Chọn dòng sản phẩm</option>
                                <?php foreach ($dataLineProduct as $items): ?>
                                    <option value="<?php echo $items->ProductLineID; ?>" class="bg-gray-800 text-gray-200"><?php echo $items->ProductLineName; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="file" class="block text-sm font-medium text-indigo-300">Hình ảnh</label>
                        <div class="input-field rounded-lg p-3">
                            <input type="file" name="file" id="file" class="w-full" accept="image/*" onchange="previewImage(this)" required>
                        </div>
                        <div class="mt-4 flex justify-center items-center preview-container h-36 rounded-lg overflow-hidden">
                            <img id="preview" src="#" alt="Preview" class="hidden max-h-32 max-w-full object-contain">
                            <div id="placeholder" class="text-gray-500 text-sm">Xem trước hình ảnh</div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="productName" class="block text-sm font-medium text-indigo-300">Tên sản phẩm</label>
                        <div class="input-field rounded-lg p-3">
                            <input type="text" id="productName" name="productName" class="w-full bg-transparent text-white focus:text-indigo-200" placeholder="Nhập tên sản phẩm" required>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="originalPrice" class="block text-sm font-medium text-indigo-300">Giá gốc</label>
                        <div class="input-field rounded-lg p-3 flex items-center">
                            <span class="text-gray-400 mr-2">₫</span>
                            <input type="number" min="0" id="originalPrice" name="originalPrice" class="w-full bg-transparent text-white focus:text-indigo-200" placeholder="Nhập giá gốc" required>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="Price" class="block text-sm font-medium text-indigo-300">Giá bán</label>
                        <div class="input-field rounded-lg p-3 flex items-center">
                            <span class="text-gray-400 mr-2">₫</span>
                            <input type="number" min="0" id="Price" name="Price" class="w-full bg-transparent text-white focus:text-indigo-200" placeholder="Nhập giá bán" required>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="capacity" class="block text-sm font-medium text-indigo-300">Dung lượng</label>
                        <div class="input-field rounded-lg p-3">
                            <input type="text" id="capacity" name="capacity" class="w-full bg-transparent text-white focus:text-indigo-200" placeholder="Ví dụ: 128GB, 256GB..." required>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="color" class="block text-sm font-medium text-indigo-300">Màu sắc</label>
                        <div class="input-field rounded-lg p-3">
                            <select id="color" name="color" required class="w-full bg-transparent text-indigo-200">
                                <option value="" disabled selected>Chọn màu</option>
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
                </div>

                <div class="flex justify-end mt-12">
                    <button type="submit" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-medium py-3 px-8 rounded-lg shadow-lg btn-glow">
                        Thêm sản phẩm
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const placeholder = document.getElementById('placeholder');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.classList.add('hidden');
                placeholder.classList.remove('hidden');
            }
        }
    </script>
</body>
</html>
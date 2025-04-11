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
    <title>Danh Sách Sản Phẩm Điện Thoại</title>
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
            background: linear-gradient(to top, rgba(239, 68, 68, 0.2), transparent);
            z-index: -1;
            transition: height 0.3s ease-out;
        }
        
        .btn-glow:hover:after {
            height: 100%;
        }
        
        /* Card hover effect */
        .product-card {
            transition: all 0.3s ease;
        }
        
        .product-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
        }
        
        /* Product info styling */
        .product-info {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.25rem;
        }
        
        /* Pagination styling */
        .pagination-item {
            transition: all 0.2s;
        }
        
        .pagination-item:hover {
            transform: scale(1.05);
        }
        
        /* Hidden product styling */
        .hidden-product {
            position: relative;
        }
        
        .hidden-product::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(17, 24, 39, 0.2);
            backdrop-filter: blur(1px);
            z-index: 1;
            pointer-events: none;
        }
    </style>
</head>

<body class="text-gray-200 min-h-screen py-6">
    <div class="container mx-auto px-4 sm:px-6 max-w-6xl">
        <div class="bg-gray-800 backdrop-filter backdrop-blur-sm bg-opacity-90 rounded-xl overflow-hidden shadow-2xl p-6 mb-8 animate__animated animate__fadeIn">
            <h1 class="text-3xl font-bold text-center mb-2 bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400">Quản Lý Sản Phẩm</h1>
            <p class="text-gray-400 text-center mb-6">Tìm kiếm và xóa sản phẩm từ kho hàng</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="md:col-span-1">
                    <form method="POST" action="index.php?controller=DeleteProduct" class="space-y-4">
                        <input type="hidden" name="action" value="chosenLine">
                        <div class="space-y-2">
                            <label for="productLine" class="block text-sm font-medium text-indigo-300">Dòng Sản Phẩm</label>
                            <div class="input-field rounded-lg">
                                <select id="productLine" name="productLine" required onchange="this.form.submit()" class="w-full bg-transparent text-indigo-200 p-3">
                                    <?php if (!empty($NameLine)): ?>
                                        <option value="<?php echo htmlspecialchars($NameLine['ProductLineName'])?>" disabled selected class="bg-gray-800 text-gray-200"><?php echo htmlspecialchars($NameLine['ProductLineName'])?></option>
                                    <?php else: ?>
                                        <option value="" disabled selected class="bg-gray-800 text-gray-200">Chọn dòng sản phẩm</option>
                                    <?php endif; ?>     
                                    <?php foreach($dataLineProduct as $items): ?>
                                    <option value="<?php echo htmlspecialchars($items->ProductLineID) ?>" class="bg-gray-800 text-gray-200"><?php echo htmlspecialchars($items->ProductLineName) ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div class="md:col-span-2">
                    <form action="index.php?controller=DeleteProduct" method="POST" class="space-y-4">
                        <input type="hidden" name="action" value="search">
                        <div class="space-y-2">
                            <label for="string" class="block text-sm font-medium text-indigo-300">Tìm kiếm sản phẩm</label>
                            <div class="flex">
                                <div class="input-field rounded-l-lg flex-grow flex items-center p-3">
                                    <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    <input placeholder="Nhập tên sản phẩm cần tìm..." id="string" name="string" class="w-full bg-transparent text-indigo-200" type="text">
                                </div>
                                <button type="submit" class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-6 rounded-r-lg transition duration-300">
                                    Tìm
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="space-y-6 mt-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php if(isset($data) && !empty($data)): ?>
                        <?php foreach($data as $item) :?>
                        <div class="product-card <?php echo ($item->Status==1) ? 'hidden-product' : ''; ?> bg-gray-700 bg-opacity-70 rounded-xl overflow-hidden shadow-md">
                            <div class="flex p-4">
                                <img src="<?php echo htmlspecialchars($item->img) ?>" alt="Product Image" class="h-24 w-24 object-cover rounded-lg mr-4">
                                <div class="flex flex-grow">
                                    <div class="flex-grow product-info">
                                        <h3 class="text-lg font-semibold text-indigo-200"><?php echo htmlspecialchars($item->productName) ?></h3>
                                        <span class="text-gray-400 text-sm">Mã: <?php echo htmlspecialchars($item->productID) ?></span>
                                        <div class="flex items-center mt-1">
                                            <span class="text-orange-400 font-medium"><?php echo number_format($item->price, 0, ',', '.') ?> đ</span>
                                            <span class="text-gray-500 line-through text-sm ml-2"><?php echo number_format($item->originalPrice, 0, ',', '.') ?> đ</span>
                                        </div>
                                        <div class="flex flex-wrap gap-x-4 text-sm text-gray-300 mt-2">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 text-indigo-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                                                </svg>
                                                <span><?php echo htmlspecialchars($item->capacity) ?></span>
                                            </div>
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 text-indigo-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                                                </svg>
                                                <span><?php echo htmlspecialchars($item->color) ?></span>
                                            </div>
                                            <div class="flex items-center">
                                                <?php 
                                                $NewStatus = "Đang bán";
                                                $statusColor = "text-green-500";
                                                $statusIcon = '<svg class="w-4 h-4 text-green-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
                                                
                                                if($item->Status == 1){
                                                    $NewStatus = "Tạm ẩn";
                                                    $statusColor = "text-red-500";
                                                    $statusIcon = '<svg class="w-4 h-4 text-red-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
                                                }
                                                echo $statusIcon;
                                                ?>
                                                <span class="<?php echo $statusColor; ?> font-medium"><?php echo $NewStatus ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex items-center">
                                        <form action="index.php?controller=DeleteProduct&action=deleteProduct" method="POST" onsubmit="return confirmDelete('<?php echo htmlspecialchars(addslashes($item->productName)); ?>')">
                                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($item->productID); ?>">
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-lg transition-colors duration-300 btn-glow">
                                                <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Xóa
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                    <?php else: ?>
                        <div class="col-span-2 py-16 text-center text-gray-400 bg-gray-700 bg-opacity-50 rounded-xl">
                            <svg class="w-16 h-16 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-xl">Không tìm thấy sản phẩm nào</p>
                            <p class="text-gray-500 mt-2">Vui lòng thử tìm kiếm với từ khóa khác hoặc chọn dòng sản phẩm khác</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if(isset($numpage) && $numpage > 0): ?>
                <div class="flex justify-center p-6 mt-4">
                    <div class="flex flex-wrap justify-center">
                        <?php for($i = 1; $i <= $numpage; $i++): ?>
                            <a href="index.php?controller=DeleteProduct&page=<?php echo $i;?>" 
                            class="pagination-item h-10 w-10 mx-1 flex items-center justify-center rounded-lg <?php echo (isset($_GET['page']) && $_GET['page'] == $i) ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600'; ?> transition-colors duration-300">
                                <?php echo $i; ?>
                            </a>
                        <?php endfor; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function confirmDelete(productName) {
            return confirm(`Bạn có chắc chắn muốn xóa sản phẩm "${productName}" không?`);
        }
    </script>
</body>
</html>
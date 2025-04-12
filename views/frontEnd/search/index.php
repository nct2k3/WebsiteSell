<?php
require_once './controllers/HeaderController.php';

$controller = new HeaderController();
$controller->index();
$id = isset($_GET['items']) ? $_GET['items'] : 1;
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$searchString = $_GET['string'] ?? '';
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm sản phẩm</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #111827;
            background-image: 
                radial-gradient(circle at 25% 25%, rgba(74, 85, 104, 0.05) 0%, transparent 40%),
                radial-gradient(circle at 75% 75%, rgba(79, 70, 229, 0.05) 0%, transparent 40%);
            overflow-y: auto;
        }
        
        /* Animation cho thông báo */
        @keyframes fadeOut {
            0% { opacity: 1; }
            100% { opacity: 0; }
        }
        
        .fade-out {
            animation: fadeOut 0.5s forwards;
        }
        
        /* Card styling */
        .product-card {
            background: linear-gradient(145deg, rgba(31, 41, 55, 0.9), rgba(17, 24, 39, 0.9));
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
        }
        
        /* Input field styling */
        .input-field {
            background-color: rgba(55, 65, 81, 0.8);
            border: none;
            color: #E5E7EB;
        }
        
        .input-field:focus {
            background-color: rgba(55, 65, 81, 1);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.3);
            outline: none;
        }
        
        /* Filter tag styling */
        .filter-tag {
            background-color: rgba(55, 65, 81, 0.6);
            transition: all 0.2s;
        }
        
        .filter-tag:hover {
            background-color: rgba(55, 65, 81, 0.8);
        }
        
        /* Pagination styling */
        .pagination-item {
            transition: all 0.2s;
        }
        
        .pagination-item:hover {
            transform: scale(1.05);
        }
        
        /* Button Styling */
        .btn-primary {
            background: linear-gradient(to right, #4F46E5, #7C3AED);
            border: none;
            transition: all 0.2s;
        }
        
        .btn-primary:hover {
            background: linear-gradient(to right, #4338CA, #6D28D9);
            transform: translateY(-1px);
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
    </style>
</head>

<body>
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <div class="bg-gray-800 backdrop-filter backdrop-blur-sm bg-opacity-90 rounded-xl overflow-hidden shadow-2xl p-6 mb-8">
            <h1 class="text-3xl font-bold text-center mb-6 bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400">Tìm Kiếm Sản Phẩm</h1>
            
            <!-- Search Form -->
            <form action="" method="GET" class="mb-6">
                <input type="hidden" name="controller" value="search">
                <input type="hidden" name="action" value="search">
                <div class="relative">
                    <input 
                        id="string" 
                        name="string" 
                        value="<?php echo htmlspecialchars($string ?? ''); ?>"  
                        required 
                        class="input-field w-full py-3 px-4 pr-12 rounded-lg text-gray-100"
                        placeholder="Nhập từ khóa tìm kiếm..."
                        type="text">
                    <button type="submit" class="absolute right-0 top-0 h-full px-4 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-r-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </form>
            
            <!-- Active Filters -->
            <div class="flex flex-wrap items-center justify-between mb-6">
                 <button 
                    id="btnSearchWithConditions" 
                    class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg text-sm font-medium hover:from-indigo-700 hover:to-purple-700 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                    Tìm kiếm với điều kiện
                </button>
                <div class="flex flex-wrap gap-2">
                    <?php
                    // Initialize variables if not set
                    $productLineName = $productLineName ?? '';
                    $From = $From ?? '';
                    $To = $To ?? '';
                    $string = $string ?? '';

                    // Show message when no search conditions are applied
                    if ((!isset($productLineName) || $productLineName == '') && 
                        (!isset($From) || $From == '') && 
                        (!isset($To) || $To == '')): ?>
                        <div class="filter-tag flex items-center text-sm px-3 py-1.5 rounded-lg text-indigo-200">
                            <span>Không có điều kiện tìm kiếm</span>
                        </div>
                    <?php endif; ?>

                    <?php 
                    // Show product line name if exists and is valid
                    if (isset($productLineName) && is_array($productLineName) && 
                        !empty($productLineName) && isset($productLineName['ProductLineName'])): ?>
                        <div class="filter-tag flex items-center text-sm px-3 py-1.5 rounded-lg text-indigo-200">
                            <span><?php echo htmlspecialchars($productLineName['ProductLineName']); ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <?php 
                    // Show minimum price if set and valid
                    if (isset($From) && $From !== '' && is_numeric($From) && $From > 0): ?>
                        <div class="filter-tag flex items-center text-sm px-3 py-1.5 rounded-lg text-indigo-200">
                            <span>Từ: <?php echo number_format($From, 0, ',', '.') . '₫'; ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <?php 
                    // Show maximum price if set and valid
                    if (isset($To) && $To !== '' && is_numeric($To) && $To > 0): ?>
                        <div class="filter-tag flex items-center text-sm px-3 py-1.5 rounded-lg text-indigo-200">
                            <span>Đến: <?php echo number_format($To, 0, ',', '.') . '₫'; ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <?php 
                    // Show clear all button if any filter is applied
                    if ((isset($productLineName) && is_array($productLineName) && !empty($productLineName)) || 
                        (isset($From) && $From !== '' && is_numeric($From) && $From > 0) || 
                        (isset($To) && $To !== '' && is_numeric($To) && $To > 0)): ?>
                        <a href="?controller=search&action=search&string=<?php echo urlencode($string); ?>"
                           class="filter-tag flex items-center text-sm px-3 py-1.5 rounded-lg text-red-300 hover:text-red-100">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Xóa tất cả
                        </a>
                    <?php endif; ?>
                </div>
                
            </div>
            
            <!-- Advanced Search Form -->
            <div id="SearchWithConditions" class="hidden mb-6 bg-gray-700 bg-opacity-50 p-4 rounded-lg">
                <form action="" method="GET" class="space-y-4">
                    <input type="hidden" name="controller" value="search">
                    <input type="hidden" name="action" value="search">
                    <input type="hidden" name="string" value="<?php echo htmlspecialchars($string ?? ''); ?>">
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-indigo-300 mb-1">Dòng Sản Phẩm</label>
                            <select id="ProductLine" name="ProductLine" class="input-field w-full py-2 px-3 rounded-lg text-gray-100">
                                <option value="" <?php echo empty($ProductLine) ? 'selected' : ''; ?>>Tất cả dòng sản phẩm</option>
                                <?php foreach ($dataLineProduct as $items): ?>
                                    <option value="<?php echo $items->ProductLineID ?>" 
                                            <?php echo (isset($ProductLine) && $ProductLine == $items->ProductLineID) ? 'selected' : ''; ?>>
                                        <?php echo $items->ProductLineName ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-indigo-300 mb-1">Giá từ</label>
                            <input 
                                name="From" 
                                value="<?php echo htmlspecialchars($From ?? ''); ?>"
                                class="input-field w-full py-2 px-3 rounded-lg text-gray-100" 
                                type="number" 
                                placeholder="VNĐ" 
                                min="0" />
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-indigo-300 mb-1">Giá đến</label>
                            <input 
                                name="To" 
                                value="<?php echo htmlspecialchars($To ?? ''); ?>"
                                class="input-field w-full py-2 px-3 rounded-lg text-gray-100" 
                                type="number" 
                                placeholder="VNĐ" 
                                min="0" />
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button 
                            type="submit" 
                            class="px-6 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg text-sm font-medium hover:from-indigo-700 hover:to-purple-700">
                            Lọc kết quả
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Product Results -->
            <?php if (!empty($dataPrd)): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($dataPrd as $productData): ?>
                        <div 
                            class="product-card rounded-xl overflow-hidden cursor-pointer"
                            onclick="window.location='?controller=DetailProduct&items=<?php echo $productData->productID; ?>'">
                            <div class="p-4 text-center">
                                <img 
                                    class="mx-auto w-40 h-40 object-contain mb-4" 
                                    src="<?php echo htmlspecialchars($productData->img); ?>" 
                                    alt="<?php echo htmlspecialchars($productData->productName); ?>">
                                
                                <h2 class="text-lg font-bold text-indigo-200 mb-2"><?php echo htmlspecialchars($productData->productName); ?></h2>
                                
                                <div class="inline-block bg-gray-700 bg-opacity-50 px-3 py-1 rounded-full text-sm text-gray-300 mb-3">
                                    <?php echo $productData->capacity?>
                                </div>
                                
                                <div class="mt-3">
                                    <p class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-200">
                                        <?php echo number_format($productData->price); ?>₫
                                    </p>
                                    <p class="text-sm line-through text-gray-500"><?php echo number_format($productData->originalPrice); ?>₫</p>
                                </div>
                                
                                <div class="mt-2 bg-gradient-to-r from-orange-500 to-yellow-500 bg-clip-text text-transparent text-sm font-medium">
                                    Online giá rẻ quá
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="bg-gray-700 bg-opacity-50 rounded-lg p-8 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-xl font-bold text-red-400">Không tìm thấy sản phẩm nào</p>
                    <p class="text-gray-400 mt-2">Vui lòng thử với từ khóa khác hoặc điều chỉnh bộ lọc</p>
                </div>
            <?php endif; ?>
            
            <!-- Pagination -->
            <?php if (isset($numpage) && $numpage > 1): ?>
                <?php
                function buildUrl($page) {
                    $query = $_GET;
                    $query['page'] = $page;
                    return '?' . http_build_query($query);
                }
                ?>
                
                <div class="flex justify-center mt-8 space-x-2">
                    <?php if ($currentPage > 1): ?>
                        <a href="<?php echo buildUrl($currentPage - 1); ?>" 
                           class="pagination-item px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Trước
                        </a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $numpage; $i++): ?>
                        <a href="<?php echo buildUrl($i); ?>" 
                           class="pagination-item px-4 py-2 <?php echo ($i == $currentPage) ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white' : 'bg-gray-700 text-white'; ?> rounded-lg">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($currentPage < $numpage): ?>
                        <a href="<?php echo buildUrl($currentPage + 1); ?>" 
                           class="pagination-item px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 flex items-center">
                            Tiếp
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        const btnSearchWithConditions = document.getElementById('btnSearchWithConditions');
        const searchConditionsDiv = document.getElementById('SearchWithConditions');
      
        btnSearchWithConditions.addEventListener('click', function () {
            if (searchConditionsDiv.classList.contains('hidden')) {
                searchConditionsDiv.classList.remove('hidden'); 
            } else {
                searchConditionsDiv.classList.toggle('hidden'); 
            }
        });
    </script>
</body>
</html>

<?php
require_once './views/footer.php';
?>
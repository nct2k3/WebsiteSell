<?php
require_once './controllers/HeaderController.php';
$controller = new HeaderController();
$controller->index();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .card-header-gradient {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        }
        
        /* Custom scrollbar for dark mode */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #1f2937;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb {
            background: #4b5563;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #6b7280;
        }
        
        .btn-primary {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }
        
        .btn-danger {
            background-color: #ef4444;
            border-color: #ef4444;
        }
        
        .btn-warning {
            background-color: #f97316;
            border-color: #f97316;
            color: white;
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen">

    <?php if (isset($products) && !empty($products)): 
        $productInfo = $products;
    ?>
        <!-- Header Section -->
        <div class="mb-8 text-center py-4">
            <div class="flex w-full justify-center p-2">
                <img class="h-10" src="https://img.icons8.com/?size=100&id=30840&format=png&color=ffffff" alt="Logo">
                <div class="text-3xl font-bold text-blue-400">iPhone</div>
            </div>
            <p class="text-gray-400 mt-2">Chi tiết sản phẩm và thông tin mua hàng</p>
        </div>

        <div class="container mx-auto p-4 md:p-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Product Image Section -->
                <div class="bg-gray-800 rounded-xl shadow-lg p-4 overflow-hidden">                    
                    <div id="carouselExampleControls" class="carousel slide px-4" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100 rounded-xl" src="<?php echo htmlspecialchars($productInfo->img, ENT_QUOTES, 'UTF-8'); ?>" alt="Product Image">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>

                <!-- Product Details Section -->
                <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                    <div class="card-header-gradient text-white py-3 px-4 flex justify-between">
                        <h2 class="text-xl font-bold flex items-center">
                            </i>Chi Tiết Sản Phẩm
                        </h2>
                        <div class="text-white font-bold text-xl">
                        Dòng sản phẩm: 
                        <?php echo htmlspecialchars($nameLine['ProductLineName']); ?>
                    </div>
                    </div>
                    
                    
                    <div class="p-6">
                        <h1 class="text-2xl font-bold mb-2 text-blue-400"><?php echo htmlspecialchars($productInfo->productName, ENT_QUOTES, 'UTF-8'); ?></h1>
                        <p class="text-gray-400 flex items-center mb-4">
                            <i class="fas fa-map-marker-alt mr-2"></i>Giá và khuyến mãi tại: Hồ Chí Minh
                        </p>
                        
                        <div class="mt-4 space-y-4">
                            <div>
                                <h2 class="text-sm font-medium text-gray-300 mb-2">Dung lượng</h2>
                                <div class="flex space-x-4">
                                    <span class="px-4 py-2 bg-gray-700 rounded-lg flex items-center">
                                        <i class="fas fa-hdd mr-2 text-blue-400"></i>
                                        <?php echo htmlspecialchars($productInfo->capacity, ENT_QUOTES, 'UTF-8'); ?>
                                    </span>
                                </div>
                            </div>
                            
                            <div>
                                <h2 class="text-sm font-medium text-gray-300 mb-2">Màu:</h2>
                                <div class="flex items-center space-x-2">
                                    <?php
                                        $colorClass = ($productInfo->color == "black" || $productInfo->color == "white") ? $productInfo->color : $productInfo->color . '-500';
                                    ?>
                                    <div class="w-8 h-8 bg-<?php echo htmlspecialchars($colorClass, ENT_QUOTES, 'UTF-8'); ?> rounded-full cursor-pointer"></div>
                                    <span class="text-gray-300 capitalize"><?php echo htmlspecialchars($productInfo->color, ENT_QUOTES, 'UTF-8'); ?></span>
                                </div>
                            </div>

                            <div class="mt-6 bg-gray-700 p-4 rounded-lg">
                                <h2 class="text-lg font-bold flex items-center text-yellow-300 mb-2">
                                    <i class="fas fa-tag mr-2"></i>Online Giá Rẻ Quá
                                </h2>
                                <div class="flex items-center justify-between">
                                    <p class="text-2xl font-bold text-blue-400"><?php echo number_format($productInfo->price, 0, ',', '.'); ?>₫</p>
                                    <s class="text-gray-400"><?php echo number_format($productInfo->originalPrice, 0, ',', '.'); ?>₫</s>
                                </div>
                                
                                <div class="mt-3 mb-2">
                                    <div class="bg-gray-600 rounded-full">
                                        <div class="bg-blue-500 rounded-full h-2" style="width: 80%;"></div>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-400">Giảm <?php echo round((1 - $productInfo->price / $productInfo->originalPrice) * 100); ?>% so với giá gốc</p>
                            </div>
                            
                            <div class="mt-4 flex flex-col sm:flex-row gap-4">   
                            <?php if ($productInfo->Status == 1): ?>
                                <button class="btn btn-danger text-white w-full font-bold py-3 flex items-center justify-center" disabled>
                                    <i class="fas fa-ban mr-2"></i>Sản phẩm đã bị ẩn
                                </button>
                            <?php else: ?>
                                <button
                                    onclick="window.location='?controller=payment&action=buyOne&items=<?php echo htmlspecialchars($productInfo->productID, ENT_QUOTES, 'UTF-8'); ?>'"
                                    class="btn btn-primary w-full font-bold py-3 flex items-center justify-center">
                                    <i class="fas fa-shopping-cart mr-2"></i>Mua ngay
                                </button>

                                <button
                                    onclick="window.location='?controller=DetailProduct&action=addCart&items=<?php echo htmlspecialchars($productInfo->productID, ENT_QUOTES, 'UTF-8'); ?>'"
                                    class="btn btn-warning text-white w-full font-bold py-3 flex items-center justify-center">
                                    <i class="fas fa-cart-plus mr-2"></i>Thêm giỏ hàng
                                </button>
                            <?php endif; ?>
                            </div>

                            <div class="mt-4 text-gray-400 bg-gray-700 p-3 rounded-lg">
                                <p class="flex items-center mb-2">
                                    <i class="fas fa-clock mr-2"></i>Kết thúc vào: 23:59 / 28/01
                                </p>
                                <p class="flex items-center">
                                    <i class="fas fa-map-marker-alt mr-2"></i>Tại Hồ Chí Minh
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Other Products Section -->
            <div class="mt-8">
                <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                    <div class="card-header-gradient text-white py-3 px-4">
                        <h2 class="text-xl font-bold flex items-center">
                            <i class="fas fa-mobile-alt mr-2"></i>Sản Phẩm Khác
                        </h2>
                    </div>
                    
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <?php if (isset($ProductIphone) && !empty($ProductIphone)): ?>
                                <?php foreach ($ProductIphone as $items): ?>
                                    <div
                                        onclick="window.location='?controller=DetailProduct&items=<?php echo htmlspecialchars($items->productID, ENT_QUOTES, 'UTF-8'); ?>'"
                                        class="bg-gray-700 hover:bg-gray-600 rounded-xl shadow-lg p-4 text-white cursor-pointer transition duration-300">
                                        <img src="<?php echo htmlspecialchars($items->img, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($items->productName, ENT_QUOTES, 'UTF-8'); ?>" class="w-full h-48 object-contain rounded-lg mb-4">
                                        <h2 class="text-lg font-semibold mb-2 text-blue-300"><?php echo htmlspecialchars($items->productName, ENT_QUOTES, 'UTF-8'); ?></h2>
                                        <div class="flex justify-between items-center">
                                            <h1 class="font-bold text-xl text-blue-400"><?php echo number_format($items->price, 0, ',', '.'); ?>₫</h1>
                                            <h1 class="line-through text-gray-400 text-sm"><?php echo number_format($items->originalPrice, 0, ',', '.'); ?>₫</h1>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
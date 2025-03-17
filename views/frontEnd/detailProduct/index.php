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
</head>
<body class="bg-dark text-light">

    <?php if (isset($products) && !empty($products)): 
        $productInfo = $products;
    ?>
        <div class="text-center bg-dark py-3">
            <div class="flex w-full justify-center p-2">
                <img class="h-10" src="https://img.icons8.com/?size=100&id=30840&format=png&color=ffffff" alt="Logo">
                <div class="text-3xl font-bold text-white">iPhone</div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
            <div id="carouselExampleControls" class="carousel slide px-16" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100 rounded-3xl" src="<?php echo htmlspecialchars($productInfo->img); ?>" alt="Product Image">
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

            <div class="w-full">
                <div class="max-w-lg mx-auto bg-gray-800 rounded-lg p-6 shadow-lg">
                    <h1 class="text-2xl font-bold mb-2"><?php echo htmlspecialchars($productInfo->productName); ?></h1>
                    <p class="text-gray-400">Giá và khuyến mãi tại: Hồ Chí Minh</p>
                    <div class="mt-4">
                        <h2 class="font-semibold mb-2">Dung lượng</h2>
                        <div class="flex space-x-4">
                            <span class="px-4 py-2 bg-gray-700 rounded-lg"><?php echo htmlspecialchars($productInfo->capacity); ?></span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h2 class="font-semibold mb-2">Màu:</h2>
                       
                                <?php
                                    $colorClass = ($productInfo->color == "black" || $productInfo->color == "white") ? $productInfo->color : $productInfo->color . '-500';
                                ?>
                                <div class="w-8 h-8 bg-<?php echo htmlspecialchars($colorClass); ?> rounded-full cursor-pointer"></div>
                            
                    </div>

                    <div class="mt-6">
                        <h2 class="text-lg font-bold">Online Giá Rẻ Quá</h2>
                        <p class="text-2xl font-bold text-orange-500"><?php echo number_format($productInfo->price, 0, ',', '.'); ?>₫</p>
                        <s class="text-gray-400"><?php echo number_format($productInfo->originalPrice, 0, ',', '.'); ?>₫</s>
                    </div>

                    <div class="mt-4 bg-gray-600 rounded-full">
                        <div class="bg-orange-500 rounded-full h-2" style="width: 80%;"></div>
                    </div>
                    <div class="flex">   
                    <?php if ($productInfo->Status = 1): ?>
                        <button class="btn btn-danger text-white w-full font-bold m-2 text-xl" disabled>
                            Sản phẩm đã bị ẩn
                        </button>
                    <?php else: ?>
                        <button
                            onclick="window.location='?controller=payment&action=buyOne&items=<?php echo htmlspecialchars($productInfo->productID); ?>'"
                            class="btn btn-primary w-full font-bold m-2 text-xl py-4">
                            Mua ngay
                        </button>

                        <button
                            onclick="window.location='?controller=DetailProduct&action=addCart&items=<?php echo htmlspecialchars($productInfo->productID); ?>'"
                            class="btn btn-warning text-white w-full font-bold m-2 text-xl">
                            Thêm gỏ hàng
                        </button>
                    <?php endif; ?>
                    </div>

                    <div class="mt-4 text-gray-400">
                        <p>Kết thúc vào: 23:59 / 28/01</p>
                        <p>Tại Hồ Chí Minh</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full bg-gray-500 p-8">
            <div class="text-xl font-bold text-white p-4">Other Products</div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">
                <?php
                if(isset($ProductIphone) && !empty($ProductIphone)): ?>
                    <?php foreach($ProductIphone as $items): ?>
                        <div
                            onclick="window.location='?controller=DetailProduct&items=<?php echo htmlspecialchars($items->productID); ?>'"
                            class="bg-gray-800 hover:bg-gray-700 rounded-xl shadow-lg p-6 max-w-xs text-white mx-auto cursor-pointer">
                            <img src="<?php echo htmlspecialchars($items->img); ?>" alt="<?php echo htmlspecialchars($items->productName); ?>" class="w-full rounded-lg mb-4">
                            <h2 class="text-lg font-semibold mb-2"><?php echo htmlspecialchars($items->productName); ?></h2>
                            <h1 class="font-bold text-xl"><?php echo number_format($items->price, 0, ',', '.'); ?>₫</h1>
                            <h1 class="line-through text-gray-400 text-sm"><?php echo number_format($items->originalPrice, 0, ',', '.'); ?>₫</h1>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
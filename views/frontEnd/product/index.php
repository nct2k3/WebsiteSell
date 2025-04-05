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
    <title>iPhone Store</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .banner-image {
            max-height: 300px;
            object-fit: cover;
        }
        .product-card {
            transition: transform 0.2s;
            text-align: center;
        }
        .product-card:hover {
            transform: translateY(-5px);
        }
        .pagination-button {
            transition: all 0.3s ease;
        }
        .pagination-button:hover {
            background-color: #4B5563;
            color: white;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-100">
    
    <div class="container mx-auto px-4 py-8">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner rounded-xl overflow-hidden">
                <div class="carousel-item active">
                    <img class="d-block w-full banner-image" src="https://support.apple.com/content/dam/edam/applecare/images/en_US/psp/psp-hero-banner-communities.image.large_2x.jpg" alt="Featured">
                </div>
                <?php foreach ($Banner as $Items): ?>
                <div class="carousel-item">
                    <img class="d-block w-full banner-image" src="<?php echo htmlspecialchars($Items->img); ?>" alt="Banner">
                </div>
                <?php endforeach; ?>
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

        <div class="flex justify-end my-6">
            <select id="sortSelect" name="sort" class="bg-gray-700 text-white border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="handleSort(this.value)">
                <option value="" disabled selected>Sắp xếp theo giá</option>
                <option value="0">Giá cao đến thấp</option>
                <option value="1">Giá thấp đến cao</option>
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($products as $productData): ?>
            <div class="product-card bg-gray-800 rounded-xl shadow-xl p-6 cursor-pointer text-center" 
                 onclick="window.location='?controller=DetailProduct&items=<?php echo $productData->productID; ?>'">
                <img class="mx-auto w-48 h-48 object-contain" 
                     src="<?php echo htmlspecialchars($productData->img); ?>" 
                     alt="<?php echo htmlspecialchars($productData->productName); ?>">
                <h2 class="text-xl font-bold mt-4 text-white text-center"><?php echo htmlspecialchars($productData->productName); ?></h2>
                <div class="flex justify-center space-x-2 mt-3">
                    <span class="text-gray-300"><?php echo $productData->capacity?></span>
                </div>
                <div class="mt-4 space-y-2 text-center">
                    <p class="text-2xl font-bold text-yellow-400"><?php echo number_format($productData->price); ?>₫</p>
                    <p class="text-sm line-through text-gray-500"><?php echo number_format($productData->originalPrice); ?>₫</p>
                </div>
                <p class="text-orange-500 font-semibold mt-3 text-center">Giá ưu đãi online</p>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="flex justify-center mt-8 space-x-2">
            <?php if(isset($numpage) && $numpage > 0): ?>
                <?php for($i = 1; $i <= $numpage; $i++): ?>
                <button onclick="window.location.href='?controller=product&items=<?php echo isset($items) ? htmlspecialchars($items) : ''; ?>&page=<?php echo $i;?>'"
                        class="pagination-button h-10 w-10 flex items-center justify-center rounded-lg bg-gray-700 text-white hover:bg-gray-600">
                    <?php echo $i; ?>
                </button>
                <?php endfor; ?>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function handleSort(value) {
            if (value === "0") {
                window.location.href = '?controller=product&action=indexSortHightToLow&items=<?php echo $items; ?>';
            } else if (value === "1") {
                window.location.href = '?controller=product&action=indexSortLowToHight&items=<?php echo $items; ?>';
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
require_once './views/footer.php';
?>
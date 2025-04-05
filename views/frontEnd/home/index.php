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
    <title>Apple Store</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .carousel-item img {
            max-height: 400px;
            object-fit: cover;
        }
        .product-card {
            transition: all 0.3s ease;
            text-align: center;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        .category-header {
            border-bottom: 2px solid #4B5563;
            margin-bottom: 2rem;
            justify-content: center;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body class="bg-gray-900">
    <!-- Carousel Section -->
    <div id="carouselExampleControls" class="carousel slide bg-gray-900 px-4 py-8" data-ride="carousel">
        <div class="carousel-inner rounded-lg shadow-xl">
            <div class="carousel-item active">
                <img class="d-block w-100" src="https://cdnv2.tgdd.vn/mwg-static/topzone/Banner/d1/36/d136ac139c784757b4f6eedd67295ca8.png" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://cdnv2.tgdd.vn/mwg-static/topzone/Banner/cd/96/cd968911ea2586403e61263b2eea1454.png" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://cdnv2.tgdd.vn/mwg-static/topzone/Banner/dd/6c/dd6c7ef3f25a5e54e2e42f4136382f3a.png" alt="Third slide">
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

    <div class="p-8">
        <!-- iPhone Section -->
        <div class="category-header flex items-center space-x-4 mb-6 p-2">
            <img class="h-10" src="https://img.icons8.com/?size=100&id=30840&format=png&color=ffffff" alt="iPhone Logo">
            <h2 class="text-3xl font-bold text-white text-center">iPhone</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach($ProductIphone as $items): ?>
            <div onclick="window.location='?controller=DetailProduct&items=<?php echo $items->productID; ?>'"
                class="product-card bg-gray-800 rounded-xl p-6 cursor-pointer">
                <img src="<?php echo $items->img; ?>" alt="<?php echo $items->productName; ?>" class="w-full h-48 object-contain rounded-lg mb-4">
                <h3 class="text-xl font-semibold text-white mb-2 text-center"><?php echo $items->productName; ?></h3>
                <p class="text-2xl font-bold text-white text-center"><?php echo number_format($items->price); ?>₫</p>
                <p class="text-gray-400 line-through text-center"><?php echo number_format($items->originalPrice); ?>₫</p>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- MacBook Section -->
        <div class="category-header flex items-center space-x-4 mb-6 mt-12 p-2">
            <img class="h-10" src="https://img.icons8.com/?size=100&id=30840&format=png&color=ffffff" alt="MacBook Logo">
            <h2 class="text-3xl font-bold text-white text-center">MacBook</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach($ProductMacbock as $items): ?>
            <div onclick="window.location='?controller=DetailProduct&items=<?php echo $items->productID; ?>'"
                class="product-card bg-gray-800 rounded-xl p-6 cursor-pointer">
                <img src="<?php echo $items->img; ?>" alt="<?php echo $items->productName; ?>" class="w-full h-48 object-contain rounded-lg mb-4">
                <h3 class="text-xl font-semibold text-white mb-2 text-center"><?php echo $items->productName; ?></h3>
                <p class="text-2xl font-bold text-white text-center"><?php echo number_format($items->price); ?>₫</p>
                <p class="text-gray-400 line-through text-center"><?php echo number_format($items->originalPrice); ?>₫</p>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- iPad Section -->
        <div class="category-header flex items-center space-x-4 mb-6 mt-12 p-2">
            <img class="h-10" src="https://img.icons8.com/?size=100&id=30840&format=png&color=ffffff" alt="iPad Logo">
            <h2 class="text-3xl font-bold text-white text-center">iPad</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach($ProductIPad as $items): ?>
            <div onclick="window.location='?controller=DetailProduct&items=<?php echo $items->productID; ?>'"
                class="product-card bg-gray-800 rounded-xl p-6 cursor-pointer">
                <img src="<?php echo $items->img; ?>" alt="<?php echo $items->productName; ?>" class="w-full h-48 object-contain rounded-lg mb-4">
                <h3 class="text-xl font-semibold text-white mb-2 text-center"><?php echo $items->productName; ?></h3>
                <p class="text-2xl font-bold text-white text-center"><?php echo number_format($items->price); ?>₫</p>
                <p class="text-gray-400 line-through text-center"><?php echo number_format($items->originalPrice); ?>₫</p>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Watch Section -->
        <div class="category-header flex items-center space-x-4 mb-6 mt-12 p-2">
            <img class="h-10" src="https://img.icons8.com/?size=100&id=30840&format=png&color=ffffff" alt="Watch Logo">
            <h2 class="text-3xl font-bold text-white text-center">Watch</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach($ProductWatch as $items): ?>
            <div onclick="window.location='?controller=DetailProduct&items=<?php echo $items->productID; ?>'"
                class="product-card bg-gray-800 rounded-xl p-6 cursor-pointer">
                <img src="<?php echo $items->img; ?>" alt="<?php echo $items->productName; ?>" class="w-full h-48 object-contain rounded-lg mb-4">
                <h3 class="text-xl font-semibold text-white mb-2 text-center"><?php echo $items->productName; ?></h3>
                <p class="text-2xl font-bold text-white text-center"><?php echo number_format($items->price); ?>₫</p>
                <p class="text-gray-400 line-through text-center"><?php echo number_format($items->originalPrice); ?>₫</p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
require_once './views/footer.php';
?>
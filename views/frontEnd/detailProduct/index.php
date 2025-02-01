<?Php
require_once './controllers/HeaderController.php';
$controller = new HeaderController();
$controller->index();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My PHP Project</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
</head>
<body class="bg-dark text-light">
<?php if (!empty($products)): ?>
        <?php foreach ($products as $productInfo): ?>
            <?php $product = $productInfo['item']; ?>
  <!-- Header -->
  <div class="text-center bg-dark py-3">
      <div class="flex w-full justify-center p-2">
            <img class="h-10" src="https://img.icons8.com/?size=100&id=30840&format=png&color=ffffff" alt="Logo">
            <div class="text-3xl text-center font-bold text-white">Iphone</div>
      </div>
  </div>
  <!-- Banner Section -->
   <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
    <div id="carouselExampleControls" class=" carousel slide px-16" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block  w-100 rounded-3xl" src="<?php echo htmlspecialchars($product->img); ?>" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block  w-100 rounded-3xl" src="https://cdnv2.tgdd.vn/mwg-static//42/329149/s16/iphone-16-pro-max-desert-titan-1-638621795564494521-650x650.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block  w-100 rounded-3xl" src="https://cdnv2.tgdd.vn/mwg-static//42/329149/s16/iphone-16-pro-max-desert-titan-3-638621795578568215-650x650.jpg" alt="Third slide">
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
    <a class="hidden"><?php echo htmlspecialchars($product->productID); ?></a>
        <div class="max-w-lg mx-auto bg-gray-800 rounded-lg p-6 shadow-lg">
            <h1 class="text-2xl font-bold mb-2"><?php echo htmlspecialchars($product->productName); ?></h1>
            <p class="text-gray-400">Giá và khuyến mãi tại: Hồ Chí Minh</p>

            <div class="mt-4">
                <h2 class="font-semibold mb-2">Dung lượng</h2>
                <div class="flex space-x-4">
                <?php foreach ($productInfo['capacity'] as $cap): ?>
                    <button class="bg-gray-700 text-white rounded-full py-1 px-3">
                         <?php echo htmlspecialchars($cap['Capacity']); ?>
                    </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="mt-4">
                <h2 class="font-semibold mb-2">Màu:</h2>
                <div class="flex space-x-2">
                <?php foreach ($productInfo['color'] as $col): ?>
                    <?php
                        $color = ($col['Color'] == "black" || $col['Color'] == "white") ? $col['Color'] : $col['Color'] . '-500';
                    ?>
                    <div class="w-8 h-8 bg-<?php echo $color; ?> rounded-full cursor-pointer"></div>
                <?php endforeach; ?>
                
                </div>
            </div>

            <div class="mt-6">
                <h2 class="text-lg font-bold">Online Giá Rẻ Quá</h2>
                <p class="text-2xl font-bold text-orange-500"><?php echo htmlspecialchars($product->price); ?>đ</p>
                <s class="text-gray-400"><?php echo htmlspecialchars($product->originalPrice); ?>đ</s>
            </div>

            <div class="mt-4 bg-gray-600 rounded-full">
                <div class="bg-orange-500 rounded-full h-2" style="width: 80%;"></div>
            </div>
            <div class="flex">
                <button class="btn btn-primary w-full font-bold m-2 text-xl py-4">
                    By Now
                </button>

                <button
                onclick="window.location='?controller=DetailProduct&action=addCart&items=<?php echo $product->productID?>'"
                class="btn btn-warning text-white w-full font-bold m-2 text-xl">
                   Add To Cart
                </button>
            </div>


            <div class="mt-4 text-gray-400">
                <p>Kết thúc vào: 23:59 / 28/01</p>
                <p>Tại Hồ Chí Minh</p>
            </div>
        </div>
    </div>
  </div>
  <div class="w-full bg-white">

    <div class="text-xl font-bold text-black p-4">Other product</div>
  </div>
  <div>


  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <?php endforeach; ?>
    <?php else: ?>
        <p>Không có sản phẩm nào.</p>
    <?php endif; ?>
</body>
</html>

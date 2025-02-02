
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
    <style>
        .px12 {
            max-height: 300px;
        }
    
    </style>
</head>
<body class="bg-dark text-light">

  <!-- Header -->
  <div class="text-center bg-dark py-3">
      <div class="flex w-full justify-center p-2">
            <img class="h-10" src="https://img.icons8.com/?size=100&id=30840&format=png&color=ffffff" alt="Logo">
            <div class="text-3xl text-center font-bold text-white">Iphone</div>
      </div>
  </div>

  <!-- Banner Section -->
  <div id="carouselExampleControls" class="carousel slide px-20" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block px12 w-100 rounded-3xl" src="https://support.apple.com/content/dam/edam/applecare/images/en_US/psp/psp-hero-banner-communities.image.large_2x.jpg" alt="First slide">
        </div>
        <?php foreach ($Banner as $Items): ?>
        <div class="carousel-item">
            <img class="d-block px12 w-100 rounded-3xl" src="
             <?php echo htmlspecialchars($Items->img); ?>" alt="Second slide">
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

  <!-- Footer Navigation -->
  <div class="mx-8 mt-2">
    <div class="container flex-wrap d-flex gap-3">
      <button
      onclick="window.location='?controller=product&items=<?php echo $items?>'"
      class="text-white hover:underline underline">All</button>
      <?php foreach ($Model as $Models): ?>
      <button
      onclick="window.location='?controller=product&action=productModel&items=<?php echo $items?>&model=<?php echo htmlspecialchars($Models->productModel); ?>'"
      class="text-white hover:underline">
      <?php echo htmlspecialchars($Models->productModel); ?>
      </button>
      <?php endforeach; ?>
    </div>
  </div>
  <div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-0 p-0">
        <?php foreach ($products as $productData): ?>
            <div class="w-auto bg-gray-800 rounded-2xl shadow-lg p-5 text-center hover:bg-gray-700 m-4"
            onclick="window.location='?controller=DetailProduct&items=<?php echo $productData['item']->productID; ?>'"
            >
                <a class="hidden"><?php echo htmlspecialchars($productData['item']->productID); ?></a>
                <img class="mx-auto w-40 h-40" src="<?php echo htmlspecialchars($productData['item']->img); ?>" alt="<?php echo htmlspecialchars($productData['item']->productName); ?>">
                <h2 class="text-lg font-bold mt-4"><?php echo htmlspecialchars($productData['item']->productName); ?></h2>
                <div class="flex justify-center space-x-2 mt-3">
                    <?php if (!empty($productData['capacity'])): ?>
                        <?php foreach ($productData['capacity'] as $capacityData): ?>
                            <span class="bg-gray-700 px-3 py-1 rounded text-sm"><?php echo htmlspecialchars($capacityData['Capacity']); ?></span>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <span class="bg-gray-700 px-3 py-1 rounded text-sm">No capacity available</span>
                    <?php endif; ?>
                </div>
                <div class="mt-4">
                    <p class="text-xl font-bold text-yellow-400"><?php echo number_format($productData['item']->price); ?>₫</p>
                    <p class="text-sm line-through text-gray-400"><?php echo number_format($productData['item']->originalPrice); ?>₫</p>
                </div>
                <p class="text-orange-500 font-semibold mt-2">Online giá rẻ quá</p>
            </div>
        <?php endforeach; ?>

          
    </div>
  </div>
  <div class="flex justify-center w-full p-4">
    <button class="flex items-center bg-gray-700 text-white font-semibold py-2 px-4 rounded shadow hover:bg-gray-600">
    See more products
          <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
    </button>
  </div>



  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

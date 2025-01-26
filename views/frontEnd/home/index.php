<?php
require_once './views/header.php';
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
      
        .px12{
            margin-left:12.5%;
            max-height: 300px;
        }
        .mw{
            max-width: 25%;
        }
    </style>
</head>
<body>
    <div class=" bg-gray-900 h-16 mt-1"></div>
    <div id="carouselExampleControls" class="carousel slide bg-gray-900 p-2" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img class="d-block  px12 w-75" src="https://cdnv2.tgdd.vn/mwg-static/tgdd/Banner/b0/76/b0761df21edde3ec5925b7fecee07e51.png" alt="First slide">
        </div>
        <div class="carousel-item">
        <img class="d-block  px12 w-75"src="https://cdnv2.tgdd.vn/mwg-static/tgdd/Banner/be/8e/be8e7b84b9075827701e90bb1c3de053.png" alt="Second slide">
        </div>
        <div class="carousel-item">
        <img class="d-block  px12 w-75" src="https://cdnv2.tgdd.vn/mwg-static/tgdd/Banner/e0/f2/e0f27a962faace8fa8a6341c51fac39a.png" alt="Third slide">
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
    <div class="bg-gray-800 w-full">
        <div class="flex w-full justify-center p-2">
            <img class="h-8" src="https://img.icons8.com/?size=100&id=30840&format=png&color=ffffff" alt="Logo">
            <div class=" text-2xl text-center font-bold text-white">Iphone </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-0 p-0">
             <?php foreach($ProductIphone as $items): ?>
            <div class="bg-gray-800 rounded-xl shadow-lg p-6 max-w-xs text-white mx-auto mb-0 mt-22">
                <img src="<?php  echo $items->img;  ?>" alt="iPhone 16 Pro Max" class="w-full rounded-lg mb-4">
                <h2 class="text-lg font-semibold mb-2"><?php  echo $items->productName;  ?></h2>
                <h1 class="font-bold text-xl"><?php  echo $items->price;  ?>₫</h1>
                <h1 class="line-through text-gray-400 text-sm"><?php  echo $items->originalPrice;  ?>₫</h1>
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                    Buy now
                </button>
            </div>
            <?php endforeach; ?>
        </div>
<!-- macbock -->
        <div class="flex w-full justify-center p-2">
            <img class="h-8" src="https://img.icons8.com/?size=100&id=30840&format=png&color=ffffff" alt="Logo">
            <div class=" text-2xl text-center font-bold text-white">Macbook </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-0 p-0">
             <?php foreach($ProductMacbock as $items): ?>
            <div class="bg-gray-800 rounded-xl shadow-lg p-6 max-w-xs text-white mx-auto mb-0 mt-22">
                <img src="<?php  echo $items->img;  ?>" alt="iPhone 16 Pro Max" class="w-full rounded-lg mb-4">
                <h2 class="text-lg font-semibold mb-2"><?php  echo $items->productName;  ?></h2>
                <h1 class="font-bold text-xl"><?php  echo $items->price;  ?>₫</h1>
                <h1 class="line-through text-gray-400 text-sm"><?php  echo $items->originalPrice;  ?>₫</h1>
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                    Buy now
                </button>
            </div>
            <?php endforeach; ?>
        </div>
<!-- ipad -->
        <div class="flex w-full justify-center p-2">
            <img class="h-8" src="https://img.icons8.com/?size=100&id=30840&format=png&color=ffffff" alt="Logo">
            <div class=" text-2xl text-center font-bold text-white">Ipad </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-0 p-0">
             <?php foreach($ProductIPad as $items): ?>
            <div class="bg-gray-800 rounded-xl shadow-lg p-6 max-w-xs text-white mx-auto mb-0 mt-22">
                <img src="<?php  echo $items->img;  ?>" alt="iPhone 16 Pro Max" class="w-full rounded-lg mb-4">
                <h2 class="text-lg font-semibold mb-2"><?php  echo $items->productName;  ?></h2>
                <h1 class="font-bold text-xl"><?php  echo $items->price;  ?>₫</h1>
                <h1 class="line-through text-gray-400 text-sm"><?php  echo $items->originalPrice;  ?>₫</h1>
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                    Buy now
                </button>
            </div>
            <?php endforeach; ?>
        </div>
<!-- Watch -->
        <div class="flex w-full justify-center p-2">
            <img class="h-8" src="https://img.icons8.com/?size=100&id=30840&format=png&color=ffffff" alt="Logo">
            <div class=" text-2xl text-center font-bold text-white">Watch </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-0 p-0">
             <?php foreach($ProductWatch as $items): ?>
            <div class="bg-gray-800 rounded-xl shadow-lg p-6 max-w-xs text-white mx-auto mb-0 mt-22">
                <img src="<?php  echo $items->img;  ?>" alt="iPhone 16 Pro Max" class="w-full rounded-lg mb-4">
                <h2 class="text-lg font-semibold mb-2"><?php  echo $items->productName;  ?></h2>
                <h1 class="font-bold text-xl"><?php  echo $items->price;  ?>₫</h1>
                <h1 class="line-through text-gray-400 text-sm"><?php  echo $items->originalPrice;  ?>₫</h1>
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                    Buy now
                </button>
            </div>
            <?php endforeach; ?>
        </div>


    </div>
    
</body>   
</html>

<?php
require_once './views/footer.php';
?>
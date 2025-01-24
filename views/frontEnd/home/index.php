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
            max-width: 20%;
        }
    </style>
</head>
<body>
    <div class=" bg-gray-900 h-16 "></div>
    <div class="bg-gray-800">
       <div class="row flex justify-center">
            <div class="col-1 font-bold text-white text-sm flex justify-center hover:bg-gray-400 p-1"> 
                <img class="h-6 mx-1" src="https://img.icons8.com/?size=100&id=11409&format=png&color=000000">
                <a>IPhone</a>
            </div>
            <div class="col-1 font-bold text-white text-sm flex justify-center hover:bg-gray-400 p-1">  
                <img class="h-6 mx-1" src="https://img.icons8.com/?size=100&id=10326&format=png&color=000000">
                <a>MacBook</a>
            </div>
            <div class="col-1 font-bold text-white text-sm flex justify-center hover:bg-gray-400 p-1">  
                <img class="h-6 mx-1" src="https://img.icons8.com/?size=100&id=11309&format=png&color=000000">
                <a>Mac</a>
            </div>
            <div class="col-1 font-bold text-white text-sm flex justify-center hover:bg-gray-400 p-1">  
                <img class="h-6 mx-1" src="https://img.icons8.com/?size=100&id=2318&format=png&color=000000">
                <a>Ipad</a>
            </div>
            <div class="col-1 font-bold text-white text-sm flex justify-center hover:bg-gray-400 p-1">  
                <img class="h-6 mx-1" src="https://img.icons8.com/?size=100&id=111236&format=png&color=000000">
                <a>Watch</a>
            </div>
            <div class="col-1 font-bold text-white text-sm flex justify-center hover:bg-gray-400 p-1">  
                <img class="h-6 mx-1" src="https://img.icons8.com/?size=100&id=Cxy3RFJwyy2Z&format=png&color=000000">
                <a>Accessory</a>
            </div>
            
            
       </div>
    </div>
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
    <div class="bg-gray-800">
        <div>
           iphone 
        </div>
        <div class="flex  flex-wrap items-center justify-center ">
            <div class="mw bg-gray-800 rounded-xl shadow-lg p-6 max-w-xs text-white m-4">
                <img src="https://cdn.tgdd.vn/Products/Images/42/329149/s16/iphone-16-pro-max-titan-sa-mac-thumbnew-650x650.png" alt="iPhone 16 Pro Max" class="w-full rounded-lg mb-4">
                <h2 class="text-lg font-semibold mb-2">iPhone 16 Pro Max 256GB</h2>
                <div class="flex items-center mb-4">
                    <span class="font-bold">32.790.000₫</span>
                    <span class="line-through text-gray-400 ml-2 text-sm">34.990.000₫</span>
                    <span class="text-green-500 ml-2">-6%</span>
                </div>
                <button class=" w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    By now
                </button>
            </div>
            <div class="mw bg-gray-800 rounded-xl shadow-lg p-6 max-w-xs text-white m-4">
                <img src="https://cdn.tgdd.vn/Products/Images/42/329149/s16/iphone-16-pro-max-titan-sa-mac-thumbnew-650x650.png" alt="iPhone 16 Pro Max" class="w-full rounded-lg mb-4">
                <h2 class="text-lg font-semibold mb-2">iPhone 16 Pro Max 256GB</h2>
                <div class="flex items-center mb-4">
                    <span class="font-bold">32.790.000₫</span>
                    <span class="line-through text-gray-400 ml-2 text-sm">34.990.000₫</span>
                    <span class="text-green-500 ml-2">-6%</span>
                </div>
                <button class=" w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    By now
                </button>
            </div>
            <div class="mw bg-gray-800 rounded-xl shadow-lg p-6 max-w-xs text-white m-4">
                <img src="https://cdn.tgdd.vn/Products/Images/42/329149/s16/iphone-16-pro-max-titan-sa-mac-thumbnew-650x650.png" alt="iPhone 16 Pro Max" class="w-full rounded-lg mb-4">
                <h2 class="text-lg font-semibold mb-2">iPhone 16 Pro Max 256GB</h2>
                <div class="flex items-center mb-4">
                    <span class="font-bold">32.790.000₫</span>
                    <span class="line-through text-gray-400 ml-2 text-sm">34.990.000₫</span>
                    <span class="text-green-500 ml-2">-6%</span>
                </div>
                <button class=" w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    By now
                </button>
            </div>
            <div class="mw bg-gray-800 rounded-xl shadow-lg p-6 max-w-xs text-white m-4">
                <img src="https://cdn.tgdd.vn/Products/Images/42/329149/s16/iphone-16-pro-max-titan-sa-mac-thumbnew-650x650.png" alt="iPhone 16 Pro Max" class="w-full rounded-lg mb-4">
                <h2 class="text-lg font-semibold mb-2">iPhone 16 Pro Max 256GB</h2>
                <div class="flex items-center mb-4">
                    <span class="font-bold">32.790.000₫</span>
                    <span class="line-through text-gray-400 ml-2 text-sm">34.990.000₫</span>
                    <span class="text-green-500 ml-2">-6%</span>
                </div>
                <button class=" w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    By now
                </button>
            </div>
            <div class="mw bg-gray-800 rounded-xl shadow-lg p-6 max-w-xs text-white m-4">
                <img src="https://cdn.tgdd.vn/Products/Images/42/329149/s16/iphone-16-pro-max-titan-sa-mac-thumbnew-650x650.png" alt="iPhone 16 Pro Max" class="w-full rounded-lg mb-4">
                <h2 class="text-lg font-semibold mb-2">iPhone 16 Pro Max 256GB</h2>
                <div class="flex items-center mb-4">
                    <span class="font-bold">32.790.000₫</span>
                    <span class="line-through text-gray-400 ml-2 text-sm">34.990.000₫</span>
                    <span class="text-green-500 ml-2">-6%</span>
                </div>
                <button class=" w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    By now
                </button>
            </div>
        </div>
    </div>
    
</body>   
</html>

<?php
require_once './views/footer.php';
?>
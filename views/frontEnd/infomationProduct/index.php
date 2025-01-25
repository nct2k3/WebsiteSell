
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
<div class=" bg-gray-900 h-16 mt-1"></div>
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
                <img class="d-block  w-100 rounded-3xl" src="https://cdn.tgdd.vn/Products/Images/42/329149/s16/iphone-16-pro-max-titan-sa-mac-thumbnew-650x650.png" alt="First slide">
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
        <div class="max-w-lg mx-auto bg-gray-800 rounded-lg p-6 shadow-lg">
            <h1 class="text-2xl font-bold mb-2">iPhone 16 Pro Max 256GB</h1>
            <p class="text-gray-400">Giá và khuyến mãi tại: Hồ Chí Minh</p>

            <div class="mt-4">
                <h2 class="font-semibold mb-2">Dung lượng</h2>
                <div class="flex space-x-4">
                    <button class="bg-gray-700 text-white rounded-full py-1 px-3">256GB</button>
                    <button class="bg-gray-600 text-white rounded-full py-1 px-3">512GB</button>
                    <button class="bg-gray-600 text-white rounded-full py-1 px-3">1TB</button>
                </div>
            </div>

            <div class="mt-4">
                <h2 class="font-semibold mb-2">Màu:</h2>
                <div class="flex space-x-2">
                    <div class="w-8 h-8 bg-gray-300 rounded-full cursor-pointer"></div>
                    <div class="w-8 h-8 bg-gray-500 rounded-full cursor-pointer"></div>
                    <div class="w-8 h-8 bg-gray-700 rounded-full cursor-pointer"></div>
                </div>
            </div>

            <div class="mt-6">
                <h2 class="text-lg font-bold">Online Giá Rẻ Quá</h2>
                <p class="text-2xl font-bold text-orange-500">32.790.000đ</p>
                <p class="text-gray-400">34.000.000đ (-6%)</p>
            </div>

            <div class="mt-4 bg-gray-600 rounded-full">
                <div class="bg-orange-500 rounded-full h-2" style="width: 80%;"></div>
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
</body>
</html>

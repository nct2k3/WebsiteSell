
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
        .mw {
            max-width: 25%;
        }
    </style>
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
  <div id="carouselExampleControls" class="carousel slide px-20" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block px12 w-100 rounded-3xl" src="https://cdnv2.tgdd.vn/mwg-static/topzone/Banner/b8/30/b830392d62a91134d24090c872d02e03.png" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block px12 w-100 rounded-3xl" src="https://cdnv2.tgdd.vn/mwg-static/tgdd/Banner/be/8e/be8e7b84b9075827701e90bb1c3de053.png" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block px12 w-100 rounded-3xl" src="https://cdnv2.tgdd.vn/mwg-static/tgdd/Banner/e0/f2/e0f27a962faace8fa8a6341c51fac39a.png" alt="Third slide">
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

  <!-- Footer Navigation -->
  <div class="mx-8 mt-2">
    <div class="container flex-wrap d-flex gap-3">
      <button class="text-white hover:underline underline">All</button>
      <button class="text-white hover:underline">iPhone 16</button>
      <button class="text-white hover:underline">iPhone 15</button>
      <button class="text-white hover:underline">iPhone 14</button>
      <button class="text-white hover:underline">iPhone 13</button>
      <button class="text-white hover:underline">iPhone 12</button>
      <button class="text-white hover:underline">iPhone 11</button>
    </div>
  </div>
  <div>
    <div class="container mx-auto p-5">
        <!-- Section iPhone Products -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- iPhone 16 Pro Max -->
            <div class="bg-gray-800 rounded-2xl shadow-lg p-5 text-center hover:bg-gray-700">
                <img class="mx-auto w-40 h-40" src="https://cdn.tgdd.vn/Products/Images/42/329149/s16/iphone-16-pro-max-titan-sa-mac-thumbnew-650x650.png" alt="iPhone 16 Pro Max">
                <h2 class="text-lg font-bold mt-4">iPhone 16 Pro Max</h2>
                <div class="flex justify-center space-x-2 mt-3">
                    <span class="bg-gray-700 px-3 py-1 rounded text-sm">256GB</span>
                    <span class="bg-gray-700 px-3 py-1 rounded text-sm">512GB</span>
                    <span class="bg-gray-700 px-3 py-1 rounded text-sm">1TB</span>
                </div>
                <div class="mt-4">
                    <p class="text-xl font-bold text-yellow-400">32.790.000₫</p>
                    <p class="text-sm line-through text-gray-400">34.990.000₫</p>
                </div>
                <p class="text-orange-500 font-semibold mt-2">Online giá rẻ quá</p>
            </div>

            <!-- iPhone 16 Pro -->
            <div class="bg-gray-800 rounded-2xl shadow-lg p-5 text-center">
                <img class="mx-auto w-40 h-40" src="https://cdn.tgdd.vn/Products/Images/42/329149/s16/iphone-16-pro-max-titan-sa-mac-thumbnew-650x650.png" alt="iPhone 16 Pro">
                <h2 class="text-lg font-bold mt-4">iPhone 16 Pro</h2>
                <div class="flex justify-center space-x-2 mt-3">
                    <span class="bg-gray-700 px-3 py-1 rounded text-sm">128GB</span>
                    <span class="bg-gray-700 px-3 py-1 rounded text-sm">256GB</span>
                    <span class="bg-gray-700 px-3 py-1 rounded text-sm">1TB</span>
                </div>
                <div class="mt-4">
                    <p class="text-xl font-bold text-yellow-400">27.490.000₫</p>
                    <p class="text-sm line-through text-gray-400">28.990.000₫</p>
                </div>
                <p class="text-orange-500 font-semibold mt-2">Online giá rẻ quá</p>
            </div>

            <!-- iPhone 16 Plus -->
            <div class="bg-gray-800 rounded-2xl shadow-lg p-5 text-center">
                <img class="mx-auto w-40 h-40" src="https://cdn.tgdd.vn/Products/Images/42/329149/s16/iphone-16-pro-max-titan-sa-mac-thumbnew-650x650.png" alt="iPhone 16 Plus">
                <h2 class="text-lg font-bold mt-4">iPhone 16 Plus</h2>
                <div class="flex justify-center space-x-2 mt-3">
                    <span class="bg-gray-700 px-3 py-1 rounded text-sm">128GB</span>
                    <span class="bg-gray-700 px-3 py-1 rounded text-sm">256GB</span>
                    <span class="bg-gray-700 px-3 py-1 rounded text-sm">512GB</span>
                </div>
                <div class="mt-4">
                    <p class="text-xl font-bold text-yellow-400">24.690.000₫</p>
                    <p class="text-sm line-through text-gray-400">25.990.000₫</p>
                </div>
                <p class="text-orange-500 font-semibold mt-2">Online giá rẻ quá</p>
            </div>
        </div>
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

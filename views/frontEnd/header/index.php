
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Header</title>
    <style>
        @keyframes fadeOut {
            0% { opacity: 1; }
            100% { opacity: 0; }
        }
        .fade-out {
            animation: fadeOut 0.5s forwards;
        }
    </style>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="top-20 flex justify-end fixed  right-0 z-50 bg-green-500 text-white p-3 shadow-lg transition-opacity duration-500 ease-in-out opacity-100 fade-out" style="animation-delay: 3s;">
            <?php echo $_SESSION['message']; ?> 
            </div>
            <?php unset($_SESSION['message']); ?>
          <?php endif; ?>
          
          <?php if (isset($_SESSION['error'])): ?>
            <div class="top-20 flex justify-end fixed  right-0 z-50 bg-red-500 text-white p-3 shadow-lg transition-opacity duration-500 ease-in-out opacity-100 fade-out" style="animation-delay: 3s;">
            <?php echo $_SESSION['error']; ?> 
            </div>
            <?php unset($_SESSION['error']); ?>
          <?php endif; ?>


        <div class="container-fluid w-full">
            <div id="content" class="row bg-gray-800 p-3 fixed z-40 top-0 w-full hidden md:flex md:flex-row flex-col">
                <!-- Logo -->
                <div  onclick="window.location='/'"
                class="col-12 col-md-2 d-flex align-items-center justify-content-center">
                    <img class="h-8" src="https://img.icons8.com/?size=100&id=17843&format=png&color=42A5F5" alt="Logo">
                    <h1 class="font-bold bg-gradient-to-r from-blue-500 to-red-500 bg-clip-text text-transparent text-xl ml-2">
                        IPHONE
                    </h1>
                </div>
                <!-- Menu items -->
                <div onclick="window.location='?controller=product&items=1'"
                 class="col-12 col-md-1 d-flex align-items-center justify-content-center text-white font-bold text-sm hover:bg-gray-400 p-2">
                    <img class="h-6 mx-1" src="https://img.icons8.com/?size=100&id=11409&format=png&color=ffffff" alt="Icon">
                    <a >IPhone</a>
                </div>
                <div onclick="window.location='?controller=product&items=2'"
                class="col-12 col-md-1 d-flex align-items-center justify-content-center text-white font-bold text-sm hover:bg-gray-400 p-2">
                    <img class="h-6 mx-1" src="https://img.icons8.com/?size=100&id=10326&format=png&color=ffffff" alt="Icon">
                    <a >MacBook</a>
                </div>
                <div  onclick="window.location='?controller=product&items=3'"
                 class="col-12 col-md-1 d-flex align-items-center justify-content-center text-white font-bold text-sm hover:bg-gray-400 p-2">
                    <img class="h-6 mx-1" src="https://img.icons8.com/?size=100&id=11309&format=png&color=ffffff" alt="Icon">
                    <a >Mac</a>
                </div>
                <div  onclick="window.location='?controller=product&items=5'"
                 class="col-12 col-md-1 d-flex align-items-center justify-content-center text-white font-bold text-sm hover:bg-gray-400 p-2">
                    <img class="h-6 mx-1" src="https://img.icons8.com/?size=100&id=2318&format=png&color=ffffff" alt="Icon">
                    <a >iPad</a>
                </div>
                <div  onclick="window.location='?controller=product&items=6'"
                 class="col-12 col-md-1 d-flex align-items-center justify-content-center text-white font-bold text-sm hover:bg-gray-400 p-2">
                    <img class="h-6 mx-1" src="https://img.icons8.com/?size=100&id=Cxy3RFJwyy2Z&format=png&color=ffffff" alt="Icon">
                    <a >Accessory</a>
                </div>
                <div  onclick="window.location='?controller=product&items=4'"
                 class="col-12 col-md-1 d-flex align-items-center justify-content-center text-white font-bold text-sm hover:bg-gray-400 p-2">
                    <img class="h-6 mx-1" src="https://img.icons8.com/?size=100&id=111236&format=png&color=ffffff" alt="Icon">
                    <a >Watch</a>
                </div>
                
                 <!-- Search bar -->
                 <div  id="searchButton"
                 class="bg-gray-500 col-12 col-md-1 rounded-full hover:bg-gray-400 ">
                    <img class="h-8 mx-1 mt-1 p-1" src="https://img.icons8.com/?size=100&id=7695&format=png&color=ffffff" alt="Icon">
                    
                </div>
                <!-- Login -->
                <div 
                 class="col-12 col-md-3 d-flex align-items-center justify-content-center text-white font-bold text-sm mt-2 mt-md-0">
                    <img class="h-8 w-8 bg-white rounded-full mx-2" src="https://img.icons8.com/?size=100&id=99268&format=png&color=000000" alt="Login">
                    <?php if (isset($username)): ?>
                        <a onclick="window.location='?controller=information&user=<?php echo $userID; ?>'" class="hover:text-yellow-500">
                            <?php echo $username; ?>
                        </a>
                        <div class=" d-flex align-items-center justify-content-center mt-2 mt-md-0">
                        <img class="h-8 bg-gray-900 hover:bg-gray-400 p-1 rounded-full mx-2"
                            src="https://img.icons8.com/?size=100&id=ftMXZGFfen2R&format=png&color=ffffff" alt="Icon">
                        <img class="h-8 bg-gray-900 hover:bg-gray-400 p-1 rounded-full mx-2"
                            onclick="window.location='?controller=cart&user=<?php echo $userID; ?>'"
                            src="https://img.icons8.com/?size=100&id=MuChNUVbFLwr&format=png&color=ffffff" alt="Icon">
                        </div>
                    <?php else: ?>
                        <a onclick="window.location='?controller=login'" class="hover:text-yellow-500">
                            Login
                        </a>
                    <?php endif; ?>

                </div>
                
               
            </div>
        </div>
        <div class=" bg-gray-900 h-16 p-2 flex">
        <img id="toggleButton" class="h-8 m-1" src="https://img.icons8.com/?size=100&id=8113&format=png&color=ffffff">
        <div  onclick="window.location='/'"
                class="flex w-full justify-content-center mr-4">
                    <img class="h-8" src="https://img.icons8.com/?size=100&id=17843&format=png&color=42A5F5" alt="Logo">
                    <h1 class="font-bold bg-gradient-to-r from-blue-500 to-red-500 bg-clip-text text-transparent text-xl m-1">
                        IPHONE
                    </h1>
                </div>
        </div>
        <div class="p-1"></div>
    </header>
    <div id="search" class="hiddens">
    <div id="searchButton1" class="h-full w-full bg-black fixed z-40 opacity-75 text-white py-8"> </div>
    <div class="col-8 fixed z-50 text-white py-2  " style="left: 50%; transform: translateX(-50%);">
       <div class="text-center font-bold text-2xl my-2">Search Product</div>
        <div class="flex">
            <input class="h-10 bg-white rounded-l-full p-2 text-black w-full" type="text">
            <button class="bg-gray-500 h-10 w-16 rounded-r-full hover:bg-gray-800">
                <img class="h-10 p-2" src="https://img.icons8.com/?size=100&id=7695&format=png&color=ffffff" alt="Icon">
            </button>
        </div>
        <div class="mt-2 p-2">
            <div class="rounded w-full flex flex-wrap hover:bg-gray-800 hover:opacity-75 border-b border-gray-500">
                <div class="py-2 px-2">
                    <img class="h-12 w-12 sm:h-16 sm:w-16 object-cover" src="https://cdn.tgdd.vn/Products/Images/42/329138/s16/iphone-16-pink-thumbnew-650x650.png">
                </div>
                <h class="flex py-2 px-2 mt-3"> <div class="font-bold">Name Product:</div> <div class="px-2">Iphone 16</div></h>
                <h class="flex py-2 px-2 mt-3"> <div class="font-bold">Product:</div> <div class="px-2">20.000.000 d</div></h>
            </div>                   
        </div>
    </div>
    </div>
    </div>
</body>
<script>
        const button = document.getElementById('toggleButton');
        const content = document.getElementById('content');

        button.addEventListener('click', () => {
            content.classList.toggle('hidden');
        });
        const button1 = document.getElementById('searchButton');
        const button2 = document.getElementById('searchButton1');
        const content1 = document.getElementById('search');

        button1.addEventListener('click', () => {
            content1.classList.toggle('hidden');
        });
        button2.addEventListener('click', () => {
            content1.classList.toggle('hidden');
        });
</script>

</html>

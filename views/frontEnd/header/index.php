
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
            <div id="content" class="row bg-gradient-to-r from-yellow-900 via-pink-500 to-blue-600 p-3 fixed z-40 top-0 w-full hidden md:flex md:flex-row flex-col">
                <div  onclick="window.location='/'"
                class="col-12 col-md-2 d-flex align-items-center justify-content-center">
                    <img class="h-8" src="https://img.icons8.com/?size=100&id=30840&format=png&color=ffffff" alt="Logo">
                    <h1 class="font-bold text-white bg-clip-text text-transparent text-xl ml-2">
                        IPHONE
                    </h1>
                </div>
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
                    <a >IPad</a>
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
                
                 <div  id="searchButton"
                 onclick="window.location='?controller=search'"
                 class="bg-black opacity-50 col-12 col-md-1 rounded-full hover:bg-gray-400 ">
                    <img class="h-8 mx-1 mt-1 p-1" src="https://img.icons8.com/?size=100&id=7695&format=png&color=ffffff" alt="Icon">
                    
                </div>
               
                <div 
                 class="col-12 col-md-3 d-flex align-items-center justify-content-center text-white font-bold text-sm mt-2 mt-md-0">
                    <img class="h-8 w-8 bg-white rounded-full mx-2" src="https://img.icons8.com/?size=100&id=99268&format=png&color=000000" alt="Login">
                    
                    <?php if (isset($username)): ?>
                        <a 
                            <?php if ($Role == 0): ?>
                                onclick="window.location='?controller=information&user=<?php echo $userID; ?>'"
                            <?php elseif ($Role == 1): ?>
                                onclick="window.location='?controller=homeManager'"
                            <?php endif; ?>
                            class="hover:text-yellow-500">
                            <?php echo $username; ?>
                        </a>
                        <div class="d-flex align-items-center justify-content-center mt-2 mt-md-0">
                        <?php if ($Role == 0): ?>
                            <img class="h-8 bg-gray-900 hover:bg-gray-400 p-1 rounded-full mx-2"
                                onclick="window.location='?controller=Notification'"
                                src="https://img.icons8.com/?size=100&id=ftMXZGFfen2R&format=png&color=ffffff" alt="Notification Icon">
                            <div class="text-red-500 text-sm mt-0 h-8" style="font-size:10px"> 
                                +<?php echo $NumNotification; ?> 
                            </div>

                            <img class="h-8 bg-gray-900 hover:bg-gray-400 p-1 rounded-full mx-2"
                                onclick="window.location='?controller=cart&user=<?php echo $userID; ?>'"
                                src="https://img.icons8.com/?size=100&id=MuChNUVbFLwr&format=png&color=ffffff" alt="Cart Icon">
                        <?php endif; ?>
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
</body>
<script>
        const button = document.getElementById('toggleButton');
        const content = document.getElementById('content');

        button.addEventListener('click', () => {
            content.classList.toggle('hidden');
        });


      
</script>

</html>

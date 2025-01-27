<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Header</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <div class="container-fluid">
            <div id="content" class="row bg-gray-800 p-3 fixed z-50 top-0 w-full hidden md:flex md:flex-row flex-col">
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
                 class="col-6 col-md-1 d-flex align-items-center justify-content-center text-white font-bold text-sm hover:bg-gray-400 p-2">
                    <img class="h-6 mx-1" src="https://img.icons8.com/?size=100&id=11409&format=png&color=ffffff" alt="Icon">
                    <a >IPhone</a>
                </div>
                <div onclick="window.location='?controller=product&items=2'"
                class="col-6 col-md-1 d-flex align-items-center justify-content-center text-white font-bold text-sm hover:bg-gray-400 p-2">
                    <img class="h-6 mx-1" src="https://img.icons8.com/?size=100&id=10326&format=png&color=ffffff" alt="Icon">
                    <a >MacBook</a>
                </div>
                <div  onclick="window.location='?controller=product&items=3'"
                 class="col-6 col-md-1 d-flex align-items-center justify-content-center text-white font-bold text-sm hover:bg-gray-400 p-2">
                    <img class="h-6 mx-1" src="https://img.icons8.com/?size=100&id=11309&format=png&color=ffffff" alt="Icon">
                    <a >Mac</a>
                </div>
                <div  onclick="window.location='?controller=product&items=5'"
                 class="col-6 col-md-1 d-flex align-items-center justify-content-center text-white font-bold text-sm hover:bg-gray-400 p-2">
                    <img class="h-6 mx-1" src="https://img.icons8.com/?size=100&id=2318&format=png&color=ffffff" alt="Icon">
                    <a >iPad</a>
                </div>
                <div  onclick="window.location='?controller=product&items=4'"
                 class="col-6 col-md-1 d-flex align-items-center justify-content-center text-white font-bold text-sm hover:bg-gray-400 p-2">
                    <img class="h-6 mx-1" src="https://img.icons8.com/?size=100&id=111236&format=png&color=ffffff" alt="Icon">
                    <a >Watch</a>
                </div>
                <div  onclick="window.location='?controller=product&items=6'"
                 class="col-6 col-md-1 d-flex align-items-center justify-content-center text-white font-bold text-sm hover:bg-gray-400 p-2">
                    <img class="h-6 mx-1" src="https://img.icons8.com/?size=100&id=Cxy3RFJwyy2Z&format=png&color=ffffff" alt="Icon">
                    <a >Accessory</a>
                </div>
                <!-- Login -->
                <div class="col-6 col-md-1 d-flex align-items-center justify-content-center text-white font-bold text-sm mt-2 mt-md-0">
                    <img class="h-6 bg-white rounded-full mx-2" src="https://img.icons8.com/?size=100&id=99268&format=png&color=000000" alt="Login">
                    <a  class="hover:text-yellow-500">LOGIN</a>
                </div>
                <!-- Social icons -->
                <div class="col-6 col-md-1 d-flex align-items-center justify-content-center mt-2 mt-md-0">
                    <img class="h-6 bg-gray-900 hover:bg-gray-400 p-1 rounded-full mx-2"
                        src="https://img.icons8.com/?size=100&id=ftMXZGFfen2R&format=png&color=ffffff" alt="Icon">
                    <img class="h-6 bg-gray-900 hover:bg-gray-400 p-1 rounded-full mx-2"
                        src="https://img.icons8.com/?size=100&id=MuChNUVbFLwr&format=png&color=ffffff" alt="Icon">
                </div>
                <!-- Search bar -->
                <div class="col-12 col-md-2 d-flex align-items-center justify-content-center mt-2 mt-md-0">
                    <input class="form-control rounded-full w-100" type="text" placeholder="Search...">
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

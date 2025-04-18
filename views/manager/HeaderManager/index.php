<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiêu Đề Tương Thích</title>
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
            <div id="content" class="row bg-gray-800 p-3 fixed z-40 top-0 w-full hidden md:flex md:flex-row flex-col">
            
            <div  
                class="col-12 col-md-3 d-flex align-items-center justify-content-center">
                    <img class="h-8" src="https://img.icons8.com/?size=100&id=17843&format=png&color=42A5F5" alt="Logo">
                    <h1 
                    onclick="window.location =`/`"
                    class="font-bold bg-gradient-to-r from-blue-500 to-red-500 bg-clip-text text-transparent text-xl ml-2">
                        iPhone
                    </h1>
                </div>
                <div class="col-12 col-md-2 text-white">
                    <select id="paymentType" onchange="handleSelectionProduct(this)" name="paymentType" required class="bg-gray-800 text-gray-500 mt-1 block w-full text-white p-2 rounded-md ">
                        <option value="" disabled selected>Quản Lý Sản Phẩm</option>
                        <option value="1">Danh Sách Sản Phẩm</option>
                        <option value="2">Thêm Sản Phẩm Mới</option>
                    </select>
                </div>
                <div class="col-12 col-md-2 text-white">
                    <select id="paymentType" name="paymentType" required class="bg-gray-800 text-gray-500 mt-1 block w-full text-white p-2 rounded-md" onchange="handleSelection(this)">
                        <option value="" disabled selected>Quản Lý Đơn Hàng</option>
                        <option value="5">Đơn hàng chưa hoàn thành</option>
                        <option value="3">Đơn hàng đã hoàn thành</option>
                    </select>
                </div>     
                <div class="col-12 col-md-2 text-white">
                    <select id="paymentType" name="paymentType" required class="bg-gray-800 text-gray-500 mt-1 block w-full text-white p-2 rounded-md" onchange="handleSelectionUser(this)">
                        <option value="" disabled selected>Quản lý tài khoản </option>
                        <option value="0">Thêm người dùng </option>
                        <option value="1">Quản lý người dùng</option>
                        <option value="2">Quản lý hoạt động Admin</option>
                    </select>
                </div>             
                

                <div class="col-12 col-md-2 text-white">
                    <select id="paymentType" onchange="handleSelectionStatiscal(this)" name="paymentType" required class="bg-gray-800 text-gray-500 mt-1 block w-full text-white p-2 rounded-md ">
                        <option value="" disabled selected>Thống Kê</option>
                        <option value="1">Thống kê khách hàng tiềm năng</option>
                        <!-- <option value="2">Thống kê sản phẩm</option>
                        <option value="3">Báo cáo doanh thu</option>
                        <option value="4">Thanh toán mua hàng</option> -->
                    </select>
                </div>
                <div
                onclick="window.location='?controller=Headermanager&action=logout'"
                class="col-12 rounded col-md-1 text-white p-2 mt-1 hover:bg-red-500">
                    Đăng Xuất
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
        function handleSelection(select) {
        const value = select.value;
        if (value) {
            window.location = `?controller=OderManager&id=${value}`;
        }
    }

    function handleSelectionProduct(select) {
        const value = select.value;
        if (value==1) {
            window.location = `?controller=homeManager`;
        }
        else
        if(value==2){
            window.location =`?controller=AddProduct`;
        }
        else
        if(value==3){
            window.location =`?controller=DeleteProduct`;
        }
        else
        if(value==4){
            window.location =`?controller=Adddetailproduct`;
        }

    }
    function handleSelectionStatiscal(select) {
        const value = select.value;
        if (value==1) {
            window.location = `?controller=Oderstatistical`;
        }
        else
        if(value==2){
            window.location =`?controller=Productstatistical`;
        }
        else
        if(value==3){
            window.location =`?controller=Revenuestatistical`;
        }
        if(value==4){
            window.location =`?controller=PurchasePayment`;
        }

    }
    function handleSelectionUser(select) {
        const value = select.value;
        if (value==0) {
            window.location = `?controller=Adduser`;
        } else
        if (value==1) {
            window.location = `?controller=Usermanager`;
        }else
        if (value==2) {
            window.location = `?controller=ActionManager`;
        }
    }
      
</script>

</html>

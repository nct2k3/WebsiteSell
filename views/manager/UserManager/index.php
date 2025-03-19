<?Php
require_once './controllers/HeadermanagerController.php';
$controller = new HeadermanagerController();
$controller->index();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-8">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Quản Lý Người Dùng</h1>
    
    <!-- Search Form -->
    <div class="max-w-2xl mx-auto mb-8">
        <form action="?controller=Usermanager" method="POST" class="flex shadow-lg rounded-lg overflow-hidden">
            <input type="hidden" name="action" value="search">
            <input placeholder="Tìm kiếm người dùng..." id="string" name="string" 
                   class="flex-1 px-4 py-3 text-gray-700 focus:outline-none" type="text">
            <button class="bg-blue-500 px-6 hover:bg-blue-600 transition-colors">
                <img class="h-6" src="https://img.icons8.com/?size=100&id=7695&format=png&color=ffffff" alt="Search">
            </button>
        </form>
    </div>

    <!-- User Cards Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <?php foreach($dataUser as $item) :?>
        <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow">
            <div class="border-b pb-4 mb-4">
                <h2 class="text-xl font-semibold text-gray-800">
                    ID: <?php echo $item['DataUser']->userID?>
                    <span class="float-right px-3 py-1 rounded-full text-sm <?php echo $item['DataAcc']->role == 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                        <?php echo $item['DataAcc']->role == 0 ? 'Hoạt động' : 'Đã khóa' ?>
                    </span>
                </h2>
            </div>

            <form action="?controller=Usermanager" method="POST" class="space-y-4">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="userID" value="<?php echo $item['DataUser']->userID?>">
                
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tên người dùng</label>
                        <input type="text" name="UserName" value="<?php echo $item['DataUser']->FullName?>"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="Email" value="<?php echo $item['DataAcc']->email?>"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại</label>
                        <input type="tel" name="Phone" value="<?php echo $item['DataUser']->PhoneNumber?>"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu</label>
                        <input type="password" name="password" value="<?php echo $item['DataAcc']->password?>"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Địa chỉ</label>
                        <input type="text" name="address" value="<?php echo $item['DataUser']->Address?>"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    </div>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-1 bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition-colors">
                        Lưu thay đổi
                    </button>
                </div>
            </form>
            <form action="?controller=Usermanager" method="POST" class="flex-1 mt-4">
                        <input type="hidden" name="action" value="changeStatus">
                        <input type="hidden" name="userID" value="<?php echo $item['DataUser']->userID?>">
                        <input type="hidden" name="currentRole" value="<?php echo $item['DataAcc']->role?>">
                        <button type="submit" 
                                class="w-full <?php echo $item['DataAcc']->role == 0 ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' ?> text-white py-2 px-4 rounded-md transition-colors">
                            <?php echo $item['DataAcc']->role == 0 ? 'Khóa tài khoản' : 'Mở khóa tài khoản' ?>
                        </button>
                    </form>
        </div>
        <?php endforeach ?>
    </div>
</div>

</body>
</html>
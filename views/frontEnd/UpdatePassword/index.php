<?php
require_once './controllers/HeaderController.php';
$controller = new HeaderController();
$controller->index();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập Nhật Mật Khẩu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-gray-900 to-gray-800 text-gray-100">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="flex bg-gray-800/50 backdrop-blur-sm shadow-2xl rounded-2xl overflow-hidden w-full max-w-4xl">
            <div class="hidden md:flex md:w-1/2 bg-white justify-center items-center p-6">
                <img class="rounded-2xl object-cover w-full h-full shadow-lg transform hover:scale-105 transition-transform duration-300" 
                     src="https://haloshop.vn/image/cache/catalog/products/apple/iphone/iphone16-16-plus/iphone_16_41-1400x1400.jpg" 
                     alt="Hình ảnh iPhone">
            </div>
            <div class="w-full md:w-1/2 p-8">
                <h2 class="text-3xl font-bold text-center mb-8 text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">
                    Cập Nhật Mật Khẩu
                </h2>
                <form action="?controller=Updatepassword" method="POST" class="space-y-6">
                    <input type="hidden" name="action" value="Updatepassword">
                    
                    <div class="space-y-4">
                        <div>
                            <label for="email" class="block text-sm font-medium mb-2">Địa Chỉ Email</label>
                            <input type="email" name="email" id="email" 
                                   class="w-full px-4 py-2 border border-gray-700 rounded-lg bg-gray-900/50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300" 
                                   placeholder="Nhập email của bạn" required>
                        </div>
                        
                        <div>
                            <label for="current-password" class="block text-sm font-medium mb-2">Mật Khẩu Hiện Tại</label>
                            <input type="password" name="password" id="current-password" 
                                   class="w-full px-4 py-2 border border-gray-700 rounded-lg bg-gray-900/50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300" 
                                   placeholder="Nhập mật khẩu hiện tại" required>
                        </div>
                        
                        <div>
                            <label for="new-password" class="block text-sm font-medium mb-2">Mật Khẩu Mới</label>
                            <input type="password" name="NewPassword" id="new-password" 
                                   class="w-full px-4 py-2 border border-gray-700 rounded-lg bg-gray-900/50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300" 
                                   placeholder="Nhập mật khẩu mới" required>
                        </div>
                        
                        <div>
                            <label for="confirm-password" class="block text-sm font-medium mb-2">Xác Nhận Mật Khẩu Mới</label>
                            <input type="password" name="ConfirmPassword" id="confirm-password" 
                                   class="w-full px-4 py-2 border border-gray-700 rounded-lg bg-gray-900/50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300" 
                                   placeholder="Xác nhận mật khẩu mới" required>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="?controller=forgotPassword" 
                           class="text-sm text-blue-400 hover:text-blue-300 transition-colors duration-300">
                            Quên mật khẩu?
                        </a>
                    </div>

                    <button type="submit" 
                            class="w-full py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg font-semibold hover:from-blue-600 hover:to-purple-700 transform hover:-translate-y-0.5 transition-all duration-300">
                        Cập Nhật Mật Khẩu
                    </button>
                </form>

                <div class="text-center mt-6">
                    <span>Chưa có tài khoản? 
                        <a href="?controller=register" 
                           class="text-purple-400 hover:text-purple-300 transition-colors duration-300">
                            Đăng ký tại đây
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

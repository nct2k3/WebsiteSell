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
    <title>Quên Mật Khẩu - Website Bán Hàng</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-gray-900 to-gray-800 text-gray-100">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="flex bg-gray-800/90 shadow-2xl rounded-2xl overflow-hidden w-full max-w-4xl backdrop-blur-sm">
            <div class="hidden md:flex md:w-1/2 bg-white justify-center items-center p-6">
                <img class="rounded-2xl object-cover w-full h-full shadow-lg transform hover:scale-105 transition-transform duration-300" 
                     src="https://cloud.shopback.com/c_scale,c_auto,q_70,f_webp/media-production-aps1/iuMrst6b5EQ/czM6Ly9tZWRpYS1zZXJ2aWNlLXNiLXByb2Qtdm4vNzNlNGEwYzktOWM4OS00ODg1LWI4ZDMtOGQ5OTE3NTcyZjcwLU11bHRpLVByb2R1Y3RfTWFjQm9va19pUGFkX2lQaG9uZV9XYXRjaC0oMikucG5n.png" 
                     alt="Hình Ảnh Sản Phẩm">
            </div>
            <div class="w-full md:w-1/2 p-8">
                <h2 class="text-3xl font-bold text-center mb-6 text-blue-400">Quên Mật Khẩu?</h2>
                <p class="text-gray-400 text-center mb-8">Nhập địa chỉ email của bạn và chúng tôi sẽ gửi hướng dẫn để đặt lại mật khẩu.</p>
                
                <form action="?controller=forgotpassword" method="POST" class="space-y-6">
                    <input type="hidden" name="action" value="ForgotPassword">
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-300">Địa Chỉ Email</label>
                        <div class="relative">
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   class="w-full px-4 py-3 border border-gray-700 rounded-lg bg-gray-900/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                   placeholder="Nhập email của bạn"
                                   required>
                        </div>
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold transition-colors duration-200 transform hover:scale-[1.02]">
                        Lấy Lại Mật Khẩu
                    </button>
                </form>

                <div class="text-center mt-8 space-y-4">
                    <div class="text-gray-400">
                        Đã nhớ mật khẩu? 
                        <a href="?controller=login" class="text-blue-400 hover:text-blue-300 hover:underline transition-colors duration-200">
                            Đăng nhập
                        </a>
                    </div>
                    <div class="text-gray-400">
                        Chưa có tài khoản? 
                        <a href="?controller=register" class="text-blue-400 hover:text-blue-300 hover:underline transition-colors duration-200">
                            Đăng ký
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>

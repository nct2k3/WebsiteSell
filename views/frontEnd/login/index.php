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
    <title>Đăng Nhập - Cửa Hàng Apple</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-900 to-gray-800 text-gray-100 min-h-screen">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="flex bg-gray-800/50 backdrop-blur-sm shadow-2xl rounded-2xl overflow-hidden w-full max-w-4xl">
            <div class="hidden md:flex md:w-1/2 bg-white justify-center items-center p-6">
                <img class="rounded-2xl object-cover w-full h-full shadow-lg transform hover:scale-105 transition-transform duration-300" 
                     src="https://baothainguyen.vn/file/e7837c027f6ecd14017ffa4e5f2a0e34/092024/iphone-16_promax_20240916104159.jpg" 
                     alt="iPhone Apple">
            </div>
            <div class="w-full md:w-1/2 p-8">
                <h2 class="text-3xl font-bold text-center mb-8 text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">
                    Chào Mừng Đến Cửa Hàng Apple
                </h2>
                <form action="?controller=login" method="POST" class="space-y-6">
                    <input type="hidden" name="action" value="login">
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-300">Địa chỉ email</label>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               class="w-full px-4 py-2 border border-gray-700 rounded-lg bg-gray-900/50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300" 
                               placeholder="Nhập email của bạn" 
                               required>
                    </div>
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium text-gray-300">Mật khẩu</label>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               class="w-full px-4 py-2 border border-gray-700 rounded-lg bg-gray-900/50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300" 
                               placeholder="Nhập mật khẩu của bạn" 
                               required>
                    </div>
                    <div class="flex items-center justify-between">
                        <a href="?controller=forgotPassword" 
                           class="text-sm text-blue-400 hover:text-blue-300 transition-colors duration-300">
                           Quên mật khẩu?
                        </a>
                        <a href="?controller=updatepassword" 
                           class="text-sm text-blue-400 hover:text-blue-300 transition-colors duration-300">
                           Cập nhật mật khẩu?
                        </a>
                    </div>
                    <?php if (isset($_SESSION['messages'])): ?>
                        <div class="bg-red-500/90 text-white p-3 rounded-lg text-center animate-pulse">
                            <?php echo $_SESSION['messages']; ?>
                            <?php unset($_SESSION['messages']); ?>
                        </div>
                    <?php endif; ?>
                    <button type="submit" 
                            class="w-full py-3 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-700 hover:to-blue-800 text-white rounded-lg font-semibold transform hover:scale-[1.02] transition-all duration-300">
                        ĐĂNG NHẬP
                    </button>
                </form>
                <div class="text-center mt-8">
                    <span class="text-gray-400">Chưa có tài khoản? 
                        <a href="?controller=register" 
                           class="text-red-400 hover:text-red-300 font-medium transition-colors duration-300">
                           Đăng ký
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

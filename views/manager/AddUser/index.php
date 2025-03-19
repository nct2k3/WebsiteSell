<?php
require_once './controllers/HeadermanagerController.php';
$controller = new HeadermanagerController();
$controller->index();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biểu mẫu đăng nhập với Tailwind CSS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <script>
    function validatePassword() {
      const password = document.getElementById("password").value;
      const confirmPassword = document.getElementById("ConfirmPassword").value;
      const errorDiv = document.getElementById("error-message");

      if (password !== confirmPassword) {
        errorDiv.textContent = "Mật khẩu xác nhận không khớp!";
        errorDiv.classList.remove("hidden");
        return false;
      } else {
        errorDiv.textContent = "";
        errorDiv.classList.add("hidden");
      }
      return true;
    }
  </script>
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }
  </style>
</head>
<body class="text-gray-900">
  <div class="flex mt-6 justify-center min-h-screen">
    <div class="flex bg-white shadow-2xl rounded-xl overflow-hidden w-full max-w-4xl transform transition-all hover:scale-[1.01]">
      <div class="w-full px-10 py-8">
        <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Tạo tài khoản mới</h2>
        <form action="?controller=Adduser" method="POST" class="space-y-6" onsubmit="return validatePassword();">
          <input type="hidden" name="action" value="Adduser">
          <div class="grid grid-cols-2 gap-6">
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium mb-2 text-gray-700">Địa chỉ email</label>
                <input type="email" name="Email" id="email" 
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                    placeholder="Nhập email của bạn" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium mb-2 text-gray-700">Mật khẩu</label>
                <input type="password" name="Password" id="password" 
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                    placeholder="Nhập mật khẩu của bạn" required>
            </div>
            <div class="mb-4">
                <label for="ConfirmPassword" class="block text-sm font-medium mb-2 text-gray-700">Xác nhận mật khẩu</label>
                <input type="password" name="ConfirmPassword" id="ConfirmPassword" 
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                    placeholder="Nhập lại mật khẩu của bạn" required>
            </div>
            <div class="mb-4">
                <label for="FullName" class="block text-sm font-medium mb-2 text-gray-700">Họ và tên</label>
                <input type="text" name="FullName" id="FullName" 
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                    placeholder="Nhập họ và tên của bạn" required>
            </div>
            <div class="mb-4">
                <label for="NumberPhone" class="block text-sm font-medium mb-2 text-gray-700">Số điện thoại</label>
                <input type="number" name="NumberPhone" id="NumberPhone" 
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                    placeholder="Nhập số điện thoại của bạn" required>
            </div>
            <div class="mb-4">
                <label for="Address" class="block text-sm font-medium mb-2 text-gray-700">Địa chỉ</label>
                <input type="text" name="Address" id="Address" 
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
                    placeholder="Nhập địa chỉ của bạn" required>
            </div>
          </div>
          <div id="error-message" class="text-red-500 text-sm hidden mb-4 text-center"></div>
          <button type="submit" 
            class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold text-lg transition duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Đăng ký
          </button>
        </form>
      </div>
    </div>
  </div>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>

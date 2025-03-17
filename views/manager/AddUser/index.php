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
</head>
<body class="text-gray-900">
  <div class="flex mt-6 justify-center min-h-screen">
    <div class="flex bg-gray-200 shadow-lg rounded-lg overflow-hidden w-full max-w-4xl">
      <div class="w-full px-8 py-4">
        <h2 class="text-2xl font-semibold text-center mb-2">Tạo tài khoản mới</h2>
        <form action="?controller=register" method="POST" class="space-y-4" onsubmit="return validatePassword();">
          <input type="hidden" name="action" value="register">
          <div class="grid grid-cols-2 gap-4">
            <div class="mb-1">
                <label for="email" class="block text-sm font-medium mb-1">Địa chỉ email</label>
                <input type="email" name="Email" id="email" class="w-full p-1 border h-6 border-gray-700 rounded-lg bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nhập email của bạn" required>
            </div>
            <div class="mb-1">
                <label for="password" class="block text-sm font-medium mb-1">Mật khẩu</label>
                <input type="password" name="Password" id="password" class="w-full p-1 h-6 border border-gray-700 rounded-lg bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nhập mật khẩu của bạn" required>
            </div>
            <div class="mb-1">
                <label for="ConfirmPassword" class="block text-sm font-medium mb-1">Xác nhận mật khẩu</label>
                <input type="password" name="ConfirmPassword" id="ConfirmPassword" class="w-full p-1 h-6 border border-gray-700 rounded-lg bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nhập lại mật khẩu của bạn" required>
            </div>
            <div class="mb-1">
                <label for="FullName" class="block text-sm font-medium mb-1">Họ và tên</label>
                <input type="text" name="FullName" id="FullName" class="w-full p-1 h-6 border border-gray-700 rounded-lg bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nhập họ và tên của bạn" required>
            </div>
            <div class="mb-1">
                <label for="NumberPhone" class="block text-sm font-medium mb-1">Số điện thoại</label>
                <input type="number" name="NumberPhone" id="NumberPhone" class="w-full p-1 h-6 border border-gray-700 rounded-lg bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nhập số điện thoại của bạn" required>
            </div>
            <div class="mb-1">
                <label for="Address" class="block text-sm font-medium mb-1">Địa chỉ</label>
                <input type="text" name="Address" id="Address" class="w-full p-1 h-6 border border-gray-700 rounded-lg bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nhập địa chỉ của bạn" required>
            </div>
          </div>
          <div id="error-message" class="text-red-500 text-sm hidden mb-2"></div>
          <button type="submit" class="w-full h-8 bg-blue-600 hover:bg-blue-700 text-white py-1 rounded-lg font-semibold">Đăng ký</button>
        </form>
      </div>
    </div>
  </div>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>

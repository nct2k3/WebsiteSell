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
  <title>Đăng Ký - Cửa Hàng Apple</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function validatePassword() {
      const password = document.getElementById("password").value;
      const confirmPassword = document.getElementById("ConfirmPassword").value;
      const errorDiv = document.getElementById("error-message");

      if (password !== confirmPassword) {
        errorDiv.textContent = "Mật khẩu không khớp!";
        errorDiv.classList.remove("hidden");
        return false;
      }
      errorDiv.classList.add("hidden");
      return true;
    }
  </script>
</head>
<body class="bg-gray-900 text-gray-100">
  <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="flex bg-gray-800 shadow-2xl rounded-2xl overflow-hidden w-full max-w-4xl">
      <div class="hidden md:block md:w-1/2">
        <img 
          class="h-full w-full object-cover"
          src="https://cdn2.fptshop.com.vn/unsafe/1920x0/filters:quality(100)/2022_9_21_637993950025502251_iphone-quoc-te-la-gi-0.jpg" 
          alt="Banner Cửa Hàng Apple"
        >
      </div>
      <div class="w-full md:w-1/2 p-8">
        <div class="text-center mb-8">
          <h2 class="text-3xl font-bold">Chào mừng đến Cửa Hàng Apple</h2>
          <p class="mt-2 text-gray-400">Tạo tài khoản của bạn</p>
        </div>
        
        <form action="?controller=register" method="POST" class="space-y-6" onsubmit="return validatePassword();">
          <input type="hidden" name="action" value="register">
          
          <div>
            <label for="email" class="block text-sm font-medium mb-2">Địa Chỉ Email</label>
            <input 
              type="email" 
              name="Email" 
              id="email" 
              class="w-full px-3 py-2 border border-gray-700 rounded-lg bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" 
              placeholder="Nhập email của bạn"
              required
            >
          </div>

          <div>
            <label for="password" class="block text-sm font-medium mb-2">Mật Khẩu</label>
            <input 
              type="password" 
              name="Password" 
              id="password" 
              class="w-full px-3 py-2 border border-gray-700 rounded-lg bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" 
              placeholder="Nhập mật khẩu của bạn (ít nhất 6 ký tự)"
              required
              minlength="6"
              oninvalid="this.setCustomValidity('Mật khẩu phải có ít nhất 6 ký tự')"
              oninput="this.setCustomValidity('')"
            >
          </div>

          <div id="error-message" class="text-red-500 text-sm hidden"></div>

          <div>
            <label for="ConfirmPassword" class="block text-sm font-medium mb-2">Xác Nhận Mật Khẩu</label>
            <input 
              type="password" 
              name="ConfirmPassword" 
              id="ConfirmPassword" 
              class="w-full px-3 py-2 border border-gray-700 rounded-lg bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" 
              placeholder="Xác nhận mật khẩu của bạn"
              required
              minlength="6"
              oninvalid="this.setCustomValidity('Mật khẩu xác nhận phải có ít nhất 6 ký tự')"
              oninput="this.setCustomValidity('')"
            >
          </div>

          <div>
            <label for="FullName" class="block text-sm font-medium mb-2">Họ và Tên</label>
            <input 
              type="text" 
              name="FullName" 
              id="FullName" 
              class="w-full px-3 py-2 border border-gray-700 rounded-lg bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" 
              placeholder="Nhập họ và tên của bạn"
              required
            >
          </div>

          <div>
            <label for="NumberPhone" class="block text-sm font-medium mb-2">Số Điện Thoại</label>
            <input 
              type="tel" 
              name="NumberPhone" 
              id="NumberPhone" 
              class="w-full px-3 py-2 border border-gray-700 rounded-lg bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" 
              placeholder="Nhập số điện thoại của bạn"
              required
            >
          </div>

          <div>
            <label for="Address" class="block text-sm font-medium mb-2">Địa Chỉ</label>
            <input 
              type="text" 
              name="Address" 
              id="Address" 
              class="w-full px-3 py-2 border border-gray-700 rounded-lg bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" 
              placeholder="Nhập địa chỉ của bạn"
              required
            >
          </div>

          <button 
            type="submit" 
            class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-200 transform hover:scale-[1.02]"
          >
            Tạo Tài Khoản
          </button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>

<?php
require_once './views/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form with Tailwind CSS</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-100">
  <div class="flex items-center justify-center min-h-screen">
    <div class="flex bg-gray-800 shadow-lg rounded-lg overflow-hidden w-full max-w-4xl">
      <!-- Hình ảnh bên trái -->
      <div class="hidden md:flex md:w-1/2 bg-white justify-center items-center">
        <img  class="rounded-2xl" src="https://haloshop.vn/image/cache/catalog/products/apple/iphone/iphone16-16-plus/iphone_16_41-1400x1400.jpg" alt="Illustration" >
      </div>
      <!-- Form đăng nhập -->
      <div class="w-full md:w-1/2 p-8">
        <h2 class="text-2xl font-semibold text-center mb-4">WellCome to Apple store</h2>
        <div class="flex justify-center space-x-4 mb-6">
          <button class="bg-blue-600 hover:bg-blue-700 text-white rounded-full w-10 h-10 flex items-center justify-center">
            <i class="fab fa-facebook-f"></i>
          </button>
          <button class="bg-white hover:bg-blue-100 text-white rounded-full w-10 h-10 flex items-center justify-center">
            <img src="https://img.icons8.com/?size=100&id=17843&format=png&color=000000" class="fab fa-twitter"></img>
          </button>
          <button class="bg-blue-800 hover:bg-blue-900 text-white rounded-full w-10 h-10 flex items-center justify-center">
            <i class="fab fa-linkedin-in"></i>
          </button>
        </div>
        <div class="flex items-center justify-between mb-2">
          <hr class="flex-1 border-gray-600">
          <span class="px-4 text-gray-400">Sign in</span>
          <hr class="flex-1 border-gray-600">
        </div>
        <form action="?controller=login" method="POST" class="space-y-4">
            <input type="hidden" name="action" value="login">
          <div class="mb-2">
            <label for="email" class="block text-sm font-medium mb-2">Email address</label>
            <input type="email" name="email" id="email" class="w-full p-3 border h-10 border-gray-700 rounded-lg bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your email" required>
          </div>
          <div class="mb-2">
            <label for="password" class="block text-sm font-medium mb-2">Password</label>
            <input type="password" name="password" id="password" class="w-full p-3 h-10 border border-gray-700 rounded-lg bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your password" required>
          </div>
          <div class="flex items-center justify-between mb-2">
            <a></a>
            <a href="#" class="text-sm text-blue-500 hover:underline">Forgot password?</a>
          </div>
          <button type="submit" class="w-full h-10 bg-blue-600 hover:bg-blue-700 text-white py-1 rounded-lg font-semibold">LOGIN</button>
        </form>
        <div class="text-center mt-6">
          <span>Don't have an account? <a href="#" class="text-red-500 hover:underline">Register</a></span>
        </div>
      </div>
    </div>
  </div>
  <!-- Font Awesome for icons -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>

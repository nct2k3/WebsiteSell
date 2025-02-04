<?php
require_once './controllers/HeaderController.php';
$controller = new HeaderController();
$controller->index();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form with Tailwind CSS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function validatePassword() {
      const password = document.getElementById("password").value;
      const confirmPassword = document.getElementById("ConfirmPassword").value;
      const errorDiv = document.getElementById("error-message");

      if (password !== confirmPassword) {
        errorDiv.textContent = "Confirmation password does not match!";
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
<body class="bg-gray-900 text-gray-100">
  <div class="flex mt-6 justify-center min-h-screen">
    <div class="flex bg-gray-800 shadow-lg rounded-lg overflow-hidden w-full max-w-4xl">
      <div class="hidden md:flex md:w-1/2 bg-white justify-center items-center">
        <img class="" src="https://cdn2.fptshop.com.vn/unsafe/1920x0/filters:quality(100)/2022_9_21_637993950025502251_iphone-quoc-te-la-gi-0.jpg" alt="Illustration">
      </div>
      <div class="w-full md:w-1/2 px-8 py-4">
        <h2 class="text-2xl font-semibold text-center mb-2">Welcome to Apple Store</h2>
        <form action="?controller=register" method="POST" class="space-y-4" onsubmit="return validatePassword();">
          <input type="hidden" name="action" value="register">
          <div class="mb-1">
            <label for="email" class="block text-sm font-medium mb-1">Email address</label>
            <input type="email" name="Email" id="email" class="w-full p-1 border h-6 border-gray-700 rounded-lg bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your email" required>
          </div>
          <div class="mb-1">
            <label for="password" class="block text-sm font-medium mb-1">Password</label>
            <input type="password" name="Password" id="password" class="w-full p-1 h-6 border border-gray-700 rounded-lg bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your password" required>
          </div>
          <div id="error-message" class="text-red-500 text-sm hidden mb-2"></div>
          <div class="mb-1">
            <label for="ConfirmPassword" class="block text-sm font-medium mb-1">Confirm Password</label>
            <input type="password" name="ConfirmPassword" id="ConfirmPassword" class="w-full p-1 h-6 border border-gray-700 rounded-lg bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your ConfirmPassword" required>
          </div>
          <div class="mb-1">
            <label for="FullName" class="block text-sm font-medium mb-1">Full Name</label>
            <input type="text" name="FullName" id="FullName" class="w-full p-1 h-6 border border-gray-700 rounded-lg bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your FullName" required>
          </div>
          <div class="mb-1">
            <label for="NumberPhone" class="block text-sm font-medium mb-1">Number Phone</label>
            <input type="number" name="NumberPhone" id="NumberPhone" class="w-full p-1 h-6 border border-gray-700 rounded-lg bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your NumberPhone" required>
          </div>
          <div class="mb-1">
            <label for="Address" class="block text-sm font-medium mb-1">Address</label>
            <input type="text" name="Address" id="Address" class="w-full p-1 h-6 border border-gray-700 rounded-lg bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your Address" required>
          </div>
          <button type="submit" class="w-full h-8 bg-blue-600 hover:bg-blue-700 text-white py-1 rounded-lg font-semibold">Register</button>
        </form>
      </div>
    </div>
  </div>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>

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
  <title>Register - Apple Store</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function validatePassword() {
      const password = document.getElementById("password").value;
      const confirmPassword = document.getElementById("ConfirmPassword").value;
      const errorDiv = document.getElementById("error-message");

      if (password !== confirmPassword) {
        errorDiv.textContent = "Passwords do not match!";
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
          alt="Apple Store Banner"
        >
      </div>
      <div class="w-full md:w-1/2 p-8">
        <div class="text-center mb-8">
          <h2 class="text-3xl font-bold">Welcome to Apple Store</h2>
          <p class="mt-2 text-gray-400">Create your account</p>
        </div>
        
        <form action="?controller=register" method="POST" class="space-y-6" onsubmit="return validatePassword();">
          <input type="hidden" name="action" value="register">
          
          <div>
            <label for="email" class="block text-sm font-medium mb-2">Email Address</label>
            <input 
              type="email" 
              name="Email" 
              id="email" 
              class="w-full px-3 py-2 border border-gray-700 rounded-lg bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" 
              placeholder="Enter your email"
              required
            >
          </div>

          <div>
            <label for="password" class="block text-sm font-medium mb-2">Password</label>
            <input 
              type="password" 
              name="Password" 
              id="password" 
              class="w-full px-3 py-2 border border-gray-700 rounded-lg bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" 
              placeholder="Enter your password"
              required
            >
          </div>

          <div id="error-message" class="text-red-500 text-sm hidden"></div>

          <div>
            <label for="ConfirmPassword" class="block text-sm font-medium mb-2">Confirm Password</label>
            <input 
              type="password" 
              name="ConfirmPassword" 
              id="ConfirmPassword" 
              class="w-full px-3 py-2 border border-gray-700 rounded-lg bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" 
              placeholder="Confirm your password"
              required
            >
          </div>

          <div>
            <label for="FullName" class="block text-sm font-medium mb-2">Full Name</label>
            <input 
              type="text" 
              name="FullName" 
              id="FullName" 
              class="w-full px-3 py-2 border border-gray-700 rounded-lg bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" 
              placeholder="Enter your full name"
              required
            >
          </div>

          <div>
            <label for="NumberPhone" class="block text-sm font-medium mb-2">Phone Number</label>
            <input 
              type="tel" 
              name="NumberPhone" 
              id="NumberPhone" 
              class="w-full px-3 py-2 border border-gray-700 rounded-lg bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" 
              placeholder="Enter your phone number"
              required
            >
          </div>

          <div>
            <label for="Address" class="block text-sm font-medium mb-2">Address</label>
            <input 
              type="text" 
              name="Address" 
              id="Address" 
              class="w-full px-3 py-2 border border-gray-700 rounded-lg bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" 
              placeholder="Enter your address"
              required
            >
          </div>

          <button 
            type="submit" 
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-200 transform hover:scale-[1.02]"
          >
            Create Account
          </button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>


<?Php
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
</head>
<body class="bg-gray-900 text-gray-100">
  <div class="flex items-center justify-center min-h-screen">
    <div class="flex bg-gray-800 shadow-lg rounded-lg overflow-hidden w-full max-w-4xl">
      <div class="hidden md:flex md:w-1/2 bg-white justify-center items-center">
        <img class="rounded-2xl" src="https://cloud.shopback.com/c_scale,c_auto,q_70,f_webp/media-production-aps1/iuMrst6b5EQ/czM6Ly9tZWRpYS1zZXJ2aWNlLXNiLXByb2Qtdm4vNzNlNGEwYzktOWM4OS00ODg1LWI4ZDMtOGQ5OTE3NTcyZjcwLU11bHRpLVByb2R1Y3RfTWFjQm9va19pUGFkX2lQaG9uZV9XYXRjaC0oMikucG5n.png" alt="Illustration">
      </div>
      <div class="w-full md:w-1/2 p-8">
        <h2 class="text-2xl font-semibold text-center mb-4">Forgot Password</h2>
        <form action="?controller=forgotpassword" method="POST" class="space-y-4">
          <input type="hidden" name="action" value="ForgotPassword">
          <div class="mb-2">
            <label for="email" class="block text-sm font-medium mb-2">Email address</label>
            <input type="email" name="email" id="email" class="w-full p-3 border h-10 border-gray-700 rounded-lg bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your email" required>
          </div>
          <button type="submit" class="w-full h-10 bg-blue-600 hover:bg-blue-700 text-white py-1 rounded-lg font-semibold">Take Password</button>
        </form>
        <div class="text-center mt-6">
          <span>Don't have an account? <a 
          onclick="window.location='?controller=register'"
          class="text-red-500 hover:underline">Register</a></span>
        </div>
      </div>
    </div>
  </div>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>

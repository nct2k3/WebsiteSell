
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
  <title>Form Đăng Ký</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Đăng Ký Tài Khoản</h2>
    <form action="../../../controllers/registerController.php" method="POST" class="space-y-4">
      <input type="hidden" name="action" value="create">
      <div>
        <label for="name" class="block text-sm font-medium text-gray-600">Tên</label>
        <input type="text" id="name" name="name" placeholder="Nhập tên của bạn" class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required />
      </div>
      <div>
        <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
        <input type="email" id="email" name="email" placeholder="Nhập email của bạn" class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required />
      </div>
      <div>
        <label for="phone" class="block text-sm font-medium text-gray-600">Số điện thoại</label>
        <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại của bạn" class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required />
      </div>
      <div>
        <label for="password" class="block text-sm font-medium text-gray-600">Mật khẩu</label>
        <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required />
      </div>
      <div>
        <label for="confirm_password" class="block text-sm font-medium text-gray-600">Xác nhận mật khẩu</label>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Xác nhận mật khẩu" class="w-full mt-1 p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required />
      </div>
      <input type="hidden" name="role" value="user">
      <input type="hidden" name="userID" value="1">
      <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 transition">Đăng Ký</button>
    </form>
  </div>
</body>
</html>
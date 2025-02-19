<?Php
require_once './controllers/HeadermanagerController.php';
$controller = new HeadermanagerController();
$controller->index();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Nhập Dữ Liệu Thông Báo</title>
</head>
<body >
    <div class=" mt-5 container mx-auto bg-white p-5 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-4">Delete oder</h1>
        <form action="/?controller=NotificationManager" method="POST">
            <input type="hidden" name="action" value="DeleteOder">


            <div class="mb-4">
                <label for="userID" class="block text-sm font-medium text-gray-700">Odder ID</label>
                <input type="number" readonly id="oderID" name="oderID" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:border-red-500 focus:ring focus:ring-red-200" value="<?php echo $IdOder ?>" placeholder="<?php echo $IdOder ?>">
            </div>

            <div class="mb-4">
                <label for="userID" class="block text-sm font-medium text-gray-700">UserID</label>
                <input type="number" readonly id="userID" name="userID" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:border-red-500 focus:ring focus:ring-red-200" value="<?php echo $IdUser ?>" placeholder="<?php echo $IdUser ?>">
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Reason for order deletion</label>
                <textarea id="content" name="content" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:border-red-500 focus:ring focus:ring-red-200" placeholder="Reason ............" rows="4"></textarea>
            </div>
          
            <button type="submit" class="mt-4 w-full bg-red-500 text-white font-bold py-2 rounded hover:bg-red-600">Accept Delete</button>
        </form>
    </div>

</body>
</html>
<?Php
require_once './controllers/HeadermanagerController.php';
$controller = new HeadermanagerController();
$controller->index();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Nhập Liệu Sản Phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto px-6 py-2 bg-white rounded-lg shadow-md mt-10">
        <h1 class="text-2xl font-bold mb-6">Nhập Thông Tin Sản Phẩm</h1>
        <form action="#" method="POST" class="grid grid-cols-2 gap-4">
            <div class="flex">
                <label for="capacity" class="block font-medium text-gray-700 w-48 mt-2  font-bold">Product Model</label>
                <input type="text" id="capacity" name="capacity" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>
            <div class="">
                <button type="submit" class=" w-full mt-1 bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">Thêm</button>
            </div>
        </form>
    </div>
    <div class="max-w-4xl mx-auto px-6 py-2 bg-white rounded-lg shadow-md mt-10">
        <h1 class="text-2xl font-bold mb-6">Nhập Thông Tin Sản Phẩm</h1>
        <form action="#" method="POST" class="grid grid-cols-2 gap-4">
            <div class="flex">
                <label for="capacity" class="block font-medium text-gray-700 w-48 mt-2  font-bold">Product Model</label>
                <input type="text" id="capacity" name="capacity" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>
            <div class="">
                <button type="submit" class=" w-full mt-1 bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">Thêm</button>
            </div>
        </form>
    </div>
    <div class="max-w-4xl mx-auto px-6 py-2 bg-white rounded-lg shadow-md mt-10">
        <h1 class="text-2xl font-bold mb-6">Nhập Thông Tin Sản Phẩm</h1>
        <form action="#" method="POST" class="grid grid-cols-2 gap-4">
            <div class="flex">
                <label for="capacity" class="block font-medium text-gray-700 w-48 mt-2  font-bold">Product Model</label>
                <input type="file" id="capacity" name="capacity" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>
            <div class="">
                <button type="submit" class=" w-full mt-1 bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">Thêm</button>
            </div>
        </form>
    </div>
    
</body>
</html>
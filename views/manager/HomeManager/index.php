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
    <div class="max-w-6xl mx-auto px-6 py-2 bg-white rounded-lg shadow-md mt-10">
        <h1 class="text-2xl font-bold mb-6">Nhập Thông Tin Sản Phẩm</h1>
        <form action="#" method="POST" class="grid  md:grid-cols-3 gap-4">
        
            <div>
                <label for="productLineId" class="block text-sm font-medium text-gray-700">Product Line</label>
                <div class="w-full">
                    <select id="paymentType" name="paymentType" required class="text-black border  mt-1 block w-full  p-2 rounded-md ">
                        <option value="" disabled selected>Product Line</option>
                        <option value="">Iphone</option>
                        <option value="">MacBook</option>
                    </select>
                </div>
            </div>
            <div>
                <label for="productLineId" class="block text-sm font-medium text-gray-700">Product Model</label>
                <div class="w-full">
                    <select id="paymentType" name="paymentType" required class="text-black border  mt-1 block w-full  p-2 rounded-md ">
                        <option value="" disabled selected>Product Model</option>
                        <option value="">Iphone 16</option>
                        <option value="">Iphone 15</option>
                    </select>
                </div>
            </div>
            <div>
                <label for="productLineId" class="block text-sm font-medium text-gray-700">Product Type</label>
                <div class="w-full">
                    <select id="paymentType" name="paymentType" required class="text-black border  mt-1 block w-full  p-2 rounded-md ">
                        <option value="" disabled selected>Product Type</option>
                        <option value="">Iphone 16</option>
                        <option value="">Iphone 16 Pro</option>
                    </select>
                </div>
            </div>
            <div>
                <label for="productName" class="block text-sm font-medium text-gray-700">Product Name</label>
                <input type="text" id="productName" name="productName" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>
            <div>
                <label for="originalPrice" class="block text-sm font-medium text-gray-700">Original Price</label>
                <input type="number" id="originalPrice" name="originalPrice" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>
            <div>
                <label for="originalPrice" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" id="originalPrice" name="originalPrice" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>
            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                <input type="number" id="stock" name="stock" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>
            <div>
                <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity</label>
                <input type="text" id="capacity" name="capacity" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>
            <div>
                <label for="productLineId" class="block text-sm font-medium text-gray-700">Color</label>
                <div class="w-full">
                    <select id="paymentType" name="paymentType" required class="text-black border  mt-1 block w-full  p-2 rounded-md ">
                        <option value="" disabled selected>Color</option>
                        <option value="">Iphone 16</option>
                        <option value="">Iphone 16 Pro</option>
                    </select>
                </div>
            </div>
            <div>
                <label for="img" class="block text-sm font-medium text-gray-700">Image URL</label>
                <input type="file" id="img" name="img" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>
            <div class="col-span-2 flex justify-end">
                <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">Thêm</button>
            </div>
        </form>
    </div>
</body>
</html>
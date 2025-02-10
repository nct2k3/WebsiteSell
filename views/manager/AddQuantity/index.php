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
<body class=" ">
    <h1 class="text-2xl font-bold mt-2 text-center ">Add Quantity products</h1>

    <div class="max-w-6xl mx-auto px-6 py-4 bg-white rounded-lg shadow-md ">
    <div class=" my-2 flex items-start p-4 border border-gray-200 rounded-lg hover:shadow-lg transition-shadow">
            <img src="<?php echo $ProductEdit->img ?>" alt="Product 1" class=" h-16 rounded-lg mr-4">
            <div class="flex">
                <div class="grid-3 md:grid-1">
                    <span class="text-lg font-semibold text-gray-800 ">Name: <?php echo $ProductEdit->productName ?></span>
                    <span class="text-gray-600 ml-2">Product ID: <?php echo $ProductEdit->productID?> </span>
                    <span class="text-gray-600m ml-2">Model: <?php echo $ProductEdit->productModel ?></span>
                    <span class="text-orange-600 ml-2">Price: <?php echo $ProductEdit->price?></span>
                    <span class="text-gray-500 line-through ml-2">Original Price: <?php echo $ProductEdit->originalPrice?></span>
                    <span class="text-gray-600 ml-2">Stock: <?php echo $ProductEdit->stock?></span>
                    <span class="text-gray-600 ml-2">Capacity: <?php echo $ProductEdit->capacity?></span>
                    <span class="text-gray-600 ml-2 ">Color: <?php echo $ProductEdit->color?></span>
                </div>
            </div>
    </div>
        
        <form action="?controller=AddQuantity&id=<?php echo $ProductEdit->productID?>" method="POST" class="grid  md:grid-cols-2 gap-4">
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="IdProduct"value="<?php echo $ProductEdit->productID?>">
            
            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700">Number of new products</label>
                <input required type="number" id="stock" min="1" name="stock" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" >
            </div>

            <div class="w-full h-16 mt-7">
                <button type="submit" class=" w-full bg-green-600 text-white font-bold py-2 px-4 rounded hover:bg-green-700">Add</button>
            </div>
        </form>
    </div>
</body>
</html>
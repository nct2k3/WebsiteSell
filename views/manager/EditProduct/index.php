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
    <h1 class="text-2xl font-bold mt-2 text-center ">Edit products</h1>
    
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
        <div class="grid  md:grid-cols-3 gap-4">
             <div>
                <label for="img" class="block text-sm font-medium text-gray-700">Image URL:

                </label>
                <form method="POST" action="?controller=EditProduct&id=<?php echo $ProductEdit->productID?>" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="uploadEdit">
                    <input type="file" name="file" id="file" class="w-36"  required>
                    <input type="submit" class="p-1 rounded w-36"  value="Uploads">
                </form>
                <?php if (isset($Url) && $Url != ''): ?>
                    <img class="h-16" src="<?php echo htmlspecialchars($Url); ?>" alt="Uploaded Image">
                <?php endif; ?>
            </div>
            <div>
                <label for="productLineId" class="block text-sm font-medium text-gray-700">Product Type</label>
                <input placeholder="<?php echo $ProductEdit->productType ?>" type="number" min="0" id="Price" name="Price" class="mt-1 block w-full p-2 border border-gray-300 rounded-md hover:bg-red-500" readonly> 
            </div>
        
            
            <div>
                <label for="productModel" class="block text-sm font-medium text-gray-700">Product Model</label>
                <input placeholder="<?php echo $ProductEdit->productModel ?>" type="number" min="0" id="Price" name="Price" class="mt-1 block w-full p-2 border border-gray-300 rounded-md hover:bg-red-500" readonly>    
            </div>
        </div>
        <form action="?controller=EditProduct" method="POST" class="grid  md:grid-cols-3 gap-4">
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="IdProduct"value="<?php echo $ProductEdit->productID?>">

            <div>
                <label for="productName" class="block text-sm font-medium text-gray-700">Product Name</label>
                <input placeholder="<?php echo $ProductEdit->productName ?>" type="text" id="productName" name="productName" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" >
            </div>

            <div>
                <label for="originalPrice" class="block text-sm font-medium text-gray-700">Original Price</label>
                <input placeholder="<?php echo $ProductEdit->originalPrice ?>" type="number" min="0" id="originalPrice" name="originalPrice" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" >
            </div>

            <div>
                <label for="Price" class="block text-sm font-medium text-gray-700">Price</label>
                <input placeholder="<?php echo $ProductEdit->price ?>" type="number" min="0" id="Price" name="Price" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" >
            </div>
            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                <input placeholder="<?php echo $ProductEdit->stock?>" type="number" id="stock" min="1" name="stock" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" >
            </div>

            <div>
                <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity</label>
                <input placeholder="<?php echo $ProductEdit->capacity ?>" type="text" id="capacity" name="capacity" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" >
            </div>

            <div>
                <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
                <div class="w-full">
                    <select id="color" name="color"  class="text-black border  mt-1 block w-full  p-2 rounded-md ">
                        <option value="" disabled selected>Color</option>
                        <option value="black">Black</option>
                        <option value="white">White</option>
                        <option value="red">Red</option>
                        <option value="blue">Blue</option>
                        <option value="green">Green</option>
                        <option value="yellow">Gold</option>
                        <option value="pink">Pink</option>
                    </select>
                </div>
            </div>
            <div class="w-full flex justify-end">
                <button type="submit" class=" w-full bg-green-600 text-white font-bold py-2 px-4 rounded hover:bg-green-700">Edit</button>
            </div>
            </form>

        
    </div>
</body>
</html>
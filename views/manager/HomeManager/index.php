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
<body class="bg-gray-100 ">
    <h1 class="text-2xl font-bold mt-2 text-center ">Nhập Thông Tin Sản Phẩm</h1>
    <div class="max-w-6xl mx-auto px-6 py-2 bg-white rounded-lg shadow-md mt-10">
        <div class="grid  md:grid-cols-3 gap-4">
             <div>
                <label for="img" class="block text-sm font-medium text-gray-700">Image URL:

                </label>
                <form method="POST" action="?controller=homeManager" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="upload">
                    <input type="file" name="file" id="file" class="w-36" required>
                    <input type="submit" class="p-1 rounded w-36"  value="Uploads">
                </form>
                <?php if (isset($Url) && $Url != ''): ?>
                    <img class="h-16" src="<?php echo htmlspecialchars($Url); ?>" alt="Uploaded Image">
                <?php endif; ?>
            </div>

            <div>
            <form method="POST" action="?controller=homeManager">
                <input type="hidden" name="action" value="chosenLine">
                    <label for="productLine" class="block text-sm font-medium text-gray-700">Product Line</label>
                    <div class="w-full">
                        <select id="productLine" name="productLine" required onchange="this.form.submit()" class="text-black border  mt-1 block w-full  p-2 rounded-md ">
                            <?php if (!empty($NameLine)): ?>
                                <option value="<?php echo $NameLine['ProductLineName']?>" disabled selected><?php echo $NameLine['ProductLineName']?></option>
                            <?php else: ?>
                                <option value="" disabled selected>Chọn Product Line</option>
                            <?php endif; ?>    
                            <?php foreach($dataLineProduct as $items): ?>
                            <option value="<?php echo $items->ProductLineID ?>"><?php echo $items->ProductLineName ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
            </form>
            </div>
        
            
            <div>
            <form method="POST" action="?controller=homeManager">
                <input type="hidden" name="action" value="chosenModel">
                    <label for="productModel" class="block text-sm font-medium text-gray-700">Product Model</label>
                    <div class="w-full">
                        <select id="productModel" name="productModel" required onchange="this.form.submit()" class="text-black border  mt-1 block w-full  p-2 rounded-md ">
                            <?php if (!empty($NameModel)): ?>
                                <option value="<?php echo $NameModel['ProductModelName']?>" disabled selected><?php echo $NameModel['ProductModelName']?></option>
                            <?php else: ?>
                                <option value="" disabled selected>Chọn Product Model</option>
                            <?php endif; ?> 
                            <?php if (!empty($dataModelProduct)): ?>
                                <?php foreach ($dataModelProduct as $items): ?>
                                    <option value="<?php echo htmlspecialchars($items->ProductModelID); ?>">
                                        <?php echo htmlspecialchars($items->ProductModelName); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="" disabled>Let chosen line</option>
                            <?php endif; ?>
                        </select>
                    </div>
            </form>
            </div>
        </div>
            <form action="?controller=homeManager" method="POST" class="grid  md:grid-cols-3 gap-4">
            <input type="hidden" name="action" value="add">
            <div>
                <label for="productLineId" class="block text-sm font-medium text-gray-700">Product Type</label>
                <div class="w-full">
                    <select id="productType" name="productType" required class="text-black border  mt-1 block w-full  p-2 rounded-md ">
                        <option value="" disabled selected>Product Type</option>
                        <?php if (!empty($dataTypeProduct)): ?>
                                <?php foreach ($dataTypeProduct as $items): ?>
                                    <option value="<?php echo htmlspecialchars($items->ProductTypeName); ?>">
                                        <?php echo htmlspecialchars($items->ProductTypeName); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="" disabled>Let chosen model</option>
                            <?php endif; ?>
                    </select>
                </div>
            </div>

            <div>
                <label for="productName" class="block text-sm font-medium text-gray-700">Product Name</label>
                <input type="text" id="productName" name="productName" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <div>
                <label for="originalPrice" class="block text-sm font-medium text-gray-700">Original Price</label>
                <input type="number" min="0" id="originalPrice" name="originalPrice" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <div>
                <label for="Price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" min="0" id="Price" name="Price" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>
            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                <input type="number" id="stock" min="1" name="stock" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <div>
                <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity</label>
                <input type="text" id="capacity" name="capacity" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <div>
                <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
                <div class="w-full">
                    <select id="color" name="color" required class="text-black border  mt-1 block w-full  p-2 rounded-md ">
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

            <div class="col-span-2 flex justify-end">
                <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">Thêm</button>
            </div>
            </form>

        
    </div>
</body>
</html>
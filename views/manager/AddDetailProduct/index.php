<?php
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
<body>
    <h1 class="text-2xl font-bold mt-2 text-center">Add New Model</h1>
    <div class="max-w-6xl mx-auto px-6 py-4 bg-white rounded-lg shadow-md mt-10">

            <form action="?controller=Adddetailproduct" method="POST" class="grid md:grid-clos-3 p-2">
                <input type="hidden" name="action" value="addModel">
                <div class="w-full p-2">
                    <label for="productModel" class="block text-sm font-medium text-gray-700">Product Line</label>
                    <select id="productModel" name="productModel" required class="text-black border mt-1 block w-full p-2 p-2 rounded-md">
                        <option value="" disabled selected>Product Line</option>
                            <?php foreach ($dataLineProduct as $items): ?>
                                <option value="<?php echo $items->ProductLineID  ?>">
                                    <?php echo $items->ProductLineName ?>
                                </option>
                            <?php endforeach; ?>
                    </select>
                </div>

                <div class="w-full p-2">
                    <label for="productModelName" class="block text-sm font-medium text-gray-700">Product Models Name</label>
                    <input type="text" id="productNameModel" name="productNameModel" class="mt-1 block w-full p-2 p-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="w-full p-2 flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 w-full p-2">Add</button>
                </div>
            </form>
       
    </div>


    <h1 class="text-2xl font-bold mt-2 text-center">Add New Type</h1>
    <div class="max-w-6xl mx-auto px-6 py-4 bg-white rounded-lg shadow-md mt-10">
        <div class="grid ">
        <div class="w-full p-2">
            <label for="img" class="block text-sm font-medium text-gray-700">Image URL:</label>
            <form method="POST" action="?controller=Adddetailproduct" enctype="multipart/form-data" class="mt-2">
                <input type="hidden" name="action" value="uploadType">
                <div class="relative">
                    <input  type="file" name="file[]" id="file" class="hidden" multiple required 
                        onchange="updateFileNames(this.files)">
                    <label for="file" class="cursor-pointer bg-gray-100 hover:bg-gray-200 text-gray-700 py-2 px-4 rounded-lg w-full inline-block">
                        <span id="file-name">Choose files</span>
                    </label>
                </div>
                <div class="w-full p-2">
                    <label for="productType" class="block text-sm font-medium text-gray-700">Product Type</label>
                    <select id="productType" name="productType" required class="text-black border mt-1 block w-full p-2 p-2 rounded-md">
                        <option value="" disabled selected>Product Type</option>
                  
                            <?php foreach ($dataModelProduct as $items): ?>
                                <option value="<?php echo htmlspecialchars($items->ProductModelID); ?>">
                                    <?php echo htmlspecialchars($items->ProductModelName); ?>
                                </option>
                            <?php endforeach; ?>
                       
                    </select>
                </div>

                <div class="w-full p-2">
                    <label for="productName" class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input type="text" id="productName" name="productName" class="mt-1 block w-full p-2 p-2 border border-gray-300 rounded-md" required>
                </div>
                <input type="submit" class="mt-2 p-1 rounded w-full p-2 bg-blue-600 text-white hover:bg-blue-700 cursor-pointer" value="Upload">
            </form>

            <script>
                function updateFileNames(files) {
                    const fileNames = Array.from(files).map(file => file.name).join(", ");
                    document.getElementById('file-name').textContent = fileNames || "Choose files";
                }
            </script>
        </div>
        </div>
    </div>
</body>
</html>
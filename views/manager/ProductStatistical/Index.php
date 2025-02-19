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
  <title>Responsive Chart</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="grid grid-cols-1 px-6 py-4 min-h-screen bg-gray-100">
        <div class="p-6 bg-white rounded-lg shadow-lg m-2 overflow-hidden">
            <h2 class="mb-4 text-xl font-bold text-gray-700"> Statistics quantity of products sold</h2>

            <div class="flex flex-col space-y-4">
                <div class="w-full flex justify-between">
                    <span class="text-sm text-gray-600 m-2">Products</span>
                    <div class="items-center space-x-2 mt-2">
                        Quantity of products sold/ Percentage of sold items
                    </div>
                </div>
            </div>
            

            <?php foreach ($data as $items): ?>
            <div class="flex flex-col space-y-4 p-2">
                <div class="w-full flex hover:bg-gray-200  rounded">
                    <div class="flex h-8" style="width: 30%;">
                        <img src="<?php echo $items['img'] ?>" class="h-8" alt="Product Image" />
                        <span class="text-sm text-gray-600 m-2"><?php echo $items['ProductName'] ?></span>
                    </div>
                    <div class="flex justify-between items-center space-x-2 " style="width: 70%;">
                    <div></div>    
                    <div class="h-8 bg-green-500 hover:bg-green-700 text-center text-white"
                             style="width: <?php echo $items['Percent'] ?>%;">
                            <?php echo $items['Quantity'] ?>/<?php echo number_format($items['Percent'], 2)?>%
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
       
        <div class="font-bold text-red-500 mt-2 w-full rounded flex justify-end border-b border-t ">Total revenue :   <?php echo   number_format($totalAmount, 0, ',', '.') . ' Đ'; ?></div>
        </div>
    </div>
</body>
</html>
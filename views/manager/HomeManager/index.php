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
    <title>Phone Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-8 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Phone Product List</h1>
        <div>
        <form method="POST" action="?controller=homeManager">
                <input type="hidden" name="action" value="chosenLine">
                    <label for="productLine" class="block text-sm font-medium text-gray-700">Product Line</label>
                    <div class="w-full">
                        <select id="productLine" name="productLine" required onchange="this.form.submit()" class="text-black border  mt-1 block w-full  p-2 rounded-md ">
                            <?php if (!empty($NameLine)): ?>
                                <option value="<?php echo $NameLine['ProductLineName']?>" disabled selected><?php echo $NameLine['ProductLineName']?></option>
                            <?php else: ?>
                                <option value="" disabled selected>Select product line</option>
                            <?php endif; ?>     
                            <?php foreach($dataLineProduct as $items): ?>
                            <option value="<?php echo $items->ProductLineID ?>"><?php echo $items->ProductLineName ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
            </form>
            <form action="?controller=homeManager" method="POST" class="space-y-4">
            <input type="hidden" name="action" value="search">
            <div class="flex">
                <input placeholder="Iphone 16, Macbook...." id="string" name="string" class="h-10 border  rounded-l-lg p-2 text-black w-full" type="text">
                <button class="bg-gray-500 h-10 w-16 rounded-r-lg hover:bg-gray-800">
                    <img class="h-10 p-2" src="https://img.icons8.com/?size=100&id=7695&format=png&color=ffffff" alt="Icon">
                </button>
            </div>
        </form>
        </div>

    <div class="space-y-4 mt-1">
        <?php foreach($data as $item) :?>
        <div class="flex items-start p-4 border border-gray-200 rounded-lg hover:shadow-lg transition-shadow">
            <img src="<?php echo $item->img ?>" alt="Product 1" class=" h-16 rounded-lg mr-4">
            <div class="flex">
                <div class="grid-3 md:grid-1">
                    <span class="text-lg font-semibold text-gray-800 ">Name: <?php echo $item->productName ?></span>
                    <span class="text-gray-600 ml-2">Product ID: <?php echo $item->productID?> </span>
                    <span class="text-orange-600 ml-2">Price: <?php echo $item->price?></span>
                    <span class="text-gray-500 line-through ml-2">Original Price: <?php echo $item->originalPrice?></span>
                    <span class="text-gray-600 ml-2">Capacity: <?php echo $item->capacity?></span>
                    <span class="text-gray-600 ml-2 ">Color: <?php echo $item->color?></span>
                </div>
                <div>
                    <div
                    onclick="window.location='/?controller=EditProduct&id=<?php echo $item->productID?>'"
                    class="text-center text-white rounded text-sm h-7 bg-blue-500 p-1 w-36 hover:bg-blue-400 m-2"> Edit </div>
                    
                </div>
            </div>
        </div>
        <?php endforeach ?>

    </div>

</div>

</body>
</html>
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
    <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Delete Product </h1>
        <div>
        <form method="POST" action="?controller=DeleteProduct">
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
            <form action="?controller=DeleteProduct" method="POST" class="space-y-4">
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
    <div class="grid grid-cols-2 gap-4">
        <?php foreach($data as $item) :?>
        <div class="  <?php if($item->Status==1) echo "opacity-50 bg-gray-300" ?> flex items-start p-4 border border-gray-200 rounded-lg hover:shadow-lg transition-shadow">
            <img src="<?php echo $item->img ?>" alt="Product 1" class="h-16 rounded-lg mr-4">
            <div class="flex flex-grow">
                <div class="flex-grow">
                    <span class="text-lg font-semibold text-gray-800 block">Name: <?php echo $item->productName ?></span>
                    <span>Mã sản phẩm: <?php echo $item->productID ?></span>
                    <span class="text-orange-600 block">Price: <?php echo $item->price?></span>
                    <span class="text-gray-500 line-through block">Original Price: <?php echo $item->originalPrice?></span>
                    <span class="text-gray-600 block">Stock: <?php echo $item->stock?></span>
                    <span class="text-gray-600 block">Capacity: <?php echo $item->capacity?></span>
                    <span class="text-gray-600 block">Color: <?php echo $item->color?></span>
                    <span>Trạng thái: 
                        <?php 
                        $NewStatus = "Đang bán";
                        $statusColor = "text-green-600";
                        if($item->Status == 1){
                            $NewStatus = "Tạm ẩn";
                            $statusColor = "text-red-600";
                        }
                        ?>
                        <span class="<?php echo $statusColor; ?> font-semibold">
                            <?php echo $NewStatus ?>
                        </span>
                    </span>
                </div>
                <div class="ml-4">
                    <form action="/?controller=DeleteProduct&action=deleteProduct" method="POST" onsubmit="return confirmDelete()">
                        <input type="hidden" name="id" value="<?php echo $item->productID; ?>">
                        <div class="text-center text-white rounded text-sm h-7 bg-red-500 p-1 w-36 hover:bg-red-400">
                            <button type="submit" class="w-full h-full bg-transparent border-none cursor-pointer">
                                Delete
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</div>

<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this product?');
    }
</script>
    <div class="flex justify-center p-4">
    <?php if(isset($numpage) && $numpage > 0): ?>
        <?php for($i = 1; $i <= $numpage; $i++): ?>
            <button
            onclick= "window.location.href = '?controller=DeleteProduct&page=<?php echo $i;?>'"
            class="h-12 w-12 p-4 rounded-xl bg-gray-100 m-2 flex items-center justify-center hover:bg-gray-200 border"><?php echo $i; ?></button>
        <?php endfor; ?>
    <?php endif; ?>


</div>

</body>
</html>
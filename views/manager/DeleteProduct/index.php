<?php
require_once './controllers/HeadermanagerController.php';
$controller = new HeadermanagerController();
$controller->index();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sản Phẩm Điện Thoại</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-8 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Xóa Sản Phẩm</h1>
        <div>
        <form method="POST" action="index.php?controller=DeleteProduct">
                <input type="hidden" name="action" value="chosenLine">
                    <label for="productLine" class="block text-sm font-medium text-gray-700">Dòng Sản Phẩm</label>
                    <div class="w-full">
                        <select id="productLine" name="productLine" required onchange="this.form.submit()" class="text-black border mt-1 block w-full p-2 rounded-md">
                            <?php if (!empty($NameLine)): ?>
                                <option value="<?php echo htmlspecialchars($NameLine['ProductLineName'])?>" disabled selected><?php echo htmlspecialchars($NameLine['ProductLineName'])?></option>
                            <?php else: ?>
                                <option value="" disabled selected>Chọn dòng sản phẩm</option>
                            <?php endif; ?>     
                            <?php foreach($dataLineProduct as $items): ?>
                            <option value="<?php echo htmlspecialchars($items->ProductLineID) ?>"><?php echo htmlspecialchars($items->ProductLineName) ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
            </form>
            <form action="index.php?controller=DeleteProduct" method="POST" class="space-y-4">
            <input type="hidden" name="action" value="search">
            <div class="flex">
                <input placeholder="Iphone 16, Macbook...." id="string" name="string" class="h-10 border rounded-l-lg p-2 text-black w-full" type="text">
                <button type="submit" class="bg-gray-500 h-10 w-16 rounded-r-lg hover:bg-gray-800">
                    <img class="h-10 p-2" src="https://img.icons8.com/?size=100&id=7695&format=png&color=ffffff" alt="Search">
                </button>
            </div>
        </form>
        </div>

<div class="space-y-4 mt-1">
    <div class="grid grid-cols-2 gap-4">
        <?php if(isset($data) && !empty($data)): ?>
            <?php foreach($data as $item) :?>
            <div class="<?php echo ($item->Status==1) ? 'opacity-50 bg-gray-300' : ''; ?> flex items-start p-4 border border-gray-200 rounded-lg hover:shadow-lg transition-shadow">
                <img src="<?php echo htmlspecialchars($item->img) ?>" alt="Product Image" class="h-16 rounded-lg mr-4">
                <div class="flex flex-grow">
                    <div class="flex-grow">
                        <span class="text-lg font-semibold text-gray-800 block">Tên: <?php echo htmlspecialchars($item->productName) ?></span>
                        <span>Mã sản phẩm: <?php echo htmlspecialchars($item->productID) ?></span>
                        <span class="text-orange-600 block">Giá: <?php echo number_format($item->price, 0, ',', '.') ?> đ</span>
                        <span class="text-gray-500 line-through block">Giá gốc: <?php echo number_format($item->originalPrice, 0, ',', '.') ?> đ</span>
                        <span class="text-gray-600 block">Tồn kho: <?php echo htmlspecialchars($item->stock) ?></span>
                        <span class="text-gray-600 block">Dung lượng: <?php echo htmlspecialchars($item->capacity) ?></span>
                        <span class="text-gray-600 block">Màu sắc: <?php echo htmlspecialchars($item->color) ?></span>
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
                        <form action="index.php?controller=DeleteProduct&action=deleteProduct" method="POST" onsubmit="return confirmDelete()">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($item->productID); ?>">
                            <div class="text-center text-white rounded text-sm h-7 bg-red-500 p-1 w-36 hover:bg-red-400">
                                <button type="submit" class="w-full h-full bg-transparent border-none cursor-pointer">
                                    Xóa
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        <?php else: ?>
            <div class="col-span-2 text-center text-gray-500">Không tìm thấy sản phẩm nào</div>
        <?php endif; ?>
    </div>
</div>

<script>
    function confirmDelete() {
        return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');
    }
</script>
    <div class="flex justify-center p-4">
    <?php if(isset($numpage) && $numpage > 0): ?>
        <?php for($i = 1; $i <= $numpage; $i++): ?>
            <a href="index.php?controller=DeleteProduct&page=<?php echo $i;?>" 
               class="h-12 w-12 p-4 rounded-xl bg-gray-100 m-2 flex items-center justify-center hover:bg-gray-200 border">
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>
    <?php endif; ?>
</div>

</body>
</html>
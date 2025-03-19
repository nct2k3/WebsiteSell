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
  <title>Biểu Đồ Tương Thích</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="grid grid-cols-1 px-6 py-4 min-h-screen bg-gray-100">
        <div class="p-6 bg-white rounded-lg shadow-lg m-2 overflow-hidden">
            <h2 class="mb-4 text-xl font-bold text-gray-700">Lịch sử mua hàng</h2>

            <div class="flex flex-col space-y-4">
                    <span class="w-full text-xl font-bold text-center text-gray-600 m-2">Sản phẩm đã bán</span>
            </div>
            <div class="p-2 ml-1 w-full flex justify-end"> 
                <button id="filterButton" class="btn btn-primary">Lọc</button>
            </div>
            <div id="dateFilter" class="p-2 ml-1 w-full flex justify-end hidden">
                    <form action="/?controller=PurchasePayment" method="POST" class="space-y-4">
                    <input type="hidden" name="action" value="DateFillter"> 
                        <input required id="date" name="date" type="date">
                        <button type="submit" class="bg-blue-500 text-white p-1 rounded-lg text-sm">Lọc</button>
                    </form>
            </div>
            <div id="yearFilter" class="p-2 ml-1 w-full flex justify-end hidden">
                <form action="/?controller=PurchasePayment" method="POST" class="">
                    <input type="hidden" name="action" value="YearFillter">
                    <strong>Tháng:</strong>
                    <input type="number" id="month" name="month" class="year-input" min="1" max="12" placeholder="tháng" required>
                    <strong>Năm:</strong>
                    <input type="number" id="year" name="year" class="year-input" min="2024" max="2100" placeholder="năm" required>
                    <button type="submit" class="bg-blue-500 h-8 text-white p-1 rounded-lg">Lọc</button>
                </form>
            </div>

            <?php foreach ($data as $items): ?>
            <div class="flex flex-col space-y-4 p-2">
                <div class="w-full flex flex-wrap hover:bg-gray-200 rounded">
                    <div class="mx-4 w-24">Mã: <?php echo $items['ProductID'] ?></div>
                    <div class="flex h-8" style="width: 40%;">
                        <img src="<?php echo $items['img'] ?>" class="h-8" alt="Ảnh sản phẩm" />
                        <span class="text-sm text-gray-600 m-2"><?php echo $items['ProductName'] ?></span>
                    </div>
                    <div class="mx-4">Ngày: <?php echo $items['time'] ?></div>
                    <div class=mx-4>Số lượng: <?php echo $items['Quantity'] ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
<script>
    document.getElementById('filterButton').addEventListener('click', function() {
        document.getElementById('dateFilter').classList.toggle('hidden');
        document.getElementById('yearFilter').classList.toggle('hidden');
    });
</script>
</html>
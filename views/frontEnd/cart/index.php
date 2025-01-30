<?php
require_once './controllers/HeaderController.php';
$controller = new HeaderController();
$controller->index();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng của bạn</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-700">

<div class="container mx-auto bg-gray-700 py-4">
    <h1 class="text-3xl font-bold text-center text-white">Giỏ hàng của bạn</h1>

    <div class="bg-gray-600 shadow-md rounded px-10 pt-6 pb-8 my-4 mx-20">
        <table class="table-auto w-full text-white">
            <thead>
                <tr>
                    <th class="text-left">Sản phẩm</th>
                    <th class="text-left">Ảnh</th>
                    <th class="text-left">Giá</th>
                    <th class="text-left">Số lượng</th>
                    <th class="text-left">Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $item): ?>
                    <tr class="hover:bg-gray-500 "> <!-- Thêm lớp hover -->
                        <td class="py-2 px-2 "><?php echo htmlspecialchars($item->productName); ?></td>
                        <td class="py-2"><img class="h-12" src="<?php echo htmlspecialchars($item->img); ?>" alt="<?php echo htmlspecialchars($item->productName); ?>"></td>
                        <td class="py-2"><?php echo htmlspecialchars(number_format($item->price, 0, ',', '.')) . '₫'; ?></td>
                        <td class="py-2">
                            <span class="py-2 px-1">1</span>
                        </td>
                        <td class="py-2">
                            <a href="#" class="text-red-500"
                            onclick="window.location='?controller=cart&action=Delete&user=<?php echo $userID; ?>&product=<?php echo $item->productID?>'"
                            >Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <p class="text-right mt-4 text-white"><strong>Tổng tiền:</strong> <?php echo htmlspecialchars(number_format($total, 0, ',', '.')) . '₫'; ?></p>
    </div>
</div>

</body>
</html>
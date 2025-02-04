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

<div class="container mx-auto bg-gray-700 py-4 px-2 sm:px-10">
    <h1 class="text-3xl font-bold text-center text-white">Your Cart</h1>

    <div class="bg-gray-600 shadow-md rounded px-4 pt-6 pb-8 my-4">
        <div class="overflow-x-auto">
            <table class="table-auto w-full text-white text-sm sm:text-base">
                <thead>
                    <tr class="border-b border-gray-500">
                        <th class="text-left px-2 py-1">Product</th>
                        <th class="text-left px-2 py-1">Picture</th>
                        <th class="text-left px-2 py-1">Price</th>
                        <th class="text-left px-2 py-1">Quantity</th>
                        <th class="text-left px-2 py-1">Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($products as $item): ?>
                            <tr class="hover:bg-gray-500 border-b border-gray-500">
                                <td class="py-2 px-2 break-words"><?php echo htmlspecialchars($item['item']->productName); ?></td>
                                <td class="py-2 px-2">
                                    <img class="h-12 w-12 sm:h-16 sm:w-16 object-cover" src="<?php echo htmlspecialchars($item['item']->img); ?>" alt="<?php echo htmlspecialchars($item['item']->productName); ?>">
                                </td>
                                <td class="py-2 px-2"><?php echo htmlspecialchars(number_format($item['price'], 0, ',', '.')) . '₫'; ?></td>
                                <td class="py-2 px-2">
                                    <input 
                                        type="number" 
                                        class="quantity-input w-16 text-center border rounded bg-gray-800" 
                                        value="<?php echo $item['quantity']; ?>" 
                                        min="1" max="<?php $item['item']->stock; ?>?>"
                                        data-product-id="<?php echo $item['item']->productID; ?>" />
                                </td>
                                <td class="py-2 px-2">
                                    <a href="#" class="text-red-500 hover:text-red-600"
                                       onclick="window.location='?controller=cart&action=Delete&user=<?php echo $userID; ?>&product=<?php echo $item['item']->productID; ?>'">Delete</a>
                                </td>
                               
                            </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div onclick="window.location='?controller=payment'"
        class="flex justify-end items-center mt-4 text-white bg-gray-500 p-2 rounded hover:bg-green-300">
            <p><strong>Buy All Total:</strong> <?php echo htmlspecialchars(number_format($total, 0, ',', '.')) . '₫'; ?></p>
        </div>
    </div>
</div>
<script>
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function () {
            const productId = this.dataset.productId;
            const newQuantity = this.value;
            const url = new URL(window.location.href);
            url.searchParams.set('action', 'ChangeQuantity'); 
            url.searchParams.set('quantity', newQuantity);
            url.searchParams.set('product', productId);
            window.location.href = url.toString();
        });
    });
</script>

</body>
</html>


<?Php
require_once './controllers/HeaderController.php';
$controller = new HeaderController();
$controller->index();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Payment Page</title>
</head>
<body class="bg-gray-700 text-white">

<div class="container mx-auto p-8">
    <h1 class="text-2xl font-bold mb-6 text-center">Payment for Product</h1>

    <div class="bg-gray-600 p-6 rounded-lg shadow-md">
        
        <h2 class="text-xl font-semibold mb-4">Payment Details</h2>
        <form action="?controller=payment" method="POST">
            <input type="hidden" name="action" value="<?php echo $dataAction ?>">
            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-100">Shipping Address</label>
                <input type="text" id="address" name="address"   class="mt-1 block w-full text-black  p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200" placeholder="<?php echo $dataUser->Address ?>">
            </div>
            <div class="mb-4">
                <label for="PhomeNumber" class="block text-sm font-medium text-gray-100">Phone Number</label>
                <input type="number" id="PhoneNumber" name="PhoneNumber"   class="mt-1 block w-full text-black  p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200" placeholder="<?php echo $dataUser->PhoneNumber ?>">
            </div>
            <div class="mb-4">
                <label for="PhomeNumber" class="block text-sm font-medium text-gray-100">Delivery date</label>
                <input
                required
                type="date" id="DateDelivery" name="DateDelivery"
                    class="mt-1 block w-full text-black p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200"
                    placeholder="<?php echo $dataUser->PhoneNumber ?>" 
                    min="<?php echo date('Y-m-d', strtotime('+5 days')); ?>">
            </div>
            <div class="mb-4">
                <label for="Note" class="block text-sm font-medium text-gray-100">Note</label>
                <input type="text" id="Note" name="Note"   class="mt-1 block w-full text-black  p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200" placeholder="Note....">
            </div>

            <div class="mb-4">
                    <label for="LoyaltyPoints" class="block text-sm font-medium text-gray-100">Loyalty Points Max: <?php echo  number_format($dataUser->LoyaltyPoints, 0, ',', '.') . '₫';?></label>
                    <input type="number" id="LoyaltyPoints" name="LoyaltyPoints" class="mt-1 block w-full text-black  p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200" placeholder="Enter the number of points you want to use" min="0" max="<?php echo $dataUser->LoyaltyPoints?>">
                </div>
            <div class="mb-4">
                <label for="paymentType" class="block text-sm font-medium text-gray-100">Payment Type</label>
                <select id="paymentType" name="paymentType" required class=" text-gray-500 mt-1 block w-full text-black  p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200">
                    <option value="" disabled selected>Select payment method</option>
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">Payment upon receipt</option>
                </select>
            </div>
            <div id="creditCardFields" class="hidden">
                <div class="mb-4">
                    <label for="cardName" class="block text-sm font-medium text-gray-100">Name on Card</label>
                    <input type="text" id="cardName" name="cardName"  class="mt-1 block w-full text-black  p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200" placeholder="John Doe">
                </div>
                <div class="mb-4">
                    <label for="cardNumber" class="block text-sm font-medium text-gray-100">Number Phone</label>
                    <input type="text" id="cardNumber" name="cardNumber"  class="mt-1 block w-full text-black  p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200" placeholder="1234 5678 9012 3456">
                </div>

                <div class="flex mb-4">
                    <div class="w-1/2 pr-2">
                        <label for="expiry" class="block text-sm font-medium text-gray-100">Expiry Date</label>
                        <input type="text" id="expiry" name="expiry"  class="mt-1 block w-full text-black  p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200" placeholder="MM/YY">
                    </div>
                    <div class="w-1/2 pl-2">
                        <label for="cvv" class="block text-sm font-medium text-gray-100">CVV</label>
                        <input type="text" id="cvv" name="cvv"  class="mt-1 block w-full text-black  p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200" placeholder="123">
                    </div>
                </div>
            </div>
            <h2 class="text-xl font-semibold mb-4">Product Summary</h2>
        
        <!-- Product Image -->
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
                                    <?php if($dataAction=='payOne') echo 'readonly' ?>
                                        type="number" 
                                        class="quantity-input w-16 text-center border rounded bg-gray-700" 
                                        value="<?php echo $item['quantity']; ?>" 
                                        min="1"
                                        data-product-id="<?php echo $item['item']->productID; ?>" />
                                </td>
                                <td class="py-2 px-2">
                                    <?php if($dataAction == 'payOne'): ?>
                                        <span class="text-gray-500">Delete</span> <!-- Hiển thị dưới dạng văn bản không có liên kết -->
                                    <?php else: ?>
                                        <a href="#" class="text-red-500 hover:text-red-600"
                                        onclick="window.location='?controller=payment&action=Delete&user=<?php echo $userID; ?>&product=<?php echo $item['item']->productID; ?>'">Delete</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="flex justify-end items-center mt-2 text-white text-sm ">
                <p><strong>Cumulative points:</strong> <?php echo htmlspecialchars(number_format($total/100, 0, ',', '.')) . '₫'; ?></p>
            </div>
            <div class="flex justify-end items-center mt-2 text-white ">
                <p><strong>Total:</strong> <?php echo htmlspecialchars(number_format($total, 0, ',', '.')) . '₫'; ?></p>
            </div>
        </div>

            <button type="submit" class="w-full bg-indigo-600 text-white p-2 rounded-md button-animation hover:bg-indigo-700">Pay Now</button>
        </form>
    </div>
    
</div>

<script>
    document.getElementById('paymentType').addEventListener('change', function() {
        const creditCardFields = document.getElementById('creditCardFields');
        if (this.value === 'credit_card') {
            creditCardFields.classList.remove('hidden'); 
        } else {
            creditCardFields.classList.add('hidden'); 
        }
    });

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

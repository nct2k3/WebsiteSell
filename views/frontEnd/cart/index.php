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
    <title>Giỏ Hàng Của Bạn</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        }
        /* Custom scrollbar for dark mode */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #1f2937;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb {
            background: #4b5563;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #6b7280;
        }
        .cart-container {
            display: grid;
            grid-template-rows: auto 1fr;
            min-height: 500px;
        }
        .cart-list {
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #4b5563 #1f2937;
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen">
<div class="container mx-auto p-4 md:p-5">
    <!-- Header Section -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-blue-400">Giỏ Hàng Của Bạn</h1>
        <p class="text-gray-400">Xem và quản lý các sản phẩm bạn đã chọn</p>
    </div>

    <!-- Cart Container -->
    <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden cart-container">
        <div class="gradient-bg text-white py-4 px-6 flex justify-between items-center">
            <h2 class="text-xl font-bold flex items-center">
                <i class="fas fa-shopping-cart mr-2"></i>Sản Phẩm Đã Chọn
            </h2>
            <span class="text-sm bg-blue-900 rounded-full px-3 py-1">
                <?php echo count($products); ?> sản phẩm
            </span>
        </div>
        
        <div class="p-4 space-y-4 cart-list">
            <?php if (empty($products)): ?>
                <div class="text-center py-16 text-gray-400">
                    <i class="fas fa-shopping-cart text-5xl mb-4"></i>
                    <p class="text-xl">Giỏ hàng của bạn đang trống</p>
                    <a href="?controller=product" class="mt-4 inline-block px-6 py-3 bg-blue-700 text-white rounded-lg font-medium">
                        <i class="fas fa-store mr-2"></i>Tiếp tục mua sắm
                    </a>
                </div>
            <?php else: ?>
                <?php foreach ($products as $item): ?>
                    <div class="bg-gray-700 rounded-lg overflow-hidden shadow-md">
                        <div class="p-4">
                            <div class="flex flex-col sm:flex-row gap-4 items-center">
                                <!-- Product Image -->
                                <div class="w-24 h-24 flex-shrink-0 rounded-lg overflow-hidden">
                                    <img class="w-full h-full object-cover" 
                                         src="<?php echo htmlspecialchars($item['item']->img); ?>" 
                                         alt="<?php echo htmlspecialchars($item['item']->productName); ?>">
                                </div>
                                
                                <!-- Product Info -->
                                <div class="flex-grow space-y-2">
                                    <h3 class="font-bold text-blue-300 text-lg"><?php echo htmlspecialchars($item['item']->productName); ?></h3>
                                </div>
                                
                                <!-- Controls -->
                                <div class="flex items-center space-x-4">
                                    <!-- Quantity Controls -->
                                    <div class="flex items-center">
                                        <button class="w-8 h-8 bg-gray-600 rounded-l-lg text-white flex items-center justify-center quantity-decrease"
                                                data-product-id="<?php echo $item['item']->productID; ?>">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" 
                                               class="quantity-input w-12 h-8 text-center border-0 bg-gray-800 text-white" 
                                               value="<?php echo $item['quantity']; ?>" 
                                               min="1"
                                               data-product-id="<?php echo $item['item']->productID; ?>"
                                               readonly>
                                        <button class="w-8 h-8 bg-gray-600 rounded-r-lg text-white flex items-center justify-center quantity-increase"
                                                data-product-id="<?php echo $item['item']->productID; ?>">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    
                                    <!-- Total for this item -->
                                    <div class="text-lg font-medium text-gray-200" data-unit-price="<?php echo $item['price']; ?>">
                                        <?php echo htmlspecialchars(number_format($item['price'], 0, ',', '.')) . '₫'; ?>
                                    </div>
                                    
                                    <!-- Delete Button -->
                                    <a href="?controller=cart&action=Delete&user=<?php echo $userID; ?>&product=<?php echo $item['item']->productID; ?>" 
                                       class="w-8 h-8 bg-red-700 rounded-lg text-white flex items-center justify-center hover:bg-red-800 transition-colors">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                
                <!-- Summary Section -->
                <div class="mt-6 bg-gray-700 rounded-lg p-4 shadow-lg">
                    <div class="flex flex-col md:flex-row justify-between gap-4">
                        <div class="space-y-4">
                            <h3 class="text-xl font-bold text-blue-400">Tóm Tắt Đơn Hàng</h3>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Tổng số sản phẩm:</span>
                                    <span class="font-medium text-gray-200"><?php echo count($products); ?></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Tổng số lượng:</span>
                                    <span class="font-medium text-gray-200">
                                        <?php 
                                            $totalQuantity = 0;
                                            foreach ($products as $item) {
                                                $totalQuantity += $item['quantity'];
                                            }
                                            echo $totalQuantity;
                                        ?>
                                    </span>
                                </div>
                                <div class="flex justify-between font-bold text-xl">
                                    <span class="text-blue-300 mr-2">Tổng tiền: </span>
                                    <span class="text-green-300"> <?php echo htmlspecialchars( number_format($total, 0, ',', '.')) . '₫'; ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex flex-col justify-end">
                            <a href="?controller=payment" 
                               class="px-6 py-3 bg-blue-700 text-white rounded-lg font-bold text-center hover:bg-blue-800 transition-colors">
                                <i class="fas fa-credit-card mr-2"></i>Tiến Hành Thanh Toán
                            </a>
                            <a href="?controller=product" 
                               class="mt-3 px-6 py-3 bg-gray-600 text-white rounded-lg font-medium text-center hover:bg-gray-700 transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i>Tiếp Tục Mua Sắm
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    // Event listeners for quantity buttons
    document.querySelectorAll('.quantity-increase').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const inputField = document.querySelector(`.quantity-input[data-product-id="${productId}"]`);
            
            let newQuantity = parseInt(inputField.value) + 1;
            inputField.value = newQuantity;
            
            updateQuantity(productId, newQuantity);
        });
    });
    
    document.querySelectorAll('.quantity-decrease').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const inputField = document.querySelector(`.quantity-input[data-product-id="${productId}"]`);
            
            let newQuantity = parseInt(inputField.value) - 1;
            if (newQuantity < 1) newQuantity = 1;
            
            inputField.value = newQuantity;
            
            updateQuantity(productId, newQuantity);
        });
    });
    
    // Direct input handling
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            const productId = this.dataset.productId;
            let newQuantity = parseInt(this.value);
            if (isNaN(newQuantity) || newQuantity < 1) newQuantity = 1;
            
            this.value = newQuantity;
            updateQuantity(productId, newQuantity);
        });
    });
    
    // Function to update quantity - with a debounce to prevent rapid changes
    let updateTimer;
    function updateQuantity(productId, newQuantity) {
        clearTimeout(updateTimer);
        
        // Update display immediately but don't reload yet
        const priceElement = document.querySelector(`.quantity-input[data-product-id="${productId}"]`)
            .closest('.flex')
            .querySelector('.text-green-300');
        
        if (priceElement) {
            // Get the original price per item (strip out all non-numeric characters)
            const priceDisplay = document.querySelector(`.quantity-input[data-product-id="${productId}"]`)
                .closest('.flex')
                .parentElement
                .querySelector('.text-gray-200');
                
            // Extract the numeric value from the price display (removing dots and ₫)
            const priceText = priceDisplay.innerText.replace(/\./g, '').replace('₫', '');
            const itemPrice = parseInt(priceText, 10);
            
            // Calculate the new total
            const newTotal = itemPrice * newQuantity;
            
            // Format with dots as thousand separators (Vietnamese format)
            const formattedTotal = newTotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '₫';
            priceElement.innerText = formattedTotal;
        }
        
        // Debounce the actual navigation to prevent too many reloads
        updateTimer = setTimeout(function() {
            const url = new URL(window.location.href);
            url.searchParams.set('action', 'ChangeQuantity'); 
            url.searchParams.set('quantity', newQuantity);
            url.searchParams.set('product', productId);
            window.location.href = url.toString();
        }, 800); // 800ms delay before performing the actual update
    }
</script>

<?php
require_once './views/footer.php';
?>
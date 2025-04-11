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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Payment Page</title>
    <style>
        .card-header-gradient {
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
        
        .form-control:focus {
            border-color: #f97316;
            box-shadow: 0 0 0 0.2rem rgba(249, 115, 22, 0.25);
        }
        
        .table-row-hover:hover {
            background-color: #374151;
            transition: background-color 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen">
    <!-- Header with Logo - Matching the product page style -->
    <div class="text-center bg-gray-900 py-3 mb-6">
        <div class="flex w-full justify-center p-2">
            <img class="h-10" src="https://img.icons8.com/?size=100&id=30840&format=png&color=ffffff" alt="Logo">
            <div class="text-3xl font-bold text-orange-500">Thanh Toán</div>
        </div>
        <p class="text-gray-400 mt-2">Xác nhận thông tin đơn hàng của bạn</p>
    </div>

    <div class="container mx-auto px-4 pb-8">
        <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="card-header-gradient text-white py-3 px-4">
                <h2 class="text-xl font-bold flex items-center">
                    <i class="fas fa-shopping-cart mr-2"></i>Đơn hàng của bạn
                </h2>
            </div>
            
            <div class="p-6">
                <form action="?controller=payment" method="POST">
                    <input type="hidden" name="action" value="<?php echo $dataAction ?>">
                    
                    <!-- Thông tin giao hàng -->
                    <div class="bg-gray-800 rounded-lg mb-6">
                        <h3 class="text-lg font-semibold mb-4 text-blue-400 flex items-center">
                            <i class="fas fa-map-marker-alt mr-2"></i>Thông tin giao hàng
                        </h3>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Left Column -->
                            <div class="space-y-4">
                                <div class="space-y-2">
                                    <label for="province" class="block text-sm font-medium text-gray-300 flex items-center">
                                        <i class="fas fa-city text-orange-500 mr-2"></i>Tỉnh/Thành phố
                                    </label>
                                    <div class="flex items-center bg-gray-700 rounded-lg px-3 py-2">
                                        <select id="province" name="province" onchange="loadDistricts(this.value)" 
                                            class="w-full bg-transparent border-0 focus:outline-none text-gray-100">
                                            <option value="" disabled selected>Chọn tỉnh/thành phố</option>
                                            <?php foreach ($provinceList as $province): ?>
                                                <option value="<?php echo $province->code; ?>"><?php echo $province->name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="space-y-2">
                                    <label for="district" class="block text-sm font-medium text-gray-300 flex items-center">
                                        <i class="fas fa-map text-orange-500 mr-2"></i>Quận/Huyện
                                    </label>
                                    <div class="flex items-center bg-gray-700 rounded-lg px-3 py-2">
                                        <select id="district" name="district" 
                                            class="w-full bg-transparent border-0 focus:outline-none text-gray-100">
                                            <option value="" disabled selected>Chọn quận/huyện</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="space-y-2">
                                    <label for="address" class="block text-sm font-medium text-gray-300 flex items-center">
                                        <i class="fas fa-home text-orange-500 mr-2"></i>Số nhà/ tên đường
                                    </label>
                                    <div class="flex items-center bg-gray-700 rounded-lg px-3 py-2">
                                        <input type="text" id="address" name="address" 
                                            class="w-full bg-transparent border-0 focus:outline-none text-gray-100" 
                                            placeholder="<?php echo $dataUser->Address ?>">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Right Column -->
                            <div class="space-y-4">
                                <div class="space-y-2">
                                    <label for="PhoneNumber" class="block text-sm font-medium text-gray-300 flex items-center">
                                        <i class="fas fa-phone text-orange-500 mr-2"></i>Số điện thoại
                                    </label>
                                    <div class="flex items-center bg-gray-700 rounded-lg px-3 py-2">
                                        <input type="number" id="PhoneNumber" name="PhoneNumber" 
                                            class="w-full bg-transparent border-0 focus:outline-none text-gray-100" 
                                            placeholder="<?php echo $dataUser->PhoneNumber ?>">
                                    </div>
                                </div>
                                
                                <div class="space-y-2">
                                    <label for="DateDelivery" class="block text-sm font-medium text-gray-300 flex items-center">
                                        <i class="fas fa-calendar-alt text-orange-500 mr-2"></i>Ngày giao hàng mong muốn
                                    </label>
                                    <div class="flex items-center bg-gray-700 rounded-lg px-3 py-2">
                                        <input type="date" id="DateDelivery" name="DateDelivery" 
                                            class="w-full bg-transparent border-0 focus:outline-none text-gray-100" 
                                            min="<?php echo date('Y-m-d', strtotime('+5 days')); ?>">
                                    </div>
                                </div>
                                
                                <div class="space-y-2">
                                    <label for="Note" class="block text-sm font-medium text-gray-300 flex items-center">
                                        <i class="fas fa-sticky-note text-orange-500 mr-2"></i>Ghi chú
                                    </label>
                                    <div class="flex items-center bg-gray-700 rounded-lg px-3 py-2">
                                        <input type="text" id="Note" name="Note" 
                                            class="w-full bg-transparent border-0 focus:outline-none text-gray-100" 
                                            placeholder="Ghi chú...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Loyalty Points -->
                        <div class="mt-6 bg-gray-700 p-4 rounded-lg">
                            <div class="space-y-2">
                                <label for="LoyaltyPoints" class="block text-sm font-medium flex items-center">
                                    <i class="fas fa-star text-yellow-300 mr-2"></i>
                                    <span>Số điểm tích được của bạn: <span class="text-orange-500 font-semibold"><?php echo number_format($dataUser->LoyaltyPoints, 0, ',', '.') . '₫';?></span></span>
                                </label>
                                <div class="flex items-center bg-gray-600 rounded-lg px-3 py-2">
                                    <input type="number" id="LoyaltyPoints" name="LoyaltyPoints" 
                                        class="w-full bg-transparent border-0 focus:outline-none text-gray-100" 
                                        placeholder="Nhập số điểm thưởng bạn muốn dùng" min="0" max="<?php echo $dataUser->LoyaltyPoints?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Danh sách sản phẩm -->
                    <div class="bg-gray-800 rounded-lg mb-6">
                        <h3 class="text-lg font-semibold mb-4 text-blue-400 flex items-center">
                            <i class="fas fa-shopping-basket mr-2"></i>Danh sách sản phẩm mua
                        </h3>
                        
                        <div class="bg-gray-700 rounded-lg overflow-hidden shadow-md">
                            <div class="overflow-x-auto">
                                <table class="w-full text-gray-100">
                                    <thead class="bg-gray-800">
                                        <tr>
                                            <th class="text-left px-4 py-3">Tên sản phẩm</th>
                                            <th class="text-left px-4 py-3">Hình ảnh</th>
                                            <th class="text-left px-4 py-3">Giá</th>
                                            <th class="text-left px-4 py-3">Số lượng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($products as $item): ?>
                                            <tr class="table-row-hover border-t border-gray-600">
                                                <td class="py-3 px-4 break-words"><?php echo htmlspecialchars($item['item']->productName); ?></td>
                                                <td class="py-3 px-4">
                                                    <img class="h-16 w-16 object-contain rounded-lg" src="<?php echo htmlspecialchars($item['item']->img); ?>" alt="<?php echo htmlspecialchars($item['item']->productName); ?>">
                                                </td>
                                                <td class="py-3 px-4 text-orange-500 font-semibold"><?php echo htmlspecialchars(number_format($item['price'], 0, ',', '.')) . '₫'; ?></td>
                                                <td class="py-3 px-4">
                                                    <input 
                                                        readonly
                                                        type="number" 
                                                        class="bg-gray-600 text-center border border-gray-500 rounded-lg py-1 px-2 w-16" 
                                                        value="<?php echo $item['quantity']; ?>" 
                                                        min="1"
                                                        data-product-id="<?php echo $item['item']->productID; ?>" />
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Order Summary -->
                            <div class="bg-gray-800 p-4 border-t border-gray-600">
                                <div class="flex justify-between items-center mb-2 text-gray-300">
                                    <span class="flex items-center"><i class="fas fa-award text-yellow-300 mr-2"></i>Số điểm bạn được tích khi mua:</span>
                                    <span class="font-semibold text-yellow-300"><?php echo htmlspecialchars(number_format($total/100, 0, ',', '.')) . '₫'; ?></span>
                                </div>
                                <div class="flex justify-between items-center text-gray-100">
                                    <span class="flex items-center font-bold"><i class="fas fa-money-bill-wave text-green-400 mr-2"></i>Đơn giá cuối:</span>
                                    <span class="text-xl font-bold text-orange-500"><?php echo htmlspecialchars(number_format($total, 0, ',', '.')) . '₫'; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" class="w-full text-white py-3 px-4 rounded-lg font-bold flex items-center justify-center transition duration-300" style="background-color: #0c4a6e; border: none;">
                        <i class="fas fa-check-circle mr-2"></i>Xác nhận đặt hàng
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('paymentType').addEventListener('change', function() {
            const creditCardFields = document.getElementById('creditCardFields');
            if (this.value == 3) {
                creditCardFields.classList.remove('hidden'); 
            } else {
                creditCardFields.classList.add('hidden'); 
            }
        });

        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('change', function () {
                console.log("Quantity changed:", this.value, this.dataset.productId);
                const productId = this.dataset.productId;
                const newQuantity = this.value;
                const url = new URL(window.location.href);
                url.searchParams.set('action', 'ChangeQuantity');
                url.searchParams.set('quantity', newQuantity);
                url.searchParams.set('product', productId);
                console.log("Redirecting to:", url.toString());
                window.location.href = url.toString();
            });
        });
        
        function loadDistricts(provinceCode) {
            if (!provinceCode) return;
            
            fetch(`?controller=payment&action=getDistricts&province=${provinceCode}`)
                .then(response => response.json())
                .then(districts => {
                    const districtSelect = document.getElementById('district');
                    districtSelect.innerHTML = '<option value="" disabled selected>Chọn quận/huyện</option>';
                    
                    districts.forEach(district => {
                        const option = document.createElement('option');
                        option.value = district.code;
                        option.textContent = district.name;
                        districtSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error loading districts:', error));
        }
    </script>
</body>
</html>
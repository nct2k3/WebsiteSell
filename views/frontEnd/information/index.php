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
    <title>Thông Tin Đơn Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        function loadDistricts() {
            const provinceCode = document.getElementById("ProvinceCode").value;
            const districtSelect = document.getElementById("DistrictCode");

            districtSelect.innerHTML = '<option value="">Chọn huyện</option>';

            if (provinceCode) {
                fetch(`?controller=information&action=getDistricts&province=${provinceCode}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(district => {
                            const option = document.createElement("option");
                            option.value = district.code;
                            option.textContent = district.name;
                            if (district.name === '<?php echo $districtName; ?>') option.selected = true;
                            districtSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error loading districts:', error));
            }
        }

        window.onload = function() {
            if (document.getElementById("ProvinceCode").value) {
                loadDistricts(); // Tải danh sách huyện nếu đã có tỉnh
            }
        };
    </script>
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
        .order-container {
            display: grid;
            grid-template-rows: auto 1fr;
            height: 600px; /* Chiều cao cố định cho cả hai phần */
        }
        .order-list {
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
        <h1 class="text-3xl font-bold text-blue-400">Thông Tin Tài Khoản & Đơn Hàng</h1>
        <p class="text-gray-400">Quản lý thông tin cá nhân và theo dõi đơn hàng của bạn</p>
    </div>

    <!-- Customer Information Card -->
    <div class="w-full mb-8">
        <div class="bg-gray-800 rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-bold text-blue-400"><i class="fas fa-user-circle mr-2"></i>Thông Tin Khách Hàng</h2>
                <div class="h-16 w-16 rounded-full bg-gray-700 flex items-center justify-center">
                    <img class="h-10 w-10" src="https://img.icons8.com/?size=100&id=99268&format=png&color=ffffff">
                </div>
            </div>
            
            <form action="?controller=information" method="POST" class="space-y-5">
                <input type="hidden" name="action" value="change">
                
                <!-- Họ và tên ở hàng đầu tiên -->
                <div class="space-y-2">
                    <label for="fullName" class="block text-sm font-medium text-gray-300">Họ và tên</label>
                    <div class="flex items-center bg-gray-700 rounded-lg px-3 py-2">
                        <i class="fas fa-user text-blue-400 mr-2"></i>
                        <input type="text" name="fullName" id="fullName" 
                            class="w-full bg-transparent border-0 focus:outline-none text-gray-100" 
                            placeholder="<?php echo $dataUser->FullName; ?>">
                    </div>
                </div>
                
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <label for="Email" class="block text-sm font-medium text-gray-300">Email</label>
                            <div class="flex items-center bg-gray-700 rounded-lg px-3 py-2">
                                <i class="fas fa-envelope text-blue-400 mr-2"></i>
                                <input type="email" name="Email" id="Email" 
                                    class="w-full bg-transparent border-0 focus:outline-none text-gray-400" 
                                    placeholder="<?php echo $Email; ?>" readonly>
                            </div>
                        </div>
                        
                        <div class="space-y-2">
                            <label for="phone" class="block text-sm font-medium text-gray-300">Số điện thoại</label>
                            <div class="flex items-center bg-gray-700 rounded-lg px-3 py-2">
                                <i class="fas fa-phone text-blue-400 mr-2"></i>
                                <input type="tel" name="phone" id="phone" 
                                    class="w-full bg-transparent border-0 focus:outline-none text-gray-100" 
                                    placeholder="<?php echo $dataUser->PhoneNumber; ?>">
                            </div>
                        </div>
                        
                        <div class="space-y-2">
                            <label for="SpecificAddress" class="block text-sm font-medium text-gray-300">Địa chỉ cụ thể</label>
                            <div class="flex items-center bg-gray-700 rounded-lg px-3 py-2">
                                <i class="fas fa-home text-blue-400 mr-2"></i>
                                <input type="text" name="SpecificAddress" id="SpecificAddress" 
                                    class="w-full bg-transparent border-0 focus:outline-none text-gray-100" 
                                    placeholder="<?php echo $specificAddress; ?>">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <label for="LoyaltyPoints" class="block text-sm font-medium text-gray-300">Điểm tích lũy</label>
                            <div class="flex items-center bg-gray-700 rounded-lg px-3 py-2">
                                <i class="fas fa-star text-yellow-300 mr-2"></i>
                                <input type="text" name="LoyaltyPoints" id="LoyaltyPoints" 
                                    class="w-full bg-transparent border-0 focus:outline-none text-gray-400" 
                                    placeholder="<?php echo number_format($dataUser->LoyaltyPoints, 0, ',', '.'); ?>đ" readonly>
                            </div>
                        </div>
                        
                        <div class="space-y-2">
                            <label for="ProvinceCode" class="block text-sm font-medium text-gray-300">Tỉnh/Thành Phố</label>
                            <div class="flex items-center bg-gray-700 rounded-lg px-3 py-2">
                                <i class="fas fa-map-marker-alt text-blue-400 mr-2"></i>
                                <select name="ProvinceCode" id="ProvinceCode" 
                                    class="w-full bg-gray-700 border-0 focus:outline-none text-gray-100" 
                                    onchange="loadDistricts()">
                                    <option value="">Chọn tỉnh</option>
                                    <?php foreach ($provinces as $province): ?>
                                        <option value="<?php echo $province->code; ?>" <?php if ($province->name === $provinceName) echo 'selected'; ?>>
                                            <?php echo $province->name; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="space-y-2">
                            <label for="DistrictCode" class="block text-sm font-medium text-gray-300">Quận/Huyện</label>
                            <div class="flex items-center bg-gray-700 rounded-lg px-3 py-2">
                                <i class="fas fa-map text-blue-400 mr-2"></i>
                                <select name="DistrictCode" id="DistrictCode" 
                                    class="w-full bg-gray-700 border-0 focus:outline-none text-gray-100">
                                    <option value="">Chọn huyện</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <button type="submit" class="flex-1 py-3 px-4 bg-blue-700 text-white rounded-lg font-bold">
                        <i class="fas fa-save mr-2"></i>Lưu Thay Đổi
                    </button>
                    <a href="?controller=information&action=logout" class="flex-1 py-3 px-4 bg-red-700 text-white rounded-lg font-bold text-center">
                        <i class="fas fa-sign-out-alt mr-2"></i>Đăng Xuất
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Orders Section -->
    <div class="grid md:grid-cols-2 gap-6">
        <!-- In Progress Orders -->
        <div class="order-section">
            <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden order-container">
                <div class="gradient-bg text-white py-4 px-6">
                    <h2 class="text-xl font-bold flex items-center">
                        <i class="fas fa-clock mr-2"></i>Đơn Hàng Đang Thực Hiện
                    </h2>
                </div>
                
                <div class="p-4 space-y-4 order-list">
                    <?php if (empty($dataPament)): ?>
                        <div class="text-center py-6 text-gray-400">
                            <i class="fas fa-shopping-bag text-5xl mb-2"></i>
                            <p>Không có đơn hàng đang thực hiện</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($dataPament as $payment): ?>
                            <div class="bg-gray-700 rounded-lg overflow-hidden shadow">
                                <div class="bg-blue-800 text-white py-2 px-4 flex justify-between items-center">
                                    <span class="font-bold">#<?php echo $payment['invoice']->invoiceID; ?></span>
                                    <span class="text-sm bg-blue-900 rounded-full px-3 py-1">
                                        <?php 
                                            $statusText = $payment['status'];
                                            $statusIcon = 'fa-clock';
                                            
                                            if ($statusText == 'wait for confirmation') {
                                                $statusIcon = 'fa-clock';
                                                $statusText = 'Chờ xác nhận';
                                            } elseif ($statusText == 'delivered') {
                                                $statusIcon = 'fa-truck';
                                                $statusText = 'Đã giao hàng';
                                            } elseif ($statusText == 'complete') {
                                                $statusIcon = 'fa-check-circle';
                                                $statusText = 'Hoàn thành';
                                            }
                                        ?>
                                        <i class="fas <?php echo $statusIcon; ?> mr-1"></i> <?php echo $statusText; ?>
                                    </span>
                                </div>
                                
                                <div class="p-4">
                                    <!-- Products -->
                                    <?php foreach ($payment['products'] as $productDetail): ?>
                                        <div class="flex flex-col sm:flex-row gap-4 items-center p-3 mb-3 bg-gray-800 rounded-lg shadow">
                                            <div class="w-24 h-24 flex-shrink-0 bg-gray-700 rounded-lg overflow-hidden">
                                                <img class="w-full h-full object-cover" src="<?php echo $productDetail['product']->img; ?>">
                                            </div>
                                            <div class="flex-grow space-y-1">
                                                <h3 class="font-bold text-blue-300"><?php echo $productDetail['product']->productName; ?></h3>
                                                <div class="flex justify-between text-sm">
                                                    <span class="text-gray-300">SL: <?php echo $productDetail['quantity']; ?></span>
                                                    <span class="font-medium text-gray-200"><?php echo number_format($productDetail['product']->price * $productDetail['quantity'], 0, ',', '.'); ?>đ</span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    
                                    <!-- Order Info -->
                                    <div class="mt-4 pt-4 space-y-2 text-sm">
                                        <div class="flex justify-between">
                                            <span class="text-gray-400">Ngày đặt:</span>
                                            <span class="font-medium text-gray-300"><?php echo $payment['invoice']->invoiceDate; ?></span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-400">Số điện thoại:</span>
                                            <span class="font-medium text-gray-300"><?php echo $payment['invoice']->NumberPhone; ?></span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-400">Địa chỉ:</span>
                                            <span class="font-medium text-gray-300"><?php echo $payment['invoice']->Address; ?></span>
                                        </div>
                                        <div class="flex justify-between font-bold text-blue-300">
                                            <span>Tổng tiền:</span>
                                            <span><?php echo number_format($payment['invoice']->totalAmount); ?>đ</span>
                                        </div>
                                        
                                        <?php if ($payment['invoice']->DateDelivery != '0000-00-00' && !empty($payment['invoice']->DateDelivery)): ?>
                                            <div class="flex justify-between text-green-400">
                                                <span>Ngày giao hàng mong muốn:</span>
                                                <span><?php echo $payment['invoice']->DateDelivery; ?></span>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if (!empty($payment['invoice']->Note)): ?>
                                            <div class="mt-2 bg-gray-600 p-2 rounded-lg">
                                                <p class="text-gray-300"><strong class="text-yellow-300">Ghi chú:</strong> <?php echo $payment['invoice']->Note; ?></p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <!-- Action Buttons -->
                                    <div class="mt-4 pt-3">
                                        <?php if ($payment['status'] == 'delivered'): ?>
                                            <form action="?controller=information" method="POST">
                                                <input type="hidden" name="action" value="ChangeStatus">
                                                <input type="hidden" name="IdOder" value="<?php echo $payment['invoice']->invoiceID; ?>">
                                                <input type="hidden" name="TotalAmount" value="<?php echo $payment['invoice']->totalAmount; ?>">
                                                <button class="w-full py-2 bg-green-700 text-white rounded-lg font-medium">
                                                    <i class="fas fa-check-circle mr-2"></i>Xác nhận đã nhận đơn hàng
                                                </button>
                                            </form>
                                        <?php elseif ($payment['status'] !== 'wait for confirmation' && $payment['status'] !== 'complete'): ?>
                                            <button disabled class="w-full py-2 bg-yellow-600 text-white rounded-lg font-medium opacity-75 cursor-not-allowed">
                                                <i class="fas fa-truck mr-2"></i>Đơn hàng đang được xử lý
                                            </button>
                                        <?php elseif ($payment['status'] == 'complete'): ?>
                                            <form action="?controller=information" method="POST">
                                                <input type="hidden" name="action" value="Reorder">
                                                <input type="hidden" name="InvoiceID" value="<?php echo $payment['invoice']->invoiceID; ?>">
                                                <button type="submit" class="w-full py-2 bg-purple-700 text-white rounded-lg font-medium">
                                                    <i class="fas fa-redo mr-2"></i>Đặt lại
                                                </button>
                                            </form>
                                        <?php elseif ($payment['status'] == 'wait for confirmation'): ?>
                                            <a href="?controller=Information&action=CancalOder&ID=<?php echo $payment['invoice']->invoiceID; ?>" 
                                               class="block w-full py-2 bg-red-700 text-white rounded-lg font-medium text-center">
                                                <i class="fas fa-times-circle mr-2"></i>Hủy đơn hàng
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Completed Orders -->
        <div class="order-section">
            <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden order-container">
                <div class="gradient-bg text-white py-4 px-6">
                    <h2 class="text-xl font-bold flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>Đơn Hàng Đã Hoàn Thành
                    </h2>
                </div>
                
                <div class="p-4 space-y-4 order-list">
                    <?php if (empty($dataWasPayment)): ?>
                        <div class="text-center py-6 text-gray-400">
                            <i class="fas fa-shopping-bag text-5xl mb-2"></i>
                            <p>Không có đơn hàng đã hoàn thành</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($dataWasPayment as $payment): ?>
                            <div class="bg-gray-700 rounded-lg overflow-hidden shadow">
                                <div class="bg-green-800 text-white py-2 px-4 flex justify-between items-center">
                                    <span class="font-bold">#<?php echo $payment['invoice']->invoiceID; ?></span>
                                    <span class="text-sm bg-green-900 rounded-full px-3 py-1">
                                        <i class="fas fa-check-circle mr-1"></i> <?php echo $payment['status']; ?>
                                    </span>
                                </div>
                                
                                <div class="p-4">
                                    <!-- Products -->
                                    <?php foreach ($payment['products'] as $productDetail): ?>
                                        <div class="flex flex-col sm:flex-row gap-4 items-center p-3 mb-3 bg-gray-800 rounded-lg shadow">
                                            <div class="w-24 h-24 flex-shrink-0 bg-gray-700 rounded-lg overflow-hidden">
                                                <img class="w-full h-full object-cover" src="<?php echo $productDetail['product']->img; ?>">
                                            </div>
                                            <div class="flex-grow space-y-1">
                                                <h3 class="font-bold text-green-300"><?php echo $productDetail['product']->productName; ?></h3>
                                                <div class="flex justify-between text-sm">
                                                    <span class="text-gray-300">SL: <?php echo $productDetail['quantity']; ?></span>
                                                    <span class="font-medium text-gray-200"><?php echo number_format($productDetail['product']->price * $productDetail['quantity'], 0, ',', '.'); ?>đ</span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    
                                    <!-- Order Info -->
                                    <div class="mt-4 pt-4 space-y-2 text-sm">
                                        <div class="flex justify-between">
                                            <span class="text-gray-400">Ngày đặt:</span>
                                            <span class="font-medium text-gray-300"><?php echo $payment['invoice']->invoiceDate; ?></span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-400">Số điện thoại:</span>
                                            <span class="font-medium text-gray-300"><?php echo $payment['invoice']->NumberPhone; ?></span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-400">Địa chỉ:</span>
                                            <span class="font-medium text-gray-300"><?php echo $payment['invoice']->Address; ?></span>
                                        </div>
                                        <div class="flex justify-between font-bold text-green-300">
                                            <span>Tổng tiền:</span>
                                            <span><?php echo number_format($payment['invoice']->totalAmount); ?>đ</span>
                                        </div>
                                        
                                        <?php if ($payment['invoice']->DateDelivery != '0000-00-00' && !empty($payment['invoice']->DateDelivery)): ?>
                                            <div class="flex justify-between text-green-400">
                                                <span>Ngày giao hàng dự kiến:</span>
                                                <span><?php echo $payment['invoice']->DateDelivery; ?></span>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if (!empty($payment['invoice']->Note)): ?>
                                            <div class="mt-2 bg-gray-600 p-2 rounded-lg">
                                                <p class="text-gray-300"><strong class="text-yellow-300">Ghi chú:</strong> <?php echo $payment['invoice']->Note; ?></p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <!-- Reorder Button -->
                                    <div class="mt-4 pt-3">
                                        <form action="?controller=information" method="POST">
                                            <input type="hidden" name="action" value="Reorder">
                                            <input type="hidden" name="InvoiceID" value="<?php echo $payment['invoice']->invoiceID; ?>">
                                            <button type="submit" class="w-full py-2 bg-purple-700 text-white rounded-lg font-medium">
                                                <i class="fas fa-redo mr-2"></i>Đặt lại
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once './views/footer.php';
?>
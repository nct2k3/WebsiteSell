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
    <title>Thông Tin Đơn Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #111827;
            background-image: 
                radial-gradient(circle at 25% 25%, rgba(74, 85, 104, 0.05) 0%, transparent 40%),
                radial-gradient(circle at 75% 75%, rgba(79, 70, 229, 0.05) 0%, transparent 40%);
        }
        
        /* Loại bỏ outline khi focus */
        input:focus, select:focus, button:focus {
            outline: none;
        }
        
        /* Tùy chỉnh select */
        select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23A78BFA' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1em;
            padding-right: 2.5rem;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }
        
        /* Thanh cuộn tối */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #1F2937;
        }
        ::-webkit-scrollbar-thumb {
            background: #4B5563;
            border-radius: 4px;
        }
        
        /* Input styling */
        .input-field {
            transition: all 0.3s;
            background-color: rgba(55, 65, 81, 0.8);
            color: #E5E7EB;
        }
        
        .input-field:focus-within {
            background-color: rgba(55, 65, 81, 1);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.3);
        }
        
        /* Button glow effect */
        .btn-glow {
            position: relative;
            z-index: 1;
            overflow: hidden;
            transition: all 0.3s;
        }
        
        .btn-glow:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 0;
            background: linear-gradient(to top, rgba(129, 140, 248, 0.2), transparent);
            z-index: -1;
            transition: height 0.3s ease-out;
        }
        
        .btn-glow:hover:after {
            height: 100%;
        }
        
        /* Card hover effect */
        .order-card {
            transition: all 0.3s ease;
        }
        
        .order-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
        }
        
        /* Status badges - all white */
        .status-badge {
            display: inline-flex;
            align-items: center;
            border-radius: 9999px;
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 500;
            white-space: nowrap;
            background-color: rgba(255, 255, 255, 0.1);
            color: #FFFFFF;
        }
        
        /* Product item styling - updated */
        .product-item {
            transition: all 0.2s ease;
        }
        
        .product-item:hover {
            background-color: rgba(55, 65, 81, 0.7);
        }
        
        /* Form groups */
        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 0.75rem;
        }
        
        .form-group label {
            margin-bottom: 0.25rem;
            white-space: nowrap;
        }
        
        /* Date inputs custom styling */
        input[type="date"] {
            color-scheme: dark;
        }
    </style>
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
                            option.classList.add("bg-gray-800", "text-gray-200");
                            if (district.code === '<?php echo $selectedDistrict; ?>') option.selected = true;
                            districtSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error loading districts:', error));
            }
        }

        window.onload = function() {
            if (document.getElementById("ProvinceCode").value) {
                loadDistricts();
            }
        };
    </script>
</head>
<body class="text-gray-200 min-h-screen py-6">
    <div class="container mx-auto px-4 sm:px-6 max-w-7xl">
        <div class="bg-gray-800 backdrop-filter backdrop-blur-sm bg-opacity-90 rounded-xl overflow-hidden shadow-2xl p-6 mb-8 animate__animated animate__fadeIn">
            <h1 class="text-3xl font-bold text-center mb-2 bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400">Quản Lý Đơn Hàng</h1>
            
            <!-- Status heading -->
            <?php if ($donestatus == 5): ?>
                <div class="flex justify-center items-center mb-6">
                    <div class="status-badge">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Đơn hàng chưa hoàn thành
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($donestatus == 4): ?>
                <div class="flex justify-center items-center mb-6">
                    <div class="status-badge">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Đơn hàng đã được nhận
                    </div>
                </div>
            <?php endif; ?>

            <!-- Improved Filter Section -->
            <div class="bg-gray-700 bg-opacity-50 rounded-lg p-6 mb-6">
                <h2 class="text-lg font-medium text-indigo-300 mb-5">Bộ lọc đơn hàng</h2>
                
                <div class="grid grid-cols-1 gap-6">
                    <!-- Date filter -->
                    <div class="bg-gray-800 bg-opacity-50 rounded-lg p-4">
                        <h3 class="text-sm font-medium text-indigo-200 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Lọc theo ngày
                        </h3>
                        
                        <form action="?controller=OderManager&id=<?php echo $donestatus ?>" method="POST" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <input type="hidden" name="action" value="Fillter">
                            <input type="hidden" name="Status" value="<?php echo $donestatus; ?>">
                            
                            <div class="flex flex-col">
                                <label for="DateFrom" class="text-sm font-medium text-gray-400 mb-1">Từ ngày:</label>
                                <input required id="DateFrom" name="DateFrom" type="date" class="input-field p-2 rounded-lg">
                            </div>
                            
                            <div class="flex flex-col">
                                <label for="DateTo" class="text-sm font-medium text-gray-400 mb-1">Đến ngày:</label>
                                <input required id="DateTo" name="DateTo" type="date" class="input-field p-2 rounded-lg">
                            </div>
                            
                            <div class="flex items-end md:col-span-2">
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition duration-300 btn-glow w-full">
                                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                    </svg>
                                    Lọc theo ngày
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Address filter -->
                    <div class="bg-gray-800 bg-opacity-50 rounded-lg p-4">
                        <h3 class="text-sm font-medium text-indigo-200 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Lọc theo địa chỉ
                        </h3>
                        
                        <form action="?controller=OderManager&id=<?php echo $donestatus ?>" method="POST" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <input type="hidden" name="action" value="FilterByAddress">
                            <input type="hidden" name="Status" value="<?php echo $donestatus; ?>">
                            
                            <div class="flex flex-col">
                                <label for="ProvinceCode" class="text-sm font-medium text-gray-400 mb-1">Tỉnh:</label>
                                <select id="ProvinceCode" name="ProvinceCode" class="input-field p-2 rounded-lg" onchange="loadDistricts()">
                                    <option value="" class="bg-gray-800 text-gray-200">Chọn tỉnh</option>
                                    <?php foreach ($provinces as $province): ?>
                                        <option value="<?php echo $province->code; ?>" <?php if ($province->code === $selectedProvince) echo 'selected'; ?> class="bg-gray-800 text-gray-200"><?php echo $province->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="flex flex-col">
                                <label for="DistrictCode" class="text-sm font-medium text-gray-400 mb-1">Huyện:</label>
                                <select id="DistrictCode" name="DistrictCode" class="input-field p-2 rounded-lg">
                                    <option value="" class="bg-gray-800 text-gray-200">Chọn huyện</option>
                                </select>
                            </div>
                            
                            <div class="flex items-end md:col-span-2">
                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition duration-300 btn-glow w-full">
                                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    Tìm kiếm địa chỉ
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Orders List -->
            <?php if (!empty($dataPament)): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($dataPament as $payment): ?>
                        <div class="order-card bg-gray-700 bg-opacity-70 rounded-xl overflow-hidden shadow-md">
                            <div class="bg-gray-600 bg-opacity-70 p-3">
                                <div class="flex justify-between items-center">
                                    <h3 class="font-bold text-indigo-300">Mã Đơn: #<?php echo $payment['invoice']->invoiceID; ?></h3>
                                    <span class="text-sm text-gray-400">ID: <?php echo $payment['invoice']->userID; ?></span>
                                </div>
                                <div class="text-sm text-gray-400 mt-1">
                                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <?php echo $payment['invoice']->invoiceDate; ?>
                                </div>
                            </div>
                            
                            <!-- Products in the order - cải tiến bố cục -->
                            <div class="p-4">
                                <h4 class="font-medium text-gray-300 mb-3 uppercase text-sm tracking-wide">Sản phẩm đã đặt:</h4>
                                <?php foreach ($payment['products'] as $productDetail): ?>
                                    <div class="product-item bg-gray-800 bg-opacity-50 rounded-lg p-3 mb-2">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 mr-3">
                                                <img class="h-16 w-16 object-cover rounded" src="<?php echo $productDetail['product']->img; ?>">
                                            </div>
                                            <div class="flex-grow">
                                                <p class="font-medium text-indigo-200 text-base"><?php echo $productDetail['product']->productName; ?></p>
                                                <div class="flex flex-wrap gap-2 mt-2">
                                                    <div class="flex items-center">
                                                        <div class="w-6 h-6 rounded-full bg-indigo-900 bg-opacity-30 flex items-center justify-center mr-1 flex-shrink-0">
                                                            <svg class="w-3 h-3 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                                            </svg>
                                                        </div>
                                                        <span class="text-sm text-gray-300">Số lượng: <span class="text-indigo-300 font-medium"><?php echo $productDetail['quantity']; ?></span></span>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <div class="w-6 h-6 rounded-full bg-orange-900 bg-opacity-30 flex items-center justify-center mr-1 flex-shrink-0">
                                                            <svg class="w-3 h-3 text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                            </svg>
                                                        </div>
                                                        <span class="text-sm text-gray-300">Giá: <span class="text-orange-300 font-medium"><?php echo number_format($productDetail['product']->price * $productDetail['quantity'], 0, ',', '.'); ?> đ</span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                
                                <!-- Order details - Redesigned và loại bỏ phương thức thanh toán -->
                                <div class="mt-3 bg-gray-800 bg-opacity-50 rounded-lg overflow-hidden ">
                                    <!-- Order header with ID and date -->
                                    <div class="bg-gray-700 bg-opacity-50 p-3">
                                        <div class="flex justify-between items-center">
                                            <h3 class="font-semibold text-indigo-300 flex items-center">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                                </svg>
                                                Chi tiết đơn hàng
                                            </h3>
                                            <span class="text-sm bg-gray-800 rounded-full px-3 py-1 text-gray-300">
                                                #<?php echo $payment['invoice']->invoiceID; ?>
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <!-- Order info in sections - giảm khoảng cách -->
                                    <div class="p-3">
                                        <!-- Contact section -->
                                        <div class="mb-3 pb-3">
                                            <h4 class="text-sm uppercase text-gray-400 mb-2 font-medium tracking-wide">Thông tin liên hệ</h4>
                                            <div class="flex flex-col space-y-2">
                                                <div class="flex items-center">
                                                    <div class="w-8 h-8 rounded-full bg-indigo-900 bg-opacity-30 flex items-center justify-center mr-2 flex-shrink-0">
                                                        <svg class="w-4 h-4 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm text-gray-400">Số điện thoại</p>
                                                        <p class="text-gray-200 font-medium"><?php echo $payment['invoice']->NumberPhone; ?></p>
                                                    </div>
                                                </div>
                                                
                                                <div class="flex items-start">
                                                    <div class="w-8 h-8 rounded-full bg-indigo-900 bg-opacity-30 flex items-center justify-center mr-2 flex-shrink-0">
                                                        <svg class="w-4 h-4 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm text-gray-400">Địa chỉ giao hàng</p>
                                                        <p class="text-gray-200"><?php echo $payment['invoice']->Address; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Payment section - chỉ giữ lại tổng tiền -->
                                        <div class="mb-3 pb-3 ">
                                            <h4 class="text-sm uppercase text-gray-400 mb-2 font-medium tracking-wide">Thông tin thanh toán</h4>
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-full bg-orange-900 bg-opacity-30 flex items-center justify-center mr-2 flex-shrink-0">
                                                    <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="text-sm text-gray-400">Tổng thanh toán</p>
                                                    <p class="text-orange-400 font-bold text-lg"><?php echo number_format($payment['invoice']->totalAmount, 0, ',', '.'); ?> đ</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Status section -->
                                        <div>
                                            <h4 class="text-sm uppercase text-gray-400 mb-2 font-medium tracking-wide">Tình trạng đơn hàng</h4>
                                            <div class="flex flex-col space-y-2">
                                                <div class="flex items-center">
                                                    <div class="w-8 h-8 rounded-full bg-blue-900 bg-opacity-30 flex items-center justify-center mr-2 flex-shrink-0">
                                                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm text-gray-400">Trạng thái đơn hàng</p>
                                                        <p class="text-gray-200 font-medium"><?php echo $payment['status']; ?></p>
                                                    </div>
                                                </div>
                                                
                                                <div class="flex items-center">
                                                    <div class="w-8 h-8 rounded-full bg-purple-900 bg-opacity-30 flex items-center justify-center mr-2 flex-shrink-0">
                                                        <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm text-gray-400">Giao hàng dự kiến</p>
                                                        <p class="text-gray-200 font-medium"><?php echo $payment['invoice']->DateDelivery; ?></p>
                                                    </div>
                                                </div>
                                                
                                                <?php if (!empty($payment['invoice']->Note)): ?>
                                                <div class="flex items-start">
                                                    <div class="w-8 h-8 rounded-full bg-yellow-900 bg-opacity-30 flex items-center justify-center mr-2 flex-shrink-0">
                                                        <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm text-gray-400">Ghi chú</p>
                                                        <p class="text-gray-200"><?php echo $payment['invoice']->Note; ?></p>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        
                                        <!-- Action buttons for pending orders -->
                                        <?php if ($donestatus == 5 || $_GET['id'] == 5): ?>
                                            <div class="mt-3 pt-3">
                                                <form action="?controller=OderManager" method="POST" class="mb-2">
                                                    <input type="hidden" name="action" value="ChangeStatus">
                                                    <input type="hidden" name="IdPayment" value="<?php echo $payment['invoice']->invoiceID; ?>">
                                                    <input type="hidden" name="IdUser" value="<?php echo $payment['invoice']->userID; ?>">
                                                    <select onchange="this.form.submit()" id="Status" name="Status" required class="w-full bg-gray-700 text-white rounded-lg p-2 text-sm cursor-pointer hover:bg-gray-600 transition-colors duration-300">
                                                        <option value="" disabled selected class="bg-gray-800 text-white">Thay đổi trạng thái</option>
                                                        <option value="1" class="bg-gray-800 text-white">Đã xác nhận</option>
                                                        <option value="2" class="bg-gray-800 text-white">Đang vận chuyển</option>
                                                        <option value="3" class="bg-gray-800 text-white">Đã giao hàng</option>
                                                    </select>
                                                </form>
                                                
                                                <button 
                                                    onclick="confirmDelete(<?php echo $payment['invoice']->invoiceID; ?>, <?php echo $payment['invoice']->userID; ?>)" 
                                                    class="w-full bg-red-600 hover:bg-red-700 text-white rounded-lg p-2 text-sm flex items-center justify-center transition-colors duration-300">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Xóa Đơn Hàng
                                                </button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="flex flex-col items-center justify-center py-16 bg-gray-700 bg-opacity-30 rounded-xl">
                    <svg class="w-16 h-16 text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-xl text-gray-300">Không có đơn hàng nào được tìm thấy</p>
                    <p class="text-gray-400 mt-2">Thử thay đổi bộ lọc hoặc kiểm tra lại sau</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <script>
        function confirmDelete(orderId, userId) {
            if (confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')) {
                window.location.href = `?controller=NotificationManager&idOder=${orderId}&idUser=${userId}`;
            }
        }
    </script>
</body>
</html>
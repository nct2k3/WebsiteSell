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
    <title>Quản lý người dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            background-color: rgba(55, 65, 81, 0.8);
        }
        
        .input-field:focus {
            background-color: rgba(55, 65, 81, 1);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.3);
        }
        
        /* Status badge styling */
        .status-badge {
            display: inline-flex;
            align-items: center;
            border-radius: 9999px;
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 500;
            white-space: nowrap;
        }
        
        .badge-active {
            background-color: rgba(16, 185, 129, 0.2);
            color: #10B981;
        }
        
        .badge-locked {
            background-color: rgba(239, 68, 68, 0.2);
            color: #EF4444;
        }
    </style>
    <script>
        function loadDistricts(userId, districtCode = '') {
            const provinceCode = document.getElementById(`ProvinceCode_${userId}`).value;
            const districtSelect = document.getElementById(`DistrictCode_${userId}`);
            districtSelect.innerHTML = '<option value="' + districtCode + '">' + (districtCode ? document.getElementById(`OriginalDistrictName_${userId}`).value : 'Chọn huyện') + '</option>';

            if (provinceCode) {
                fetch(`?controller=Usermanager&action=getDistricts&province=${provinceCode}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data && Array.isArray(data)) {
                            data.forEach(district => {
                                const option = document.createElement("option");
                                option.value = district.code;
                                option.textContent = district.name;
                                if (district.code === districtCode) {
                                    option.selected = true;
                                }
                                districtSelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => console.error('Error loading districts:', error));
            }
        }
    </script>
</head>
<body class="text-gray-200 min-h-screen py-6">
    <div class="container mx-auto px-4 sm:px-6 max-w-6xl">
        <div class="bg-gray-800 backdrop-filter backdrop-blur-sm bg-opacity-90 rounded-xl overflow-hidden shadow-2xl p-6 mb-8">
            <h1 class="text-3xl font-bold text-center mb-2 bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400">Quản Lý Người Dùng</h1>
            <p class="text-gray-400 text-center mb-6">Quản lý và chỉnh sửa thông tin người dùng</p>

            <?php if (isset($_SESSION['message'])): ?>
                <div class="bg-green-900 bg-opacity-30 text-green-200 p-4 rounded-lg mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="bg-red-900 bg-opacity-30 text-red-200 p-4 rounded-lg mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <!-- Search Form -->
            <div class="max-w-2xl mx-auto mb-8">
                <form action="?controller=Usermanager" method="POST" class="space-y-2">
                    <input type="hidden" name="action" value="search">
                    <label for="string" class="block text-sm font-medium text-indigo-300">Tìm kiếm người dùng</label>
                    <div class="flex">
                        <div class="input-field rounded-l-lg flex-grow flex items-center p-2">
                            <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input placeholder="Nhập tên người dùng cần tìm..." id="string" name="string" class="w-full bg-transparent text-indigo-200" type="text">
                        </div>
                        <button type="submit" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-4 py-2 rounded-r-lg">
                            Tìm
                        </button>
                    </div>
                </form>
            </div>

            <!-- User Cards Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <?php foreach ($dataUser as $item): ?>
                <div class="bg-gray-700 bg-opacity-70 rounded-xl overflow-hidden shadow-md">
                    <div class="p-3 bg-gradient-to-r <?php echo $item['DataAcc']->role == 0 ? 'from-blue-800 to-indigo-800' : 'from-red-800 to-rose-800' ?> flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="bg-gray-800 bg-opacity-30 w-8 h-8 rounded-full flex items-center justify-center mr-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h2 class="text-base font-medium text-white">
                                ID: <?php echo $item['DataUser']->userID?>
                            </h2>
                        </div>
                        <span class="status-badge <?php echo $item['DataAcc']->role == 0 ? 'badge-active' : 'badge-locked' ?>">
                            <?php echo $item['DataAcc']->role == 0 ? 'Hoạt động' : 'Đã khóa' ?>
                        </span>
                    </div>

                    <div class="p-4 space-y-4">
                        <form action="?controller=Usermanager" method="POST" class="space-y-4">
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="userID" value="<?php echo $item['DataUser']->userID?>">
                            <input type="hidden" id="OriginalProvinceCode_<?php echo $item['DataUser']->userID?>" name="OriginalProvinceCode" value="<?php echo $item['ProvinceCode']?>">
                            <input type="hidden" id="OriginalDistrictCode_<?php echo $item['DataUser']->userID?>" name="OriginalDistrictCode" value="<?php echo $item['DistrictCode']?>">
                            <input type="hidden" id="OriginalSpecificAddress_<?php echo $item['DataUser']->userID?>" name="OriginalSpecificAddress" value="<?php echo $item['SpecificAddress']?>">
                            <input type="hidden" id="OriginalDistrictName_<?php echo $item['DataUser']->userID?>" value="<?php echo $item['DistrictName'] ? $item['DistrictName'] : 'Chọn huyện'; ?>">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label class="block text-sm font-medium text-indigo-300">Tên người dùng</label>
                                    <input type="text" name="UserName" value="<?php echo $item['DataUser']->FullName?>"
                                           class="input-field w-full rounded-lg p-2 text-sm text-gray-100">
                                </div>
                                
                                <div class="space-y-1">
                                    <label class="block text-sm font-medium text-indigo-300">Email</label>
                                    <input type="email" name="Email" value="<?php echo $item['DataAcc']->email?>"
                                           class="input-field w-full rounded-lg p-2 text-sm text-gray-100">
                                </div>

                                <div class="space-y-1">
                                    <label class="block text-sm font-medium text-indigo-300">Số điện thoại</label>
                                    <input type="tel" name="Phone" value="<?php echo $item['DataUser']->PhoneNumber?>"
                                           class="input-field w-full rounded-lg p-2 text-sm text-gray-100">
                                </div>

                                <div class="space-y-1">
                                    <label class="block text-sm font-medium text-indigo-300">Mật khẩu</label>
                                    <input type="password" name="password" value="<?php echo $item['DataAcc']->password?>"
                                           class="input-field w-full rounded-lg p-2 text-sm text-gray-100">
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label class="block text-sm font-medium text-indigo-300">Tỉnh/Thành phố</label>
                                <select name="ProvinceCode" id="ProvinceCode_<?php echo $item['DataUser']->userID?>" 
                                        class="input-field w-full rounded-lg p-2 text-sm text-gray-100"
                                        onchange="loadDistricts('<?php echo $item['DataUser']->userID?>', '<?php echo $item['DistrictCode']?>')">
                                    <option value="" class="bg-gray-800 text-gray-200">Chọn tỉnh/thành phố</option>
                                    <?php foreach ($provinces as $province): ?>
                                        <option value="<?php echo $province->code ?>" <?php echo $province->code == $item['ProvinceCode'] ? 'selected' : '' ?> class="bg-gray-800 text-gray-200">
                                            <?php echo $province->name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="space-y-1">
                                <label class="block text-sm font-medium text-indigo-300">Quận/Huyện</label>
                                <select name="DistrictCode" id="DistrictCode_<?php echo $item['DataUser']->userID?>" 
                                        class="input-field w-full rounded-lg p-2 text-sm text-gray-100">
                                    <option value="<?php echo $item['DistrictCode']?>" class="bg-gray-800 text-gray-200">
                                        <?php echo $item['DistrictName'] ? $item['DistrictName'] : 'Chọn huyện'; ?>
                                    </option>
                                    <?php if (!empty($item['Districts'])): ?>
                                        <?php foreach ($item['Districts'] as $district): ?>
                                            <?php if ($district->code != $item['DistrictCode']): ?>
                                                <option value="<?php echo $district->code ?>" class="bg-gray-800 text-gray-200">
                                                    <?php echo $district->name ?>
                                                </option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <div class="space-y-1">
                                <label class="block text-sm font-medium text-indigo-300">Địa chỉ cụ thể</label>
                                <input type="text" name="SpecificAddress" id="SpecificAddress_<?php echo $item['DataUser']->userID?>"
                                       value="<?php echo $item['SpecificAddress']?>"
                                       class="input-field w-full rounded-lg p-2 text-sm text-gray-100">
                            </div>

                            <div>
                                <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-2 px-3 rounded-lg text-sm font-medium">
                                    Lưu thay đổi
                                </button>
                            </div>
                        </form>

                        <form action="?controller=Usermanager" method="POST">
                            <input type="hidden" name="action" value="changeStatus">
                            <input type="hidden" name="userID" value="<?php echo $item['DataUser']->userID?>">
                            <input type="hidden" name="currentRole" value="<?php echo $item['DataAcc']->role?>">
                            <button type="submit" 
                                    class="w-full <?php echo $item['DataAcc']->role == 0 ? 'bg-gradient-to-r from-red-600 to-pink-600' : 'bg-gradient-to-r from-green-600 to-blue-600' ?> text-white py-2 px-3 rounded-lg text-sm font-medium">
                                <?php echo $item['DataAcc']->role == 0 ? 'Khóa tài khoản' : 'Mở khóa tài khoản' ?>
                            </button>
                        </form>
                    </div>
                </div>
                <script>
                    <?php if ($item['ProvinceCode']): ?>
                        loadDistricts('<?php echo $item['DataUser']->userID?>', '<?php echo $item['DistrictCode'] ?>');
                    <?php endif; ?>
                </script>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</body>
</html>
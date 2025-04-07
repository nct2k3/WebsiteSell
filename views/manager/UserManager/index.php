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
<body class="bg-gray-100">
<div class="container mx-auto p-8">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Quản Lý Người Dùng</h1>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <!-- Search Form -->
    <div class="max-w-2xl mx-auto mb-8">
        <form action="?controller=Usermanager" method="POST" class="flex shadow-lg rounded-lg overflow-hidden">
            <input type="hidden" name="action" value="search">
            <input placeholder="Tìm kiếm người dùng..." id="string" name="string" 
                   class="flex-1 px-4 py-3 text-gray-700 focus:outline-none" type="text">
            <button class="bg-blue-500 px-6 hover:bg-blue-600 transition-colors">
                <img class="h-6" src="https://img.icons8.com/?size=100&id=7695&format=png&color=ffffff" alt="Search">
            </button>
        </form>
    </div>

    <!-- User Cards Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <?php foreach ($dataUser as $item): ?>
        <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow">
            <div class="border-b pb-4 mb-4">
                <h2 class="text-xl font-semibold text-gray-800">
                    ID: <?php echo $item['DataUser']->userID?>
                    <span class="float-right px-3 py-1 rounded-full text-sm <?php echo $item['DataAcc']->role == 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                        <?php echo $item['DataAcc']->role == 0 ? 'Hoạt động' : 'Đã khóa' ?>
                    </span>
                </h2>
            </div>

            <form action="?controller=Usermanager" method="POST" class="space-y-4">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="userID" value="<?php echo $item['DataUser']->userID?>">
                <input type="hidden" id="OriginalProvinceCode_<?php echo $item['DataUser']->userID?>" name="OriginalProvinceCode" value="<?php echo $item['ProvinceCode']?>">
                <input type="hidden" id="OriginalDistrictCode_<?php echo $item['DataUser']->userID?>" name="OriginalDistrictCode" value="<?php echo $item['DistrictCode']?>">
                <input type="hidden" id="OriginalSpecificAddress_<?php echo $item['DataUser']->userID?>" name="OriginalSpecificAddress" value="<?php echo $item['SpecificAddress']?>">
                <input type="hidden" id="OriginalDistrictName_<?php echo $item['DataUser']->userID?>" value="<?php echo $item['DistrictName'] ? $item['DistrictName'] : 'Chọn huyện'; ?>">
                
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tên người dùng</label>
                        <input type="text" name="UserName" value="<?php echo $item['DataUser']->FullName?>"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="Email" value="<?php echo $item['DataAcc']->email?>"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại</label>
                        <input type="tel" name="Phone" value="<?php echo $item['DataUser']->PhoneNumber?>"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu</label>
                        <input type="password" name="password" value="<?php echo $item['DataAcc']->password?>"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tỉnh/Thành phố</label>
                        <select name="ProvinceCode" id="ProvinceCode_<?php echo $item['DataUser']->userID?>" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                onchange="loadDistricts('<?php echo $item['DataUser']->userID?>', '<?php echo $item['DistrictCode']?>')">
                            <option value="">Chọn tỉnh/thành phố</option>
                            <?php foreach ($provinces as $province): ?>
                                <option value="<?php echo $province->code ?>" <?php echo $province->code == $item['ProvinceCode'] ? 'selected' : '' ?>>
                                    <?php echo $province->name ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Quận/Huyện</label>
                        <select name="DistrictCode" id="DistrictCode_<?php echo $item['DataUser']->userID?>" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                            <!-- Hiển thị Quận/Huyện hiện tại của người dùng làm tùy chọn mặc định -->
                            <option value="<?php echo $item['DistrictCode']?>">
                                <?php echo $item['DistrictName'] ? $item['DistrictName'] : 'Chọn huyện'; ?>
                            </option>
                            <?php if (!empty($item['Districts'])): ?>
                                <?php foreach ($item['Districts'] as $district): ?>
                                    <!-- Không hiển thị lại Quận/Huyện hiện tại trong danh sách -->
                                    <?php if ($district->code != $item['DistrictCode']): ?>
                                        <option value="<?php echo $district->code ?>">
                                            <?php echo $district->name ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Địa chỉ cụ thể</label>
                        <input type="text" name="SpecificAddress" id="SpecificAddress_<?php echo $item['DataUser']->userID?>"
                               value="<?php echo $item['SpecificAddress']?>"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    </div>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-1 bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition-colors">
                        Lưu thay đổi
                    </button>
                </div>
            </form>

            <form action="?controller=Usermanager" method="POST" class="flex-1 mt-4">
                <input type="hidden" name="action" value="changeStatus">
                <input type="hidden" name="userID" value="<?php echo $item['DataUser']->userID?>">
                <input type="hidden" name="currentRole" value="<?php echo $item['DataAcc']->role?>">
                <button type="submit" 
                        class="w-full <?php echo $item['DataAcc']->role == 0 ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' ?> text-white py-2 px-4 rounded-md transition-colors">
                    <?php echo $item['DataAcc']->role == 0 ? 'Khóa tài khoản' : 'Mở khóa tài khoản' ?>
                </button>
            </form>
            <script>
                <?php if ($item['ProvinceCode']): ?>
                    loadDistricts('<?php echo $item['DataUser']->userID?>', '<?php echo $item['DistrictCode'] ?>');
                <?php endif; ?>
            </script>
        </div>
        <?php endforeach ?>
    </div>
</div>
</body>
</html>
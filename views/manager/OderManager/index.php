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
<body class="">
<div class="container mx-auto px-5 py-2">
    <div class="mt-2">
        <?php if ($donestatus == 5): ?>
            <p class="text-yellow-500 font-bold text-center text-xl">Đơn hàng chưa hoàn thành</p>
        <?php endif; ?>
        <?php if ($donestatus == 4): ?>
            <p class="text-blue-500 font-bold text-center text-xl">Đơn hàng đã được nhận</p>
        <?php endif; ?>

        <!-- Form tìm kiếm theo thời gian -->
        <div class="p-2 flex space-x-4">
            <form action="?controller=OderManager&id=<?php echo $donestatus ?>" method="POST" class="space-y-4 flex items-center">
                <input type="hidden" name="action" value="Fillter">
                <input type="hidden" name="Status" value="<?php echo $donestatus; ?>">
                <strong>Lọc theo ngày Từ:</strong>
                <input required id="DateFrom" name="DateFrom" type="date" class="p-2 border rounded">
                <strong>Đến:</strong>
                <input required id="DateTo" name="DateTo" type="date" class="p-2 border rounded">
                <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg text-sm">Lọc</button>
            </form>

            <!-- Form tìm kiếm theo địa chỉ -->
            <form action="?controller=OderManager&id=<?php echo $donestatus ?>" method="POST" class="space-y-4 flex items-center">
                <input type="hidden" name="action" value="FilterByAddress">
                <input type="hidden" name="Status" value="<?php echo $donestatus; ?>">
                <strong>Tỉnh:</strong>
                <select id="ProvinceCode" name="ProvinceCode" class="p-2 border rounded" onchange="loadDistricts()">
                    <option value="">Chọn tỉnh</option>
                    <?php foreach ($provinces as $province): ?>
                        <option value="<?php echo $province->code; ?>" <?php if ($province->code === $selectedProvince) echo 'selected'; ?>><?php echo $province->name; ?></option>
                    <?php endforeach; ?>
                </select>
                <strong>Huyện:</strong>
                <select id="DistrictCode" name="DistrictCode" class="p-2 border rounded">
                    <option value="">Chọn huyện</option>
                </select>
                <button type="submit" class="bg-green-500 text-white p-2 rounded-lg text-sm">Tìm kiếm</button>
            </form>
        </div>

        <div class="w-full px-4 py-2 bg-gray-200 mt-2 rounded-lg grid md:grid-cols-3">
            <?php foreach ($dataPament as $payment): ?>
                <div class="p-3 rounded bg-gray-100 m-2 hover:bg-gray-300">
                    <div class="font-bold text-center my-2">Mã Đơn Hàng: <?php echo $payment['invoice']->invoiceID; ?></div>
                    <div class="font-bold text-center my-2">Mã Người Dùng: <?php echo $payment['invoice']->userID; ?></div>
                    <?php foreach ($payment['products'] as $productDetail): ?>
                        <div class="bg-gray-100 rounded-lg shadow-md p-6 mb-2 flex justify-between">
                            <div>
                                <p><strong>Tên Sản Phẩm:</strong> <?php echo $productDetail['product']->productName; ?></p>
                                <p><strong>Số Lượng:</strong> <?php echo $productDetail['quantity']; ?></p>
                                <p><strong>Giá:</strong> <?php echo number_format($productDetail['product']->price * $productDetail['quantity'], 0, ',', '.'); ?></p>
                            </div>
                            <div>
                                <img class="h-16" src="<?php echo $productDetail['product']->img; ?>">
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="p-4 bg-gray-100 rounded">
                        <p><strong>Số Điện Thoại: </strong><?php echo $payment['invoice']->NumberPhone; ?></p>
                        <p><strong>Địa Chỉ: </strong><?php echo $payment['invoice']->Address; ?></p>
                        <p><strong>Phương Thức Thanh Toán: </strong><?php echo $payment['invoice']->paymentType; ?></p>
                        <p><strong>Ngày Đặt Hàng: </strong><?php echo $payment['invoice']->invoiceDate; ?></p>
                        <p><strong>Tổng Tiền: </strong><?php echo $payment['invoice']->totalAmount; ?></p>
                        <p><strong class="text-green-500">Ngày Giao Hàng Dự Kiến: </strong><?php echo $payment['invoice']->DateDelivery; ?></p>
                        <p><strong class="text-green-500">Ghi Chú: </strong><?php echo $payment['invoice']->Note; ?></p>
                        <p class="text-red-500"><strong>Trạng Thái: </strong><?php echo $payment['status']; ?></p>
                        <form action="?controller=OderManager" method="POST" class="space-y-4">
                            <input type="hidden" name="action" value="ChangeStatus">
                            <?php if ($donestatus == 5 || $_GET['id'] == 5): ?>
                                <input type="hidden" name="IdPayment" value="<?php echo $payment['invoice']->invoiceID; ?>">
                                <input type="hidden" name="IdUser" value="<?php echo $payment['invoice']->userID; ?>">
                                <select onchange="this.form.submit()" id="Status" name="Status" required class="text-white bg-green-500 border mt-1 block w-full p-2 rounded-md">
                                    <option value="" disabled selected>Thay đổi trạng thái</option>
                                    <option value="1">Đã xác nhận</option>
                                    <option value="2">Đang vận chuyển</option>
                                    <option value="3">Đã giao hàng</option>
                                </select>
                            </form>
                            <div onclick="window.location.href='?controller=NotificationManager&idOder=<?php echo $payment['invoice']->invoiceID; ?>&idUser=<?php echo $payment['invoice']->userID; ?>'" class="mt-1 rounded bg-red-500 hover:bg-red-700 w-full p-1 text-center text-white">
                                Xóa Đơn Hàng
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</body>
</html>
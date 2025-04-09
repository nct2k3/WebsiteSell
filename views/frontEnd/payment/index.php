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
    <h1 class="text-2xl font-bold mb-6 text-center">Đơn hàng của bạn</h1>

    <div class="bg-gray-600 p-6 rounded-lg shadow-md">
        
        <h2 class="text-xl font-semibold mb-4">Thông tin đơn hàng</h2>
        <form action="?controller=payment" method="POST">
            <input type="hidden" name="action" value="<?php echo $dataAction ?>">
          
            <div class="mb-4">
                <label for="province" class="block text-sm font-medium text-gray-100">Tỉnh/Thành phố</label>
                <select id="province" name="province" onchange="loadDistricts(this.value)" class="mt-1 block w-full text-black p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200">
                    <option value="" disabled selected>Chọn tỉnh/thành phố</option>
                    <?php foreach ($provinceList as $province): ?>
                        <option value="<?php echo $province->code; ?>"><?php echo $province->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="district" class="block text-sm font-medium text-gray-100">Quận/Huyện</label>
                <select id="district" name="district" class="mt-1 block w-full text-black p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200">
                    <option value="" disabled selected>Chọn quận/huyện</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-100"> Số nhà/ tên đường</label>
                <input type="text" id="address" name="address"   class="mt-1 block w-full text-black  p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200" placeholder="<?php echo $dataUser->Address ?>">
            </div>
            <div class="mb-4">
                <label for="PhomeNumber" class="block text-sm font-medium text-gray-100">Số điện thoại</label>
                <input type="number" id="PhoneNumber" name="PhoneNumber"   class="mt-1 block w-full text-black  p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200" placeholder="<?php echo $dataUser->PhoneNumber ?>">
            </div>
            <div class="mb-4">
                <label for="PhomeNumber" class="block text-sm font-medium text-gray-100">Ngày giao hàng mong muốn</label>
                <input
                type="date" id="DateDelivery" name="DateDelivery"
                   class="mt-1 block w-full text-black p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200"
                    min="<?php echo date('Y-m-d', strtotime('+5 days')); ?>">
            </div>
            <div class="mb-4">
                <label for="Note" class="block text-sm font-medium text-gray-100">Ghi chúchú</label>
                <input type="text" id="Note" name="Note"   class="mt-1 block w-full text-black  p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200" placeholder="Note....">
            </div>

            <div class="mb-4">
                    <label for="LoyaltyPoints" class="block text-sm font-medium text-gray-100">Số điểm tích được của bạnbạn: <?php echo  number_format($dataUser->LoyaltyPoints, 0, ',', '.') . '₫';?></label>
                    <input type="number" id="LoyaltyPoints" name="LoyaltyPoints" class="mt-1 block w-full text-black  p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200" placeholder="Nhập số điểm thưởng bạn muốn dùng" min="0" max="<?php echo $dataUser->LoyaltyPoints?>">
                </div>
            <h2 class="text-xl font-semibold mb-4">Danh sách sản phẩm mua</h2>
        

        <div class="bg-gray-600 shadow-md rounded px-4 pt-6 pb-8 my-4">
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-white text-sm sm:text-base">
                    <thead>
                        <tr class="border-b border-gray-500">
                            <th class="text-left px-2 py-1">Tên sản phẩm</th>
                            <th class="text-left px-2 py-1"></th>
                            <th class="text-left px-2 py-1">Giá</th>
                            <th class="text-left px-2 py-1">Số lượng</th>
                            
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
                                         readonly
                                        type="number" 
                                        class="quantity-input w-16 text-center border rounded bg-gray-700" 
                                        value="<?php echo $item['quantity']; ?>" 
                                        min="1"
                                        data-product-id="<?php echo $item['item']->productID; ?>" />
                                </td>
                                
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="flex justify-end items-center mt-2 text-white text-sm ">
                <p><strong>Số điểm bạn được tích khi mua:</strong> <?php echo htmlspecialchars(number_format($total/100, 0, ',', '.')) . '₫'; ?></p>
            </div>
            <div class="flex justify-end items-center mt-2 text-white ">
                <p><strong>Đơn giá cuối:</strong> <?php echo htmlspecialchars(number_format($total, 0, ',', '.')) . '₫'; ?></p>
            </div>
        </div>

            <button type="submit" class="w-full bg-indigo-600 text-white p-2 rounded-md button-animation hover:bg-indigo-700">Xác nhận đặt hàng</button>
        </form>
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

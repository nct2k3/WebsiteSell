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
    <title>Thống Kê Khách Hàng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #121826;
            color: #e2e8f0;
            font-family: 'Inter', sans-serif;
        }
        
        .card {
            background-color: #1e293b;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s;
        }
        
        th {
            color: #94a3b8;
            font-weight: 500;
        }
        
        .date-input {
            background-color: #2d3748;
            color: #e2e8f0;
            border: none;
        }
        
        .rank-badge {
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: 600;
        }
        
        .detail-section {
            background-color: #1e293b;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        
        .invoice-card {
            background-color: #2d3748;
        }
        
        .invoice-info {
            background-color: #374151;
        }
        
        .toggle-btn {
            transition: all 0.2s ease;
        }
        
        .filter-btn {
            background: linear-gradient(to right, #3b82f6, #2563eb);
            transition: all 0.2s ease;
        }
        
        .filter-btn:hover {
            background: linear-gradient(to right, #2563eb, #1d4ed8);
        }
    </style>
</head>
<body>
    <div class="max-w-7xl mx-auto py-6 px-4">
        <div class="card rounded-xl p-6 mb-6">
            <h1 class="font-bold text-3xl text-center mb-6 text-white">Thống kê khách hàng tiềm năng</h1>
            
            <form action="?controller=Oderstatistical" method="GET" class="flex flex-wrap gap-4 justify-center mb-6">
                <input type="hidden" name="controller" value="Oderstatistical">
                <div class="flex items-center gap-3">
                    <label class="text-gray-300">Từ ngày:</label>
                    <input required id="datefrom" name="datefrom" type="date" class="date-input rounded-lg p-2">
                </div>
                <div class="flex items-center gap-3">
                    <label class="text-gray-300">Đến ngày:</label>
                    <input required id="dateto" name="dateto" type="date" class="date-input rounded-lg p-2">
                </div>
                <button type="submit" class="filter-btn text-white px-6 py-2 rounded-lg font-medium">Lọc</button>
            </form>
            
            <div class="overflow-hidden rounded-xl">
                <table class="w-full text-sm">
                    <thead class="bg-gray-800">
                        <tr>
                            <th class="p-3 text-left">Xếp hạng</th>
                            <th class="p-3 text-left">Tên</th>
                            <th class="p-3 text-left">Tổng tiền</th>
                            <th class="p-3 text-left"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($dataUser as $items): ?>
                            <tr class="<?php echo $i==1 ? 'bg-amber-900/20' : ($i==2 ? 'bg-emerald-900/20' : 'bg-gray-800/20'); ?>">
                                <td class="p-3">
                                    <span class="rank-badge <?php 
                                        echo $i==1 ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-amber-100' : 
                                            ($i==2 ? 'bg-gradient-to-r from-emerald-500 to-emerald-600 text-emerald-100' : 
                                            'bg-gradient-to-r from-gray-600 to-gray-700 text-gray-200');
                                    ?>"><?php echo $i ?></span>
                                </td>
                                <td class="p-3 font-medium"><?= $items['name'] ?></td>
                                <td class="p-3 font-semibold text-gray-100"><?php echo number_format($items['totalAmount']) ?>₫</td>
                                <td class="p-3">
                                    <button 
                                        onclick="toggleDetails('details-<?= $items['id'] ?>', this)" 
                                        class="toggle-btn text-blue-400 hover:text-blue-300 focus:outline-none font-medium"
                                    >
                                        Xem chi tiết
                                    </button>
                                </td>
                            </tr>
                        <?php $i++; endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <?php foreach ($dataPament as $userID => $payment): ?>
        <section id="details-<?= $userID ?>" class="detail-section mb-6 rounded-xl p-6 hidden">
            <h3 class="text-xl font-bold pb-3 mb-4 border-b border-gray-700">
                <?= $payment['userName'] ?> 
                <span class="text-gray-400 ml-2">(<?= number_format($payment['totalAmount'], 0, ',', '.') ?> VND)</span>
            </h3>
            
            <?php foreach ($payment['invoices'] as $index => $invoice): ?>
                <div class="invoice-card mb-5 rounded-lg p-4">
                    <h4 class="font-medium mb-3 text-gray-200">Hóa đơn #<?= $index + 1 ?></h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-4 text-sm">
                        <div class="invoice-info p-3 rounded-lg">
                            <p class="text-gray-400 mb-1">Mã: <span class="text-gray-200"><?= $invoice['invoice']->invoiceID ?></span></p>
                            <p class="text-gray-400">Ngày: <span class="text-gray-200"><?= $invoice['invoice']->invoiceDate ?></span></p>
                        </div>
                        <div class="invoice-info p-3 rounded-lg">
                            <p class="text-gray-400 mb-1">Số tiền: <span class="text-gray-200"><?= number_format($invoice['invoice']->totalAmount, 0, ',', '.') ?> VND</span></p>
                            <p class="text-gray-400">Thanh toán: <span class="text-gray-200"><?= ucfirst($invoice['invoice']->paymentType) ?></span></p>
                        </div>
                    </div>

                    <div class="overflow-hidden rounded-lg bg-gray-800">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-900 text-xs">
                                <tr>
                                    <th class="p-3 text-left">Sản phẩm</th>
                                    <th class="p-3 text-left">Giá</th>
                                    <th class="p-3 text-left">Số lượng</th>
                                    <th class="p-3 text-left">Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($invoice['products'] as $product): ?>
                                    <tr class="bg-gray-800/50">
                                        <td class="p-3">
                                            <div class="flex items-center gap-3">
                                                <div class="w-12 h-12 rounded-lg overflow-hidden">
                                                    <img src="<?= $product['product']->img ?>" class="w-full h-full object-cover">
                                                </div>
                                                <span class="font-medium"><?= $product['product']->productName ?></span>
                                            </div>
                                        </td>
                                        <td class="p-3"><?= number_format($product['product']->price, 0, ',', '.') ?></td>
                                        <td class="p-3"><?= $product['quantity'] ?></td>
                                        <td class="p-3 font-medium"><?= number_format($product['product']->price * $product['quantity'], 0, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
        <?php endforeach; ?>
    </div>

    <script>
        function toggleDetails(elementId, button) {
            const element = document.getElementById(elementId);
            
            if (element.classList.contains('hidden')) {
                element.classList.remove('hidden');
                button.textContent = 'Ẩn chi tiết';
                button.classList.remove('text-blue-400');
                button.classList.add('text-red-400');
            } else {
                element.classList.add('hidden');
                button.textContent = 'Xem chi tiết';
                button.classList.remove('text-red-400');
                button.classList.add('text-blue-400');
            }
        }
    </script>
</body>
</html>
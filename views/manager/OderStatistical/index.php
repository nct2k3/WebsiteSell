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
</head>
<body class="bg-gray-50 font-[Inter]">
    <div class="max-w-7xl mx-auto py-4 px-2">
        <div class="bg-white rounded-lg shadow p-4 mb-4">
            <h1 class="font-bold text-2xl text-gray-800 text-center mb-4">Thống kê khách hàng tiềm năng</h1>
            
            <form action="?controller=Oderstatistical" method="GET" class="flex flex-wrap gap-4 justify-center mb-4">
                <input type="hidden" name="controller" value="Oderstatistical">
                <div class="flex items-center gap-2">
                    <label>Từ ngày:</label>
                    <input required id="datefrom" name="datefrom" type="date" class="border rounded p-1">
                </div>
                <div class="flex items-center gap-2">
                    <label>Đến ngày:</label>
                    <input required id="dateto" name="dateto" type="date" class="border rounded p-1">
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded">Lọc</button>
            </form>
            
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-2 text-left">Xếp hạng</th>
                        <th class="p-2 text-left">Tên</th>
                        <th class="p-2 text-left">Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach ($dataUser as $items): ?>
                        <tr class="border-t <?php echo $i==1 ? 'bg-amber-50' : ($i==2 ? 'bg-emerald-50' : ''); ?>">
                            <td class="p-2"><span class="w-6 h-6 inline-flex items-center justify-center rounded-full <?php 
                                echo $i==1 ? 'bg-amber-100 text-amber-700' : ($i==2 ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-700');
                            ?>"><?php echo $i ?></span></td>
                            <td class="p-2"><a href="#<?= $items['name'] ?>" class="text-blue-600"><?= $items['name'] ?></a></td>
                            <td class="p-2"><?php echo number_format($items['totalAmount']) ?>₫</td>
                        </tr>
                    <?php $i++; endforeach;?>
                </tbody>
            </table>
        </div>

        <h2 class="text-2xl font-bold text-center mb-4">Danh Sách Hóa Đơn Chi Tiết</h2>
        
        <?php foreach ($dataPament as $userID => $payment): ?>
        <section id="<?= $payment['userName'] ?>" class="mb-4 bg-white rounded-lg shadow p-4">
            <h3 class="text-xl font-bold border-b pb-2 mb-3">
                <?= $payment['userName'] ?> 
                <span class="text-gray-600">(<?= number_format($payment['totalAmount'], 0, ',', '.') ?> VND)</span>
            </h3>
            
            <?php foreach ($payment['invoices'] as $index => $invoice): ?>
                <div class="mb-4 bg-gray-50 rounded p-3">
                    <h4 class="font-medium mb-2">Hóa đơn #<?= $index + 1 ?></h4>
                    
                    <div class="grid grid-cols-2 gap-2 mb-3 text-sm">
                        <div class="bg-white p-2 rounded">
                            <p class="text-gray-600">Mã: <?= $invoice['invoice']->invoiceID ?></p>
                            <p>Ngày: <?= $invoice['invoice']->invoiceDate ?></p>
                        </div>
                        <div class="bg-white p-2 rounded">
                            <p>Số tiền: <?= number_format($invoice['invoice']->totalAmount, 0, ',', '.') ?> VND</p>
                            <p>Thanh toán: <?= ucfirst($invoice['invoice']->paymentType) ?></p>
                        </div>
                    </div>

                    <table class="w-full text-sm bg-white rounded">
                        <thead class="bg-gray-50 text-xs">
                            <tr>
                                <th class="p-2 text-left">Sản phẩm</th>
                                <th class="p-2 text-left">Giá</th>
                                <th class="p-2 text-left">Số lượng</th>
                                <th class="p-2 text-left">Tổng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($invoice['products'] as $product): ?>
                                <tr class="border-t">
                                    <td class="p-2">
                                        <div class="flex items-center gap-2">
                                            <img src="<?= $product['product']->img ?>" class="w-10 h-10 rounded object-cover">
                                            <span><?= $product['product']->productName ?></span>
                                        </div>
                                    </td>
                                    <td class="p-2"><?= number_format($product['product']->price, 0, ',', '.') ?></td>
                                    <td class="p-2"><?= $product['quantity'] ?></td>
                                    <td class="p-2"><?= number_format($product['product']->price * $product['quantity'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; ?>
        </section>
        <?php endforeach; ?>
    </div>
</body>
</html>

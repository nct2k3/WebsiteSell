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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --color-bg: #0f172a;
            --color-card: #1e293b;
            --color-card-secondary: #293548;
            --color-accent: #3b82f6;
            --color-accent-dark: #2563eb;
            --color-text: #e2e8f0;
            --color-text-secondary: #94a3b8;
        }
        
        body {
            background-color: var(--color-bg);
            color: var(--color-text);
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-image: 
                radial-gradient(circle at 25% 10%, rgba(59, 130, 246, 0.05) 0%, transparent 20%),
                radial-gradient(circle at 75% 75%, rgba(16, 185, 129, 0.05) 0%, transparent 20%);
        }
        
        .card {
            background-color: var(--color-card);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .card-header {
            background: linear-gradient(to right, rgba(59, 130, 246, 0.1), rgba(16, 185, 129, 0.05));
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        th {
            color: var(--color-text-secondary);
            font-weight: 600;
            letter-spacing: 0.025em;
        }
        
        .date-input {
            background-color: rgba(30, 41, 59, 0.8);
            color: var(--color-text);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.2s ease;
        }
        
        .date-input:focus {
            border-color: var(--color-accent);
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
            outline: none;
        }
        
        .rank-badge {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: 700;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .detail-section {
            background-color: var(--color-card);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: top;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .detail-section.visible {
            transform: scaleY(1);
            opacity: 1;
        }
        
        .detail-section.hidden {
            transform: scaleY(0.98);
            opacity: 0;
        }
        
        .invoice-card {
            background-color: var(--color-card-secondary);
            transition: all 0.2s ease;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .invoice-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px -3px rgba(0, 0, 0, 0.2);
        }
        
        .invoice-info {
            background-color: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(5px);
        }
        
        .toggle-btn {
            transition: all 0.2s ease;
            position: relative;
            padding-left: 1.5rem;
        }
        
        .toggle-btn:before {
            content: "";
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 0.75rem;
            height: 0.75rem;
            background-color: currentColor;
            mask-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='currentColor'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 5l7 7-7 7'%3E%3C/path%3E%3C/svg%3E");
            mask-size: cover;
            transition: transform 0.2s ease;
        }
        
        .toggle-btn.active:before {
            transform: translateY(-50%) rotate(90deg);
        }
        
        .filter-btn {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .filter-btn:after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            z-index: -1;
            opacity: 0;
            transition: opacity 0.2s ease;
        }
        
        .filter-btn:hover:after {
            opacity: 1;
        }
        
        .section-title {
            background: linear-gradient(to right, #e2e8f0, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .table-wrapper {
            overflow: hidden;
            border-radius: 0.75rem;
            background: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(5px);
        }
        
        .table-row {
            transition: background-color 0.2s ease;
        }
        
        .table-row:hover {
            background-color: rgba(255, 255, 255, 0.03) !important;
        }
        
        .product-image {
            border-radius: 0.5rem;
            overflow: hidden;
            transition: transform 0.2s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .product-image:hover {
            transform: scale(1.05);
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.3s ease forwards;
        }
        
        .chart-container {
            position: relative;
            height: 280px;
            width: 100%;
            border-radius: 0.75rem;
            overflow: hidden;
            background: rgba(15, 23, 42, 0.4);
            padding: 1.5rem;
        }
        
        .tabs {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
        
        .tab {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            background-color: rgba(30, 41, 59, 0.5);
        }
        
        .tab.active {
            background-color: var(--color-accent);
            color: white;
        }
        
        .chart-card {
            height: 100%;
            display: none;
        }
        
        .chart-card.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6">
        <div class="card rounded-2xl p-0 mb-8 overflow-hidden">
            <div class="card-header p-6">
                <h1 class="font-bold text-3xl text-center mb-2 section-title">Thống kê khách hàng tiềm năng</h1>
                <p class="text-center text-gray-400 mb-6">Phân tích chi tiết lịch sử mua hàng theo thời gian</p>
                
                <form action="?controller=Oderstatistical" method="GET" class="flex flex-wrap gap-6 justify-center mb-2">
                    <input type="hidden" name="controller" value="Oderstatistical">
                    <div class="flex items-center gap-3">
                        <label class="text-gray-300 font-medium">Từ ngày:</label>
                        <input required id="datefrom" name="datefrom" type="date" class="date-input rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    </div>
                    <div class="flex items-center gap-3">
                        <label class="text-gray-300 font-medium">Đến ngày:</label>
                        <input required id="dateto" name="dateto" type="date" class="date-input rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    </div>
                    <button type="submit" class="filter-btn text-white px-8 py-2.5 rounded-lg font-medium shadow-lg">
                        Lọc dữ liệu
                    </button>
                </form>
            </div>
            
            <!-- Biểu đồ -->
            <div class="p-6">
                <div class="flex flex-wrap items-center justify-between mb-4">
                    <h2 class="font-bold text-xl text-gray-200">Tổng quan chi tiêu</h2>
                    <div class="tabs">
                        <div class="tab active" onclick="switchChart('barChart')">Biểu đồ cột</div>
                        <div class="tab" onclick="switchChart('pieChart')">Biểu đồ tròn</div>
                    </div>
                </div>
                
                <div class="chart-container">
                    <div id="barChartCard" class="chart-card active">
                        <canvas id="barChart"></canvas>
                    </div>
                    <div id="pieChartCard" class="chart-card">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                <h2 class="font-bold text-xl text-gray-200 mb-4">Bảng xếp hạng khách hàng</h2>
                <div class="table-wrapper">
                    <table class="w-full text-sm">
                        <thead>
                            <tr>
                                <th class="p-4 text-left">Xếp hạng</th>
                                <th class="p-4 text-left">Tên khách hàng</th>
                                <th class="p-4 text-left">Tổng chi tiêu</th>
                                <th class="p-4 text-center">Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($dataUser as $items): ?>
                                <tr class="table-row <?php echo $i==1 ? 'bg-amber-900/20' : ($i==2 ? 'bg-emerald-900/20' : ($i==3 ? 'bg-blue-900/20' : 'bg-gray-800/10')); ?>">
                                    <td class="p-4">
                                        <span class="rank-badge <?php 
                                            echo $i==1 ? 'bg-gradient-to-br from-amber-400 to-amber-600 text-amber-100' : 
                                                ($i==2 ? 'bg-gradient-to-br from-emerald-400 to-emerald-600 text-emerald-100' : 
                                                ($i==3 ? 'bg-gradient-to-br from-blue-400 to-blue-600 text-blue-100' :
                                                'bg-gradient-to-br from-gray-500 to-gray-700 text-gray-200'));
                                        ?>"><?php echo $i ?></span>
                                    </td>
                                    <td class="p-4 font-medium"><?= $items['name'] ?></td>
                                    <td class="p-4">
                                        <span class="font-semibold text-lg text-gray-100"><?php echo number_format($items['totalAmount']) ?>
                                        <span class="text-gray-400 text-sm">₫</span></span>
                                    </td>
                                    <td class="p-4 text-center">
                                        <button 
                                            onclick="toggleDetails('details-<?= $items['id'] ?>', this)" 
                                            class="toggle-btn text-blue-400 hover:text-blue-300 focus:outline-none font-medium px-3 py-1.5 rounded-full bg-blue-500/10 hover:bg-blue-500/20 transition-all"
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
        </div>
        
        <?php foreach ($dataPament as $userID => $payment): ?>
        <section id="details-<?= $userID ?>" class="detail-section mb-8 rounded-2xl p-0 hidden overflow-hidden">
            <div class="p-6 bg-gradient-to-r from-blue-900/30 to-purple-900/20">
                <div class="flex flex-wrap items-center justify-between">
                    <h3 class="text-2xl font-bold mb-2">
                        <?= $payment['userName'] ?>
                        <span class="text-gray-400 text-base ml-2">(<?= count($payment['invoices']) ?> hóa đơn)</span>
                    </h3>
                    <span class="text-xl bg-blue-500/20 text-blue-300 py-1.5 px-4 rounded-full">
                        <?= number_format($payment['totalAmount'], 0, ',', '.') ?> VND
                    </span>
                </div>
                <p class="text-gray-400 text-sm mb-4">Chi tiết lịch sử mua hàng và hóa đơn</p>
            </div>
            
            <div class="p-6 grid gap-6">
                <?php foreach ($payment['invoices'] as $index => $invoice): ?>
                    <div class="invoice-card rounded-xl p-5 animate-fade-in" style="animation-delay: <?= $index * 0.1 ?>s">
                        <div class="flex flex-wrap items-center justify-between mb-4">
                            <h4 class="font-semibold text-xl text-gray-200 flex items-center gap-2">
                                <span class="w-8 h-8 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-300 text-sm"><?= $index + 1 ?></span>
                                Hóa đơn #<?= $invoice['invoice']->invoiceID ?>
                            </h4>
                            <span class="text-gray-400 text-sm mt-2 sm:mt-0">
                                <?= $invoice['invoice']->invoiceDate ?>
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-5 text-sm">
                            <div class="invoice-info p-4 rounded-xl flex items-center">
                                <div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs">Mã hóa đơn</p>
                                    <p class="text-gray-200 font-medium"><?= $invoice['invoice']->invoiceID ?></p>
                                </div>
                            </div>
                            <div class="invoice-info p-4 rounded-xl flex items-center">
                                <div class="w-10 h-10 rounded-full bg-green-500/20 flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 8h6m-5 0a3 3 0 110 6H9l3 3m-3-6h6m6 1a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs">Tổng tiền</p>
                                    <p class="text-gray-200 font-medium"><?= number_format($invoice['invoice']->totalAmount, 0, ',', '.') ?> VND</p>
                                </div>
                            </div>
                            <div class="invoice-info p-4 rounded-xl flex items-center">
                                <div class="w-10 h-10 rounded-full bg-purple-500/20 flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs">Phương thức</p>
                                    <p class="text-gray-200 font-medium"><?= ucfirst($invoice['invoice']->paymentType) ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-xl overflow-hidden">
                            <table class="w-full text-sm">
                                <thead class="bg-gray-900 text-xs">
                                    <tr>
                                        <th class="p-4 text-left">Sản phẩm</th>
                                        <th class="p-4 text-right">Giá</th>
                                        <th class="p-4 text-center">Số lượng</th>
                                        <th class="p-4 text-right">Tổng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($invoice['products'] as $product): ?>
                                        <tr class="bg-gray-800/30 hover:bg-gray-800/50 transition-colors">
                                            <td class="p-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="product-image w-14 h-14 flex items-center justify-center">
                                                        <img src="<?= $product['product']->img ?>" class="max-w-full max-h-full object-contain">
                                                    </div>
                                                    <div>
                                                        <span class="font-medium block"><?= $product['product']->productName ?></span>
                                                        <span class="text-gray-400 text-xs">SKU: <?= substr(md5($product['product']->productName), 0, 8) ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-4 text-right"><?= number_format($product['product']->price, 0, ',', '.') ?></td>
                                            <td class="p-4 text-center">
                                                <span class="inline-flex items-center justify-center min-w-[2rem] h-6 px-2 rounded-full bg-gray-700 text-gray-300">
                                                    <?= $product['quantity'] ?>
                                                </span>
                                            </td>
                                            <td class="p-4 text-right font-medium text-blue-300">
                                                <?= number_format($product['product']->price * $product['quantity'], 0, ',', '.') ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot class="bg-gray-900/50">
                                    <tr>
                                        <td colspan="3" class="p-4 text-right font-medium">Tổng cộng:</td>
                                        <td class="p-4 text-right font-bold text-blue-300">
                                            <?= number_format($invoice['invoice']->totalAmount, 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endforeach; ?>
    </div>

    <script>
        function toggleDetails(elementId, button) {
    const element = document.getElementById(elementId);
    
    // If we're opening this detail section
    if (element.classList.contains('hidden')) {
        // First close any open detail sections
        document.querySelectorAll('.detail-section:not(.hidden)').forEach(section => {
            if (section.id !== elementId) {
                // Hide the section
                section.classList.add('hidden');
                
                // Find and reset the corresponding button
                const sectionId = section.id;
                const buttonSelector = `button[onclick*="${sectionId}"]`;
                const otherButton = document.querySelector(buttonSelector);
                
                if (otherButton) {
                    otherButton.textContent = 'Xem chi tiết';
                    otherButton.classList.remove('text-red-400', 'bg-red-500/10', 'active');
                    otherButton.classList.add('text-blue-400', 'bg-blue-500/10');
                    otherButton.classList.add('hover:bg-blue-500/20');
                    otherButton.classList.remove('hover:bg-red-500/20');
                }
            }
        });
        
        // Now open the requested section
        element.classList.remove('hidden');
        button.textContent = 'Ẩn chi tiết';
        button.classList.remove('text-blue-400', 'bg-blue-500/10');
        button.classList.add('text-red-400', 'bg-red-500/10', 'active');
        button.classList.add('hover:bg-red-500/20');
        button.classList.remove('hover:bg-blue-500/20');
    } else {
        // Closing this detail section
        element.classList.add('hidden');
        button.textContent = 'Xem chi tiết';
        button.classList.remove('text-red-400', 'bg-red-500/10', 'active');
        button.classList.add('text-blue-400', 'bg-blue-500/10');
        button.classList.add('hover:bg-blue-500/20');
        button.classList.remove('hover:bg-red-500/20');
    }
}
        
        function switchChart(chartId) {
            // Ẩn tất cả các tab và chart
            document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.chart-card').forEach(card => card.classList.remove('active'));
            
            // Hiện tab và chart được chọn
            if (chartId === 'barChart') {
                document.querySelector('.tab:nth-child(1)').classList.add('active');
                document.getElementById('barChartCard').classList.add('active');
            } else if (chartId === 'pieChart') {
                document.querySelector('.tab:nth-child(2)').classList.add('active');
                document.getElementById('pieChartCard').classList.add('active');
            }
        }
        
        // Khởi tạo biểu đồ khi trang được tải
document.addEventListener('DOMContentLoaded', function() {
    // Lấy dữ liệu từ bảng
    const userData = [];
    const labels = [];
    const amounts = [];
    const colors = [
        'rgba(245, 158, 11, 0.8)',  // Amber
        'rgba(16, 185, 129, 0.8)',  // Emerald
        'rgba(59, 130, 246, 0.8)',  // Blue
        'rgba(139, 92, 246, 0.8)',  // Purple
        'rgba(236, 72, 153, 0.8)',  // Pink
        'rgba(248, 113, 113, 0.8)', // Red
        'rgba(251, 191, 36, 0.8)',  // Yellow
        'rgba(52, 211, 153, 0.8)',  // Teal
        'rgba(96, 165, 250, 0.8)',  // Light Blue
        'rgba(167, 139, 250, 0.8)'  // Indigo
    ];
    
    // Lấy dữ liệu từ bảng
    document.querySelectorAll('tbody tr').forEach((row, index) => {
        const name = row.querySelector('td:nth-child(2)').textContent.trim();
        const amountText = row.querySelector('td:nth-child(3)').textContent.trim().replace('₫', '').replace(/\./g, '').replace(/,/g, '');
        const amount = parseInt(amountText, 10);
        
        // Chỉ lấy các giá trị có chi tiêu lớn hơn 100000 VND
        if (amount > 100000) {
            labels.push(name);
            amounts.push(amount);
        }
    });
    
    // Biểu đồ cột
    const barCtx = document.getElementById('barChart').getContext('2d');
    const barChart = new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Tổng chi tiêu (VND)',
                data: amounts,
                backgroundColor: colors,
                borderColor: colors.map(color => color.replace('0.8', '1')),
                borderWidth: 1,
                borderRadius: 6,
                maxBarThickness: 50
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    titleColor: '#e2e8f0',
                    bodyColor: '#e2e8f0',
                    borderColor: 'rgba(255, 255, 255, 0.1)',
                    borderWidth: 1,
                    padding: 12,
                    boxPadding: 6,
                    usePointStyle: true,
                    callbacks: {
                        label: function(context) {
                            return `Chi tiêu: ${new Intl.NumberFormat('vi-VN').format(context.raw)} VND`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        color: '#94a3b8',
                        font: {
                            family: "'Plus Jakarta Sans', sans-serif",
                        }
                    }
                },
                y: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.05)',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#94a3b8',
                        font: {
                            family: "'Plus Jakarta Sans', sans-serif",
                        },
                        callback: function(value) {
                            return new Intl.NumberFormat('vi-VN', { 
                                notation: 'compact',
                                compactDisplay: 'short'
                            }).format(value);
                        }
                    }
                }
            }
        }
    });
    
    // Biểu đồ tròn
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: amounts,
                backgroundColor: colors,
                borderColor: 'rgba(30, 41, 59, 0.8)',
                borderWidth: 2,
                hoverOffset: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        color: '#e2e8f0',
                        font: {
                            family: "'Plus Jakarta Sans', sans-serif",
                            size: 12
                        },
                        padding: 15,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    titleColor: '#e2e8f0',
                    bodyColor: '#e2e8f0',
                    borderColor: 'rgba(255, 255, 255, 0.1)',
                    borderWidth: 1,
                    padding: 12,
                    boxPadding: 6,
                    usePointStyle: true,
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((context.raw / total) * 100);
                            return `${context.label}: ${new Intl.NumberFormat('vi-VN').format(context.raw)} VND (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
});
    </script>
</body>
</html>
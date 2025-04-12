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
    <title>Thông Báo</title>
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
        button:focus {
            outline: none;
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
        
        /* Notification card styling */
        .notification-card {
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        
        .notification-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
        }
        
        .notification-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            transition: all 0.3s;
        }
        
        .notification-card.success::before {
            background: linear-gradient(to bottom, #4F46E5, #8B5CF6);
        }
        
        .notification-card.danger::before {
            background: linear-gradient(to bottom, #EF4444, #F87171);
        }
        
        .notification-card:hover::before {
            width: 6px;
        }
        
        /* Label values */
        .label-status {
            display: inline-block;
            padding: 0.1rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .label-status.success {
            background-color: rgba(5, 150, 105, 0.1);
            color: #10B981;
        }
        
        .label-status.danger {
            background-color: rgba(220, 38, 38, 0.1);
            color: #EF4444;
        }
        
        /* Button styles */
        .btn-delete {
            background: linear-gradient(to right, #DC2626, #B91C1C);
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        
        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
        }
        
        .btn-download {
            background: linear-gradient(to right, #10B981, #059669);
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        
        .btn-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }
        
        /* Empty state styling */
        .empty-state {
            opacity: 0.7;
            transition: all 0.3s;
        }
        
        .empty-state:hover {
            opacity: 1;
        }
    </style>
</head>

<body class="text-gray-200 min-h-screen py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="bg-gray-800 backdrop-filter backdrop-blur-sm bg-opacity-90 rounded-xl overflow-hidden shadow-2xl p-8 animate__animated animate__fadeIn">
            <h1 class="text-3xl font-bold text-center mb-2 bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400">
                Thông Báo Của Bạn
            </h1>
            <p class="text-center text-gray-400 mb-8">
                Theo dõi tình trạng đơn hàng và thông báo hệ thống
            </p>

            <!-- Invoice Notifications -->
            <?php if (!empty($DataInvoice)): ?>
                <div class="space-y-4 mb-8">
                    <h2 class="text-xl font-semibold text-indigo-300 mb-4 pl-2 border-l-4 border-indigo-500">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Hóa Đơn
                    </h2>
                    
                    <?php foreach($DataInvoice as $items): ?>
                        <div class="notification-card <?php echo $items['Data']->Status == 1 ? 'success' : 'danger'; ?> bg-gray-800 backdrop-filter backdrop-blur-sm bg-opacity-90 rounded-lg shadow-lg overflow-hidden animate__animated animate__fadeInUp">
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-xl font-semibold flex items-center">
                                        <?php if ($items['Data']->Status == 1): ?>
                                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        <?php else: ?>
                                            <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        <?php endif; ?>
                                        <span class="text-indigo-200">
                                            <?php 
                                            echo $items['Data']->Status == 1 ? 'Đơn Hàng Đã Giao Thành Công' : 'Đơn Hàng Đã Hủy';
                                            ?>
                                        </span>
                                        <span class="ml-2 label-status <?php echo $items['Data']->Status == 1 ? 'success' : 'danger'; ?>">
                                            Đơn #<?php echo $items['Data']->InvoiceID; ?>
                                        </span>
                                    </h2>
                                    <form action="?controller=Notification" method="POST">
                                        <input type="hidden" name="action" value="Delete">
                                        <input type="hidden" name="IdDelete" value="<?php echo $items['Data']->InvoiceID?>">
                                        <button type="submit" class="btn-delete text-white px-4 py-2 rounded-lg shadow transition duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-800 btn-glow flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Xóa
                                        </button>
                                    </form>
                                </div>
                                
                                <div class="mb-6 bg-gray-700 bg-opacity-50 p-4 rounded-lg">
                                    <p class="text-gray-300"><?php echo $items['Data']->Content?></p>
                                </div>

                                <div class="flex justify-between items-center">
                                    <form action="?controller=Notification" method="POST">
                                        <input type="hidden" name="action" value="TakeFile">
                                        <input type="hidden" name="URL" value="<?php echo $items['Link'] ?>">
                                        <button type="submit" class="btn-download text-white px-4 py-2 rounded-lg shadow transition duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-800 btn-glow flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                            </svg>
                                            Tải Hóa Đơn
                                        </button>
                                    </form>
                                    <span class="text-sm text-indigo-300 bg-indigo-900 bg-opacity-20 px-3 py-1 rounded-full">
                                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <?php echo $items['Data']->Time?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif ?>

            <!-- Regular Notifications -->
            <?php if (!empty($data)): ?>
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-indigo-300 mb-4 pl-2 border-l-4 border-indigo-500">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        Thông Báo Hệ Thống
                    </h2>
                    
                    <?php foreach($data as $items): ?>
                        <div class="notification-card <?php echo $items->Status == 1 ? 'success' : 'danger'; ?> bg-gray-800 backdrop-filter backdrop-blur-sm bg-opacity-90 rounded-lg shadow-lg overflow-hidden animate__animated animate__fadeInUp">
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-xl font-semibold flex items-center">
                                        <?php if ($items->Status == 1): ?>
                                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        <?php else: ?>
                                            <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        <?php endif; ?>
                                        <span class="text-indigo-200">
                                            <?php 
                                            echo $items->Status == 1 ? 'Đơn Hàng Đã Giao Thành Công' : 'Đơn Hàng Đã Hủy';
                                            ?>
                                        </span>
                                        <span class="ml-2 label-status <?php echo $items->Status == 1 ? 'success' : 'danger'; ?>">
                                            Đơn #<?php echo $items->InvoiceID; ?>
                                        </span>
                                    </h2>
                                    <form action="?controller=Notification" method="POST">
                                        <input type="hidden" name="action" value="Delete">
                                        <input type="hidden" name="IdDelete" value="<?php echo $items->ID?>">
                                        <button type="submit" class="btn-delete text-white px-4 py-2 rounded-lg shadow transition duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-800 btn-glow flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Xóa
                                        </button>
                                    </form>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <p class="text-gray-300 bg-gray-700 bg-opacity-50 p-3 rounded-lg"><?php echo $items->Content?></p>
                                    <span class="text-sm text-indigo-300 bg-indigo-900 bg-opacity-20 px-3 py-1 rounded-full ml-4">
                                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <?php echo $items->Time?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
            
            <?php if (empty($DataInvoice) && empty($data)): ?>
                <div class="text-center py-12 empty-state">
                    <svg class="w-16 h-16 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <h3 class="text-xl font-medium text-gray-400 mb-2">Không có thông báo nào</h3>
                    <p class="text-gray-500">Các thông báo mới sẽ xuất hiện tại đây</p>
                </div>
            <?php endif ?>
        </div>
    </div>

    <script>
        // Animation on page load
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.notification-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>
<?php
require_once './views/footer.php';
?>
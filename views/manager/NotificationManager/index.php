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
    <title>Xóa Đơn Hàng</title>
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
        input:focus, textarea:focus, button:focus {
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
        
        /* Input styling */
        .input-field {
            transition: all 0.3s;
            background-color: rgba(55, 65, 81, 0.8);
        }
        
        .input-field:focus-within {
            background-color: rgba(55, 65, 81, 1);
            box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.3);
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
            background: linear-gradient(to top, rgba(248, 113, 113, 0.2), transparent);
            z-index: -1;
            transition: height 0.3s ease-out;
        }
        
        .btn-glow:hover:after {
            height: 100%;
        }
        
        /* Form wrapper styling */
        .form-wrapper {
            position: relative;
            overflow: hidden;
        }
        
        .form-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(to right, #EF4444, #F87171);
        }
        
        /* Label values */
        .label-value {
            display: inline-block;
            padding: 0.1rem 0.5rem;
            border-radius: 0.25rem;
            background-color: rgba(239, 68, 68, 0.1);
            color: #F87171;
        }
        
        /* Warning box */
        .warning-box {
            background-color: rgba(220, 38, 38, 0.05);
            border-left: 3px solid #EF4444;
        }
    </style>
</head>

<body class="text-gray-200 min-h-screen py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6">
        <div class="bg-gray-800 backdrop-filter backdrop-blur-sm bg-opacity-90 rounded-xl overflow-hidden shadow-2xl p-8 animate__animated animate__fadeIn form-wrapper">
            <h1 class="text-3xl font-bold text-center mb-2 bg-clip-text text-transparent bg-gradient-to-r from-red-400 to-pink-400">
                Xóa Đơn Hàng
            </h1>
            <p class="text-center text-gray-400 mb-8">
                Vui lòng cung cấp lý do xóa đơn hàng
            </p>
            
            <div class="warning-box p-4 mb-6 rounded-lg">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-red-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <p class="text-sm text-red-200">
                        Lưu ý: Hành động này không thể hoàn tác. Đơn hàng sẽ bị xóa vĩnh viễn khỏi hệ thống.
                    </p>
                </div>
            </div>
            
            <form action="/?controller=NotificationManager" method="POST" class="space-y-6">
                <input type="hidden" name="action" value="DeleteOder">

                <div class="space-y-3">
                    <label for="oderID" class="block text-sm font-medium text-red-300 mb-2 flex justify-between">
                        <span>
                            <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Mã Đơn Hàng
                        </span>
                        <span class="label-value ml-2">#<?php echo $IdOder ?></span>
                    </label>
                    <div class="input-field rounded-lg p-3 flex items-center">
                        <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <input type="number" readonly id="oderID" name="oderID" value="<?php echo $IdOder ?>" class="w-full bg-transparent text-red-200" required>
                    </div>
                </div>

                <div class="space-y-3">
                    <label for="userID" class="block text-sm font-medium text-red-300 mb-2 flex justify-between">
                        <span>
                            <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Mã Khách Hàng
                        </span>
                        <span class="label-value ml-2">#<?php echo $IdUser ?></span>
                    </label>
                    <div class="input-field rounded-lg p-3 flex items-center">
                        <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <input type="number" readonly id="userID" name="userID" value="<?php echo $IdUser ?>" class="w-full bg-transparent text-red-200" required>
                    </div>
                </div>

                <div class="space-y-3">
                    <label for="content" class="block text-sm font-medium text-red-300 mb-2">
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Lý Do Xóa Đơn Hàng
                    </label>
                    <div class="input-field rounded-lg p-3 flex">
                        <textarea id="content" name="content" required class="w-full bg-transparent text-red-200 resize-none" placeholder="Nhập lý do xóa đơn hàng..." rows="4"></textarea>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Vui lòng cung cấp lý do cụ thể để thông báo cho khách hàng.</p>
                </div>
              
                <div class="flex justify-end mt-10">
                    <button type="submit" class="bg-gradient-to-r from-red-600 to-pink-600 text-white font-medium py-3 px-8 rounded-lg shadow-lg transition duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-800 btn-glow flex items-center">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Xác Nhận Xóa
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
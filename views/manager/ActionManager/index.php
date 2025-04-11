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
    <title>Action Manager</title>
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
        
        /* Table styling */
        .table-container {
            overflow-x: auto;
            border-radius: 0.75rem;
            background-color: rgba(31, 41, 55, 0.8);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        table {
            min-width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        thead {
            position: sticky;
            top: 0;
            z-index: 10;
        }
        
        th {
            background-color: rgba(55, 65, 81, 0.9);
            color: #D1D5DB;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            padding: 0.75rem 1rem;
            text-align: left;
        }
        
        th:first-child {
            border-top-left-radius: 0.5rem;
        }
        
        th:last-child {
            border-top-right-radius: 0.5rem;
        }
        
        tr {
            transition: background-color 0.2s;
        }
        
        tbody tr {
            border-bottom: 1px solid rgba(75, 85, 99, 0.2);
        }
        
        tbody tr:last-child {
            border-bottom: none;
        }
        
        td {
            padding: 0.75rem 1rem;
            color: #E5E7EB;
            font-size: 0.875rem;
        }
        
        /* Status colors */
        .status-login {
            color: #10B981;
            font-weight: 600;
        }
        
        .status-logout {
            color: #FBBF24;
            font-weight: 600;
        }
        
        .status-add {
            color: #3B82F6;
            font-weight: 600;
        }
        
        .status-delete {
            color: #EF4444;
            font-weight: 600;
        }
    </style>
</head>
<body class="text-gray-200 min-h-screen py-6">
    <div class="container mx-auto px-4 sm:px-6 max-w-6xl">
        <div class="bg-gray-800 backdrop-filter backdrop-blur-sm bg-opacity-90 rounded-xl overflow-hidden shadow-2xl p-6 mb-8">
            <h1 class="text-3xl font-bold text-center mb-2 bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400">Action Manager</h1>
            <p class="text-gray-400 text-center mb-6">Theo dõi hoạt động của người dùng trên hệ thống</p>

            <div class="table-container mt-6">
                <table>
                    <thead>
                        <tr>
                            <th>UserID</th>
                            <th>Thời gian đăng nhập</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $items): ?>
                            <tr class="hover:bg-gray-700">
                                <td><?php echo $items->UserID ?></td>
                                <td><?php echo $items->TimeLogin ?></td>
                                <td class="
                                <?php 
                                    if ($items->Action === 'Login') {
                                        echo 'status-login';
                                    } elseif ($items->Action === 'Logout') {
                                        echo 'status-logout';
                                    } elseif ($items->Action === 'Add') {
                                        echo 'status-add';
                                    } elseif ($items->Action === 'Delete' || $items->Action === 'Delete Oder') {
                                        echo 'status-delete';
                                    }
                                ?>">
                                    <?php echo $items->Action ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
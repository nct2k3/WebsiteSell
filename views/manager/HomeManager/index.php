<?Php
require_once './controllers/HeadermanagerController.php';
$controller = new HeadermanagerController();
$controller->index();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sản Phẩm Điện Thoại</title>
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
        input:focus,
        select:focus,
        button:focus {
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
            transition: all 0.3s;
            background-color: rgba(55, 65, 81, 0.8);
        }

        .input-field:focus-within {
            background-color: rgba(55, 65, 81, 1);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.3);
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
            background: linear-gradient(to top, rgba(59, 130, 246, 0.2), transparent);
            z-index: -1;
            transition: height 0.3s ease-out;
        }

        .btn-glow:hover:after {
            height: 100%;
        }

        /* Card hover effect */
        .product-card {
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
        }

        /* Pagination styling */
        .pagination-item {
            transition: all 0.2s;
        }

        .pagination-item:hover {
            transform: scale(1.05);
        }

        /* Hidden product styling */
        .hidden-product {
            position: relative;
        }

        .hidden-product::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(17, 24, 39, 0.2);
            backdrop-filter: blur(1px);
            z-index: 1;
            pointer-events: none;
        }

        /* Product info styling */
        .product-info {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.25rem;
        }

        /* Badge styling */
        .status-badge {
            display: inline-flex;
            align-items: center;
            border-radius: 9999px;
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 500;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .badge-active {
            background-color: rgba(16, 185, 129, 0.1);
            color: #10B981;
        }

        .badge-hidden {
            background-color: rgba(239, 68, 68, 0.1);
            color: #EF4444;
        }
    </style>
</head>

<body class="text-gray-200 min-h-screen py-6">
    <div class="container mx-auto px-4 sm:px-6 max-w-6xl">
        <div
            class="bg-gray-800 backdrop-filter backdrop-blur-sm bg-opacity-90 rounded-xl overflow-hidden shadow-2xl p-6 mb-8 animate__animated animate__fadeIn">
            <h1
                class="text-3xl font-bold text-center mb-2 bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400">
                Danh Sách Sản Phẩm</h1>
            <p class="text-gray-400 text-center mb-6">Quản lý và chỉnh sửa thông tin sản phẩm</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="md:col-span-1">
                    <div class="space-y-2">
                        <label for="productLine" class="block text-sm font-medium text-indigo-300">Dòng Sản Phẩm</label>
                        <div class="input-field rounded-lg">
                            <select id="productLine" name="productLine" required onchange="filterByLine(this.value)"
                                class="w-full bg-transparent text-indigo-200 p-3">
                                <option value="" class="bg-gray-800 text-gray-200">Chọn dòng sản phẩm</option>
                                <?php foreach ($dataLineProduct as $items): ?>
                                    <option value="<?php echo $items->ProductLineID ?>"
                                        <?php echo (isset($productLineID) && $productLineID == $items->ProductLineID) ? 'selected' : ''; ?>
                                        class="bg-gray-800 text-gray-200"><?php echo $items->ProductLineName ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <?php if (isset($productLineID)): ?>
                            <div class="mt-2">
                                <a href="?controller=homeManager" class="text-indigo-400 text-sm hover:text-indigo-300 inline-flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    Xóa bộ lọc
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <form action="?controller=homeManager" method="POST" class="space-y-4">
                        <input type="hidden" name="action" value="search">
                        <div class="space-y-2">
                            <label for="string" class="block text-sm font-medium text-indigo-300">Tìm kiếm sản
                                phẩm</label>
                            <div class="flex">
                                <div class="input-field rounded-l-lg flex-grow flex items-center p-3">
                                    <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    <input placeholder="Nhập tên sản phẩm cần tìm..." id="string" name="string"
                                        class="w-full bg-transparent text-indigo-200" type="text"
                                        value="<?php echo isset($searchTerm) ? htmlspecialchars($searchTerm) : ''; ?>">
                                </div>
                                <button type="submit"
                                    class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-6 rounded-r-lg transition duration-300">
                                    Tìm
                                </button>
                            </div>
                            <?php if (isset($searchTerm)): ?>
                                <div class="mt-2">
                                    <a href="?controller=homeManager" class="text-indigo-400 text-sm hover:text-indigo-300 inline-flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                        </svg>
                                        Xóa tìm kiếm
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>

            <div class="space-y-6 mt-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <?php if (!empty($data)): ?>
                        <?php foreach ($data as $item): ?>
                            <!-- Updated product card structure with buttons at the bottom -->
                            <!-- Updated product card to match the reference image -->
                            <div
                                class="product-card <?php echo ($item->Status == 1) ? 'hidden-product' : ''; ?> bg-gray-800 bg-opacity-90 rounded-xl overflow-hidden shadow-md flex flex-col">
                                <!-- Product info section -->
                                <div class="p-4">
                                    <div class="flex">
                                        <!-- Product image -->
                                        <img src="<?php echo $item->img ?>" alt="Sản phẩm"
                                            class="h-20 w-20 object-cover rounded-lg mr-4 flex-shrink-0">

                                        <!-- Product details -->
                                        <div class="flex-grow min-w-0">
                                            <div class="flex items-start justify-between">
                                                <!-- Product name and code -->
                                                <div>
                                                    <h3 class="text-lg font-semibold text-indigo-200 truncate pr-2 w-64">
                                                        <?php echo $item->productName ?>
                                                    </h3>
                                                    <span class="text-gray-400 text-sm">Mã:
                                                        <?php echo $item->productID ?></span>
                                                </div>

                                                <!-- Status badge -->
                                                <?php
                                                $NewStatus = "Đang bán";
                                                $statusBadge = "badge-active";
                                                if ($item->Status == 1) {
                                                    $NewStatus = "Tạm ẩn";
                                                    $statusBadge = "badge-hidden";
                                                }
                                                ?>
                                                <span class="status-badge <?php echo $statusBadge; ?> whitespace-nowrap">
                                                    <?php echo $NewStatus ?>
                                                </span>
                                            </div>

                                            <!-- Price information -->
                                            <div class="mt-2">
                                                <span
                                                    class="text-orange-400 font-medium"><?php echo number_format($item->price, 0, ',', '.') ?>
                                                    đ</span>
                                                <span
                                                    class="text-gray-500 line-through text-sm ml-2"><?php echo number_format($item->originalPrice, 0, ',', '.') ?>
                                                    đ</span>
                                            </div>

                                            <!-- Specs -->
                                            <div class="flex flex-wrap gap-x-4 text-sm text-gray-300 mt-2">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 text-indigo-400 mr-1 flex-shrink-0" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10">
                                                        </path>
                                                    </svg>
                                                    <span><?php echo $item->capacity ?></span>
                                                </div>
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 text-indigo-400 mr-1 flex-shrink-0" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01">
                                                        </path>
                                                    </svg>
                                                    <span><?php echo $item->color ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Button section at the bottom -->
                                <div class="mt-auto p-3 border-t border-gray-700 flex justify-center space-x-4">
                                    <button
                                        onclick="window.location='/?controller=EditProduct&id=<?php echo $item->productID ?>'"
                                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition-colors duration-300 btn-glow w-1/2 flex items-center justify-center h-10">
                                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                        Sửa
                                    </button>
                                    <form action="/?controller=homeManager&action=deleteProduct" method="POST"
                                        onsubmit="return confirmDelete('<?php echo htmlspecialchars(addslashes($item->productName)); ?>')"
                                        class="w-1/2 flex">
                                        <input type="hidden" name="id"
                                            value="<?php echo htmlspecialchars($item->productID); ?>">
                                        <!-- Truyền thêm tham số cho trang hiện tại khi xóa -->
                                        <?php if (isset($productLineID)): ?>
                                            <input type="hidden" name="lineID" value="<?php echo htmlspecialchars($productLineID); ?>">
                                        <?php endif; ?>
                                        <?php if (isset($searchTerm)): ?>
                                            <input type="hidden" name="string" value="<?php echo htmlspecialchars($searchTerm); ?>">
                                        <?php endif; ?>
                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 rounded-lg transition-colors duration-300 btn-glow w-full flex items-center justify-center h-10">
                                            <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                            Xóa
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach ?>
                    <?php else: ?>
                        <div class="col-span-2 py-16 text-center text-gray-400 bg-gray-700 bg-opacity-50 rounded-xl">
                            <svg class="w-16 h-16 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <p class="text-xl">Không tìm thấy sản phẩm nào</p>
                            <p class="text-gray-500 mt-2">Vui lòng thử tìm kiếm với từ khóa khác hoặc chọn dòng sản phẩm
                                khác</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (isset($numpage) && $numpage > 0): ?>
                <div class="flex justify-center p-6 mt-4">
                    <div class="flex flex-wrap justify-center">
                        <?php for ($i = 1; $i <= $numpage; $i++): ?>
                            <?php
                            // Tạo URL chính xác dựa trên trường hợp: tìm kiếm, lọc hoặc hiển thị danh sách thông thường
                            if (isset($searchTerm)) {
                                $pageUrl = '?controller=homeManager&action=search&string=' . urlencode($searchTerm) . '&page=' . $i;
                            } else if (isset($productLineID)) {
                                $pageUrl = '?controller=homeManager&action=filter&lineID=' . urlencode($productLineID) . '&page=' . $i;
                            } else {
                                $pageUrl = '?controller=homeManager&page=' . $i;
                            }
                            ?>
                            <button onclick="window.location.href = '<?php echo $pageUrl; ?>'"
                                class="pagination-item h-10 w-10 mx-1 flex items-center justify-center rounded-lg <?php echo (isset($_GET['page']) && $_GET['page'] == $i) ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600'; ?> transition-colors duration-300">
                                <?php echo $i; ?>
                            </button>
                        <?php endfor; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

<script>
    function confirmDelete(productName) {
        return confirm(`Bạn có chắc chắn muốn xóa sản phẩm "${productName}" không?`);
    }
    
    function filterByLine(lineID) {
        if (lineID) {
            window.location.href = '?controller=homeManager&action=filter&lineID=' + lineID + '&page=1';
        }
    }
</script>

</html>
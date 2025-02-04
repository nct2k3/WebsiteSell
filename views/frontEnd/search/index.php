<?php
require_once './controllers/HeaderController.php';
$controller = new HeaderController();
$controller->index();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Header</title>
    <style>
        @keyframes fadeOut {
            0% { opacity: 1; }
            100% { opacity: 0; }
        }
        .fade-out {
            animation: fadeOut 0.5s forwards;
        }

        body {
            overflow-y: auto; /* Đảm bảo có thanh cuộn dọc */
        }

      
    </style>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-600">
    <div id="search" class="px-8 text-white">
        <div class="text-center font-bold text-2xl my-2">Search Product</div>
        <form action="?controller=search" method="POST" class="space-y-4">
            <input type="hidden" name="action" value="search">
            <div class="flex">
                <input id="string" name="string" class="h-10  rounded-l-full p-2 text-black w-full" type="text">
                <button class="bg-gray-500 h-10 w-16 rounded-r-full hover:bg-gray-800">
                    <img class="h-10 p-2" src="https://img.icons8.com/?size=100&id=7695&format=png&color=ffffff" alt="Icon">
                </button>
            </div>
        </form>

        <?php if (!empty($data)): ?>
            <?php foreach ($data as $product): ?>
            <div
            onclick="window.location='?controller=DetailProduct&items=<?php echo $product->productID; ?>'"
             class="mt-2 p-2">
                <div class="rounded w-full flex flex-wrap hover:bg-gray-800 hover:opacity-75 border-b border-gray-500">
                    <div class="py-2 px-2">
                        <img class="h-12 w-12 sm:h-16 sm:w-16 object-cover" src="<?php echo $product->img ?>">
                    </div>
                    <h class="flex py-2 px-2 mt-3">
                        <div class="font-bold">Name Product:</div>
                        <div class="px-2"><?php echo $product->productName ?></div>
                    </h>
                    <h class="flex py-2 px-2 mt-3">
                        <div class="font-bold">Product:</div>
                        <div class="px-2"><?php echo htmlspecialchars(number_format($product->price, 0, ',', '.')) . '₫'; ?></div>
                    </h>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            
            <p class="text-center font-bold mt-4 text-red-500">There are no products found</p>
        <?php endif; ?>
    </div>
</body>
</html>
<?php
require_once './views/footer.php';
?>
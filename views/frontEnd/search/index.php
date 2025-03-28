<?php
require_once './controllers/HeaderController.php';

$controller = new HeaderController();
$controller->index();
$id = isset($_GET['items']) ? $_GET['items'] : 1;
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$searchString = $_GET['string'] ?? '';
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
            overflow-y: auto;
        }

      
    </style>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-600 ">
    <div id="search" class="px-8 text-white">
        <div class="text-center font-bold text-2xl my-2">Search Product</div>
        <form action="" method="GET" class="space-y-4">
            <input type="hidden" name="controller" value="search">
            <input type="hidden" name="action" value="search">
            <div class="flex">
                <input id="string" name="string" 
                    value="<?php echo isset($_GET['string']) ? htmlspecialchars($_GET['string']) : ''; ?>"  
                    required class="h-10 rounded-l-full p-2 text-black w-full" type="text">
                <button class="bg-gray-500 h-10 w-16 rounded-r-full hover:bg-gray-800">
                    <img class="h-10 p-2" src="https://img.icons8.com/?size=100&id=7695&format=png&color=ffffff" alt="Icon">
                </button>
            </div>
        </form>


            <div class="row">
                <div class="col-2"></div>
                <div class="col-6 flex flex-wrap gap-2 p-2">
                    <?php if (isset($productLineName) && $productLineName != '' && !empty($productLineName)): ?>
                        <div class="text-sm border px-4 py-2 rounded-md"><?php echo htmlspecialchars($productLineName['ProductLineName']); ?></div>
                    <?php endif; ?>
                    <?php if (isset($FromAdd) && $FromAdd != '' && $FromAdd != 0): ?>
                        <div class="text-sm border px-4 py-2 rounded-md">From: <?php echo number_format($FromAdd, 0, ',', '.') . '₫'; ?></div>
                    <?php endif; ?>
                    <?php if (isset($ToAdd) && $ToAdd != '' && $ToAdd != 0): ?>
                        <div class="text-sm border px-4 py-2 rounded-md">To: <?php echo number_format($ToAdd, 0, ',', '.') . '₫'; ?></div>
                    <?php endif; ?>
                    <?php if ((isset($productLineName) && $productLineName != '') || (isset($FromAdd) && $FromAdd != '' && $FromAdd != 0) || (isset($ToAdd) && $ToAdd != '' && $ToAdd != 0)): ?>
                        <div 
                            onclick="window.location='?controller=search&action=CleanAll'"
                            class="text-sm border px-4 py-2 rounded-md hover:text-red-500">Clean all</div>
                    <?php endif; ?>
                </div>
                <button id="btnSearchWithConditions" class="text-sm col-3 btn btn-primary m-2">Search with conditions</button>
            </div>

            <div id="SearchWithConditions" class="w-full hidden">
                <form action="" method="GET" class="space-y-4">
                    <input type="hidden" name="controller" value="search">
                    <input type="hidden" name="action" value="searchWithConditions">
                    <div class="flex flex-wrap">
                        <select id="ProductLine" name="ProductLine" class="mx-2 text-black border text-sm block px-4 py-2 rounded-md">
                            <option value="" selected>Line Product</option>
                            <?php foreach ($dataLineProduct as $items): ?>
                                <option value="<?php echo $items->ProductLineID ?>"><?php echo $items->ProductLineName ?></option>
                            <?php endforeach ?>
                        </select>
                        <input name="From" class="mx-2 text-black h-10 border text-sm px-4 py-2 rounded-md w-1/3" type="number" placeholder="From" min="0" />
                        <input name="To" class="mx-2 text-black h-10 border text-sm px-4 py-2 rounded-md w-1/3" type="number" placeholder="To" min="0" />
                        <button type="submit" class="mx-2 btn h-10 btn-primary px-6 text-white bg-blue-600 hover:bg-blue-700 rounded-md">
                            Accept
                        </button>
                    </div>
                </form>
            </div>
            
        <?php if (!empty($dataPrd)): ?>
            <div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-0 p-0">
                    <?php foreach ($dataPrd as $productData):?>

                        <div class="w-auto bg-gray-800 rounded-2xl shadow-lg p-5 text-center hover:bg-gray-700 m-4"
                        onclick="window.location='?controller=DetailProduct&items=<?php echo $productData->productID; ?>'"
                        >
                            <a class="hidden"><?php echo htmlspecialchars($productData->productID); ?></a>
                            <img class="mx-auto w-40 h-40" src="<?php echo htmlspecialchars($productData->img); ?>" alt="<?php echo htmlspecialchars($productData->productName); ?>">
                            <h2 class="text-lg font-bold mt-4"><?php echo htmlspecialchars($productData->productName); ?></h2>
                            <div class="flex justify-center space-x-2 mt-3">
                                <?php echo $productData->capacity?>
                            </div>
                            <div class="mt-4">
                                <p class="text-xl font-bold text-yellow-400"><?php echo number_format($productData->price); ?>₫</p>
                                <p class="text-sm line-through text-gray-400"><?php echo number_format($productData->originalPrice); ?>₫</p>
                            </div>
                            <p class="text-orange-500 font-semibold mt-2">Online giá rẻ quá</p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            
            <p class="text-center font-bold mt-4 text-red-500">There are no products found</p>
        <?php endif; ?>
    </div>
    <div class="flex justify-center m-20 space-x-2">
    
    <?php if (isset($numpage) && $numpage > 1): ?>
    <?php 
       $controller = isset($_GET['controller']) && !empty($_GET['controller']) ? $_GET['controller'] : 'search';
       $action = isset($_GET['action']) && !empty($_GET['action']) ? $_GET['action'] : 'search';
        $string = isset($_GET['string']) ? $_GET['string'] : '';
        $productLine = isset($_SESSION['ProductLineSearch']) ? $_SESSION['ProductLineSearch'] : '';
        $from = isset($_SESSION['From']) ? $_SESSION['From'] : '';
        $to = isset($_SESSION['To']) ? $_SESSION['To'] : '';

        
        function buildUrl($page, $controller, $action, $string, $productLine, $from, $to) {
            return "?controller=" . urlencode($controller) . 
                   "&action=" . urlencode($action) . 
                   "&string=" . urlencode($string) . 
                   "&ProductLine=" . urlencode($productLine) . 
                   "&From=" . urlencode($from) . 
                   "&To=" . urlencode($to) . 
                   "&page=" . intval($page);
        }
        
    ?>

    <?php if ($currentPage > 1): ?>
        <a href="<?php echo buildUrl($currentPage - 1, $controller, $action, $string, $productLine, $from, $to);
 ?>" 
           class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600">
            Previous
        </a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $numpage; $i++): ?>
        <a href="<?php echo buildUrl($i, $controller, $action, $string, $productLine, $from, $to); ?>" 
           class="px-4 py-2 <?php echo ($i == $currentPage) ? 'bg-yellow-400 text-black' : 'bg-gray-700 text-white'; ?> rounded-lg hover:bg-gray-600">
            <?php echo $i; ?>
        </a>
    <?php endfor; ?>

    <?php if ($currentPage < $numpage): ?>
        <a href="<?php echo buildUrl($currentPage + 1, $controller, $action, $string, $productLine, $from, $to); ?>" 
           class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600">
            Next
        </a>
    <?php endif; ?>
<?php endif; ?>

</div>
</body>
<script>

    const btnSearchWithConditions = document.getElementById('btnSearchWithConditions');
    const searchConditionsDiv = document.getElementById('SearchWithConditions');
  
    btnSearchWithConditions.addEventListener('click', function () {
        if (searchConditionsDiv.classList.contains('hidden')) {
            searchConditionsDiv.classList.remove('hidden'); 
        } else {
            searchConditionsDiv.classList.toggle('hidden'); 
        }
    });
</script>

</html>

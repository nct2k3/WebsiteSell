<?php
require_once './controllers/HeaderController.php';
require_once './controllers/ProductController.php';

$category = isset($_GET['category']) ? $_GET['category'] : 'iphone';
$controller = new HeaderController();
$controller->index();




function renderProductList($products, $category, $numpage, $currentPage) {
    if (!isset($currentPage) || $currentPage < 1) {
        $currentPage = 1;
    }
    $itemsPerPage = 6;
    $startIndex = ($currentPage - 1) * $itemsPerPage;
    $productsOnPage = array_slice($products, $startIndex, $itemsPerPage);

    echo '<div class="flex w-full justify-center p-2 my-2">';
    echo '<img class="h-8" src="https://img.icons8.com/?size=100&id=30840&format=png&color=ffffff" alt="Logo">';
    echo '<div class="text-2xl text-center font-bold text-white">' . ucfirst($category) . '</div>';
    echo '</div>';
    
    echo '<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">';
   

    foreach ($productsOnPage as $item) {
        echo '<div onclick="window.location=\'?controller=DetailProduct&items=' . $item['ProductID'] . '\'" 
                class="bg-gray-800 hover:bg-gray-500 rounded-xl shadow-lg p-6 max-w-xs text-white mx-auto mb-8 mt-4 cursor-pointer">';
        echo '<img class="w-full rounded-lg mb-4" src="' . $item['Img'] . '" alt="' . $item['ProductName'] . '">';
        echo '<h2 class="text-lg font-semibold mb-2">' . $item['ProductName'] . '</h2>';
        echo '<h1 class="font-bold text-xl">' . number_format((float)$item['Price']) . '₫</h1>';
        echo '<h1 class="line-through text-gray-400 text-sm">' . number_format((float)$item['OriginalPrice']) . '₫</h1>';
        echo '</div>';
    }
    
    
    echo '</div>';

    echo '<div class="flex justify-center m-20 space-x-2">';
    if ($numpage > 1) {
        if ($currentPage > 1) {
            echo '<a href="?category=' . urlencode($category) . '&page=' . ($currentPage - 1) . '" 
                    class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600">
                    Previous
                </a>';
        }

        for ($i = 1; $i <= $numpage; $i++) {
            echo '<a href="?category=' . urlencode($category) . '&page=' . $i . '" 
                    class="px-4 py-2 ' . ($i == $currentPage ? 'bg-yellow-400 text-black' : 'bg-gray-700 text-white') . ' 
                    rounded-lg hover:bg-gray-600">
                    ' . $i . '
                </a>';
        }

        if ($currentPage < $numpage) {
            echo '<a href="?category=' . urlencode($category) . '&page=' . ($currentPage + 1) . '" 
                    class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600">
                    Next
                </a>';
        }
    }
    echo '</div>';
    
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My PHP Project</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
      
        .px12{  
            max-height: 300px;
        }
        .mw{
            max-width: 25%;
        }
    </style>
</head>
<body class="bg-gray-900">
    <div id="carouselExampleControls" class="carousel slide bg-gray-900 px-4 py-8" data-ride="carousel">
        <div class="carousel-inner rounded-lg shadow-xl">
            <div class="carousel-item active">
                <img class="d-block w-100" src="https://cdnv2.tgdd.vn/mwg-static/topzone/Banner/d1/36/d136ac139c784757b4f6eedd67295ca8.png" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://cdnv2.tgdd.vn/mwg-static/topzone/Banner/cd/96/cd968911ea2586403e61263b2eea1454.png" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://cdnv2.tgdd.vn/mwg-static/topzone/Banner/dd/6c/dd6c7ef3f25a5e54e2e42f4136382f3a.png" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <?php
        $controller1= new ProductController();
        $iphoneProducts = $controller1->getProductsByCategory(1);
        
        renderProductList($iphoneProducts, 'iphone', $totalPagesIphone, $currentPageIphone);

        $macbookProducts = $controller1->getProductsByCategory(2);
        renderProductList($macbookProducts, 'macbook', $totalPagesMacbook, $currentPageMacbook);

        $ipadProducts = $controller1->getProductsByCategory(5);
        renderProductList($ipadProducts, 'ipad', $totalPagesIPad, $currentPageIPad);

        $watchProducts = $controller1->getProductsByCategory(4);
        renderProductList($watchProducts, 'watch', $totalPagesWatch, $currentPageWatch);
    ?>
    </div> 
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>   
</html>

<?php
require_once './views/footer.php';
?>
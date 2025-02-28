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
            overflow-y: auto;
        }

      
    </style>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-600 ">
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
            <div class=" row ">
                <div class="col-2"></div>
                <div class="col-6 flex flex-wrap gap-2 p-2">
                    <?php if(isset($productLineName)&& $productLineName!=''):?>
                    <div class="text-sm border px-4 py-2 rounded-md"><?php echo $productLineName['ProductLineName']?></div>
                    <?php endif?>
                    <?php if(isset($FromAdd)&& $FromAdd!=0):?>
                    <div class="text-sm border px-4 py-2 rounded-md">From:<?php echo number_format($FromAdd, 0, ',', '.') . '₫' ?> </div>
                    <?php endif?>
                    <?php if(isset($ToAdd)&& $ToAdd!=0):?>
                    <div class="text-sm border px-4 py-2 rounded-md">To:<?php echo number_format($ToAdd, 0, ',', '.') . '₫' ?></div>
                    <?php endif?>
                    <?php if(isset($FromAdd)&& $FromAdd!=0):?>
                    <div 
                    onclick="window.location='?controller=search&action=CleanAll'"
                    class="text-sm border px-4 py-2 rounded-md hover:text-red-500 ">Clean all</div>
                    <?php endif?>
                </div>
                <button id="btnSearchWithConditions" class=" text-sm col-3 btn btn-primary m-2">Search with conditions</button>
            </div>

            <div id="SearchWithConditions" class=" w-full hidden ">   
            <form action="?controller=search" method="POST" class="space-y-4">
            <input type="hidden" name="action" value="searchWithConditions">
                <div class="  flex flex-wrap ">
                    <select id="ProductLine" name="ProductLine"   class=" mx-2 text-black border text-sm block  px-4 py-2 rounded-md ">
                        <option value="" disabled selected>Line Product</option>
                        <?php foreach($dataLineProduct as $items): ?>
                            <option value="<?php echo $items->ProductLineID ?>"><?php echo $items->ProductLineName ?></option>
                        <?php endforeach ?>
                    </select>
                    <input required name="From" class=" mx-2 text-black h-10 border text-sm px-4 py-2 rounded-md w-1/3" type="number" placeholder="From" min="1" />
                    <input required name="To" class=" mx-2 text-black h-10 border text-sm px-4 py-2 rounded-md w-1/3"  type="number" placeholder="To" min="1" />
                    <button type="submit" class="mx-2 btn h-10 btn-primary px-6 text-white bg-blue-600 hover:bg-blue-700 rounded-md">
                        Accept
                    </button>
                </div>
            </from>
            </div>
            
        <?php if (!empty($dataPrd)): ?>
            <?php foreach ($dataPrd as $product): ?>
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

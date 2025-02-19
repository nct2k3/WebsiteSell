<?Php
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
</head>
<body >

    <div
    class="flex justify-center items-center h-20 bg-gray-700 text-white text-2xl"> Your Notification</div>
    <?php foreach($data as $items): ?>
    <?php $color='blue'; if($items->Status == 0)$color='red'; ?>
    <div class="flex  h-auto bg-gray-100 px-6 py-2">
        <div class="h-1/5 w-full bg-white border-l-4 border-<?php echo $color?>-500 pt-6 rounded shadow-md text-center">
            <div class="flex justify-between items-center px-6">
            <h1 class=" font-bold py-1">
                    Notification: 
                    <?php 
                    if ($items->Status == 0) {
                        echo 'Cancel Order'; 
                    } else if ($items->Status == 1) {
                        echo 'Successful delivery'; 
                    }
                    ?>
                    
                    order code: <?php echo $items->InvoiceID?>
                    </h1>
                <a href="#" class="bg-<?php echo $color?>-500 text-sm text-white font-bold py-1 px-4 rounded hover:bg-<?php echo $color?>-700 transition duration-200">Delete Notification</a>
            </div>
            <p class="text-gray-700 mb-2"><?php echo $items->Content?></p>
            <p class="text-gray-100 bg-<?php echo $color?>-500 text-sm ">Time: <?php echo $items->Time?></p>
        </div>
    </div>
    <?php endforeach ?>
</body>
</html>
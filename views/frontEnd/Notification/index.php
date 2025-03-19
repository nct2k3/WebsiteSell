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
</head>
<body class="bg-gradient-to-r from-gray-800 to-black">
    <div class="container mx-auto px-4 py-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white">Your Notifications</h1>
        </div>

        <!-- Invoice Notifications -->
        <?php if (!empty($DataInvoice)): ?>
            <div class="space-y-4">
                <?php foreach($DataInvoice as $items): ?>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="border-l-4 border-blue-500">
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-xl font-semibold">
                                        <?php 
                                        echo $items['Data']->Status == 0 ? 'Order Cancelled' : 'Order Delivered Successfully';
                                        echo " - Order #" . $items['Data']->InvoiceID;
                                        ?>
                                    </h2>
                                    <form action="?controller=Notification" method="POST">
                                        <input type="hidden" name="action" value="Delete">
                                        <input type="hidden" name="IdDelete" value="<?php echo $items['Data']->InvoiceID?>">
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition duration-200">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                                
                                <div class="mb-4">
                                    <p class="text-gray-600"><?php echo $items['Data']->Content?></p>
                                </div>

                                <div class="flex justify-between items-center">
                                    <form action="?controller=Notification" method="POST">
                                        <input type="hidden" name="action" value="TakeFile">
                                        <input type="hidden" name="URL" value="<?php echo $items['Link'] ?>">
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md transition duration-200">
                                            Download Invoice
                                        </button>
                                    </form>
                                    <span class="text-sm text-gray-500">
                                        <?php echo $items['Data']->Time?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endif ?>

        <!-- Regular Notifications -->
        <?php if (!empty($data)): ?>
            <div class="space-y-4 mt-8">
                <?php foreach($data as $items): ?>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="border-l-4 border-<?php echo $items->Status == 0 ? 'red' : 'blue'?>-500">
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-xl font-semibold">
                                        <?php 
                                        echo $items->Status == 0 ? 'Order Cancelled' : 'Order Delivered Successfully';
                                        echo " - Order #" . $items->InvoiceID;
                                        ?>
                                    </h2>
                                    <form action="?controller=Notification" method="POST">
                                        <input type="hidden" name="action" value="Delete">
                                        <input type="hidden" name="IdDelete" value="<?php echo $items->ID?>">
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition duration-200">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <p class="text-gray-600"><?php echo $items->Content?></p>
                                    <span class="text-sm text-gray-500">
                                        <?php echo $items->Time?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endif ?>
    </div>
</body>
</html>
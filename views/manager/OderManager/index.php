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
    <title>Thông Tin Đơn Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-400 text-white">

<div class="container mx-auto px-5 py-2">
    <div class="">
        <?php if ($donestatus==5): ?>
            <p class="text-red-500 font-bold text-center text-xl">The order has not yet been received</p>
        <?php endif?>
        <?php if ($donestatus==4): ?>
            <p class="text-blue-500 font-bold text-center text-xl">The order has been received</p>
        <?php endif?>
        <!-- Thông tin đơn hàng -->
        <div class="w-full  p-4 bg-gray-600 mt-2 rounded-lg grid  md:grid-cols-3">
            
            <?php foreach ($dataPament as $payment): ?>
                <div class="p-3 rounded bg-gray-800 m-2 hover:bg-gray-700">
                    <div class="font-bold text-center my-2">Shopping Information ID: <?php echo $payment['invoice']->invoiceID; ?></div>
                    <div class="font-bold text-center my-2">User ID: <?php echo $payment['invoice']->userID; ?></div>

                    <?php foreach ($payment['products'] as $productDetail): ?>
                        <div class="bg-gray-500 rounded-lg shadow-md p-6 mb-2 flex justify-between">
                            <div>
                                <p><strong>Name Product:</strong> <?php echo $productDetail['product']->productName; ?> </p>
                                <p><strong>Quantity:</strong> <?php echo $productDetail['quantity']; ?></p>
                                <p><strong>Price:</strong> <?php echo number_format($productDetail['product']->price*$productDetail['quantity'], 0, ',', '.'); ?></p>
                
                            </div>
                            <div>
                                <img class="h-16" src="<?php echo $productDetail['product']->img; ?>">
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="p-4 bg-gray-500 rounded">
                        
                        <p class=""><strong>Number Phone: </strong><?php echo $payment['invoice']->NumberPhone; ?> </p>
                        <p class=""><strong>Address: </strong><?php echo $payment['invoice']->Address; ?> </p>
                        <p><strong>Date: </strong><?php echo $payment['invoice']->paymentType; ?></p>
                        <p><strong>Date: </strong><?php echo $payment['invoice']->invoiceDate; ?></p>
                        <p><strong>End price: </strong><?php echo $payment['invoice']->totalAmount; ?></p>
                        <p class="text-red-500"><strong>Status: </strong><?php echo $payment['status']; ?> </p>
                        <form action="?controller=OderManager" method="POST" class="space-y-4">
                        <input type="hidden" name="action" value="ChangeStatus">
                        <?php if ($donestatus==5): ?>
                            
                        <input type="hidden" name="IdPayment" value="<?php echo $payment['invoice']->invoiceID; ?>">
                            <select onchange="this.form.submit()" id="Status" name="Status" required class="text-white bg-green-500 border  mt-1 block w-full  p-2 rounded-md ">
                                <option value="" disabled selected>Change status</option>
                                <option value="1">confirmed</option>
                                <option value="2">being transported</option>
                                <option value="3">delivered</option>
                            </select>
                        </form>
                        <?php endif?>
                        
                        
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

</body>
</html>

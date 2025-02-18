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
<body class=" ">

<div class="container mx-auto px-5 py-2">
    <div class="mt-2">
        <?php if ($donestatus==5): ?>
            <p class="text-yellow-500 font-bold text-center text-xl">The order has not yet been received</p>
        <?php endif?>
        <?php if ($donestatus==4): ?>
            <p class="text-blue-500 font-bold text-center text-xl">The order has been received</p>
        <?php endif?>
        
        <div class="p-2">
            <form action="?controller=OderManager&id=<?php echo $donestatus ?>" method="POST" class="space-y-4">
            <input type="hidden" name="action" value="Fillter">
            <input  type="hidden" name="Status" value="<?php echo $donestatus; ?>">
                <strong class="">Fillter white date From : </strong>
                <input required id="DateFrom" name="DateFrom" type="date" >
                <strong class="">To : </strong>
                <input required id="DateTo" name="DateTo" type="date" >
                <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg text-sm">Fillter</button>
            </form>
        </div>

        <div class="w-full  px-4 py-2 bg-gray-200 mt-2 rounded-lg grid  md:grid-cols-3">
            <?php foreach ($dataPament as $payment): ?>
                <div class="p-3 rounded bg-gray-100 m-2 hover:bg-gray-300">
                    <div class="font-bold text-center my-2">Shopping Information ID: <?php echo $payment['invoice']->invoiceID; ?></div>
                    <div class="font-bold text-center my-2">User ID: <?php echo $payment['invoice']->userID; ?></div>

                    <?php foreach ($payment['products'] as $productDetail): ?>
                        <div class="bg-gray-100 rounded-lg shadow-md p-6 mb-2 flex justify-between">
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
                    <div class="p-4 bg-gray-100 rounded">
                        
                        <p class=""><strong>Number Phone: </strong><?php echo $payment['invoice']->NumberPhone; ?> </p>
                        <p class=""><strong>Address: </strong><?php echo $payment['invoice']->Address; ?> </p>
                        <p><strong>Date: </strong><?php echo $payment['invoice']->paymentType; ?></p>
                        <p><strong>Date: </strong><?php echo $payment['invoice']->invoiceDate; ?></p>
                        <p><strong>End price: </strong><?php echo $payment['invoice']->totalAmount; ?></p>
                        <p><strong class="text-green-500">Estimated delivery date: </strong><?php echo $payment['invoice']->DateDelivery; ?></p>
                        <p><strong class="text-green-500">Note: </strong><?php echo $payment['invoice']->Note; ?></p>
                        <p class="text-red-500"><strong>Status: </strong><?php echo $payment['status']; ?> </p>
                        <form action="?controller=OderManager" method="POST" class="space-y-4">
                        <input type="hidden" name="action" value="ChangeStatus">
                        <?php if ($donestatus==5||$_GET['id']==5): ?>
                            
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

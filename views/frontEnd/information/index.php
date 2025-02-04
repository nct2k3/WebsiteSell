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
    <title>Thông Tin Đơn Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-700 text-white">

<div class="container mx-auto p-5">
    <div class="flex flex-wrap">
        <!-- Thông tin khách hàng -->
        <div class="w-full md:w-1/2 p-2">
            <div class="bg-gray-600 rounded-lg shadow-md py-6 px-14">
                <h2 class="text-xl font-semibold mb-2 text-center font-bold">Customer Information</h2>
                <div class="w-full flex justify-center">

                    <div class="h-20 w-20 p-2 bg-gray-300 rounded-full">
                        <img class="" src="https://img.icons8.com/?size=100&id=99268&format=png&color=000000">
                    </div>
                </div>
                <div class="w-full flex justify-center">
                    <div 
                    onclick="window.location='?controller=information&action=logout'"
                    class="w-auto p-1 my-2 text-center font-bold rounded-full hover:text-red-500 underline">
                            logout
                    </div>
                </div>
        <form action="?controller=information" method="POST" class="space-y-4">
          <input type="hidden" name="action" value="change">
                <p class="flex items-center ">
                    <strong class="mr-2 ">Full Name:</strong>
                    <input type="text" name="fullName" id="fullName" class=" w-auto p-1 border-0 focus:outline-none h-8 bg-gray-600 hover:bg-green-300 rounded-2xl" placeholder="<?php echo $dataUser->FullName;?>" required>
                </p>
                
                <p class="flex items-center">
                    <strong class="mr-2">Số Điện Thoại:</strong>
                    <input type="number" name="phone" id="phone" class="w-auto p-1 border-0 focus:outline-none h-8 bg-gray-600 hover:bg-green-300 rounded-2xl" placeholder="<?php echo $dataUser->PhoneNumber; ?>" required>
                </p>
                <p class="flex items-center">
                    <strong class="mr-2">Địa Chỉ:</strong>
                    <input type="text" name="address" id="address" class="flex-1 p-1 border-0 focus:outline-none h-8 bg-gray-600 hover:bg-green-300 rounded-2xl" placeholder="<?php echo $dataUser->Address ?>" required>
                </p>
                <p class="flex items-center">
                    <strong class="mr-2">Email:</strong>
                    <input type="email" name="Email" id="Email" class="w-auto p-1 border-0 focus:outline-none h-8 bg-gray-600 hover:bg-red-400 rounded-2xl" placeholder="<?php echo $Email; ?>" required readonly>
                </p>
                <p class="flex items-center">
                    <strong class="mr-2">Loyalty Points:</strong>
                    <input type="text" name="LoyaltyPoints" id="LoyaltyPoints" class="w-auto p-1 border-0 focus:outline-none h-8 bg-gray-600 hover:bg-red-400 rounded-2xl" placeholder="<?php echo number_format($dataUser->LoyaltyPoints, 0, ',', '.'); ?>đ" required readonly>
                </p>
                
                <button class="w-full p-2 my-2 text-center font-bold bg-blue-500 rounded-2xl hover:bg-blue-600">
                Change
                </button>
        </form>                        
            </div>
        </div>

        <!-- Thông tin đơn hàng -->
        <div class="w-full md:w-1/2 p-4 bg-gray-600 mt-2 rounded-lg">
        <h2 class="text-xl font-semibold mb-2 font-bold text-center">Shopping Information</h2>
       
            <?php foreach ($dataPament as $payment): ?>
                <div class="p-3 rounded bg-gray-800 m-2 hover:bg-gray-700">
                    <div class="font-bold text-center my-2">Shopping Information ID: <?php echo $payment['invoice']->invoiceID; ?></div>
                    <?php foreach ($payment['products'] as $productDetail): ?>
                        <div class="bg-gray-500 rounded-lg shadow-md p-6 mb-2 flex justify-between">
                            <div>
                                <p><strong>Name Product:</strong> <?php echo $productDetail['product']->productName; ?> </p>
                                <p><strong>Quantity:</strong> <?php echo $productDetail['quantity']; ?></p>
                                <p><strong>Price:</strong> <?php echo number_format($productDetail['product']->price*$productDetail['quantity'], 0, ',', '.'); ?></p>
                
                            </div>
                            <div>
                                <img class="h-32" src="<?php echo $productDetail['product']->img; ?>">
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="p-4 bg-gray-500 rounded">
                        <p class=""><strong>Status: </strong><?php echo $payment['status']; ?> </p>
                        <p class=""><strong>Number Phone: </strong><?php echo $payment['invoice']->NumberPhone; ?> </p>
                        <p class=""><strong>Status: </strong><?php echo $payment['invoice']->Address; ?> </p>
                        <div class="flex justify-between ">
                            <p><strong>Date:</strong><?php echo $payment['invoice']->invoiceDate; ?></p>
                            <p><strong>End price: </strong><?php echo $payment['invoice']->totalAmount; ?></p>
                        </div>
                        <button class="p-2 w-full rounded bg-green-500 hover:bg-green-600 my-2 font-bold">Order Confirmation</button>
                        <?php if ($payment['status']=='wait for confirmation'): ?>
                            <button 
                            onclick="window.location='?controller=Information&action=CancalOder&ID=<?php echo $payment['invoice']->invoiceID; ?>'"
                            class="p-2 w-full rounded bg-red-500 hover:bg-red-600 my-2 font-bold">Cancel Order</button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

</body>
</html>
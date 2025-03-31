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
    <div class="w-full ">
            <div class="bg-gray-600 rounded-lg shadow-md py-6 p-4">
            <div class="w-full flex justify-end">
                
                </div>
                <h2 class="text-xl font-semibold mb-2 text-center font-bold">Thông Tin Khách Hàng</h2>
                <div class="w-full flex justify-center">

                    <div class="h-20 w-20 p-2 bg-gray-300 rounded-full">
                        <img class="" src="https://img.icons8.com/?size=100&id=99268&format=png&color=000000">
                    </div>
                </div>
        <form action="?controller=information" method="POST" class="space-y-4">
          <input type="hidden" name="action" value="change">
            <div class="w-full grid md:grid-cols-2">        
                <p class="flex items-center  ">
                    <strong class="mr-2 ">Họ và tên:</strong>
                    <input type="text" name="fullName" id="fullName" class=" w-auto p-1 border-0 focus:outline-none h-8 bg-gray-600 hover:bg-green-300 rounded-2xl" placeholder="<?php echo $dataUser->FullName;?>" required>
                </p>
                
                <p class="flex items-center ">
                    <strong class="mr-2">Email:</strong>
                    <input type="email" name="Email" id="Email" class="w-auto p-1 border-0 focus:outline-none h-8 bg-gray-600 hover:bg-red-400 rounded-2xl" placeholder="<?php echo $Email; ?>" required readonly>
                </p>
                <p class="flex items-center ">
                    <strong class="mr-2">Địa chỉ:</strong>
                    <input type="text" name="address" id="address" class="flex-1 p-1 border-0 focus:outline-none h-8 bg-gray-600 hover:bg-green-300 rounded-2xl" placeholder="<?php echo $dataUser->Address ?>" required>
                </p>
                <p class="flex items-center ">
                    <strong class="mr-2">Điểm tích lũy:</strong>
                    <input type="text" name="LoyaltyPoints" id="LoyaltyPoints" class="w-auto p-1 border-0 focus:outline-none h-8 bg-gray-600 hover:bg-red-400 rounded-2xl" placeholder="<?php echo number_format($dataUser->LoyaltyPoints, 0, ',', '.'); ?>đ" required readonly>
                </p>
              
                <p class="flex items-center ">
                    <strong class="mr-2">Số điện thoại:</strong>
                    <input type="number" name="phone" id="phone" class="w-auto p-1 border-0 focus:outline-none h-8 bg-gray-600 hover:bg-green-300 rounded-2xl" placeholder="<?php echo $dataUser->PhoneNumber; ?>" required>
                </p>
                
            </div>
                <div class="flex justify-center">
                    <button class="w-1/2 p-2 my-2 text-center font-bold bg-blue-500 rounded-2xl hover:bg-blue-600">
                    Thay đổi
                    </button>
                </div>
        </form>    
        <div class="flex justify-center">
                    <div 
                        onclick="window.location='?controller=information&action=logout'"
                        class="w-1/2 p-2 text-xl text-center text-gray-200 bg-red-500 font-bold rounded-full hover:bg-red-600 hover:text-white underline cursor-pointer">
                                Đăng xuất
                    </div>
                </div>                    
        </div>
    </div>

    <div class="grid md:grid-cols-2">

        <!-- Thông tin đơn hàng hang cho-->
        <div class="w-full   bg-gray-600 mt-2 rounded-l-lg">
        <h2 class="text-xl font-semibold mb-2 font-bold text-center">Đơn hàng đang thực hiện</h2>
       
            <?php foreach ($dataPament as $payment): ?>
                <div class="p-3 rounded bg-gray-800 m-2 hover:bg-gray-700">
                    <div class="font-bold text-center my-2">Mã đơn hàng: <?php echo $payment['invoice']->invoiceID; ?></div>
                    <?php foreach ($payment['products'] as $productDetail): ?>
                        <div class="bg-gray-500 rounded-lg shadow-md p-6 mb-2 flex justify-between">
                            <div>
                                <p><strong>Tên sản phẩm:</strong> <?php echo $productDetail['product']->productName; ?> </p>
                                <p><strong>Số lượng:</strong> <?php echo $productDetail['quantity']; ?></p>
                                <p><strong>Giá:</strong> <?php echo number_format($productDetail['product']->price*$productDetail['quantity'], 0, ',', '.'); ?></p>
                
                            </div>
                            <div>
                                <img class="h-32" src="<?php echo $productDetail['product']->img; ?>">
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="p-4 bg-gray-500 rounded">
                        <p class=""><strong>Trạng thái: </strong><?php echo $payment['status']; ?> </p>
                        <p class=""><strong>Số điện thoại: </strong><?php echo $payment['invoice']->NumberPhone; ?> </p>
                        <p class=""><strong>Địa chỉ: </strong><?php echo $payment['invoice']->Address; ?> </p>
                        <div class="flex justify-between ">
                            <p><strong>Ngày đặt: </strong><?php echo $payment['invoice']->invoiceDate; ?></p>
                            <p><strong>Tổng tiền: </strong><?php echo number_format($payment['invoice']->totalAmount); ?></p>
                        </div>
                        <p><strong class="text-green-500">Ngày giao hàng mong muốn: </strong>
                            <?php 
                                if($payment['invoice']->DateDelivery == '0000-00-00' || empty($payment['invoice']->DateDelivery)) {
                                    echo "Bạn không chọn ngày giao hàng mong muốn";
                                } else {
                                    echo $payment['invoice']->DateDelivery;
                                }
                            ?>
                        </p>
                        <p><strong class="text-green-500">Ghi chú: </strong><?php echo $payment['invoice']->Note; ?></p>
                        <?php if ($payment['status']=='delivered'): ?>
                            <form action="?controller=information" method="POST" class="space-y-4">
                                <input type="hidden" name="action" value="ChangeStatus">
                                <input type="hidden" name="IdOder" value=" <?php echo $payment['invoice']->invoiceID; ?>">
                                <input type="hidden" name="TotalAmount" value="<?php echo $payment['invoice']->totalAmount; ?>">
                                
                                <button class="p-2 w-full rounded bg-green-500 hover:bg-green-600 my-2 font-bold">Xác nhận đã nhận đơn hàng</button>
                            </form>
                            

                        <?php endif?>
                        <?php if ($payment['status']!=='delivered'&&$payment['status']!=='wait for confirmation'&&$payment['status']!=='complete'): ?>
                            <button  readonly class="opacity-50 p-2 w-full rounded bg-yellow-500  hover:bg-yellow-600 my-2 font-bold">Đơn hàng đang được xử lý</button>
                        <?php endif?>
                        <?php if ($payment['status']=='complete'): ?>
                            <form action="?controller=information" method="POST">
                                <input type="hidden" name="action" value="Reorder">
                                <input type="hidden" name="InvoiceID" value="<?php echo $payment['invoice']->invoiceID; ?>">
                                <button type="submit" class=" p-2 w-full rounded bg-purple-600 hover:bg-purple-400   my-2 font-bold">Đặt lại</button>
                            </form>
                        <?php endif?>
                        <?php if ($payment['status']=='wait for confirmation'): ?>
                            <button 
                            onclick="window.location='?controller=Information&action=CancalOder&ID=<?php echo $payment['invoice']->invoiceID; ?>'"
                            class="p-2 w-full rounded bg-red-500 hover:bg-red-600 my-2 font-bold">Hủy đơn hàng</button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Thông tin đơn hàng hang da dat-->
        <div class="w-full  bg-gray-600 mt-2 rounded-r-lg">
        <h2 class="text-xl font-semibold mb-2 font-bold text-center">Đơn hàng đã hoàn thành</h2>
       
            <?php foreach ($dataWasPayment as $payment): ?>
                <div class="p-3 rounded bg-gray-800 m-2 hover:bg-gray-700">
                    <div class="font-bold text-center my-2">Mã đơn hàng: <?php echo $payment['invoice']->invoiceID; ?></div>
                    <?php foreach ($payment['products'] as $productDetail): ?>
                        <div class="bg-gray-500 rounded-lg shadow-md p-6 mb-2 flex justify-between">
                            <div>
                                <p><strong>Tên sản phẩm:</strong> <?php echo $productDetail['product']->productName; ?> </p>
                                <p><strong>Số lượng:</strong> <?php echo $productDetail['quantity']; ?></p>
                                <p><strong>Giá:</strong> <?php echo number_format($productDetail['product']->price*$productDetail['quantity'], 0, ',', '.'); ?></p>
                
                            </div>
                            <div>
                                <img class="h-32" src="<?php echo $productDetail['product']->img; ?>">
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="p-4 bg-gray-500 rounded">
                        <p class=""><strong>Trạng thái: </strong><?php echo $payment['status']; ?> </p>
                        <p class=""><strong>Số điện thoại: </strong><?php echo $payment['invoice']->NumberPhone; ?> </p>
                        <p class=""><strong>Địa chỉ: </strong><?php echo $payment['invoice']->Address; ?> </p>
                        <div class="flex justify-between ">
                            <p><strong>Ngày đặt: </strong><?php echo $payment['invoice']->invoiceDate; ?></p>
                            <p><strong>Tổng tiền: </strong><?php echo number_format($payment['invoice']->totalAmount); ?></p>
                        </div>
                        <p><strong class="text-green-500">Ngày giao hàng dự kiến: </strong><?php echo $payment['invoice']->DateDelivery; ?></p>
                        <p><strong class="text-green-500">Ghi chú: </strong><?php echo $payment['invoice']->Note; ?></p>
                        <?php if ($payment['status']=='delivered'): ?>
                            <form action="?controller=information" method="POST" class="space-y-4">
                                <input type="hidden" name="action" value="ChangeStatus">
                                <input type="hidden" name="IdOder" value=" <?php echo $payment['invoice']->invoiceID; ?>">
                                <input type="hidden" name="TotalAmount" value="<?php echo $payment['invoice']->totalAmount; ?>">
                                
                                <button class="p-2 w-full rounded bg-green-500 hover:bg-green-600 my-2 font-bold">Xác nhận đơn hàng</button>
                            </form>
                            

                        <?php endif?>
                        
                        
                            <form action="?controller=information" method="POST">
                                <input type="hidden" name="action" value="Reorder">
                                <input type="hidden" name="InvoiceID" value="<?php echo $payment['invoice']->invoiceID; ?>">
                                <button type="submit" class=" p-2 w-full rounded bg-purple-600 hover:bg-purple-400   my-2 font-bold">Đặt lại</button>
                            </form>
                    

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

</body>
</html>

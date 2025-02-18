<?Php
require_once './controllers/HeadermanagerController.php';
$controller = new HeadermanagerController();
$controller->index();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Chart</title>
  <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
    <div  class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 min-h-screen bg-gray-100">
        <div class="p-6 bg-white rounded-lg shadow-lg m-2 overflow-hidden">
            <h2 class="mb-4 text-xl font-bold text-gray-700">Number Order</h2>
            <div class="p-2 ml-1">
                    <form  method="POST" class="space-y-4">
                    <input type="hidden" name="action" value="Fillter">
                    <input  type="hidden" name="Status" value="<?php echo $donestatus; ?>">
                        <strong class="">From : </strong>
                        <input required id="DateFrom" name="DateFrom" type="date" >
                        <strong class="">To : </strong>
                        <input required id="DateTo" name="DateTo" type="date" >
                        <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg text-sm">Fillter</button>
                    </form>
            </div>

            <div class="relative flex space-x-4 border-b border-gray-200" style="height: 300px;">
            <div class="flex flex-col items-center" style="height: 100%;">
                <div class="bg-black text-center text-white" style="height: 100%; width: 1px;">0</div>
                <span class="mt-1 text-sm text-gray-600">Oder:<?php echo $total ?></span>
            </div>
            <div class="flex flex-col items-center" style="height: 100%;">
                <div class="w-8 bg-red-500 hover:bg-red-400 text-center text-white" style="height:<?php echo $PercentWaitingConfirm ?>%;"><?php echo $numWaitingConfirm ?></div>
                <span class="mt-1 text-sm text-gray-600 ">Wait confirmed</span>
            </div>
            <div class="flex flex-col items-center" style="height: 100%;">
                <div class="w-8 bg-yellow-500 hover:bg-yellow-400 text-center text-white" style="height: <?php echo $PercentConfirmed ?>%;"><?php echo $numConfirmed ?></div>
                <span class="mt-1 text-sm text-gray-600">Confirmed</span>
            </div>
            <div class="flex flex-col items-center" style="height: 100%;">
                <div class="w-8 bg-green-500 hover:bg-green-700 text-center text-white" style="height: <?php echo $PercentInDelivery ?>%;"><?php echo $numInDelivery ?></div>
                <span class="mt-1 text-sm text-gray-600">In delivery</span>
            </div>
            <div class="flex flex-col items-center" style="height: 100%;">
                <div class="w-8 bg-blue-500 hover:bg-blue-700 text-center text-white" style="height: <?php echo $PercentCompleted ?>%;"><?php echo $numCompleted ?></div>
                <span class="mt-1 text-sm text-gray-600">Completed</span>
            </div>
            </div>
        </div>

        <div class="p-6 bg-white rounded-lg shadow-lg m-2">
            <h2 class="mb-4 text-xl font-bold text-gray-700">Product Order</h2>
            <div class="flex flex-col space-y-4" style="width: 100%; height: auto;">
            <div class="flex items-center space-x-2">
                <p class="font-bold text-gray-600 ">Status</p>
                <span class="w-auto text-sm text-gray-600  ">Number of products :<?php echo $numAllProductAllProduct ?></span>
                
            </div>
            
            <div class="flex items-center space-x-2">
                <span class="w-24 text-sm text-gray-600">Sold</span>
                <div class="h-6 bg-green-500 hover:bg-green-700 text-center text-white"
                 style="width : <?php echo $PercentProductSold ?>%;">
                <?php echo $numProductSold ?>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <span class="w-24 text-sm text-gray-600">Not Sold</span>
                <div class="h-6 bg-red-500 hover:bg-red-700 text-center text-white"
                 style="width: <?php echo $PercentProductNotSold ?>%;">
                 <?php echo $numProductNotSold ?></div>
            </div>

            </div>
            <div class="flex justify-center w-full">  
                <button 
                onclick="window.location.href='?controller=Productstatistical'"
                class="btn btn-primary w-3/4  mt-8 "> Sell Detail</button>
            </div>
        </div>
    </div>
</body>
</html>
<?php
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
    <div class="grid grid-cols-1 px-6 py-4 min-h-screen bg-gray-100">
        <div class="p-6 bg-white rounded-lg shadow-lg m-2 overflow-hidden">
            <div class="flex justify-between px-3">
                <h2 class="mb-4 text-xl font-bold text-gray-700"> Revenue statistical</h2>
                <h1 class="text-2xl"><?php echo $year?></h1>
            </div>

            <div class=" flex flex-wrap border-b border-gray-200 py-2">
            <div class="px-3">
                <form action="/?controller=Revenuestatistical" method="POST" class="">
                    <input type="hidden" name="action" value="RevenueYear">
                    <strong>Year:</strong>
                    <input type="number" id="year" name="year" class="year-input" min="2024" max="2100" placeholder="2025" required>
                    <button type="submit" class="bg-blue-500 h-8 text-white p-1 rounded-lg">Filter</button>
                </form>
            </div>
                <div class="ml-4  md:w-24 "></div>
                
                <div class="  mx-4 mt-2 flex"> 
                    <div class="w-5 h-5 bg-green-500 mr-1"></div>
                    <div> : Revenue</div>
                </div>
                <div class="mx-4 mt-2 flex "> 
                    <div class="w-5 h-5 bg-blue-500 mr-1"></div>
                    <div> : Order Number</div>
                </div>
                
            </div>

            <?php foreach($dataStatistical as $items ): ?>
            <div class="flex flex-col space-y-4 p-2">
                <div class="w-full flex hover:bg-gray-200  rounded">
                    <div class="flex h-8" style="width: 30%;">
                        <span class="text-lg text-gray-600 m-2 font-bold"><?php echo $items['month']  ?></span>
                    </div>
                    <div class="  " style="width: 70%;">
                    <div class="h-4 bg-green-500 hover:bg-green-700 text-center text-white"
                                style="width:  <?php echo $items['percent']  ?>%; font-size:70%">
                                <?php echo   number_format($items['total'], 0, ',', '.') . ' Đ'; ?>
                        </div>
                        <div class="h-4 bg-blue-500 hover:bg-blue-700 text-center text-white"
                                style="width:  <?php echo $items['percentOrder']  ?>%; font-size:70%">
                                <?php echo $items['numOrder']  ?>
                        </div>
                    </div>
                </div>
            </div>
          <?php endforeach ?>
          <div class="font-bold text-red-500 mt-2 w-full rounded flex justify-end border-b border-t ">Total revenue for the year:   <?php echo   number_format($totalAmount, 0, ',', '.') . ' Đ'; ?></div>
        </div>
    </div>
</body>
</html>
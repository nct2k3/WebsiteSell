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
    <?php foreach($data as $items): ?>
    <div class="flex justify-center min-h-screen bg-gray-100 p-8">
        <div class="h-1/5 w-full bg-white border-l-4 border-blue-500 p-6 rounded shadow-md text-center">
            <h1 class="text-xl font-bold mb-4">Notification: <?php echo $items->Status?></h1>
            <p class="text-gray-700 mb-4">Time: <?php echo $items->Time?></p>
            <p class="text-gray-700 mb-4"><?php echo $items->Content?></p>
            <a href="#" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition duration-200">Delete Notification</a>
        </div>
    </div>

    <?php endforeach ?>
</body>
</html>
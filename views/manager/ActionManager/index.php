
<?php
require_once './controllers/HeadermanagerController.php';
$controller = new HeadermanagerController();
$controller->index();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Hiển Thị Dữ Liệu</title>
</head>
<body>

    <div class="container mx-auto bg-white p-5 rounded-lg shadow mt-4">
        <h1 class="text-2xl font-bold mb-4">Action manager</h1>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                  
                    <th class="py-3 px-6 text-left">UserID</th>
                    <th class="py-3 px-6 text-left">TimeLogin</th>
                    <th class="py-3 px-6 text-left">Action</th>
                </tr>
            </thead>
            <?php foreach ($data as $items): ?>
                        <tbody class="text-gray-600 text-sm font-light">
                            <tr class="border-b border-gray-300 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left"><?php echo $items->UserID ?></td>
                                <td class="py-3 px-6 text-left"><?php echo $items->TimeLogin?></td>
                                <td class="py-3 px-6 text-left 
                            <?php 
                                if ($items->Action === 'Login') {
                                    echo 'text-green-500 font-bold';
                                } elseif ($items->Action === 'Logout') {
                                    echo 'text-yellow-500 font-bold';
                                } elseif ($items->Action === 'Add') {
                                    echo 'text-blue-500 font-bold';
                                } elseif ($items->Action === 'Delete') {
                                    echo 'text-red-500 font-bold';
                                }
                            ?>">
                            <?php echo $items->Action ?>
                        </td>
                            </tr>
                        </tbody>
            <?php endforeach; ?>

        </table>
    </div>

</body>
</html>
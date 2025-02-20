<?php

function downloadFile($file) {
    $filePath = "uploads/" . basename($file);

    if (file_exists($filePath)) {
      
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        flush();
        exit;
    } else {
        echo "File không tồn tại.";
    }
}


// if (isset($_GET['file'])) {
//     downloadFile($_GET['file']);
// } else {
//     echo "Không có file nào được chỉ định.";
// }
?>
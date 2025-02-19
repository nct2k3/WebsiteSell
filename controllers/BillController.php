<?php
require '../vendor/autoload.php';

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
class BillController{
function createInvoice($User, $items , $totalAmount) {
    
    $phpWord = new PhpWord();
    $section = $phpWord->addSection();

   
    $section->addTitle('HÓA ĐƠN', 1);

    $section->addText('Người bán: Công ty Iphone Store');
    $section->addText('Địa chỉ: 192,Tân Thới nhất, Quận 12, TP.Hồ Chí Minh');
    $section->addText('Điện thoại:0368731585');
    $section->addText('Email:nguyennrdz@gmail.com');
    $section->addTextBreak();

    $section->addText('Người mua: ' . $User->fullName);
    $section->addText('Địa chỉ: ' . $User->address);
    $section->addText('Điện thoại: ' . $User->phoneNumber);
    $section->addTextBreak(); 

    $table = $section->addTable();
    $table->addRow();
    $table->addCell(2000)->addText('STT');
    $table->addCell(4000)->addText('Tên sản phẩm');
    $table->addCell(2000)->addText('Số lượng');
    $table->addCell(2000)->addText('Đơn giá');
    $table->addCell(2000)->addText('Thành tiền');

    foreach ($items as $item) {
        $table->addRow();
        $table->addCell(2000)->addText($item['STT']);
        $table->addCell(4000)->addText($item['ProductName']);
        $table->addCell(2000)->addText($item['Quantity']);
        $table->addCell(2000)->addText(number_format($item['UnitPrice'], 0, ',', '.') . ' VNĐ');
        $table->addCell(2000)->addText(number_format($item['Total'], 0, ',', '.') . ' VNĐ');
    }


    $section->addTextBreak(); 
    $section->addText('Tổng tiền: ' . number_format($totalAmount, 0, ',', '.') . ' VNĐ');

    $fileName = 'hoadon.docx';
    $filePath ='../public/bill/' . $fileName; 
    $writer = IOFactory::createWriter($phpWord, 'Word2007');
    $writer->save($filePath);

    return $filePath; 
}
}
?>
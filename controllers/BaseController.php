<?php

class BaseController
{
    const VIEW_FOLDER_NAME = 'Views';
    const MODEL_FOLDER_NAME = 'models';

    protected function view($viewPath, array $data = [])
    {
        // Chuyển đổi mảng dữ liệu thành biến
        extract($data); // Giúp biến có thể được sử dụng trong view
        
        // Yêu cầu view
        require (self::VIEW_FOLDER_NAME . '/' . str_replace('.', '/', $viewPath) . '.php');
    }

    protected function loadModel($model)
{
    // Đường dẫn đến mô hình
    $modelPath = __DIR__ . '/../' . self::MODEL_FOLDER_NAME . '/' . str_replace('.', '/', $model) . '.php';

    // Yêu cầu mô hình
    require_once $modelPath;

    // Khởi tạo mô hình và trả về instance
    return new $model(); // Đảm bảo rằng tên lớp chính xác và có sẵn
}

protected function takeIDAccount(){
    if (isset($_SESSION['AccountID'])) {
        $accountID = $_SESSION['AccountID'];
        return $accountID;
    } else {
       return;
    }


}


}
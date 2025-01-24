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
        // Yêu cầu mô hình
        require (self::MODEL_FOLDER_NAME . '/' . str_replace('.', '/', $model) . '.php');

        // Khởi tạo mô hình và trả về instance
        return new $model();
    }
}
<?php

class BaseController
{
    const VIEW_FOLDER_NAME = 'Views';
    const MODEL_FOLDER_NAME = 'models';

    protected function view($viewPath, array $data = [])
    {
        extract($data); 
        require (self::VIEW_FOLDER_NAME . '/' . str_replace('.', '/', $viewPath) . '.php');
    }

    protected function loadModel($model)
{
 
    $modelPath = __DIR__ . '/../' . self::MODEL_FOLDER_NAME . '/' . str_replace('.', '/', $model) . '.php';
    require_once $modelPath;
    return new $model();
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
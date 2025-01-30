<?php
session_start();
require_once 'core/database.php';
require_once 'models/baseModel.php';
require_once 'controllers/BaseController.php';
$controllerName = ucfirst(strtolower($_REQUEST['controller'] ?? 'home')) . 'Controller';
$actionName = $_REQUEST['action'] ?? 'index';

require_once "./controllers/{$controllerName}.php";

$controllerObject = new $controllerName();

if (method_exists($controllerObject, $actionName)) {
    $controllerObject->$actionName();
} else {
    echo "Action {$actionName} not found in controller {$controllerName}.";
}
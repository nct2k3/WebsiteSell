<?php

require 'core/database.php';
require 'models/baseModel.php';
require 'controllers/BaseController.php';
$controllerName = ucfirst(strtolower($_REQUEST['controller'] ?? 'home')) . 'Controller';
$actionName = $_REQUEST['action'] ?? 'index';

// Require the controller file
require "./controllers/{$controllerName}.php";

// Create an instance of the controller
$controllerObject = new $controllerName();

// Call the action method
if (method_exists($controllerObject, $actionName)) {
    $controllerObject->$actionName();
} else {
    // Handle the case where the action does not exist
    echo "Action {$actionName} not found in controller {$controllerName}.";
}
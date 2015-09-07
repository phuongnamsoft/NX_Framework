<?php

class bootstraper {
    //put your code here
}

require 'core.php';


use NX_framework\NX_core\Router\Router;
$route = new Router();
$controller = $route->controller();
$method = $route->method() ? $route->method() : 'index';
$controller_path = APP_PATH . 'controllers' . DIRECTORY_SEPARATOR . $controller . '.php';
require_once_ex($controller_path);
$ct = new $controller();
$ct->$method();
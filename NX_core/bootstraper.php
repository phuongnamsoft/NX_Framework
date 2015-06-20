<?php

class bootstraper {
    //put your code here
}

require 'core.php';


use NX_framework\NX_core\Router\Router;
$route = new Router();
$controller = $route->controller();
$method = $route->method();
$controller_path = APP_PATH . 'controllers\\' . $controller . '.php';
require_once $controller_path;
$ct = new $controller();
$ct->$method();
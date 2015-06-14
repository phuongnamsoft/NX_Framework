<?php

class bootstraper {
    //put your code here
}

require 'core.php';

function __autoload($name) {
    $parts = explode('\\', $name);
    $full_path = SYS_PATH . end($parts) . '.php';
    if (file_exists($full_path))
        require_once $full_path;
    else {
        throw new Exception('Can\'t load class ' . $name);
    }
}
use NX_framework\NX_core\Router\Router;
$route = new Router();
$controller = $route->controller();
$method = $route->method();
$controller_path = APP_PATH . 'controllers\\' . $controller . '.php';
require_once $controller_path;
$ct = new $controller();
$ct->$method();
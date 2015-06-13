<?php

class bootstraper {
    //put your code here
}


$controller = isset($_GET['page'])?$_GET['page']:'home'; //Neu co page thi get page ko thi se ve home
$method = isset($_GET['method'])?$_GET['method']:'index';
$controller = $controller.'_controller';
require_once APP_PATH.'\controllers\\'.$controller.'.php';
$ct = new $controller();
$ct->$method();
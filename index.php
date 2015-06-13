<?php

error_reporting(E_ERROR | E_PARSE | E_NOTICE);
define('_PATH', __DIR__ . DIRECTORY_SEPARATOR);
define('APP_PATH', _PATH . 'application' . DIRECTORY_SEPARATOR);
define('SYS_PATH', _PATH . 'NX_core' . DIRECTORY_SEPARATOR);
include_once SYS_PATH . 'core.php';

/*
//error_reporting(E_ERROR  | E_PARSE | E_NOTICE);
define('APP_PATH', __DIR__);
require_once APP_PATH.'\database\database_connection.php';
class Controller {


    public function __construct() {
        
    }

    public function load_model($name) {
        require_once  APP_PATH.'\models\\'.$name.'.php';
        $this->$name = new $name();
    }

    public function load_view($name) {
        include "\\views\\$name.php";
    }

}

$controller = isset($_GET['page'])?$_GET['page']:'home'; //Neu co page thi get page ko thi se ve home
$method = isset($_GET['method'])?$_GET['method']:'index';
$controller = $controller.'_controller';
require_once APP_PATH.'\controllers\\'.$controller.'.php';
$ct = new $controller();
$ct->$method();
 * 
 * 
 */


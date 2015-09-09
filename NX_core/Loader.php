<?php

namespace NX_framework\NX_core\Loader;

use NX_framework\NX_core\Exceptions\Exceptions;

class Loader {

    protected $config;
    protected $database_connections;
    protected $exception;
    public $db;

    public function __construct() {
        $this->exception = new Exceptions();
        $this->load_config();
    }

    public function load_config() {
        $config_file = APP_PATH . DIRECTORY_SEPARATOR . "config.php";
        if (file_exists($config_file)) {
            require_once $config_file;
            $this->config = $config;
            $this->database_connections = $databases;
        } else {
            $this->exception->show_500();
        }
    }

    public function model($model, $model_name = '') {

        if ($model_name == '') {
            $model_name = $model;
        }
        $model_inc = APP_PATH . DIRECTORY_SEPARATOR . "models" . DIRECTORY_SEPARATOR . $model . ".php";
        if (file_exists($model_inc)) {
            require_once $model_inc;
            $nx = get_instance();
            $nx->$model_name = new $model();
        } else {
            $this->exception->show_500();
        }
    }

    public function view($view_name, $data = array(), $return = FALSE) {
        ob_start();
        if (is_array($data))
            @extract($data);
        $this->load = $this;
        $view_inc = APP_PATH . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . $view_name . ".php";
        if (file_exists($view_inc))
            @include $view_inc;
        else {
            $this->exception->show_404($view_name);
        }
        //else 

        $output = ob_get_contents();
        if ($return == TRUE)
            ob_clean();
        ob_end_flush();
        return $output;
    }

    public function database($param = 'default', $return_instance = FALSE) {
        $data_type = array('mysql', 'mysqli', 'sqlite', 'postgresql', 'pdo');
        if (isset($this->database_connections[$param])) {
            $database_connection = $this->database_connections[$param];
            if (in_array($database_connection['type'], $data_type)) {
                $driver_file = SYS_PATH . DIRECTORY_SEPARATOR . 'database' .DIRECTORY_SEPARATOR . $database_connection['type'] . '.driver.php';
                require_once_ex($driver_file);
            }
        }
        return $this->db;
    }

}

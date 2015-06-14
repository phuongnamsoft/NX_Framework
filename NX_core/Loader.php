<?php

namespace NX_framework\NX_core\Loader;

class Loader {

    public function __construct() {
        
    }

    public function model($model, $model_name = '') {
        if ($model_name == '') {
            $model_name = $model;
        }
        $model_inc = APP_PATH . DIRECTORY_SEPARATOR . "models" . DIRECTORY_SEPARATOR . $model . ".php";
        if (file_exists($model_inc))
            require_once $model_inc;
        $this->$model_name = new $model();
    }

    public function view($view_name, $data = array(), $return = FALSE) {
        ob_start();
        @extract($data);
        $this->load = $this;
        $view_inc = APP_PATH . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . $view_name . ".php";
        if (file_exists($view_inc))
            @include $view_inc;
        //else 

        $output = ob_get_contents();
        if ($return == TRUE)
            ob_clean();
        ob_end_flush();
        return $output;
    }

    public function database($param = 'default') {
        
    }

}

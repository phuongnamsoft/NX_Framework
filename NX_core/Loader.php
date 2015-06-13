<?php
namespace NX_framework\NX_core\Loader;
class Loader {

    public function __construct() {
        
    }

    public function model($model, $model_name = '') {
        if ($model_name == '') {
            $model_name = $model;
        }
        $this->$model_name = new $model();
    }

    public function view($view_name, $data = array(), $return = FALSE) {
        ob_start(array('this', 'indent')); 
        @extract($data);
        @include $view_name;
        ob_end_flush();
    }

}

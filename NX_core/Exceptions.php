<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace NX_framework\NX_core\Exceptions;

/**
 * Description of Exceptions
 *
 * @author WIN7
 */
use NX_framework\NX_core\Router\Router;

class Exceptions {

    private $levels = array(
        E_ERROR => 'Error',
        E_WARNING => 'Warning',
        E_PARSE => 'Parsing Error',
        E_NOTICE => 'Notice',
        E_CORE_ERROR => 'Core Error',
        E_CORE_WARNING => 'Core Warning',
        E_COMPILE_ERROR => 'Compile Error',
        E_COMPILE_WARNING => 'Compile Warning',
        E_USER_ERROR => 'User Error',
        E_USER_WARNING => 'User Warning',
        E_USER_NOTICE => 'User Notice',
        E_STRICT => 'Runtime Notice',
        E_RECOVERABLE_ERROR => 'Recoverable Error',
        E_USER_DEPRECATED => 'User Deprecated'
    );

    public function __construct() {
        
    }

    public function log() {
        
    }

    public function show_404() {
        
    }

    public function show_500() {
        
    }

    public function show_error($param) {
        
    }
    
    public function _write_log($param) {
        
    }

}

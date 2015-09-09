<?php

function __autoload($name) {
    $parts = explode('\\', $name);
    $full_path = SYS_PATH . end($parts) . '.php';
    if (file_exists($full_path))
        require_once $full_path;
    else {
        throw new Exception('Can\'t load class ' . $name);
    }
}

/*
 * Get Framework instance
 * return: framework instance
 */
function get_instance() {
    return NX_framework\NX_core\Controller\Controller::$instance;
}
$nx = get_instance();

function array2object($param = array()) {
    if (!is_array($param)) {
        return FALSE;
    }
    $result = new stdClass();
    foreach ($param as $key => $value) {
        $result->key = $value;
    }
    return $result;
}

function object2array($param) {
    if (!is_object($param)) {
        return FALSE;
    }
    $result = array();
    foreach ($param as $key => $value) {
        $result[$key] = $value;
    }
    return $result;
}

function class_loader($class_name) {
    $full_path = APP_PATH . $class_name . '.php';
    if (file_exists($full_path)) {
        require_once $full_path;
        if (class_exists($class_name)) {
            return new $class_name();
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}

function include_ex($file) {
    if (file_exists($file)) {
        @include $file;
    } else {
        throw new Exception;
    }
}

function include_once_ex($file) {
    if (file_exists($file)) {
        @include_once $file;
    } else {
        throw new Exception;
    }
}

function require_ex($file) {
    if (file_exists($file)) {
        require $file;
    } else {
        throw new Exception;
    }
}

function require_once_ex($file) {
    if (file_exists($file)) {
        require_once $file;
    } else {
        throw new Exception;
    }
}

function get_config($param = '') {
    
}
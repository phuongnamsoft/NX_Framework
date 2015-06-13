<?php

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

function __autoload($name) {
    $full_path = SYS_PATH . $name . '.php';
    if (file_exists($full_path))
        require_once $full_path;
    else {
        throw new Exception('Can\'t load class ' . $name);
    }
}

function get_config($param = '') {
    
}
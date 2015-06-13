<?php

/**
 * Description of Input base class
 *
 * @author Phuongnamsoft
 */

namespace NX_framework\NX_core\Input;

use NX_framework\NX_core\Router;
use NX_framework\NX_core\Security;

class Input {

    private $_post;
    private $_get;
    private $security;
    private $uri;

    public function __construct() {
        $this->_get = $_GET;
        $this->_post = $_POST;
        unset($_GET);
        unset($_POST);
        $this->uri = new Router\URI();
        $this->security = new Security\Security();
    }
    public function post($param = '', $xss_filter = FALSE) {
        $resources = array();
        if (is_array($this->_post)) {
            if ($param == '') {
                foreach ($this->_post as $key => $value) {
                    $value = $xss_filter ? $this->security->xss_filter($value) : $value;
                    $resources[$key] = $value;
                }
            } elseif (isset($this->_post[$param])) {
                $resources = $this->_post[$param];
            } else {
                return FALSE;
            }
            return $resources;
        } else {
            return FALSE;
        }
    }

    public function get($param = '', $xss_filter = FALSE) {
        $resources = array();
        if (is_array($this->_get)) {
            if ($param == '') {
                foreach ($this->_get as $key => $value) {
                    if ($xss_filter) {
                        $value = $this->security->xss_filter($value);
                    }
                    $resources[$key] = $value;
                }
            } elseif (isset($this->_get[$param])) {
                $resources = $this->_get[$param];
            } else {
                return FALSE;
            }
            return $resources;
        } else {
            return FALSE;
        }
    }

    public function head($param = '') {
        
    }

    public function is_post() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($this->post()))
            return TRUE;
        else
            return FALSE;
    }

    public function is_get() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
            return TRUE;
        else
            return FALSE;
    }

    public function http_method() {
        return $_SERVER['REQUEST_METHOD'];
    }

}

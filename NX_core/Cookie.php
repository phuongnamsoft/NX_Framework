<?php

namespace NX_framework\NX_core\Cookie;

class Cookie {

    private $expire;
    private $path = '/';
    private $domain;
    private $secure = false;
    private $httponly = false;

    public function __construct($param = array()) {
        if (isset($param['expire'])) {
            $this->expire = $param['expire'];
        }
        if (isset($param['path'])) {
            $this->path = $param['path'];
        }
        if (isset($param['domain'])) {
            $this->domain = $param['domain'];
        }
        if (isset($param['secure'])) {
            $this->secure = $param['secure'];
        }
        if (isset($param['httponly'])) {
            $this->httponly = $param['httponly'];
        }
    }

    public function set($param, $data, $expire = 3600) {
        setcookie($param, $data, time() + $expire, $this->path, $this->domain, $this->secure);
    }

    public function get($param) {
        if (isset($_COOKIE[$param])) {
            return $_COOKIE[$param];
        } else {
            return FALSE;
        }
    }

    public function delete($param) {
        if (isset($_COOKIE[$param])) {
            setcookie($param, null, -1, $this->path);
            unset($_COOKIE[$param]);
        } else {
            return FALSE;
        }
    }

    public function config($param = array()) {
        if (isset($param['expire'])) {
            $this->expire = $param['expire'];
        }
        if (isset($param['path'])) {
            $this->path = $param['path'];
        }
        if (isset($param['domain'])) {
            $this->domain = $param['domain'];
        }
        if (isset($param['secure'])) {
            $this->secure = $param['secure'];
        }
        if (isset($param['httponly'])) {
            $this->httponly = $param['httponly'];
        }
    }

}

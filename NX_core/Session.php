<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Session
 *
 * @author WIN7
 */

namespace NX_framework\NX_core\Session;

class Session {

    private $session_id;

    public function __construct() {
        session_start();
        $this->session_id = session_id();
        if (!isset($_SESSION[$this->session_id]))
            $_SESSION[$this->session_id] = array();
        if (!isset($_SESSION[$this->session_id]['NX_'])) {
            $_SESSION[$this->session_id]['NX_'] = array(
                'last_active' => time(),
                'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                'user_ip' => $_SERVER['REMOTE_ADDR']
            );
        }
    }

    public function config($param = array()) {
        
    }

    public function last_active() {
        return $_SESSION[$this->session_id]['NX_']['last_active'];
    }
    
    public function session_id() {
        return $this->session_id;
    }

    public function set_data($param, $data) {
        $_SESSION[$this->session_id][$param] = $data;
    }

    public function get_data($param) {
        if (isset($_SESSION[$this->session_id][$param])) {
            return $_SESSION[$this->session_id][$param];
        } else {
            return FALSE;
        }
    }

    public function unset_data($param) {
        if (isset($_SESSION[$this->session_id][$param])) {
            unset($_SESSION[$this->session_id][$param]);
        } else {
            return FALSE;
        }
    }

}

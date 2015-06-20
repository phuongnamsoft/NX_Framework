<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author WIN7
 */
use NX_framework\NX_core\Controller\Controller;

class home extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        echo $this->database();
        
    }

    public function home() {
        $this->input->params();
    }
    
    public function login() {
        $data = array(
            'page' => 'login',
            'data' => 'hello'
        );
        $this->load->view('index',$data);
    }

}

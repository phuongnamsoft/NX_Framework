<?php

namespace NX_framework\NX_core\Controller;

use NX_framework\NX_core\Loader\Loader;
use NX_framework\NX_core\Input\Input;
use NX_framework\NX_core\Router\Router;
use NX_framework\NX_core\Session\Session;
use NX_framework\NX_core\Exceptions\Exceptions;
use NX_framework\NX_core\Upload\Upload;

class Controller {

    static $instance;
    public $load;

    public function __construct() {
        $this->exception = new Exceptions();
        $this->router = new Router();
        $this->input = new Input();
        $this->upload = new Upload();
        $this->session = new Session();
        $this->load = new Loader();
    }

    public function __call($name, $arguments) {
        $this->$name = $this->load->$name();
    }

    public static function &get_instance() {
        return self::$instance;
    }

}

namespace NX_framework\NX_core\NX_Controller;
use NX_framework\NX_core\Controller\Controller;

class NX_Controller extends Controller {

    public function __construct() {
        parent::__construct();
    }

}

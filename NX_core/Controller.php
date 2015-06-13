<?php

namespace NX_framework\NX_core\Controller;

use NX_framework\NX_core\Loader\Loader;
use NX_framework\NX_core\Input\Input;
use NX_framework\NX_core\Router\Router;
use NX_framework\NX_core\Session\Session;

class Controller {

    public function __construct() {
        $this->router = new Router();
        $this->input = new Input();
        $this->session = new Session();
        $this->load = new Loader();
    }

}

namespace NX_framework\NX_core\NX_Controller;

use NX_framework\NX_core\Controller;

class NX_Controller extends Controller {

    public function __construct() {
        parent::__construct();
    }

}

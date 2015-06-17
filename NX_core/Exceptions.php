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

    public function show_404($filename) {
        $data = array(
        'error_code' => '404',
        'error_title' => '404 - Not Found',
        'error_message' => "The requested URL was not found on this server.",
        'time' => date('l jS \of F Y h:i:s A'),
        'filename' => $filename
        );
        $this->template($data);
    }

    public function show_500() {
        $data = array(
            'error_code' => '500',
            'error_title' => '500 - Internal Server Error',
            'error_message' => "The server encountered an internal error or misconfiguration and was unable to complete your request",
            'time' => date('l jS \of F Y h:i:s A')
        );
    }

    public function show_error($param) {
        
    }

    public function _write_log($param) {
        
    }

    public function template($param = array()) {
        @extract($param);
        echo "
            <html>
            <head>
                    <title>
                            $error_title
                    </title>

                    <style>
                    * { font-family: verdana; font-size: 15pt; COLOR: gray; }
                    b { font-weight: bold; }
                    table { height: 50%; border: 1px solid gray;}
                    td { text-align: center; padding: 25;}

                    </style>
            </head>
            <body>
            <center>
            <br><br><br><br>
                    <table>
                    <tr><td><b>$error_title</b></td></tr>
                    <tr><td>$error_message</td></tr>
                    <tr><td style='font-size: 8pt'>Filename: $filename.php  Date: $time</td></tr>
                    </table>
            <br><br>

            </center>
            </body>

            </html>";
    }

}

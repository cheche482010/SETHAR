<?php
date_default_timezone_set('America/Caracas');
ini_set('display_errors', 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
error_reporting(E_NOTICE);
 set_error_handler(function($errno, $errstr, $errfile, $errline) {
            $log = date('[Y-m-d H:i:s]') . " Error $errno: $errstr en $errfile:$errline\n";
            error_log($log, 3, 'errores.log');
        });
        
if (file_exists("vendor/autoload.php")) {
    require_once "vendor/autoload.php";
} else {
    die("[Error Composer] => El Archivo autoload.php es requerido.");
}

use Iniciar_Sistema as Iniciar_Sistema;
$app = new Iniciar_Sistema();

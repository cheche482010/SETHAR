<?php
date_default_timezone_set('America/Caracas');
ini_set('display_errors', 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
error_reporting(E_NOTICE);

$autoload =  'componentes/vendor/autoload.php';
if (file_exists($autoload)) {
    require_once $autoload;
} else {
    die('[Error] No se ha encontrado el archivo autoload.php generado por Composer.');
}

Errores::Capturar();

use App as Iniciar_Sistema;
$app = new Iniciar_Sistema();

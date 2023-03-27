<?php

class Errores
{
    private $ruta = '/componentes/logs/';
    
    public function __construct()
    {
        set_error_handler(array($this, 'manejo_errores'));
    }
    
    public function manejo_errores($errno, $errstr, $errfile, $errline)
    {
        switch ($errno) {
            case E_USER_ERROR:
                $tipoError = 'modelo-error';
                break;
            case E_USER_WARNING:
                $tipoError = 'controlador-warning';
                break;
            case E_USER_NOTICE:
                $tipoError = 'sistema-notice';
                break;
            default:
                $tipoError = 'general';
                break;
        }
        
        $log = date('[Y-m-d H:i:s]') . " Error $errno: $errstr en $errfile:$errline\n";
        error_log($log, 3, $this->ruta . $tipoError . '.log');
    }
    
    public static function Capturar()
    {
        return new self();
    }
}


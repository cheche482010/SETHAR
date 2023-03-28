<?php

class Errores
{
    public function __construct()
    {
        set_error_handler(array($this, 'Manejo_Errores'));
        set_exception_handler(array($this, 'Manejo_Excepciones'));
    }

    public function Manejo_Errores($errno, $errstr, $errfile, $errline)
    {
        switch ($errno) {
            case E_USER_ERROR:
                $tipoError = 'modelo';
                break;
            case E_USER_WARNING:
                $tipoError = 'controlador';
                break;
            case E_USER_NOTICE:
                $tipoError = 'sistema';
                break;
            case E_ERROR:
                $tipoError = 'error';
                break;
            case E_WARNING:
                $tipoError = 'advertencia';
                break;
            case E_NOTICE:
                $tipoError = 'notificacion';
                break;
            case E_PARSE:
                $tipoError = 'parseo';
                break;
            case E_DEPRECATED:
                $tipoError = 'obsoleto';
                break;
            default:
                $tipoError = 'general';
                break;
        }

        $log = date('[Y-m-d H:i:s]') . " Error $errno: $errstr en $errfile:$errline\n";
        error_log($log, 3, "componentes/logs/" . $tipoError . '.log');
    }

    public function Manejo_Excepciones($exception)
    {
        if ($exception instanceof PDOException) {
            $tipoError = 'pdo';
        } else if ($exception instanceof Exception) {
            $tipoError = 'exception';
        } else {
            $tipoError = 'general';
        }
        $log = date('[Y-m-d H:i:s]') . " Excepción: " . $exception->getMessage() . " en " . $exception->getFile() . ":" . $exception->getLine() . "\n";
        error_log($log, 3, "componentes/logs/excepciones.log");
    }

    public static function Personalizado($mensaje)
    {

        $log = date('[Y-m-d H:i:s]') . " Error personalizado: $mensaje\n";
        error_log($log, 3, "componentes/logs/personalizado.log");
    }

    public static function Capturar()
    {
        return new self();
    }
}

<?php

final class Iniciar_Sistema
{
    private $url;
    private $parametros;
    private $controlador;
    private $directorrio;
    private $archivo_controlador;
    private $nombre_controlador;
    
    public function __construct()
    {
        session_start();
        $this->url = isset($_GET['url']) ? $_GET['url'] : null;
        $this->url = rtrim($this->url, '/');
        $this->url = explode('/', $this->url);
        // set_error_handler(function($errno, $errstr, $errfile, $errline) {
        //     $log = date('[Y-m-d H:i:s]') . " Error $errno: $errstr en $errfile:$errline\n";
        //     error_log($log, 3, 'errores.log');
        // });
        $this->archivo_controlador = 'controlador/' . strtolower($this->url[0]) . '_controlador.php';

        if (empty($this->url[0])) {
            require_once 'controlador/plantas_controlador.php';
            $this->controlador = new Plantas();
            $this->controlador->Cargar_Modelo('plantas');
            $this->controlador->Cargar_Vistas();
        } else {
            require_once $this->archivo_controlador;
            $this->nombre_controlador = ucwords($this->url[0]);
            $this->controlador = new $this->nombre_controlador;
            $this->controlador->Cargar_Modelo($this->url[0]);
            $N_parametors = sizeof($this->url);
            if ($N_parametors > 1) {
                if ($N_parametors > 2) {
                    $parametros = [];
                    for ($i = 2; $i < $N_parametors; $i++) {
                        array_push($parametros, $this->url[$i]);
                    }
                    $this->parametros = $parametros;
                    $this->controlador->{$this->url[1]}($this->parametros);
                } else {
                    $this->controlador->{$this->url[1]}();
                }
            } else {
                $this->controlador->Cargar_Vistas();
            }
        }
    }

}

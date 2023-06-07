<?php

use Componentes\Funciones\Mensajes;

class Login extends Controlador
{
    use Mensajes;

    public function __construct()
    {
        parent::__construct();
    }

    public function Cargar_Vistas()
    {
        Vista::Login('index');
    }
}

<?php

class Ejemplo extends Controlador
{

    public function __construct()
    {
        parent::__construct();
    }

    public function Cargar_Vistas()
    {   
        echo "si llego aqui";
        // $this->vista->Cargar_Vistas('ejemplo/index');
    }

}

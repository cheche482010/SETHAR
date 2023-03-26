<?php

class Plantas extends Controlador
{

    public function __construct()
    {
        parent::__construct();
    }

    public function Cargar_Vistas()
    {   
        $this->vista->Cargar_Vistas('inicio/index');
    }

}

<?php

class Ejemplo extends Controlador
{

    public function __construct()
    {
        parent::__construct();
    }

    public function Cargar_Vistas()
    {   
        echo "string";
        // $this->modelo->_SQL_("SQL_02");
        // $x = $this->modelo->Administrar();
        // echo var_dump($x);
        // $this->vista->Cargar_Vistas('ejemplo/index');
    }
}

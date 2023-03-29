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
        #CONSULTA
        // $this->consulta["EJEMPLO"] = $this->modelo->_SQL_("SQL_02")->Administrar();
        #EJECUCION
        // $result = $this->modelo->_SQL_("SQL_01")->_Datos_($datos)->Administrar();
        // $this->vista->Cargar_Vistas('ejemplo/index');
    }
}

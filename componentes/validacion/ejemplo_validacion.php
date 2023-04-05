<?php

class Ejemplo_Validacion extends Validacion
{
    public  $mensaje;
    private $Errores;
    private $datos;

    public function __construct()
    {
        parent::__construct();
        $this->datos = $_POST['datos'];
    }

    public function Validacion()
    {
        
    }

    public function Mensaje()
    {
        return $this->mensaje;
    }

    public function Datos()
    {
        return $this->datos;
    }
}

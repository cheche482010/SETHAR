<?php 
// =============MODELO==============

class Modelo extends BASE_DATOS 
{
    #Public: acceso sin restricción.
    #Protected:Solo puede ser accesado por una clase heredada y la clase que lo define.
    #Private:Solo puede ser accesado por la clase que lo define.

    public function __construct()
    {
        parent::__construct();
    }
    
    public function Desconectar()
    {
        return $this->Configuracion()->close();
    }
     // =============CREAR VARIABLE PUBLICAS==============

    public function __GET($A)
    {
        return $this->$A;
    }
    public function __SET($A, $B)
    {
        return $this->$A = $B;
    }
}
?>
<?php
// =============CONTROLADOR=========
class Controlador
{  
    #Public: acceso sin restricción.
    #Protected:Solo puede ser accesado por una clase heredada y la clase que lo define.
    #Private:Solo puede ser accesado por la clase que lo define. 
    protected $controlador;
    protected $modelo;
    protected $vista;

    public function __construct()
    {
        $this->Cargar_Vista();
        
    }

    public function Cargar_Modelo($model)
    {
        $url = 'modelo/' . $model . '_class.php';

        if (file_exists($url)) {
            require $url;

            $modelName       = $model . '_Modelo';
            $reflectionClass = new ReflectionClass($modelName);

            if ($reflectionClass->IsInstantiable()) {
                $this->modelo = new $modelName();
            } else {
                $this->error = '[Error Objeto] => "El Objeto: [ ' . $modelName . ' ] No puede ser Instanciado."';
                return $this->Capturar_Error($this->error);
            }
        }
    }
    
    public function Cargar_Vista()
    {
        $this->vista = new Vista();
    }
    
}

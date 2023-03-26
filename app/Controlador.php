<?php
// =============CONTROLADOR=========
class Controlador
{
    #Public: acceso sin restricción.
    #Protected:Solo puede ser accesado por una clase heredada y la clase que lo define.
    #Private:Solo puede ser accesado por la clase que lo define.
    protected $controlador;
    protected $modelo;
    public $vista;

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
            }
        }
    }

    public function Cargar_Modelo2($model)
    {
        $modelName = $model . '_Modelo';

        // Autocarga de clases
        spl_autoload_register(function ($className) {
            $path = str_replace('_', '/', $className) . '.php';
            if (file_exists($path)) {
                require_once $path;
            }
        });

        // Creación de la instancia del modelo
        try {
            $this->modelo = ModeloFactory::crear($modelName);
        } catch (Exception $e) {
            throw new Exception('No se pudo cargar el modelo: ' . $e->getMessage());
        }
    }

    public function Cargar_Vista()
    {
        $this->vista = new Vista();
    }

}

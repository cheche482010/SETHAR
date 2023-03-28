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
        $nombre_modelo = $model . '_Modelo';
        // Autocarga de clases
        spl_autoload_register(function ($model) {
            $direccion = 'modelo/' . $model . '_class.php';
            if (file_exists($direccion)) {
                require_once $direccion;
            }
        });

        $class = new Clases($nombre_modelo);
        if ($class->validar()) {
            $this->modelo          = $class->instanciar();
        } else {
            Errores::Capturar()->Personalizado('No se pudo cargar el modelo');
        }
    }

    public function Cargar_Propiedades($propiedad)
    {
        $nombre_propiedad = $propiedad . '_Propiedad';
        // Autocarga de clases
        spl_autoload_register(function ($propiedad) {
            $direccion = 'controlador/propiedades/' . $propiedad . '.php';
            if (file_exists($direccion)) {
                require_once $direccion;
            }
        });

        $class = new Clases($nombre_propiedad);
        if ($class->validar()) {
            $this->propiedad = $class->instanciar();
        } else {
            Errores::Capturar()->Personalizado('No se pudo cargar la propiedad');
        }
    }

    public function Cargar_Entidades($entidad)
    {
        $nombre_entidad = $entidad . '_Entidad';
        // Autocarga de clases
        spl_autoload_register(function ($entidad) {
            $direccion = 'modelo/propiedades/' . $entidad . '.php';
            if (file_exists($direccion)) {
                require_once $direccion;
            }
        });

        $class = new Clases($nombre_entidad);
        if ($class->validar()) {
            $this->modelo->entidad = $class->instanciar();
        } else {
            Errores::Capturar()->Personalizado('No se pudo cargar la entidad');
        }
    }

    public function Cargar_Vista()
    {
        $this->vista = new Vista();
    }

}

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
            $this->modelo = $class->instanciar();
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

    public function Cargar($tipo, $nombre)
    {
        $nombre  = ucfirst($nombre);
        $archivo = strtolower($nombre);
        switch ($tipo) {
            case 'modelo':
                $nombre_clase = $nombre . '_Modelo';
                $direccion    = 'modelo/' . $archivo . '_class.php';
                break;
            case 'entidad':
                $nombre_clase = $nombre . '_Entidad';
                $direccion    = 'modelo/entidades/' . $archivo . '.php';
                break;
            case 'controlador':
                $nombre_clase = $nombre;
                $direccion    = 'controlador/' . $archivo . '_controlador.php';
                break;
            case 'propiedad':
                $nombre_clase = $nombre . '_Propiedad';
                $direccion    = 'controlador/propiedades/' . $archivo . '.php';
                break;
            case 'validacion':
                $nombre_clase = $nombre . '_Validacion';
                $direccion    = 'componentes/validacion/' . $archivo . '_validacion.php';
                break;

            default:
                Errores::Capturar()->Personalizado('Tipo de carga no válido');
                return;
        }

        // Autocarga de clases
        spl_autoload_register(function ($nombre_clase) use ($direccion) {
            if (file_exists($direccion)) {
                require_once $direccion;
            }
        });

        $class = new Clases($nombre_clase);
        if ($class->validar()) {
            switch ($tipo) {
                case 'modelo':
                    $this->modelo = $class->instanciar();
                    break;
                case 'entidad':
                    $this->modelo->entidad = $class->instanciar();
                    break;
                case 'controlador':
                    $this->controlador = $class->instanciar();
                    break;
                case 'propiedad':
                    $this->controlador->propiedad = $class->instanciar();
                    break;
                case 'validacion':
                    $this->controlador->validacion = $class->instanciar();
                    break;

            }
        } else {
            Errores::Capturar()->Personalizado('No se pudo cargar el ' . $tipo);
        }
    }

    public function Cargar_Vista()
    {
        $this->vista = new Vista();
    }

}

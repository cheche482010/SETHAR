<?php

use Componentes\Interfaces\Metodos_APP;

class App implements Metodos_APP
{
    private $url;
    private $error;
    private $num_params;
    private $controlador;
    private $directorrio;
    private $archivo_controlador;
    public $parametros;

    public function __construct()
    {
        session_start();
        $this->url = isset($_GET['url']) && !empty($_GET['url']) ? $_GET['url'] : null;
        $this->url = rtrim($this->url, '/');
        $this->url = explode('/', $this->url);

        if (isset($_SESSION['usuario'])) {
            $this->url[0] = isset($this->url[0]) && !empty($this->url[0]) ? $this->url[0] : 'inicio';
        } else {
            $this->url[0] = isset($this->url[0]) && !empty($this->url[0]) ? $this->url[0] : 'login';
        }

        $this->archivo_controlador = 'controlador/' . strtolower($this->url[0]) . '_controlador.php';
        $this->Iniciar_Ruteo();
    }

    public function Cargar_Controladores()
    {
        require_once $this->archivo_controlador;
        $this->class = new Clases($this->url[0]);
        if ($this->class->validar()) {
            $this->controlador = $this->class->instanciar();
        } else {
            Errores::Capturar()->Personalizado('No se pudo cargar el controlador: ' . $this->archivo_controlador);
        }
        $this->controlador->Cargar("modelo", $this->url[0]);
        // $this->controlador->Cargar("entidad", $this->url[0]);
        return true;
    }

    public function Cargar_Funciones()
    {
        if ($this->class->verificar_funcion($this->url[1])) {
            $this->controlador->{$this->url[1]}();
        } else {
            Errores::Capturar()->Personalizado('No existe la funcion : ' . $this->url[1] . "() \nEn la clase: " . $this->class->nombre_clase() . "\nArchivo: " . __FILE__);
        }
    }

    public function Validar_Conexion()
    {
        return ($this->controlador->modelo->Probar_Conexion() == 1) ? true : false;
    }

    public function Iniciar_Ruteo()
    {
        if ($this->Validar_Archivos_Controlador()) {
            $this->Cargar_Controladores();
            if ($this->Validar_Conexion()) {
                $this->num_params = count($this->url) - 1;
                if ($this->num_params >= 1 && isset($this->url[1])) {
                    if ($this->num_params >= 2 && $this->class->verificar_funcion($this->url[1])) {
                        $this->parametros = array_slice($this->url, 2);
                        $this->controlador->{$this->url[1]}($this->parametros);
                    } else {
                        $this->Cargar_Funciones();
                    }
                } else {
                    $this->controlador->Cargar_Vistas();
                }
            } else {
                Errores::Capturar()->Manejo_Excepciones($this->controlador->modelo->Error_Conexion());
            }
        }
    }

    public function Validar_Archivos_Controlador()
{
    $controlador = ucfirst($this->url[0]);
    $validacion  = true;

    // Excluir la verificación de archivos de la clase Vista y la función Recursos
    if ($controlador !== 'Vista' && $controlador !== 'Recursos') {
        if (!file_exists($this->archivo_controlador)) {
            Errores::Capturar()->Personalizado('El Archivo del Controlador No Existe: ' . $this->archivo_controlador);
            $validacion = false;
        }
        if (!class_exists($controlador)) {
            Errores::Capturar()->Personalizado('La Clase del Controlador No Existe: ' . $controlador);
            $validacion = false;
        }
    }

    return $validacion;
}


}

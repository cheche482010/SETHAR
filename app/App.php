<?php

class App
{
    private $url;
    private $error;
    private $parametros;
    private $controlador;
    private $directorrio;
    private $archivo_controlador;

    public function __construct()
    {
        session_start();
        // $this->Errores = new Errores;
        $this->url = isset($_GET['url']) ? $_GET['url'] : null;
        $this->url = rtrim($this->url, '/');
        $this->url = explode('/', $this->url);

        $this->archivo_controlador = 'controlador/' . strtolower($this->url[0]) . '_controlador.php';

        if (isset($_SESSION['usuario'])) {
            if (empty($this->url[0])) {
                require_once 'controlador/ejemplo_controlador.php';
                $this->controlador = new Ejemplo();
                $this->controlador->Cargar_Modelo('ejemplo');
                $this->controlador->Cargar_Vistas();
            } else {
                if ($this->Validar_Archivos_Controlador()) {
                    $this->Cargar_Controladores();
                    $N_parametors = sizeof($this->url);
                    if ($N_parametors > 1) {
                        if ($N_parametors > 2) {
                            $parametros = [];
                            for ($i = 2; $i < $N_parametors; $i++) {
                                array_push($parametros, $this->url[$i]);
                            }
                            $this->parametros = $parametros;
                            if ($this->class->verificar_funcion($this->url[1])) {
                                $this->controlador->{$this->url[1]}($this->parametros);
                            } else {
                                $this->Errores->Error_409($this->error);
                            }
                        } else {
                            $this->Cargar_Funciones();
                        }
                    } else {
                        $this->controlador->Cargar_Vistas();
                    }
                }
            }
        } else {
            if (file_exists($this->archivo_controlador)) {
                $this->Cargar_Controladores();
                if (isset($this->url[1])) {
                    $this->Cargar_Funciones();
                } else {
                    $this->controlador->Cargar_Vistas();
                }
            } else {
                require_once 'controlador/ejemplo_controlador.php';
                $this->controlador = new Ejemplo();
                $this->controlador->Cargar_Modelo('Ejemplo');
                if (isset($this->url[1])) {
                    $this->controlador->{$this->url[1]}();
                } else {
                    $this->controlador->Cargar_Vistas();
                }
            }
        }
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
        $this->controlador->Cargar_Modelo($this->url[0]);
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

    private function Validar_URL()
    {
        $patron = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        if (!preg_match($patron, $url)) {
            throw new Exception("La URL '$url' no es válida");
        }
    }

    private function Validar_Conexion()
    {
        $conexion = new BASE_DATOS();
        if (!$conexion->Probar_Conexion() == 1) {
            $this->error[] = $conexion->Error_Conexion();
            return false;
        } else {
            return true;
        }
        unset($conexion);
    }

    private function Validar_Archivos_Controlador()
    {
        $controlador = ucfirst($this->url[0]);
        $validacion  = true;
        if (!file_exists($this->archivo_controlador)) {
            Errores::Capturar()->Personalizado('El Archivo del Controlador No Existe: ' . $this->archivo_controlador);
            $validacion = false;
        }
        if (!class_exists($controlador)) {
            Errores::Capturar()->Personalizado('La Clase del Controlador No Existe: ' . $controlador);
            $validacion = false;
        }

        return $validacion;
    }

}

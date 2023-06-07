<?php

use Componentes\Interfaces\Metodos_Vista;

class Vista implements Metodos_Vista
{
    /**
     * Sesion alternativa.
     * @var mixed
     */
    private $session;
    /**
     * Mensajes opcionale.
     * @var string|null
     */
    public $mensaje;

    /**
     * Constructor de la clase Vista.
     */
    public function __construct()
    {}

    /**
     * Establece la sesión.
     *
     * @param string $session El nombre de la sesión.
     */
    public function _SESSION_(string $session): void
    {$this->session = $session;}

    /**
     * Obtiene la sesión.
     *
     * @return string El nombre de la sesión.
     */
    public function SESSION(): string
    {return $this->session;}

    /**
     * Carga una vista.
     *
     * @param string $nombre El nombre de la vista a cargar.
     */
    public function Cargar_Vistas($nombre)
    {
        require 'vista/' . $nombre . '.php';
    }

    /**
     * Incluye un recurso de la vista pública.
     *
     * @param string $nombre El nombre del recurso a incluir.
     */
    public static function Recursos($nombre)
    {
        $archivo_vista = 'vista/publico/' . $nombre . '.php';
        if (file_exists($archivo_vista)) {
            include $archivo_vista;
        }
    }

    /**
     * Método mágico para manejar llamadas estáticas a vistas.
     *
     * @param string $nombre     El nombre del módulo.
     * @param array  $arguments  Los argumentos de la llamada.
     */
    public static function __callStatic($nombre, $arguments)
    {
        $ruta           = strtolower($nombre) . '/' . $arguments[0];
        $mensaje        = isset($arguments[1]) ? $arguments[1] : null;
        $vista          = new self(); // Crear una instancia de la clase Vista
        $vista->mensaje = ($mensaje !== null) ? $mensaje : null;
        $vista->Cargar_Vistas($ruta);
    }
}

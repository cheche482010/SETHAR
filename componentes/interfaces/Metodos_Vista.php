<?php

namespace Componentes\Interfaces;
/**
 * Interfaz de la clase Vista.
 */
interface Metodos_Vista
{
    /**
     * Establece la sesión.
     *
     * @param string $session El nombre de la sesión.
     */
    public function _SESSION_(string $session): void;

    /**
     * Obtiene la sesión.
     *
     * @return string El nombre de la sesión.
     */
    public function SESSION(): string;

    /**
     * Carga una vista.
     *
     * @param string $nombre El nombre de la vista a cargar.
     */
    public function Cargar_Vistas($nombre);

    /**
     * Incluye un recurso de la vista pública.
     *
     * @param string $nombre El nombre del recurso a incluir.
     */
    public static function Recursos($nombre);

    /**
     * Método mágico para manejar llamadas estáticas a vistas.
     *
     * @param string $nombre     El nombre del módulo.
     * @param array  $arguments  Los argumentos de la llamada.
     */
    public static function __callStatic($nombre, $arguments);
}
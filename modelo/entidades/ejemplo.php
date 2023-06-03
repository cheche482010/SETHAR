<?php

class Ejemplo_Entidad
{
     /**
     * Nombre de entidad.
     * @var string|null
     */
    private $nombre;

    /**
     * Obtiene el nombre de la entidad.
     *
     * @return string El nombre de la entidad.
     */
    public function get_nombre()
    {
        return $this->nombre;
    }

    /**
     * Establece el nombre de la entidad.
     *
     * @param string $nombre El nombre de la entidad.
     */
    public function set_nombre($nombre)
    {
        $this->nombre = $nombre;
    }
}

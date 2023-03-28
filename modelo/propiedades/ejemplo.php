<?php

class Ejemplo_Entidad
{

    private $id;

    private $nombre;

    private $estado;

    public function get_id()
    {
        return $this->id;
    }

    public function get_nombre()
    {
        return $this->nombre;
    }

    public function get_estado()
    {
        return $this->estado;
    }

    public function set_id($nombre)
    {
        $this->nombre = $nombre;
    }

    public function set_nombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function set_stado($estado)
    {
        $this->estado = $estado;
    }
}

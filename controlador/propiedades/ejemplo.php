<?php

class Ejemplo_Propiedad
{

    private $nombre;
   
    public function get_nombre()
    {
        return $this->nombre;
    }

    public function set_nombre($nombre)
    {
        $this->nombre = $nombre;
    }

}

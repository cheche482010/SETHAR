<?php

class Ejemplo_Trait_Entidades
{
    use \Componentes\Funciones\Entidades;

    public function obtenerEntidad()
    {
        // Ejemplo de uso de la función Entidad_Clase()
        $entidad = $this->Entidad_Clase();

        if ($entidad) {
            // Realizar acciones en la entidad obtenida
            $valor = $this->Entidades('obtener', 'nombre');
            $this->Entidades('establecer', 'nombre', 'Nuevo Valor');
        }

        return $entidad;
    }
}

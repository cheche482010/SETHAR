<?php

trait Entidades
{
    /**
     * Obtiene una instancia de la clase entidad correspondiente al modelo actual.
     *
     * @return mixed Una instancia de la clase entidad si existe, de lo contrario, null.
     */
    public function Entidad_Clase()
    {
        $modelo_clase    = get_class($this);
        $entidad_clase   = str_replace('_Modelo', '_Entidad', $modelo_clase);
        $entidad_archivo = 'modelo/entidades/' . strtolower(str_replace('_Modelo', '', $modelo_clase)) . '.php';

        if (file_exists($entidad_archivo)) {
            require_once $entidad_archivo;
            if (class_exists($entidad_clase)) {
                $class = new Clases($entidad_clase);
                if ($class->validar()) {
                    return $this->entidad = $class->instanciar();
                }
            }

        }

        return null;
    }
    public function Entidades($accion = '', $nombre = null, $parametro = null)
    {
        $tipo = strtolower(get_class($this));

        if ($tipo === 'modelo') {
            $objeto = $this->entidad;
        } elseif ($tipo === 'controlador') {
            $objeto = $this->propiedad;
        } else {
            // Si no es un tipo reconocido, retorna null
            return null;
        }

        if ($accion === 'obtener' && !empty($nombre)) {
            // Verificar si la función existe en el objeto y devolver su resultado
            if (method_exists($objeto, "get_$nombre")) {
                return $objeto->{"get_$nombre"}();
            }
        } elseif ($accion === 'establecer' && !empty($nombre)) {
            // Verificar si la función existe en el objeto y establecer el valor
            if (method_exists($objeto, "set_$nombre")) {
                $objeto->{"set_$nombre"}($parametro);
            }
        }

        return $objeto;
    }
}

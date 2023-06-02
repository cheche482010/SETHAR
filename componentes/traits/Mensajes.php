<?php
trait Mensajes
{
    /**
     * Mensaje de éxito al crear un elemento.
     *
     * @param string $nombreElemento Nombre del elemento creado.
     * @return string
     */
    public function Crear_Exitoso($nombreElemento)
    {
        return "¡Se ha creado exitosamente el elemento '{$nombreElemento}'!";
    }

    /**
     * Mensaje de error al crear un elemento.
     *
     * @param string $nombreElemento Nombre del elemento que se intentó crear.
     * @return string
     */
    public function Crear_Error($nombreElemento)
    {
        return "¡No se pudo crear el elemento '{$nombreElemento}'. Por favor, inténtalo de nuevo.";
    }

    /**
     * Mensaje de éxito al leer un elemento.
     *
     * @param string $nombreElemento Nombre del elemento leído.
     * @return string
     */
    public function Leer_Exitoso($nombreElemento)
    {
        return "¡Se ha leído exitosamente el elemento '{$nombreElemento}'!";
    }

    /**
     * Mensaje de error al leer un elemento.
     *
     * @param string $nombreElemento Nombre del elemento que se intentó leer.
     * @return string
     */
    public function Leer_Error($nombreElemento)
    {
        return "¡No se pudo leer el elemento '{$nombreElemento}'. Por favor, inténtalo de nuevo.";
    }

    /**
     * Mensaje de éxito al actualizar un elemento.
     *
     * @param string $nombreElemento Nombre del elemento actualizado.
     * @return string
     */
    public function Actualizar_Exitoso($nombreElemento)
    {
        return "¡Se ha actualizado exitosamente el elemento '{$nombreElemento}'!";
    }

    /**
     * Mensaje de error al actualizar un elemento.
     *
     * @param string $nombreElemento Nombre del elemento que se intentó actualizar.
     * @return string
     */
    public function Actualizar_Error($nombreElemento)
    {
        return "¡No se pudo actualizar el elemento '{$nombreElemento}'. Por favor, inténtalo de nuevo.";
    }

    /**
     * Mensaje de éxito al eliminar un elemento.
     *
     * @param string $nombreElemento Nombre del elemento eliminado.
     * @return string
     */
    public function Eliminar_Exitoso($nombreElemento)
    {
        return "¡Se ha eliminado exitosamente el elemento '{$nombreElemento}'!";
    }

    /**
     * Mensaje de error al eliminar un elemento.
     *
     * @param string $nombreElemento Nombre del elemento que se intentó eliminar.
     * @return string
     */
    public function Eliminar_Error($nombreElemento)
    {
        return "¡No se pudo eliminar el elemento '{$nombreElemento}'. Por favor, inténtalo de nuevo.";
    }

    /**
     * Mensaje de éxito al cargar una lista de elementos.
     *
     * @param string $nombreElemento Nombre de los elementos cargados.
     * @return string
     */
    public function Cargar_Lista_Exitoso($nombreElemento)
    {
        return "¡Se han cargado exitosamente los elementos '{$nombreElemento}'!";
    }

    /**
     * Mensaje de error al cargar una lista de elementos.
     *
     * @param string $nombreElemento Nombre de los elementos que se intentó cargar.
     * @return string
     */
    public function Cargar_Lista_Error($nombreElemento)
    {
        return "¡No se pudieron cargar los elementos '{$nombreElemento}'. Por favor, inténtalo de nuevo.";
    }

    /**
     * Mensaje de éxito al validar un elemento.
     *
     * @param string $nombreElemento Nombre del elemento validado.
     * @return string
     */
    public function Validar_Exitoso($nombreElemento)
    {
        return "¡Se ha validado exitosamente el elemento '{$nombreElemento}'!";
    }

    /**
     * Mensaje de error al validar un elemento.
     *
     * @param string $nombreElemento Nombre del elemento que se intentó validar.
     * @return string
     */
    public function Validar_Error($nombreElemento)
    {
        return "¡No se pudo validar el elemento '{$nombreElemento}'. Por favor, inténtalo de nuevo.";
    }

    /**
     * Mensaje de éxito genérico.
     *
     * @return string
     */
    public function Exito()
    {
        return "¡Operación realizada con éxito!";
    }

    /**
     * Mensaje de error genérico.
     *
     * @return string
     */
    public function Error()
    {
        return "¡Ocurrió un error. Por favor, inténtalo de nuevo!";
    }

    /**
     * Mensaje de acceso denegado.
     *
     * @return string
     */
    public function Acceso_Denegado()
    {
        return "¡Acceso denegado!";
    }

    /**
     * Mensaje de confirmación.
     *
     * @return string
     */
    public function Confirmacion()
    {
        return "¿Estás seguro/a de realizar esta acción?";
    }

    /**
     * Mensaje de advertencia.
     *
     * @return string
     */
    public function Advertencia()
    {
        return "¡Advertencia!";
    }
}

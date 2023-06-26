<?php

trait CMD
{
    /**
     * Ejecuta un comando en la consola y devuelve la salida del comando.
     *
     * @param string $comando El comando a ejecutar.
     * @param string|null $directorio El directorio en el que se ejecutará el comando (opcional).
     * @return string|false La salida del comando si se ejecuta correctamente, o false en caso contrario.
     */
    public function Ejecutar_Consola($comando, $directorio = null)
    {
        $salida  = null;
        $retorno = null;

        if ($directorio !== null) {
            $comando = "cd " . $directorio . " && " . $comando;
        }

        exec($comando, $salida, $retorno);

        return ($retorno === 0) ? implode("\n", $salida) : false;
    }

    /**
     * Obtiene el directorio actual.
     *
     * @return string El nombre del directorio actual.
     */
    public function Obtener_Directorio()
    {
        return basename(getcwd());
    }

    /**
     * Crea un nuevo directorio.
     *
     * @param string $nombre El nombre del directorio a crear.
     * @return bool true si el directorio se crea correctamente, false en caso contrario.
     */
    public function Crear_Directorio($nombre)
    {
        return mkdir($nombre);
    }

    /**
     * Elimina un archivo o directorio.
     *
     * @param string $ruta La ruta del archivo o directorio a eliminar.
     * @return bool true si el archivo o directorio se elimina correctamente, false en caso contrario.
     */
    public function Eliminar_Archivo_Directorio($ruta)
    {
        if (is_file($ruta)) {
            return unlink($ruta);
        } elseif (is_dir($ruta)) {
            return rmdir($ruta);
        } else {
            return false;
        }
    }

    /**
     * Obtiene el contenido de un archivo.
     *
     * @param string $ruta La ruta del archivo.
     * @return string|false El contenido del archivo si se lee correctamente, o false en caso contrario.
     */
    public function Obtener_Archivo($ruta)
    {
        return file_get_contents($ruta);
    }

    /**
     * Lista los archivos en un directorio.
     *
     * @param string $directorio El directorio a listar.
     * @return array Un array con los nombres de los archivos en el directorio.
     */
    public function Listar_Archivos($directorio)
    {
        $elementos = [];
        $contenido = scandir($directorio);

        foreach ($contenido as $item) {
            if ($item !== '.' && $item !== '..') {
                $elementos[] = $item;
            }
        }

        return $elementos;
    }

    /**
     * Cambia los permisos de un archivo o directorio.
     *
     * @param string $ruta La ruta del archivo o directorio.
     * @param int $permisos Los nuevos permisos a establecer.
     * @return bool true si los permisos se cambian correctamente, false en caso contrario.
     */
    public function Cambiar_Permisos($ruta, $permisos)
    {
        return chmod($ruta, $permisos);
    }

    /**
     * Mueve un archivo a una nueva ubicación.
     *
     * @param string $origen La ruta del archivo original.
     * @param string $destino La ruta de destino del archivo.
     * @return bool true si el archivo se mueve correctamente, false en caso contrario.
     */
    public function Mover_Archivo($origen, $destino)
    {
        return rename($origen, $destino);
    }
}

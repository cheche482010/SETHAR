<?php

namespace Componentes\Funciones;

trait Archivos
{
    /**
     * Lee el contenido de un archivo.
     *
     * @param string $ruta La ruta del archivo a leer.
     * @return string|false El contenido del archivo como una cadena de texto, o false en caso de error.
     */
    public function Leer_Archivo(string $ruta): string|false
    {
        return file_get_contents($ruta);
    }

    /**
     * Escribe contenido en un archivo.
     *
     * @param string $ruta La ruta del archivo donde se escribirá el contenido.
     * @param string $contenido El contenido a escribir en el archivo.
     * @return int|false El número de bytes escritos en el archivo, o false en caso de error.
     */
    public function Escribir_Archivo(string $ruta, string $contenido): int|false
    {
        return file_put_contents($ruta, $contenido);
    }

    /**
     * Copia un archivo de origen a un archivo de destino.
     *
     * @param string $rutaOrigen La ruta del archivo de origen.
     * @param string $rutaDestino La ruta del archivo de destino.
     * @return bool true si la copia fue exitosa, false en caso contrario.
     */
    public function Copiar_Archivo(string $rutaOrigen, string $rutaDestino): bool
    {
        return copy($rutaOrigen, $rutaDestino);
    }

    /**
     * Mueve un archivo de una ubicación a otra.
     *
     * @param string $rutaOrigen La ruta del archivo de origen.
     * @param string $rutaDestino La ruta del archivo de destino.
     * @return bool true si el movimiento fue exitoso, false en caso contrario.
     */
    public function Mover_Archivo(string $rutaOrigen, string $rutaDestino): bool
    {
        return rename($rutaOrigen, $rutaDestino);
    }

    /**
     * Elimina un archivo.
     *
     * @param string $ruta La ruta del archivo a eliminar.
     * @return bool true si la eliminación fue exitosa, false en caso contrario.
     */
    public function Eliminar_Archivo(string $ruta): bool
    {
        return unlink($ruta);
    }

    /**
     * Lee el contenido de un directorio.
     *
     * @param string $directorio La ruta del directorio a leer.
     * @return array|false Un array con los nombres de los archivos y subdirectorios, o false en caso de error.
     */
    public function Leer_Directorio(string $directorio): array|false
    {
        return scandir($directorio);
    }

    /**
     * Crea un directorio.
     *
     * @param string $directorio La ruta del directorio a crear.
     * @param int $permisos [opcional] Los permisos del directorio (predeterminado: 0755).
     * @return bool true si la creación fue exitosa, false en caso contrario.
     */
    public function Crear_Directorio(string $directorio, int $permisos = 0755): bool
    {
        return mkdir($directorio, $permisos, true);
    }

    /**
     * Elimina un directorio y su contenido.
     *
     * @param string $directorio La ruta del directorio a eliminar.
     * @return bool true si la eliminación fue exitosa, false en caso contrario.
     */
    public function Eliminar_Directorio(string $directorio): bool
    {
        if (!is_dir($directorio)) {
            return false;
        }

        $archivos = array_diff(scandir($directorio), ['.', '..']);

        foreach ($archivos as $archivo) {
            $ruta = $directorio . DIRECTORY_SEPARATOR . $archivo;
            is_dir($ruta) ? $this->Eliminar_Directorio($ruta) : unlink($ruta);
        }

        return rmdir($directorio);
    }

    /**
     * Cambia el nombre de un directorio.
     *
     * @param string $directorioOrigen La ruta del directorio de origen.
     * @param string $directorioDestino La ruta del directorio de destino.
     * @return bool true si el cambio de nombre fue exitoso, false en caso contrario.
     */
    public function Renombrar_Directorio(string $directorioOrigen, string $directorioDestino): bool
    {
        return rename($directorioOrigen, $directorioDestino);
    }
}

<?php

use Componentes\Funciones\Archivos;

class Ejemplo_Trait_Archivos
{
    use Archivos;

    /**
     * Ejemplo de lectura de un archivo.
     */
    public function ejemploLeerArchivo()
    {
        $ruta = 'ruta/al/archivo.txt';
        $contenido = $this->Leer_Archivo($ruta);

        if ($contenido !== false) {
            echo "Contenido del archivo:\n";
            echo $contenido;
        } else {
            echo "Error al leer el archivo.";
        }
    }

    /**
     * Ejemplo de escritura en un archivo.
     */
    public function ejemploEscribirArchivo()
    {
        $ruta = 'ruta/al/archivo.txt';
        $contenido = "Hola, mundo!";
        $bytesEscritos = $this->Escribir_Archivo($ruta, $contenido);

        if ($bytesEscritos !== false) {
            echo "Se han escrito $bytesEscritos bytes en el archivo.";
        } else {
            echo "Error al escribir en el archivo.";
        }
    }

    /**
     * Ejemplo de copia de un archivo.
     */
    public function ejemploCopiarArchivo()
    {
        $rutaOrigen = 'ruta/al/archivo.txt';
        $rutaDestino = 'ruta/de/destino/archivo.txt';

        if ($this->Copiar_Archivo($rutaOrigen, $rutaDestino)) {
            echo "Archivo copiado exitosamente.";
        } else {
            echo "Error al copiar el archivo.";
        }
    }

    /**
     * Ejemplo de movimiento de un archivo.
     */
    public function ejemploMoverArchivo()
    {
        $rutaOrigen = 'ruta/al/archivo.txt';
        $rutaDestino = 'ruta/de/destino/archivo.txt';

        if ($this->Mover_Archivo($rutaOrigen, $rutaDestino)) {
            echo "Archivo movido exitosamente.";
        } else {
            echo "Error al mover el archivo.";
        }
    }

    /**
     * Ejemplo de eliminación de un archivo.
     */
    public function ejemploEliminarArchivo()
    {
        $ruta = 'ruta/al/archivo.txt';

        if ($this->Eliminar_Archivo($ruta)) {
            echo "Archivo eliminado exitosamente.";
        } else {
            echo "Error al eliminar el archivo.";
        }
    }

    /**
     * Ejemplo de lectura de un directorio.
     */
    public function ejemploLeerDirectorio()
    {
        $directorio = 'ruta/al/directorio';
        $archivos = $this->Leer_Directorio($directorio);

        if ($archivos !== false) {
            echo "Archivos en el directorio:\n";
            foreach ($archivos as $archivo) {
                echo "- $archivo\n";
            }
        } else {
            echo "Error al leer el directorio.";
        }
    }

    /**
     * Ejemplo de creación de un directorio.
     */
    public function ejemploCrearDirectorio()
    {
        $directorio = 'ruta/al/nuevo/directorio';

        if ($this->Crear_Directorio($directorio)) {
            echo "Directorio creado exitosamente.";
        } else {
            echo "Error al crear el directorio.";
        }
    }

    /**
     * Ejemplo de eliminación de un directorio.
     */
    public function ejemploEliminarDirectorio()
    {
        $directorio = 'ruta/al/directorio';

        if ($this->Eliminar_Directorio($directorio)) {
            echo "Directorio eliminado exitosamente.";
        } else {
            echo "Error al eliminar el directorio.";
        }
    }

    /**
     * Ejemplo de cambio de nombre de un directorio.
     */
    public function ejemploRenombrarDirectorio()
    {
        $directorioOrigen = 'ruta/al/directorio';
        $directorioDestino = 'ruta/al/nuevo/directorio';

        if ($this->Renombrar_Directorio($directorioOrigen, $directorioDestino)) {
            echo "Directorio renombrado exitosamente.";
        } else {
            echo "Error al renombrar el directorio.";
        }
    }
}

<?php
trait Traducciones
{
    /**
     * Array que contiene los textos en diferentes idiomas.
     *
     * @var array
     */
    protected $textos = [];

    /**
     * Idioma por defecto.
     *
     * @var string
     */
    protected $idioma_defecto = 'es';

    /**
     * Carga los textos en diferentes idiomas desde un archivo JSON.
     *
     * @param string $rutaArchivo Ruta del archivo JSON que contiene los textos.
     * @return void
     */
    public function Cargar_Textos($rutaArchivo)
    {
        // direccion json/idiomas.json
        $contenidoArchivo = file_get_contents($rutaArchivo);
        $this->textos     = json_decode($contenidoArchivo, true);
    }

    /**
     * Obtiene el texto en el idioma correspondiente.
     *
     * @param string $clave Clave del texto a obtener.
     * @param string|null $idioma Idioma en el que se desea obtener el texto. Si no se proporciona, se utiliza el idioma por defecto.
     * @return string Texto obtenido en el idioma correspondiente.
     */
    public function Obtener_Texto($clave, $idioma = null)
    {
        if (!$idioma) {
            $idioma = $this->idioma_defecto;
        }

        if (isset($this->textos[$idioma][$clave])) {
            return $this->textos[$idioma][$clave];
        }

        return '';
    }

    /**
     * Establece el idioma por defecto.
     *
     * @param string $idioma Idioma por defecto.
     * @return void
     */
    public function Establecer_Idioma_Defecto($idioma)
    {
        $this->idioma_defecto = $idioma;
    }

    /**
     * Agrega un nuevo idioma y sus traducciones al array de textos.
     *
     * @param string $idioma Idioma a agregar.
     * @param array $traducciones Traducciones en el nuevo idioma.
     * @return void
     */
    public function Agregar_Idioma($idioma, $traducciones)
    {
        $this->textos[$idioma] = $traducciones;
    }

    /**
     * Elimina un idioma y sus traducciones del array de textos.
     *
     * @param string $idioma Idioma a eliminar.
     * @return void
     */
    public function Eliminar_Idioma($idioma)
    {
        unset($this->textos[$idioma]);
    }

    /**
     * Actualiza una traducción existente en un idioma específico.
     *
     * @param string $idioma Idioma en el que se desea actualizar la traducción.
     * @param string $clave Clave del texto a actualizar.
     * @param string $traduccion Nueva traducción.
     * @return void
     */
    public function Actualizar_Traduccion($idioma, $clave, $traduccion)
    {
        if (isset($this->textos[$idioma][$clave])) {
            $this->textos[$idioma][$clave] = $traduccion;
        }
    }

    /**
     * Devuelve un array con los idiomas disponibles en el array de textos.
     *
     * @return array Array con los idiomas disponibles.
     */
    public function Obtener_Idiomas_Disponibles()
    {
        return array_keys($this->textos);
    }

    /**
     * Devuelve un array con todas las traducciones existentes en todos los idiomas.
     *
     * @return array Array con todas las traducciones.
     */
    public function Obtener_Todas_Traducciones()
    {
        $traducciones = [];

        foreach ($this->textos as $idioma => $textos) {
            foreach ($textos as $clave => $traduccion) {
                $traducciones[$clave][$idioma] = $traduccion;
            }
        }

        return $traducciones;
    }

    /**
     * Devuelve la cantidad total de traducciones en un idioma específico.
     *
     * @param string $idioma Idioma del que se desea contar las traducciones.
     * @return int Cantidad total de traducciones.
     */
    public function Contar_Traducciones($idioma)
    {
        if (isset($this->textos[$idioma])) {
            return count($this->textos[$idioma]);
        }

        return 0;
    }

    /**
     * Devuelve la traducción por defecto de un texto en caso de que no exista una traducción específica para el idioma solicitado.
     *
     * @param string $clave Clave del texto a obtener.
     * @param string $idioma Idioma en el que se desea obtener el texto.
     * @return string Texto obtenido en el idioma correspondiente.
     */
    public function Obtener_Traduccion_Defecto($clave, $idioma)
    {
        if (isset($this->textos[$this->idioma_defecto][$clave])) {
            return $this->textos[$this->idioma_defecto][$clave];
        }

        return $this->Obtener_Texto($clave, $idioma);
    }
}

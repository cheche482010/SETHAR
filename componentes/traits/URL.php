<?php
trait URL
{
    /**
     * Genera una URL amigable a partir de un texto.
     *
     * @param string $texto Texto a convertir en URL amigable.
     * @return string URL amigable generada.
     */
    public function Generar_URL($texto)
    {
        // Convertir el texto a minúsculas
        $texto = strtolower($texto);
        // Reemplazar caracteres especiales y espacios por guiones
        $texto = preg_replace('/[^a-z0-9\-]/', '-', $texto);
        // Eliminar guiones duplicados
        $texto = preg_replace('/-+/', '-', $texto);
        // Eliminar guiones al comienzo y al final
        $texto = trim($texto, '-');

        return $texto;
    }

    /**
     * Obtiene el texto original a partir de una URL amigable.
     *
     * @param string $url URL amigable.
     * @return string Texto original obtenido de la URL amigable.
     */
    public function Obtener_Texto_URL($url)
    {
        // Reemplazar guiones por espacios
        $texto = str_replace('-', ' ', $url);
        // Convertir la primera letra de cada palabra a mayúscula
        $texto = ucwords($texto);
        return $texto;
    }

    /**
     * Obtiene la URL base de la aplicación.
     *
     * @return string URL base de la aplicación.
     */
    public function Base_URL()
    {
        $protocol = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
        $domain   = $_SERVER['HTTP_HOST'];
        $root     = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']) . "/";
        $url      = $protocol . $domain . $root;
        unset($protocol, $domain, $root);
        return $url;
    }

    /**
     * Limpia un texto para generar una URL amigable.
     *
     * @param string $texto Texto a limpiar.
     * @return string Texto limpio para generar la URL amigable.
     */
    public function Limpiar_Texto_URL($texto)
    {
        $texto = preg_replace('/[^a-zA-Z0-9 ]/', '', $texto);
        $texto = trim($texto);
        $texto = preg_replace('/\s+/', ' ', $texto);
        return $texto;
    }

    /**
     * Genera un slug a partir de un texto.
     *
     * @param string $texto Texto para generar el slug.
     * @return string Slug generado.
     */
    public function Generar_Slug($texto)
    {
        $texto = $this->Limpiar_Texto_URL($texto);
        $slug  = str_replace(' ', '-', $texto);
        return strtolower($slug);
    }

    /**
     * Obtiene los parámetros de una URL amigable.
     *
     * @param string $url URL amigable.
     * @return array Parámetros obtenidos de la URL amigable.
     */
    public function Obtener_Parametros_URL($url)
    {
        $params = explode('/', trim($url, '/'));
        return $params;
    }

    /**
     * Valida si una URL amigable es válida.
     *
     * @param string $url URL amigable a validar.
     * @return bool Retorna true si la URL amigable es válida, false de lo contrario.
     */
    public function Validar_URL($url)
    {
        // Verificar si la URL está en el formato correcto
        if (preg_match('/^[a-z0-9\-\/]+$/', $url)) {
            return true;
        } else {
            return false;
        }
    }

}

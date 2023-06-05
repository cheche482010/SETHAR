<?php
trait Json
{
    /**
     * Convierte un objeto o arreglo en formato JSON.
     *
     * @param mixed $data Los datos a convertir en JSON.
     * @param int $options Opciones de codificación JSON (opcional).
     * @param int $depth Profundidad máxima de codificación (opcional).
     * @return string|null La representación JSON de los datos o null en caso de error.
     */
    public function Codificar_Json($data, $options = 0, $depth = 512)
    {
        return json_encode($data, $options, $depth);
    }

    /**
     * Decodifica una cadena JSON en un objeto o arreglo PHP.
     *
     * @param string $json La cadena JSON a decodificar.
     * @param bool $assoc Si se debe devolver un arreglo asociativo en lugar de un objeto (opcional, valor por defecto: false).
     * @param int $depth Profundidad máxima de decodificación (opcional).
     * @param int $options Opciones de decodificación JSON (opcional).
     * @return mixed Los datos decodificados en formato PHP o null en caso de error.
     */
    public function Decodificar_Json($json, $assoc = false, $depth = 512, $options = 0)
    {
        return json_decode($json, $assoc, $depth, $options);
    }

    /**
     * Verifica si una cadena dada es un formato JSON válido.
     *
     * @param string $json La cadena a verificar.
     * @return bool True si la cadena es un formato JSON válido, False en caso contrario.
     */
    public function Validar_Json($json)
    {
        json_decode($json);
        return (json_last_error() === JSON_ERROR_NONE);
    }

    /**
     * Valida la estructura y el esquema de un objeto JSON sin utilizar paquetes adicionales.
     *
     * @param mixed $data Los datos JSON a validar.
     * @param mixed $schema El esquema JSON a utilizar para la validación.
     * @return bool True si los datos cumplen con el esquema, False en caso contrario.
     */
    public function Validar_Esquema_Json($data, $schema)
    {
        // Convertir el esquema y los datos a arrays
        $schemaArray = json_decode($schema, true);
        $dataArray   = json_decode($data, true);

        // Validar la estructura y el esquema
        return $this->Validar_Estructura($schemaArray, $dataArray);
    }

    /**
     * Función auxiliar para validar la estructura y el esquema del objeto JSON.
     *
     * @param array $schema El esquema JSON.
     * @param array $data Los datos JSON.
     * @return bool True si los datos cumplen con el esquema, False en caso contrario.
     */
    private function Validar_Estructura($schema, $data)
    {
        // Validar las claves del esquema
        foreach ($schema as $key => $value) {
            if (!array_key_exists($key, $data)) {
                return false;
            }

            if (is_array($value)) {
                if (!$this->validarEstructura($value, $data[$key])) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Serializa un objeto PHP en formato JSON.
     *
     * @param object $object El objeto a serializar.
     * @param int $options Opciones de codificación JSON (opcional).
     * @param int $depth Profundidad máxima de codificación (opcional).
     * @return string|null La representación JSON del objeto o null en caso de error.
     */
    public function Serializar_Objeto_Json($object, $options = 0, $depth = 512)
    {
        return json_encode($object, $options, $depth);
    }

    /**
     * Deserializa una cadena JSON en un objeto PHP.
     *
     * @param string $json La cadena JSON a deserializar.
     * @param string $className El nombre de la clase del objeto resultante.
     * @return object|null El objeto deserializado o null en caso de error.
     */
    public function Deserializar_Objeto_Json($json, $className)
    {
        $data = json_decode($json, true);
        return new $className($data);
    }

    /**
     * Busca un valor en un objeto JSON utilizando una clave específica.
     *
     * @param string $json La cadena JSON en la que se realizará la búsqueda.
     * @param string $key La clave a buscar en el objeto JSON.
     * @return mixed|null El valor encontrado o null si la clave no existe.
     */
    public function Buscar_Valor_Json($json, $key)
    {
        $data = json_decode($json, true);

        $keys  = explode('.', $key);
        $value = $data;

        foreach ($keys as $key) {
            if (isset($value[$key])) {
                $value = $value[$key];
            } else {
                return null;
            }
        }

        return $value;
    }

    /**
     * Ordena un arreglo JSON por una clave específica.
     *
     * @param string $json La cadena JSON que contiene el arreglo a ordenar.
     * @param string $key La clave por la que se ordenará el arreglo.
     * @return string|null El arreglo JSON ordenado o null en caso de error.
     */
    public function Ordenar_Arreglo_Json($json, $key)
    {
        $data = json_decode($json, true);

        usort($data, function ($a, $b) use ($key) {
            return $a[$key] <=> $b[$key];
        });

        return json_encode($data);
    }

    /**
     * Embellece una cadena JSON para mejorar su legibilidad.
     *
     * @param string $json La cadena JSON a embellecer.
     * @return string|null La cadena JSON embellecida o null en caso de error.
     */
    public function Embellecer_Json($json)
    {
        $data = json_decode($json);
        return json_encode($data, JSON_PRETTY_PRINT);
    }

    /**
     * Codifica datos binarios en formato JSON utilizando Base64.
     *
     * @param string $data Los datos binarios a codificar.
     * @return string|null La representación JSON de los datos binarios codificados en Base64 o null en caso de error.
     */
    public function Codificar_Binario_Json($data)
    {
        return json_encode(base64_encode($data));
    }

    /**
     * Decodifica datos binarios codificados en formato JSON utilizando Base64.
     *
     * @param string $json La cadena JSON que contiene los datos binarios codificados en Base64.
     * @return string|null Los datos binarios decodificados o null en caso de error.
     */
    public function Decodificar_Binario_Json($json)
    {
        $data = json_decode($json, true);
        return base64_decode($data);
    }

}

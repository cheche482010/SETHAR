<?php

namespace Componentes\Funciones;

trait Api
{
    /**
     * Realiza una solicitud GET a una API.
     *
     * @param string $url URL de la API
     * @param array $headers Encabezados opcionales de la solicitud
     * @return mixed Respuesta de la API en formato JSON o false en caso de error
     */
    public function get($url, $headers = [])
    {
        $options = [
            'http' => [
                'header' => $this->buildHeaders($headers),
                'method' => 'GET',
            ],
        ];
        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        return $response !== false ? json_decode($response, true) : false;
    }

    /**
     * Realiza una solicitud POST a una API.
     *
     * @param string $url URL de la API
     * @param array $data Datos a enviar en la solicitud
     * @param array $headers Encabezados opcionales de la solicitud
     * @return mixed Respuesta de la API en formato JSON o false en caso de error
     */
    public function post($url, $data, $headers = [])
    {
        $options = [
            'http' => [
                'header'  => $this->buildHeaders($headers),
                'method'  => 'POST',
                'content' => http_build_query($data),
            ],
        ];
        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        return $response !== false ? json_decode($response, true) : false;
    }

    /**
     * Construye los encabezados de la solicitud.
     *
     * @param array $headers Encabezados de la solicitud
     * @return string Encabezados formateados para la solicitud
     */
    private function buildHeaders($headers)
    {
        $formattedHeaders = [];
        foreach ($headers as $key => $value) {
            $formattedHeaders[] = "$key: $value";
        }

        return implode("\r\n", $formattedHeaders);
    }

    /**
     * Realiza una solicitud PUT a una API.
     *
     * @param string $url URL de la API
     * @param array $data Datos a enviar en la solicitud
     * @param array $headers Encabezados opcionales de la solicitud
     * @return mixed Respuesta de la API en formato JSON o false en caso de error
     */
    public function put($url, $data, $headers = [])
    {
        $options = [
            'http' => [
                'header'  => $this->buildHeaders($headers),
                'method'  => 'PUT',
                'content' => http_build_query($data),
            ],
        ];
        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        return $response !== false ? json_decode($response, true) : false;
    }

    /**
     * Realiza una solicitud DELETE a una API.
     *
     * @param string $url URL de la API
     * @param array $headers Encabezados opcionales de la solicitud
     * @return mixed Respuesta de la API en formato JSON o false en caso de error
     */
    public function delete($url, $headers = [])
    {
        $options = [
            'http' => [
                'header' => $this->buildHeaders($headers),
                'method' => 'DELETE',
            ],
        ];
        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        return $response !== false ? json_decode($response, true) : false;
    }

    /**
     * Obtiene un valor específico de la respuesta JSON.
     *
     * @param array $response Respuesta JSON
     * @param string $key Clave del valor a obtener
     * @param mixed $defaultValue Valor predeterminado si la clave no existe
     * @return mixed Valor correspondiente a la clave o valor predeterminado si la clave no existe
     */
    public function getResponseValue($response, $key, $defaultValue = null)
    {
        return isset($response[$key]) ? $response[$key] : $defaultValue;
    }

    /**
     * Maneja errores y excepciones específicas de las respuestas de la API.
     *
     * @param mixed $response Respuesta de la API
     * @param int $statusCode Código de estado HTTP esperado
     * @param string $errorMessage Mensaje de error personalizado
     * @throws Exception Si la respuesta no coincide con el código de estado esperado
     */
    public function handleApiResponse($response, $statusCode, $errorMessage = 'Error en la respuesta de la API')
    {
        if ($response === false) {
            throw new Exception($errorMessage);
        }

        if (is_array($response) && $this->getResponseValue($response, 'status_code') !== $statusCode) {
            throw new Exception($errorMessage);
        }
    }

    /**
     * Obtiene la siguiente página de resultados de una API paginada.
     *
     * @param string $url URL de la API paginada
     * @param int $currentPage Página actual
     * @param int $perPage Resultados por página
     * @param array $headers Encabezados opcionales de la solicitud
     * @return mixed Respuesta de la API en formato JSON o false en caso de error
     */
    public function getNextPage($url, $currentPage, $perPage, $headers = [])
    {
        $start  = ($currentPage - 1) * $perPage;
        $newUrl = str_replace('{start}', $start, $url);

        return $this->get($newUrl, $headers);
    }

    /**
     * Implementa una caché simple para almacenar en caché las respuestas de la API.
     *
     * @param string $key Clave de caché única para la solicitud
     * @param callable $callback Función de devolución de llamada para realizar la solicitud a la API
     * @param int $expiration Tiempo de expiración de la caché en segundos
     * @return mixed Respuesta de la API en formato JSON o false en caso de error
     */
    public function cachedRequest($key, $callback, $expiration)
    {
        $cache = $this->getFromCache($key);
        if ($cache !== false) {
            return $cache;
        }

        $response = $callback();

        if ($response !== false) {
            $this->storeInCache($key, $response, $expiration);
        }

        return $response;
    }

    /**
     * Obtiene el valor almacenado en caché para una clave dada.
     *
     * @param string $key Clave de caché
     * @return mixed Valor almacenado en caché o false si no existe o ha expirado
     */
    public function getFromCache($key)
    {
        $cacheFile = $this->getCacheFilePath($key);
        if (file_exists($cacheFile)) {
            $cacheData = file_get_contents($cacheFile);
            $cache     = unserialize($cacheData);

            if ($cache['expiration'] >= time()) {
                return $cache['value'];
            }
        }

        return false;
    }

    /**
     * Almacena un valor en caché con una clave y un tiempo de expiración dados.
     *
     * @param string $key Clave de caché
     * @param mixed $value Valor a almacenar en caché
     * @param int $expiration Tiempo de expiración de la caché en segundos
     */
    public function storeInCache($key, $value, $expiration)
    {
        $cache = [
            'value'      => $value,
            'expiration' => time() + $expiration,
        ];
        $cacheData = serialize($cache);
        $cacheFile = $this->getCacheFilePath($key);
        file_put_contents($cacheFile, $cacheData);
    }

    /**
     * Obtiene la ruta del archivo de caché para una clave dada.
     *
     * @param string $key Clave de caché
     * @return string Ruta del archivo de caché
     */
    private function getCacheFilePath($key)
    {
        $cacheDir = 'cache/'; // Directorio donde se almacenarán los archivos de caché
        return $cacheDir . md5($key) . '.cache';
    }

    /**
     * Configura los encabezados de autenticación para las solicitudes a la API.
     *
     * @param array $headers Encabezados existentes de la solicitud
     * @return array Encabezados actualizados con la autenticación
     */
    private function setAuthenticationHeaders($headers)
    {
        $authToken                = $this->generateAuthToken(); // Función para generar el token de autenticación
        $headers['Authorization'] = 'Bearer ' . $authToken;

        return $headers;
    }

    

    /**
     * Genera un token de autenticación.
     *
     * @return string Token de autenticación generado
     */
    private function generateAuthToken()
    {

        // Ejemplo de generación de un token aleatorio de longitud fija
        $tokenLength = 32; // Longitud del token en caracteres
        $characters  = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $token       = '';

        for ($i = 0; $i < $tokenLength; $i++) {
            $randomIndex = mt_rand(0, strlen($characters) - 1);
            $token .= $characters[$randomIndex];
        }

        return $token;
    }

}

<?php
// =============MODELO==============
interface Interface_Modelo
{
    public function Desconectar();
    public function __GET(string $A);
    public function __SET(string $A, $B);
    public function Ejecutar_Simple(string $sql, array $parametro = [], string $forzado = "MIN");
    public function Ejecutar_Detallado(string $sql, array $parametro = [], string $forzado = "MIN", bool $transaccion = false, string $tipo_valor = "detallado", bool $ultimo_id = false);
}

class Modelo extends BASE_DATOS implements Interface_Modelo
{
    protected $PDO;
    protected $datos;
    public $crud;

    public function __construct()
    {
        parent::__construct();
    }

    public function Desconectar()
    {
        if ($this->conexion !== null) {
            $this->conexion = null;
        }
    }
    // =============CREAR VARIABLE PUBLICAS==============

    /**
     * Devuelve el valor de una propiedad.
     *
     * @param string $A Nombre de la propiedad.
     * @return mixed Valor de la propiedad.
     */

    public function __GET(string $A)
    {
        if (property_exists($this, $A)) {
            return $this->{$A};
        }
    }

    /**
     * Establece el valor de una propiedad.
     *
     * @param string $A Nombre de la propiedad.
     * @param mixed $B Valor a asignar.
     */

    public function __SET(string $A, $B)
    {
        if (property_exists($this, $A)) {
            $this->{$A} = $B;
        }
    }

    /**
     * Crea una instancia de la clase CRUD con el valor proporcionado.
     *
     * @param mixed $val Valor a pasar al constructor de la clase CRUD.
     * @return CRUD Instancia de la clase CRUD.
     */

    public function CRUD($val)
    {
        return new CRUD($val);
    }

    /**
     * Obtiene la consulta SQL correspondiente a una función.
     *
     * @param string $fun Nombre de la función.
     * @return string Consulta SQL.
     */

    public function Obtener_SQL($fun): string
    {
        if (method_exists($this, $fun)) {
            return $this->{$fun}();
        }
    }

    /**
     * Ejecuta una consulta SQL y devuelve el resultado. Si se especifica la opción de caché,
     * se guarda el resultado en caché para consultas futuras.
     *
     * @param string $sql La consulta SQL a ejecutar.
     * @param array $parametros Los parámetros de la consulta SQL.
     * @param string $forzado Opción para forzar el formato de los valores de los parámetros.
     * @param bool $transaccion Opción para iniciar una transacción.
     * @param string $tipo_valor Opción para definir si los parámetros son detallados o no.
     * @param bool $ultimo_id Opción para obtener el último ID insertado.
     * @param bool $cache Opción para usar la caché.
     *
     * @return mixed El resultado de la consulta o el último ID insertado.
     */
    public function Ejecutar(string $sql, array $parametro = [], string $forzado = "MIN", bool $transaccion = false, string $tipo_valor = "detallado", bool $ultimo_id = false, bool, $filtrado = true)
    {
        $result    = false;
        $ultimo    = null;
        $cache_key = 'query_cache_' . md5($sql . serialize($parametro) . $forzado . $tipo_valor);

        $this->transacciones = new Transacciones($this->conexion, $transaccion);
        $this->cache         = new Cache($cache, $cache_key, $ultimo_id);

        if ($cache_result = $this->cache->Iniciar()) {return $cache_result;}

        $this->transacciones->Comenzar();

        $this->PDO = $this->conexion->prepare($sql);

        foreach ($parametro as $key => $value) {
            $value = $forzado === 'MAY' ? strtoupper($value) : ($forzado === 'MIN' ? strtolower($value) : $value);
            if ($filtrado) {
                $value = $this->Filtrar_Parametro($value);
                $value = $this->conexion->quote($value);
            }

            if ($tipo_valor === "detallado") {
                $this->PDO->bindParam(":$key", $value, $this->Tipo_Parametro($value), strlen($value));
            } else {
                $this->PDO->bindValue(":$key", $value, $this->Tipo_Parametro($value));
            }
        }

        $this->PDO->execute();

        if (strpos(strtolower($sql), 'select') === 0) {
            $this->PDO->setFetchMode(PDO::FETCH_ASSOC);
            $result = $this->PDO->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $result = $this->PDO->rowCount() ? true : false;

            if ($ultimo_id && strpos(strtolower($sql), 'insert') === 0) {
                $ultimo = $this->conexion->lastInsertId();
            }
        }

        $this->transacciones->Finalizar($result);

        if ($this->PDO->errorInfo()[0] !== '00000') {
            Errores::Capturar()->Personalizado('Error en la sentencia: [' . $sql . "] Parametro [" . $parametro . "] \n" . $this->PDO->errorInfo()[2]);
        }

        $this->cache->Finalizar($result, $ultimo);

        return $ultimo_id ? $ultimo : $result;
    }

    /**
     * Determina el tipo de parámetro para su enlace en la consulta preparada.
     *
     * @param mixed $value El valor del parámetro.
     * @return int El tipo de parámetro PDO correspondiente.
     */

    private function Tipo_Parametro($value)
    {
        switch (gettype($value)) {
            case 'integer':
                return PDO::PARAM_INT;
            case 'boolean':
                return PDO::PARAM_BOOL;
            case 'NULL':
                return PDO::PARAM_NULL;
            case 'resource':
                return PDO::PARAM_LOB;
            case 'object':
                if ($value instanceof PDOStatement) {
                    return PDO::PARAM_STMT;
                }
            default:
                return PDO::PARAM_STR;
        }
    }

    /**
     * Filtra y sanitiza el valor del parámetro antes de utilizarlo en la consulta.
     *
     * @param mixed $valor El valor del parámetro a filtrar.
     * @return mixed El valor del parámetro filtrado y sanitizado.
     */

    private function Filtrar_Parametro($valor)
    {
        switch (true) {
            case is_string($valor):
                $valor          = filter_var($valor, FILTER_SANITIZE_STRING);
                $valor          = preg_replace("/[^a-zA-Z0-9_.-\s]/", "", trim($valor));
                $palabras_clave = array("SELECT", "INSERT", "UPDATE", "DELETE", "WHERE", "DROP");
                foreach ($palabras_clave as $palabra) {
                    $valor = str_ireplace($palabra, "", $valor);
                }
                return $valor;
            case filter_var($valor, FILTER_VALIDATE_EMAIL):
                return filter_var($valor, FILTER_SANITIZE_EMAIL);
            case is_numeric($valor):
                return filter_var($valor, FILTER_SANITIZE_NUMBER_INT);
            case is_bool($valor):
                return filter_var($valor, FILTER_SANITIZE_BOOL);
            case DateTime::createFromFormat('Y-m-d', $valor) !== false:
                return filter_var($valor, FILTER_SANITIZE_STRING);
            case is_array($valor):
                return filter_var_array($valor, FILTER_SANITIZE_STRING);
            case is_uploaded_file($valor['tmp_name']):
                return $valor;
            case is_string($valor) && preg_match('/^<[\w]+(?!.*?<[\w]+).*?>.*?<\/[\w]+>$/', $valor):
                return filter_var($valor, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
            case filter_var($valor, FILTER_VALIDATE_URL):
                return filter_var($valor, FILTER_SANITIZE_URL);
            case DateTime::createFromFormat('H:i', $valor) !== false:
                return filter_var($valor, FILTER_SANITIZE_STRING);
            default:
                return null;
        }
    }

}

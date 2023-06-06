<?php
// set_error_handler(function($errno, $errstr, $errfile, $errline) {
        //     $log = date('[Y-m-d H:i:s]') . " Error $errno: $errstr en $errfile:$errline\n";
        //     error_log($log, 3, 'errores.log');
        // });
class PRUEBAS
{
    #Public: acceso sin restricción.
    #Protected:Solo puede ser accesado por una clase heredada y la clase que lo define.
    #Private:Solo puede ser accesado por la clase que lo define.

    protected $PDO;
    protected $datos;
    private $entidad;
    public $crud;

    public function __construct()
    {
        parent::__construct();
    }

    public function Desconectar()
    {
        $this->conexion = null;
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
        return $this->{$A} = $B;
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

    /**
     * Realiza acciones en las entidades asociadas al modelo.
     *
     * @param string $accion La acción a realizar: "obtener" o "establecer".
     * @param string|null $nombre El nombre de la propiedad de la entidad.
     * @param mixed|null $parametro El valor a establecer en la propiedad de la entidad.
     * @return mixed La entidad o el resultado de la acción realizada.
     */
    public function Entidades($accion = '', $nombre = null, $parametro = null)
    {
        if ($accion === 'obtener' && !empty($nombre)) {
            // Verificar si la función existe en la entidad y devolver su resultado
            if (method_exists($this->entidad, "get_$nombre")) {
                return $this->entidad->{"get_$nombre"}();
            }
        } elseif ($accion === 'establecer' && !empty($nombre)) {
            // Verificar si la función existe en la entidad y establecer el valor
            if (method_exists($this->entidad, "set_$nombre")) {
                $this->entidad->{"set_$nombre"}($parametro);
            }
        }
        return $this->entidad;
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
    public function Ejecutar(string $sql, array $parametro = [], array $options)
    {
        $this->Establecer_Parametros();

        if ($cache_result = $this->cache->Iniciar()) {return $cache_result;}

        $this->transacciones->Comenzar();

        $this->Consulta_Preparada();
        $this->Resultado();

        $this->transacciones->Finalizar($result);

        $this->Fallo_Sentencia();

        $this->cache->Finalizar($result, $ultimo);

        return $ultimo_id ? $ultimo : $result;
    }

    public function Consulta_Preparada()
    {
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
    }

    public function Resultado()
    {
        if (strpos(strtolower($sql), 'select') === 0) {
            $this->PDO->setFetchMode(PDO::FETCH_ASSOC);
            $result = $this->PDO->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $result = $this->PDO->rowCount() ? true : false;

            if ($ultimo_id && strpos(strtolower($sql), 'insert') === 0) {
                $ultimo = $this->conexion->lastInsertId();
            }
        }
    }

    public function Fallo_Sentencia()
    {
        if ($this->PDO->errorInfo()[0] !== '00000') {
            Errores::Capturar()->Personalizado('Error en la sentencia: [' . $sql . "] Parametro [" . $parametro . "] \n" . $this->PDO->errorInfo()[2]);
        }
    }

    public function Establecer_Parametros()
    {
        $result    = false;
        $ultimo    = null;
        $cache_key = 'query_cache_' . md5($sql . serialize($parametro) . $forzado . $tipo_valor);

        $this->transacciones = new Transacciones($this->conexion, $transaccion);
        $this->cache         = new Cache($cache, $cache_key, $ultimo_id);
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

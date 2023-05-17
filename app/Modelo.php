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
    #Public: acceso sin restricción.
    #Protected:Solo puede ser accesado por una clase heredada y la clase que lo define.
    #Private:Solo puede ser accesado por la clase que lo define.

    protected $PDO;
    protected $datos;
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

    public function __GET($A)
    {
        return $this->$A;
    }
    public function __SET($A, $B)
    {
        return $this->$A = $B;
    }

    public function CRUD($val)
    {
        return new CRUD($val);
    }

    public function Obtener_SQL($fun): string
    {
        return $this->{$fun}();
    }

    public function Ejecutar_Simple(string $sql, array $parametro = [], string $forzado = "MIN")
    {
        $this->PDO = $this->conexion->prepare($sql);
        foreach ($parametro as $key => $value) {
            $value = $forzado === 'MAY' ? strtoupper($value) : ($forzado === 'MIN' ? strtolower($value) : $value);
            $value = $this->Filtrar_Parametro($value);
            $value = $this->conexion->quote($value);
            $this->PDO->bindParam($key, $value, $this->Tipo_Parametro($value), strlen($value));
        }
        $this->PDO->execute();

        if (strpos(strtolower($sql), 'select') === 0) {
            $this->PDO->setFetchMode(PDO::FETCH_ASSOC);
            return $this->PDO->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return $this->PDO->rowCount() ? true : false;
        }
    }

    public function Ejecutar_Detallado(string $sql, array $parametro = [], string $forzado = "MIN", bool $transaccion = false, string $tipo_valor = "detallado", bool $ultimo_id = false)
    {
        if ($transaccion) {
            $this->conexion->beginTransaction();
        }

        $this->PDO = $this->conexion->prepare($sql);

        foreach ($parametro as $key => $value) {
            $value = $forzado === 'MAY' ? strtoupper($value) : ($forzado === 'MIN' ? strtolower($value) : $value);
            $value = $this->Filtrar_Parametro($value);
            $value = $this->conexion->quote($value);

            if ($tipo_valor === "detallado") {
                $this->PDO->bindParam($key, $value, $this->Tipo_Parametro($value), strlen($value));
            } else {
                $this->PDO->bindValue($key, $value, $this->Tipo_Parametro($value));
            }
        }

        $this->PDO->execute();

        $result = false;
        $ultimo = null;

        if (strpos(strtolower($sql), 'select') === 0) {
            $this->PDO->setFetchMode(PDO::FETCH_ASSOC);
            $result = $this->PDO->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $result = $this->PDO->rowCount() ? true : false;

            if ($ultimo_id && strpos(strtolower($sql), 'insert') === 0) {
                $ultimo = $this->conexion->lastInsertId();
            }
        }

        if ($transaccion) {
            if ($result) {
                $this->conexion->commit();
            } else {
                $this->conexion->rollBack();
            }
        }
        
        if ($this->PDO->errorInfo()[0] !== '00000') {
            Errores::Capturar()->Personalizado('Error en la sentencia: [' . $sql . "] \n" . $this->PDO->errorInfo()[2]);
        }

        return $ultimo_id ? $ultimo : $result;
    }

    private function Tipo_Parametro($value)
    {
        if (is_int($value)) {
            return PDO::PARAM_INT;
        } elseif (is_bool($value)) {
            return PDO::PARAM_BOOL;
        } elseif (is_null($value)) {
            return PDO::PARAM_NULL;
        } elseif (is_resource($value)) {
            return PDO::PARAM_LOB;
        } elseif ($value instanceof PDOStatement) {
            return PDO::PARAM_STMT;
        } else {
            return PDO::PARAM_STR;
        }
    }

    private function Filtrar_Parametro($valor)
    {
        if (is_string($valor)) {
            $valor          = filter_var($valor, FILTER_SANITIZE_STRING);
            $valor          = preg_replace("/[^a-zA-Z0-9_.-\s]/", "", trim($valor));
            $palabras_clave = array("SELECT", "INSERT", "UPDATE", "DELETE", "WHERE", "DROP");
            foreach ($palabras_clave as $palabra) {$valor = str_ireplace($palabra, "", $valor);}
            return $valor;
        } elseif (filter_var($valor, FILTER_VALIDATE_EMAIL)) {
            return filter_var($valor, FILTER_SANITIZE_EMAIL);
        } elseif (is_numeric($valor)) {
            return filter_var($valor, FILTER_SANITIZE_NUMBER_INT);
        } elseif (is_bool($valor)) {
            return filter_var($valor, FILTER_SANITIZE_BOOL);
        } elseif (DateTime::createFromFormat('Y-m-d', $valor) !== false) {
            return filter_var($valor, FILTER_SANITIZE_STRING);
        } elseif (is_array($valor)) {
            return filter_var_array($valor, FILTER_SANITIZE_STRING);
        } elseif (is_uploaded_file($valor['tmp_name'])) {
            return $valor;
        } elseif (is_string($valor) && preg_match('/^<[\w]+(?!.*?<[\w]+).*?>.*?<\/[\w]+>$/', $valor)) {
            return filter_var($valor, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
        } elseif (filter_var($valor, FILTER_VALIDATE_URL)) {
            return filter_var($valor, FILTER_SANITIZE_URL);
        } elseif (DateTime::createFromFormat('H:i', $valor) !== false) {
            return filter_var($valor, FILTER_SANITIZE_STRING);
        } else {
            return null;
        }
    }

}

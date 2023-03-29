<?php
// =============MODELO==============
interface Interface_Modelo
{
    public function Desconectar();
    public function __GET(string $A);
    public function __SET(string $A, $B);
    public function Ejecutar(string $sql, array $parametro = [], string $forzado = "MIN");
}

class Modelo extends BASE_DATOS implements Interface_Modelo
{
    #Public: acceso sin restricción.
    #Protected:Solo puede ser accesado por una clase heredada y la clase que lo define.
    #Private:Solo puede ser accesado por la clase que lo define.

    protected $PDO;
    protected $datos;

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

    public function Ejecutar(string $sql, array $parametro = [], string $forzado = "MIN")
    {
        $this->PDO = $this->conexion->prepare($sql);
        foreach ($parametro as $key => $value) {
            $value = $forzado === 'MAY' ? strtoupper($value) : ($forzado === 'MIN' ? strtolower($value) : $value);
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

    public function Ejecutar2(string $sql, array $parametro = [], string $forzado = "MIN", bool $transaccion = false)
    {
        if ($transaccion) {
            $this->PDO = $this->conexion->beginTransaction();
        }

        $this->PDO = $this->conexion->prepare($sql);
        foreach ($parametro as $key => $value) {
            $value = $forzado === 'MAY' ? strtoupper($value) : ($forzado === 'MIN' ? strtolower($value) : $value);
            $this->PDO->bindParam($key, $value, $this->Tipo_Parametro($value), strlen($value));
        }
        $this->PDO->execute();

        if (strpos(strtolower($sql), 'select') === 0) {
            $this->PDO->setFetchMode(PDO::FETCH_ASSOC);
            $result = $this->PDO->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $result = $this->PDO->rowCount() ? true : false;
        }

        if ($transaccion) {
            if ($result) {
                $this->PDO = $this->conexion->commit();
            } else {
                $this->PDO = $this->conexion->rollBack();
            }
        }

        return $result;
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
}

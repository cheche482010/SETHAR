<?php
// =============MODELO==============

class Modelo extends BASE_DATOS
{
    #Public: acceso sin restricción.
    #Protected:Solo puede ser accesado por una clase heredada y la clase que lo define.
    #Private:Solo puede ser accesado por la clase que lo define.

    public function __construct()
    {
        parent::__construct();
    }

    public function Desconectar()
    {
        return $this->conexion->close();
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

    protected function Ejecutar($sql, $parametro = [])
    {
        $this->PDO = $this->conexion->prepare($sql);
        foreach ($parametro as $key => $value) {
            $this->PDO->bindParam($key, $value, $this->Tipo_Parametro($value), $value["longitud"]);
        }
        $this->PDO->execute();

        if (strpos(strtolower($sql), 'select') === 0) {
            $this->PDO->setFetchMode(PDO::FETCH_ASSOC);
            return $this->PDO->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return $this->PDO->rowCount() ? true : false;
        }
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

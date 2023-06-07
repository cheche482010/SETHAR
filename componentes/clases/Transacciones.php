<?php

class Transacciones
{
    private $PDO;
    private $transaccion;

    public function __construct($conexion, $transaccion)
    {
        $this->PDO         = $conexion;
        $this->transaccion = $transaccion;
    }

    public function Comenzar()
    {
        if ($this->transaccion) {
            $this->PDO->beginTransaction();
        }
    }

    public function Confirmar()
    {
        $this->PDO->commit();
    }

    public function Verificar()
    {
        return $this->PDO->inTransaction();
    }

    public function Revertir()
    {
        $this->PDO->rollBack();
    }

    public function Finalizar($result)
    {
        if ($this->transaccion && $this->Verificar()) {
            if ($result !== false) {
                $this->Confirmar();
            } else {
                $this->Revertir();
            }
        }
    }
}

<?php

class CRUD
{
    private $tipo;
    private $tabla;
    private $columna;
    private $estado;
    private $id;
    private $orden;

    public function __construct(string $tipo)
    {
        $this->tipo = $tipo;
    }

    public function __call($metodo, $argumentos)
    {
        $metodo = strtolower($metodo);
        $valor  = $argumentos[0];

        switch ($metodo) {
            case 'tabla':
                $this->tabla = $valor;
                break;
            case 'columna':
                $this->columna = $valor;
                break;
            case 'estado':
                $this->estado = $valor;
                break;
            case 'id':
                $this->id = $valor;
                break;
            case 'orden':
                $this->orden = $valor;
                break;
            default:
                throw new Exception('Método no válido.');
        }

        return $this;
    }

    public function getSQL(): string
    {
        switch ($this->tipo) {
            case 'consultar':
                $sql = "SELECT * FROM {$this->tabla}";

                if (!empty($this->estado)) {
                    $sql .= " WHERE estado = '{$this->estado}'";
                }

                if (!empty($this->orden)) {
                    $sql .= " ORDER BY {$this->orden} ASC";
                }

                return $sql;

            case 'registrar':
                $sql = "INSERT INTO {$this->tabla} ({$this->columna}, estado) VALUES (:{$this->columna}, :estado)";
                return $sql;

            case 'editar':
                $sql = "UPDATE {$this->tabla} SET {$this->columna} = :{$this->columna} WHERE {$this->id} = :{$this->id}";
                return $sql;

            default:
                throw new Exception('Tipo de operación no válido.');
        }
    }
}

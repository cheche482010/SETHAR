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
                $sql = 'INSERT INTO ' . $this->tabla . ' (' . $this->columna . ', estado) VALUES (:' . $this->columna . ', :estado)';
                return $sql;

            case 'editar':
                $sql = 'UPDATE ' . $this->tabla . ' SET ' . $this->columna . ' = :' . $this->columna . ' WHERE ' . $this->id . ' = :' . $this->id;
                return $sql;

            case 'eliminar':
                $sql = 'DELETE FROM ' . $this->tabla . ' WHERE ' . $this->id . ' = :' . $this->id;
                return $sql;

            case 'buscar':
                $sql = 'SELECT * FROM ' . $this->tabla . ' WHERE ' . $this->columna . ' = :' . $this->columna;
                return $sql;

            case 'listar':
                $sql = 'SELECT * FROM ' . $this->tabla . ' ORDER BY ' . $this->orden . ' ASC';
                return $sql;

            case 'maximo':
                $sql = 'SELECT MAX(' . $this->id . ') FROM ' . $this->tabla;
                return $sql;

            case 'contar':
                $sql = 'SELECT COUNT(*) AS count FROM ' . $this->tabla . ' WHERE ' . $this->columna . ' = :' . $this->columna . ' AND estado = 1';
                return $sql;

            case 'join':
                if (empty($this->tabla) || empty($this->columna) || empty($this->id)) {
                    throw new Exception('Faltan parámetros para crear la consulta JOIN.');
                }
                $sql       = "SELECT * FROM {$this->tabla} ";
                $this->joinTabla = $this->columna;
                $this->joinId    = $this->id;
                if (!empty($this->estado)) {
                    $sql .= " WHERE estado = :estado";
                }
                if (!empty($this->orden)) {
                    $sql .= " ORDER BY {$this->orden} ASC";
                }
                $sql .= " {$this->joinType} {$this-$this->joinTabla} ON {$this->tabla}.{$this->joinId} = {$this->joinTabla}.{$this->joinId}";
                return $sql;

            case 'vaciar':
                $sql = "TRUNCATE TABLE {$this->tabla}";
                return $sql;

            case 'crear_tabla':
                $sql = "CREATE TABLE {$this->tabla} ({$this->columna})";
                return $sql;

            case 'modificar_modificar':
                $sql = "ALTER TABLE {$this->tabla} {$this->accion}";
                return $sql;

            case 'crear_indice':
                $sql = "CREATE INDEX {$this->nombre_indice} ON {$this->tabla} ({$this->columna})";
                return $sql;

            case 'seleccionar_nuevo':
                $sql = "SELECT * INTO {$this->nuevo_nombre_tabla} FROM {$this->tabla} WHERE {$this->condicion}";
                return $sql;

            case 'otorgar_permiso':
                $sql = "GRANT {$this->permisos} ON {$this->objeto} TO {$this->usuario}";
                return $sql;

            case 'revocar_permiso':
                $sql = "REVOKE {$this->permisos} ON {$this->objeto} FROM {$this->usuario}";
                return $sql;

            default:
                throw new Exception('Tipo de operación no válido.');
        }
    }

}

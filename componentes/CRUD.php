<?php

class CRUD
{
    private $tabla;
    private $columna;
    private $estado;
    private $id;
    private $orden;
    private $joinTabla;
    private $joinId;
    private $joinType;
    private $nombre_indice;
    private $nuevo_nombre_tabla;
    private $usuario;
    private $objeto;
    private $accion;
    private $condicion;

    public function __construct(string $tipo = null)
    {
        $this->tipo = $tipo;
    }

    public function __call($metodo, $argumentos)
    {
        $metodo = strtolower($metodo);
        $valor  = $argumentos[0];
        $valor  = (is_string($valor) && preg_match('/^[a-zA-Z0-9_\-\.]+$/', $valor)) ? filter_var($valor, FILTER_SANITIZE_STRING) : false;

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
            case 'jointabla':
                $this->joinTabla = $valor;
                break;
            case 'joinid':
                $this->joinId = $valor;
                break;
            case 'jointype':
                $this->joinType = $valor;
                break;
            case 'nombre_indice':
                $this->nombre_indice = $valor;
                break;
            case 'nuevo_nombre_tabla':
                $this->nuevo_nombre_tabla = $valor;
                break;
            case 'usuario':
                $this->usuario = $valor;
                break;
            case 'objeto':
                $this->objeto = $valor;
                break;
            case 'accion':
                $this->accion = $valor;
                break;
            case 'condicion':
                $this->condicion = $valor;
                break;
            default:
                Errores::Capturar()->Personalizado("El método {$metodo} es inválido \nArchivo: " . __DIR__);
                break;
        }

        return $this;
    }

    public function SQL(): string
    {
        $sql = "";
        switch ($this->tipo) {
            case 'consultar':
                $sql = "SELECT * FROM {$this->tabla}";

                if (!empty($this->estado)) {
                    $sql .= " WHERE estado = '{$this->estado}'";
                }

                if (!empty($this->orden)) {
                    $sql .= " ORDER BY {$this->orden} ASC";
                }

                break;

            case 'registrar':
                $sql = "INSERT INTO  {$this->tabla}  ({$this->columna}) VALUES (:{$this->columna})";
                break;

            case 'editar':
                $sql = "UPDATE {$this->tabla} SET {$this->columna} = :{$this->columna}  WHERE  {$this->id}  = :{$this->id}";
                break;

            case 'eliminar':
                $sql = "DELETE FROM {$this->tabla} WHERE {$this->id} = :{$this->id}";
                break;

            case 'buscar':
                $sql = "SELECT * FROM {$this->tabla} WHERE {$this->columna} = :{$this->columna}";
                break;

            case 'listar':
                $sql = "SELECT * FROM {$this->tabla} ORDER BY {$this->orden} ASC";
                break;

            case 'maximo':
                $sql = "SELECT MAX({$this->id}) FROM {$this->tabla}";
                break;

            case 'contar':
                $sql = "SELECT COUNT(*) AS count FROM {$this->tabla}  WHERE {$this->columna} = :{$this->columna}";
                break;

            case 'join':
                if (empty($this->tabla) || empty($this->columna) || empty($this->id)) {
                    throw new Exception('Faltan parámetros para crear la consulta JOIN.');
                }
                $sql             = "SELECT * FROM {$this->tabla} ";
                $this->joinTabla = $this->columna;
                $this->joinId    = $this->id;
                if (!empty($this->estado)) {
                    $sql .= " WHERE estado = :estado";
                }
                if (!empty($this->orden)) {
                    $sql .= " ORDER BY {$this->orden} ASC";
                }
                $sql .= " {$this->joinType} {$this->joinTabla} ON {$this->tabla}.{$this->joinId} = {$this->joinTabla}.{$this->joinId}";
                break;

            case 'seleccionar_nuevo':
                $sql = "SELECT * INTO {$this->nuevo_nombre_tabla} FROM {$this->tabla} WHERE {$this->condicion}";
                break;

            default:
                Errores::Capturar()->Personalizado("La peticion solicitada {$this->tipo} es invalida \nArchivo: " . __DIR__);
                break;
        }
        return $sql;
        exit();
    }

}

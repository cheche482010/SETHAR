<?php

class CRUD
{
    private $tipo;
    private $tabla;
    private $columna;
    private $estado;
    private $id;
    private $orden;

    public function __construct(string $tipo = null)
    {
        $this->tipo = $tipo;
    }

    public function __call($metodo, $argumentos)
    {
        $metodo = strtolower($metodo);
        $valor  = $argumentos[0];
        $valor = (is_string($valor) && preg_match('/^[a-zA-Z0-9_\-\.]+$/', $valor)) ? filter_var($valor, FILTER_SANITIZE_STRING) : false;

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
                 Errores::Capturar()->Personalizado("el metodo {$metodo} es invalido \nArchivo: ".__DIR__);
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
                $sql       = "SELECT * FROM {$this->tabla} ";
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

            case 'vaciar':
                $sql = "TRUNCATE TABLE {$this->tabla}";
                break;

            case 'crear_tabla':
                $sql = "CREATE TABLE {$this->tabla} ({$this->columna})";
                break;

            case 'modificar_modificar':
                $sql = "ALTER TABLE {$this->tabla} {$this->accion}";
                break;

            case 'crear_indice':
                $sql = "CREATE INDEX {$this->nombre_indice} ON {$this->tabla} ({$this->columna})";
                break;

            case 'seleccionar_nuevo':
                $sql = "SELECT * INTO {$this->nuevo_nombre_tabla} FROM {$this->tabla} WHERE {$this->condicion}";
                break;

            case 'otorgar_permiso':
                $sql = "GRANT {$this->permisos} ON {$this->objeto} TO {$this->usuario}";
                break;

            case 'revocar_permiso':
                $sql = "REVOKE {$this->permisos} ON {$this->objeto} FROM {$this->usuario}";
                break;

            default:
                 Errores::Capturar()->Personalizado("La peticion solicitada {$this->tipo} es invalida \nArchivo: ".__DIR__);
                break;
        }
        return $sql;
        exit();
    }

}

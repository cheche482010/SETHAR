<?php

class Ejemplo_Modelo extends Modelo
{
    #Public: acceso sin restricción.
    #Private:Solo puede ser accesado por la clase que lo define.

    private $SQL;
    private $datos;
    private $opciones;
    private $sentencia;
    private $configuracion;
    private $opciones_predeterminadas;

    public $resultado; #resultado de consultas de la bd

    public function __construct()
    {
        parent::__construct();

        $this->opciones_predeterminadas = [
            'forzado'     => 'MIN',
            'transaccion' => false,
            'tipo_valor'  => 'detallado',
            'ultimo_id'   => false,
        ];
    }

    public function Configurar(array $configuracion): self
    {
        $this->configuracion = $configuracion;
        $this->SQL           = isset($this->configuracion['sql']) ? $this->configuracion['sql'] : null;
        $this->datos         = isset($this->configuracion['datos']) ? $this->configuracion['datos'] : null;
        $this->opciones      = isset($this->configuracion['opciones']) ? array_merge($this->opciones_predeterminadas, $this->configuracion['opciones']) : $this->opciones_predeterminadas;
        return $this;
    }

    private function Sentencia():  ? string
    {
        $this->class = new Clases("Ejemplo_Modelo");
        return $this->class->verificar_funcion($this->SQL) ? $this->{$this->SQL}() : Errores::Capturar()->Personalizado('No existe la funcion : ' . $this->SQL . "() \nEn la clase: " . $this->class->nombre_clase() . "\nArchivo: " . __FILE__);
    }

    public function Administrar(string $tipo = 'simple', array $opciones = []) : mixed
    {
        $this->sentencia = $this->Sentencia();
        try {
            $this->resultado = ($tipo === 'detallado') ? $this->Ejecutar_Detallado($this->sentencia, $this->datos, $this->opciones['forzado'], $this->opciones['transaccion'], $this->opciones['tipo_valor'], $this->opciones['ultimo_id']) : $this->Ejecutar_Simple($this->sentencia, $this->datos);
            $this->Desconectar();
            return $this->resultado;
        } catch (PDOException $e) {
            Errores::Capturar()->Manejo_Excepciones($e);
        }
    }

    public function SQL_01(): string
    {
        return $this->CRUD('consultar')->tabla('tabla')->orden('columna')->SQL();
    }

    public function SQL_02(): string
    {
        return $this->CRUD('registrar')->tabla('tabla')->columna('columna')->SQL();
    }

    public function SQL_03(): string
    {
        return $this->CRUD('editar')->tabla('tabla')->columna('columna')->id('id')->SQL();
    }

    public function SQL_04(): string
    {
        return $this->CRUD('eliminar')->tabla('tabla')->id('id')->SQL();
    }

    public function SQL_05(): string
    {
        return $this->CRUD('buscar')->tabla('tabla')->columna('columna')->SQL();
    }

    public function SQL_06(): string
    {
        return $this->CRUD('listar')->tabla('tabla')->orden('columna')->SQL();
    }

    public function SQL_07(): string
    {
        return $this->CRUD('maximo')->tabla('tabla')->id('id')->SQL();
    }

    public function SQL_08(): string
    {
        return $this->CRUD('contar')->tabla('tabla')->columna('columna')->SQL();
    }

    public function SQL_09(): string
    {
        return $this->CRUD('join')->tabla('tabla1')->columna('columna1')->id('id1')->estado('estado')->orden('columna2')->joinTabla('tabla2')->joinId('id2')->joinType('INNER')->SQL();
    }

    public function SQL_10(): string
    {
        return $this->CRUD('vaciar')->tabla('tabla')->SQL();
    }

    public function SQL_11(): string
    {
        return $this->CRUD('crear_tabla')->tabla('tabla')->columna('columna1 INT, columna2 VARCHAR(255), columna3 DATE')->SQL();
    }

    public function SQL_12(): string
    {
        return $this->CRUD('modificar_tabla')->tabla('tabla')->accion('ADD COLUMN columna1 INT')->SQL();
    }

    public function SQL_13(): string
    {
        return $this->CRUD('crear_indice')->nombre_indice('indice1')->tabla('tabla')->columna('columna')->SQL();
    }

    public function SQL_14(): string
    {
        return $this->CRUD('seleccionar_nuevo')->nuevo_nombre_tabla('nueva_tabla')->tabla('tabla')->condicion('condicion')->SQL();
    }

    public function SQL_15(): string
    {
        return $this->CRUD('otorgar_permiso')->permisos('permisos')->objeto('objeto')->usuario('usuario')->SQL();
    }

    public function SQL_16(): string
    {
        return $this->CRUD('revocar_permiso')->permisos('permisos')->objeto('objeto')->usuario('usuario')->SQL();
    }

}

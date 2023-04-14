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

        $this->sentencia = $this->Sentencia();
    }

    public function Configurar(array $configuracion): self
    {
        $this->configuracion = $configuracion;
        if (isset($this->configuracion['SQL'])) {$this->SQL = $this->configuracion['SQL'];}

        if (isset($this->configuracion['datos'])) {$this->datos = $this->configuracion['datos'];}

        if (isset($this->configuracion['opciones'])) {
            $this->opciones = array_merge($this->opciones_predeterminadas, $this->configuracion['opciones']);
        }

        return $this;
    }

    private function Sentencia():  ? string
    {
        $this->class = new Clases("Ejemplo_Modelo");
        return $this->class->verificar_funcion($this->SQL) ? $this->{$this->SQL}() : Errores::Capturar()->Personalizado('No existe la funcion : ' . $this->SQL . "() \nEn la clase: " . $this->class->nombre_clase() . "\nArchivo: " . __FILE__);
    }

    public function Administrar(string $tipo = 'simple', array $opciones = []) : mixed
    {
        try {
            $this->resultado = ($tipo === 'detallado') ? $this->($this->sentencia, $this->datos, $this->opciones['forzado'], $this->opciones['transaccion'], $this->opciones['tipo_valor'], $this->opciones['ultimo_id']) : $this->($this->sentencia, $this->datos);
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

}

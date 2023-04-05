<?php

class Ejemplo_Modelo extends Modelo
{
    #Public: acceso sin restricción.
    #Private:Solo puede ser accesado por la clase que lo define.

    private $SQL; #nombre de la sentencia SQL que se ejecutara en el modelo
    private $sentencia; #sentencia sql que se ejecutara

    public $resultado; #resultado de consultas de la bd

    public function __construct()
    {parent::__construct();}

    // SETTER estaablece los datos a usar en el modelo (tipo void no retornan un valor)
    public function _SQL_(string $SQL): self
    {$this->SQL = $SQL;return $this;}

    public function _Datos_(array $datos): self
    {$this->datos = $datos;return $this;}

    private function Sentencia():  ? string
    {
        $this->class = new Clases("Ejemplo_Modelo");
        return $this->class->verificar_funcion($this->SQL) ? $this->{$this->SQL}() : Errores::Capturar()->Personalizado('No existe la funcion : ' . $this->SQL . "() \nEn la clase: " . $this->class->nombre_clase() . "\nArchivo: " . __FILE__);
    }

    public function Administrar(string $tipo = 'simple', array $opciones = []) : mixed
    {
        // Definir opciones predeterminadas
        $this->opciones_predeterminadas = [
            'forzado'     => 'MIN',
            'transaccion' => false,
            'tipo_valor'  => 'detallado',
            'ultimo_id'   => false,
        ];

        // Fusionar opciones predeterminadas con opciones proporcionadas
        $this->opciones = array_merge($this->opciones_predeterminadas, $opciones);

        $this->sentencia = $this->Sentencia();
        try {
            $this->resultado = ($tipo === 'detallado') ? $this->Ejecutar_Detallado($this->sentencia, $this->datos, $this->opciones['forzado'], $this->opciones['transaccion'], $this->opciones['tipo_valor'], $this->opciones['ultimo_id']) : $this->Ejecutar_Simple($this->sentencia, $this->datos);
            $this->Desconectar();
            return $this->resultado;
        } catch (PDOException $e) {
            Errores::Capturar()->Manejo_Excepciones($e);
        }
    }

}

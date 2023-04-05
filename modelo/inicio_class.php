<?php

class Inicio_Modelo extends Modelo
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
    {$this->SQL = $SQL; return $this;}

    public function _Datos_(array $datos): self
    {$this->datos = $datos;return $this;}

    public function Get()
    {

    }

    private function Sentencia():? string
    {
        $this->class = new Clases("Inicio_Modelo");
        return $this->class->verificar_funcion($this->SQL) ? $this->{$this->SQL}() : Errores::Capturar()->Personalizado('No existe la funcion : ' . $this->SQL . "() \nEn la clase: " . $this->class->nombre_clase() . "\nArchivo: " . __FILE__);
    }

    public function Administrar():mixed
    {
        $this->sentencia = $this->Sentencia();
        try {
            $this->resultado = $this->Ejecutar_Detallado($this->sentencia,$this->datos);
            $this->Desconectar();
            return $this->resultado;

        } catch (PDOException $e) {
            Errores::Capturar()->Manejo_Excepciones($e);
        }
    }

    public function SQL_01(): string
    {
        return $this->CRUD('consultar')->tabla('plantas')->orden('id_plantas')->SQL();
    }

}

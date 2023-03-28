<?php

class Ejemplo_Modelo extends Modelo
{
    #Public: acceso sin restricción.
    #Private:Solo puede ser accesado por la clase que lo define.

    private $SQL; #nombre de la sentencia SQL que se ejecutara en el modelo
    private $tipo; #tipo de peticion que usaremos 1/0
    private $DBAL; #sentecia sql iniciada con prepare
    private $sentencia; #sentencia sql que se ejecutara
    private $datos; #datos a ejecutar para enviar a la bd

    public $resultado; #resultado de consultas de la bd

    public function __construct()
    {parent::__construct();}

    // SETTER estaablece los datos a usar en el modelo (tipo void no retornan un valor)
    public function _SQL_(string $SQL): void
    {$this->SQL = $SQL;}
    public function _Tipo_(int $tipo): void
    {$this->tipo = $tipo;}
    public function _Datos_(array $datos): void
    {$this->datos = $datos;}

    public function Get()
    {

    }

    public function Administrar()
    {
        $this->sentencia = $this->{$this->SQL}(); #funcion anonima en espera de asignar nombre
        try {
            $this->resultado = $this->Ejecutar($this->sentencia);
            $this->Desconectar();
            return $this->resultado;

        } catch (PDOException $e) {
            Errores::Capturar()->Manejo_Excepciones($e);
        }
    }

    private function SQL_02(): string
    {
        return "SELECT p.* FROM plantas p JOIN relaciones r ON p.id = r.planta_id JOIN caracteristicas c ON r.caracteristica_id = c.id WHERE p.habitat_id = :habitad AND c.nombre = :caracteristicas";
    }
}

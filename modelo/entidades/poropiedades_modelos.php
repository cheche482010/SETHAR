<?php

trait Propiedades_Modelo
{
	 /**
     * Datos del modelo.
     * @var mixed
     */
    public $datos;

    /**
     * Opciones de configuración.
     * @var array
     */
    public $opciones;

    /**
     * Sentencia actual.
     * @var string|null
     */
    public $sentencia;

    /**
     * Resultado de la operación.
     * @var mixed
     */
    public $resultado;

    /**
     * Sentencia SQL.
     * @var string|null
     */
    protected $SQL;

    /**
     * Entidades del modelo.
     * @var obj|null
     */
    protected $entidad;

    /**
     * Configuración del modelo.
     * @var array|null
     */
    protected $configuracion;

    /**
     * Opciones predeterminadas.
     * @var array
     */
    protected $opciones_predeterminadas;
}
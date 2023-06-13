<?php

class Ejemplos_CRUD
{
    public function consultarPorOrden(): string
    {
        return $this->CRUD('consultar')->tabla('tabla')->orden('columna')->SQL();
    }

    public function registrarRegistro(): string
    {
        return $this->CRUD('registrar')->tabla('tabla')->columna('columna1,columna2,columna3')->SQL();
    }

    public function editarRegistro(): string
    {
        return $this->CRUD('editar')->tabla('tabla')->columna('columna1,columna2,columna3')->id('id')->SQL();
    }

    public function eliminarRegistro(): string
    {
        return $this->CRUD('eliminar')->tabla('tabla')->id('id')->SQL();
    }

    public function buscarRegistro(): string
    {
        return $this->CRUD('buscar')->tabla('tabla')->columna('columna')->SQL();
    }

    public function listarRegistros(): string
    {
        return $this->CRUD('listar')->tabla('tabla')->orden('columna')->SQL();
    }

    public function seleccionarUnico(): string
    {
        return $this->CRUD('select_unico')->tabla('tabla')->columna('columna')->estado('estado')->orden('columna')->SQL();
    }

    public function consultaMultiple(): string
    {
        return $this->CRUD('consulta_multiple')->tabla('tabla')->columna('columna')->estado('estado')->orden('columna')->SQL();
    }

    public function obtenerMaximo(): string
    {
        return $this->CRUD('maximo')->tabla('tabla')->id('id')->SQL();
    }

    public function contarRegistros(): string
    {
        return $this->CRUD('contar')->tabla('tabla')->columna('columna')->SQL();
    }

    public function realizarJoin(): string
    {
        return $this->CRUD('join')->tabla('tabla')->columna('columna')->id('id')->joinTabla('tabla2')->joinId('id')->joinType('INNER')->SQL();
    }

    public function seleccionarNuevo(): string
    {
        return $this->CRUD('seleccionar_nuevo')->tabla('tabla')->nuevo_nombre_tabla('nuevo')->condicion('condicion')->SQL();
    }
}

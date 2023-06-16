<?php

namespace Componentes\Interfaces;

interface Metodos_CRUD
{
    public function tabla(string $valor);

    public function columna(string $valor);

    public function estado(string $valor);

    public function id(string $valor);

    public function orden(string $valor);

    public function joinTabla(string $valor);

    public function joinId(string $valor);

    public function joinType(string $valor);

    public function nombre_indice(string $valor);

    public function nuevo_nombre_tabla(string $valor);

    public function usuario(string $valor);

    public function objeto(string $valor);

    public function accion(string $valor);

    public function condicion(string $valor);

    public function SQL(): string;
}

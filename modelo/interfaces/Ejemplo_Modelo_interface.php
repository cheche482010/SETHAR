<?php

interface Ejemplo_Modelo_interface
{
    public function Configurar(array $configuracion): self;
    public function Sentencia():  ? string;
    public function Administrar(): mixed;
}
<?php

namespace Componentes\Interfaces;

interface Metodos_Clases
{
    public function validar(): bool;

    public function nombre_clase(): string;

    public function archivo(): string;

    public function constantes(): array;

    public function propiedades(): array;

    public function funciones(): array;

    public function instanciar(): object;

    public function clase_padre():  ? string;

    public function traits() : array;

    public function verificar_funcion(string $nombre_funcion): bool;

    public function verificar_funcion_anonima(): bool;

    public function invocar_funcion(string $funcion, $args = null);
}

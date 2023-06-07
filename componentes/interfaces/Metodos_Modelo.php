<?php

namespace Componentes\Interfaces;

interface Metodos_Modelo
{
    public function Desconectar();
    public function __GET(string $A);
    public function __SET(string $A, $B);
    public function CRUD($val);
    public function Obtener_SQL($fun): string;
    public function Entidad_Clase();
    public function Entidades($accion = '', $nombre = null, $parametro = null);
    public function Ejecutar(string $sql, array $parametro = [], string $forzado = "MIN", bool $transaccion = false, string $tipo_valor = "detallado", bool $ultimo_id = false, bool $cache = false, bool $filtrado = true);
}

<?php

namespace Componentes\Interfaces;

interface Metodos_Cache
{
    public function Iniciar();

    public function Obtener_Item($key);

    public function Guardar($item);

    public function Establecer_Item($key, $value, $expiration = 300);

    public function Obtener($key);

    public function Finalizar($result, $ultimo = null);
}
